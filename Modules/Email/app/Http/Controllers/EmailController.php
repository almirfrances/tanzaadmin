<?php

namespace Modules\Email\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Providers\EmailService;
use Modules\Email\Jobs\SendEmail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Settings\Models\Setting;
use Modules\Email\Models\EmailSetting;
use Illuminate\Support\Facades\Artisan;
use Modules\Email\Models\GlobalTemplate;
use Modules\Email\Models\NotificationTemplate;
use Modules\Email\Http\Requests\UpdateEmailSettingsRequest;
use Modules\Email\Http\Requests\NotificationTemplateRequest;
use Modules\Email\Http\Requests\UpdateGlobalTemplateRequest;

class EmailController extends Controller
{

    public function checkQueueStatus()
    {
        // Check if queue worker is running (this is a placeholder; customize for your system)
        $isQueueRunning = false;

        // You can add logic to check for running processes, e.g., using `ps` command
        if (stristr(PHP_OS, 'win')) {
            // Windows system: Check if queue work process is running (customize for Windows)
            $isQueueRunning = false; // Implement suitable logic here
        } else {
            // Linux/Unix: Check queue worker process
            $output = shell_exec("ps aux | grep 'queue:work' | grep -v grep");
            $isQueueRunning = !empty($output);
        }

        $command = '* * * * * php ' . base_path('artisan') . ' queue:work --sleep=3 --tries=3 --timeout=90 >> /dev/null 2>&1';

        return response()->json([
            'isQueueRunning' => $isQueueRunning,
            'cronCommand' => $command,
        ]);
    }

    /**
     * Display the email settings page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function emailSettings()
    {
        $settings = EmailSetting::first();
        return view('email::settings.index', compact('settings'));
    }

    /**
     * Update the email settings.
     *
     * @param  UpdateEmailSettingsRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmailSettings(UpdateEmailSettingsRequest $request)
    {
        try {
            // Validate request (handled automatically by UpdateEmailSettingsRequest)
            Log::info('Updating email settings...', $request->all());

            // Save settings
            $settings = EmailSetting::firstOrCreate([]);
            $providerSettings = $this->getProviderSettings($request);

            $settings->update([
                'provider' => $request->provider,
                'settings' => $providerSettings,
            ]);

            // Clear email settings cache
            cache()->forget('email_settings');



            sweetalert()->success('Email settings updated successfully.');
            return redirect()->back();
        } catch (ValidationException $e) {
            // Catch validation errors
            Log::error('Validation Error:', $e->errors());
            sweetalert()->error('Validation failed. Please check the form and try again.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Catch generic exceptions
            Log::error('Failed to update email settings: ' . $e->getMessage());
            sweetalert()->error('An error occurred while updating email settings. Please try again later.');
            return redirect()->back()->withInput();
        }
    }





    /**
     * Get provider-specific settings.
     */
    private function getProviderSettings(UpdateEmailSettingsRequest $request)
    {
        switch ($request->provider) {
            case 'php_mailer':
                return ['email' => $request->php_mailer_email];
            case 'smtp':
                return [
                    'email' => $request->smtp_email,
                    'host' => $request->smtp_host,
                    'port' => $request->smtp_port,
                    'encryption' => $request->smtp_encryption,
                    'username' => $request->smtp_username,
                    'password' => $request->smtp_password,
                ];
            case 'sendgrid':
                return ['app_key' => $request->sendgrid_app_key];
            case 'mailjet':
                return [
                    'api_public_key' => $request->mailjet_api_public_key,
                    'api_secret_key' => $request->mailjet_api_secret_key,
                ];
            default:
                return [];
        }
    }






    public function testEmail(Request $request, EmailService $emailService)
{
    $request->validate([
        'test_email' => 'required|email',
    ]);

    try {
        $email = $request->test_email;

        // Prepare data for email
        $data = [
            'email' => $email,
            'name' => 'TanzaAdmin',
            'username' => 'tanzaadmin',
            'site_name' => config('app.name'),
            'message' => 'This is a test email to verify the email configuration.',
        ];

        // Send dynamic email
        $emailService->sendDynamicEmail('Test Email', $data);

        sweetalert()->success('Test email sent successfully to ' . $email);
        return redirect()->back();
    } catch (Exception $e) {
        Log::error('Failed to send test email: ' . $e->getMessage());
        sweetalert()->error('Failed to send test email. Please check your email configuration.');
        return redirect()->back()->withInput();
    }
}


    /**
     * Display the global email template settings page.
     */
    public function globalTemplate()
    {
        $template = GlobalTemplate::firstOrCreate(
            ['name' => 'Global Email Template'],
            [
                'subject' => 'Your Notification from {{site_name}}',
                'html_template' => '<html>
                                    <body>
                                        <h1>Hello {{name}},</h1>
                                        <p>{{message}}</p>
                                        <p>Regards,</p>
                                        <p>{{site_name}}</p>
                                    </body>
                                </html>',
                'from_name' => 'Your Company Name',
                'from_email' => 'no-reply@yourcompany.com',
            ]
        );

        $shortcodes = [
            '{{name}}' => 'Name of the recipient',
            '{{username}}' => 'Username of the recipient',
            '{{message}}' => 'Dynamic message content',
            '{{site_name}}' => 'Name of your site',
        ];

        $tinymceApiKey = Setting::where('key', 'tinymce_api')->value('value');
        return view('email::global-template', compact('template', 'shortcodes', 'tinymceApiKey'));
    }


    public function updateGlobalTemplate(UpdateGlobalTemplateRequest $request)
    {
        try {
            $template = GlobalTemplate::first();
            $template->update($request->validated());

            sweetalert()->success('Global email template updated successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Error updating global email template: ' . $e->getMessage());
            sweetalert()->error('An error occurred while updating the email template. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display all notification templates.
     */
    public function notificationTemplates()
    {
        $templates = NotificationTemplate::paginate(10);
        $tinymceApiKey = Setting::where('key', 'tinymce_api')->value('value');

        return view('email::notification-templates.index', compact('templates', 'tinymceApiKey'));
    }

    /**
     * Manage a notification template.
     */
    public function manageNotificationTemplate($id = null)
    {
        $template = $id ? NotificationTemplate::findOrFail($id) : null;
        $tinymceApiKey = Setting::where('key', 'tinymce_api')->value('value');

        return view('email::notification-templates.manage', compact('template', 'tinymceApiKey'));
    }

    /**
     * Save a notification template.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:notification_templates,name',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|boolean',
        ]);

        // Create a new notification template
        NotificationTemplate::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']), // Generate slug from name
            'subject' => $validatedData['subject'],
            'body' => $validatedData['body'],
            'status' => $validatedData['status'],
        ]);

        sweetalert()->success("Notification template created successfully.");

        // Redirect back with a success message
        return redirect()->route('admin.email.notification-templates');
    }
    public function saveNotificationTemplate(NotificationTemplateRequest $request, $id = null)
    {
        try {
            $data = $request->validated();
            $template = NotificationTemplate::updateOrCreate(
                ['id' => $id],
                $data
            );

            sweetalert()->success("Notification template [{$template->name}] saved successfully.");
            return redirect()->route('admin.email.notification-templates');
        } catch (Exception $e) {
            Log::error('Error saving notification template: ' . $e->getMessage());
            sweetalert()->error('An error occurred while saving the notification template. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete a notification template.
     */
    public function deleteNotificationTemplate($id)
    {
        try {
            $template = NotificationTemplate::findOrFail($id);
            $template->delete();

            sweetalert()->success("Notification template [{$template->name}] deleted successfully.");
            return redirect()->route('admin.email.notification-templates');
        } catch (Exception $e) {
            Log::error('Error deleting notification template: ' . $e->getMessage());
            sweetalert()->error('An error occurred while deleting the notification template. Please try again.');
            return redirect()->back();
        }
    }



    public function sendDynamicEmail(string $templateName, array $data)
{
    try {
        // Dispatch email job to the queue
        SendEmail::dispatch($templateName, $data);

        Log::info("Email job dispatched for template: {$templateName}", ['recipient' => $data['email']]);
        // sweetalert()->success('The email has been scheduled for delivery.');
    } catch (Exception $e) {
        Log::error('Failed to dispatch email job: ' . $e->getMessage());

        // Show a professional error message
        sweetalert()->error(
            'Failed to send the email. Please check the email configuration or contact support if the problem persists.'
        );
    }
}



private function parseShortcodes(string $text, array $data): string
{
    foreach ($data as $key => $value) {
        $text = str_replace("{{{$key}}}", $value, $text);
    }

    return $text;
}
}

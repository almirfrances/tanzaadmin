<?php

namespace Modules\Email\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Modules\Email\Models\EmailSetting;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Email\Models\GlobalTemplate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Email\Models\NotificationTemplate;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $templateName;
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string $templateName
     * @param array $data
     */
    public function __construct(string $templateName, array $data)
    {
        $this->templateName = $templateName;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Fetch email settings
            $emailSettings = EmailSetting::first();
            $globalTemplate = GlobalTemplate::firstOrFail();
            $notificationTemplate = NotificationTemplate::where('name', $this->templateName)
                ->where('status', true) // Ensure the template is active
                ->firstOrFail();

            // Apply email configuration
            if ($emailSettings) {
                $this->applyMailSettings($emailSettings);
            }

            // Parse shortcodes
            $subject = $this->parseShortcodes($notificationTemplate->subject, $this->data);
            $htmlTemplate = $this->parseShortcodes(
                $globalTemplate->html_template,
                array_merge($this->data, ['message' => $this->parseShortcodes($notificationTemplate->body, $this->data)])
            );

            // Send email
            Mail::html($htmlTemplate, function ($message) use ($subject) {
                $message->to($this->data['email'])->subject($subject);
            });

            Log::info("Email sent successfully to {$this->data['email']} using template: {$this->templateName}");
        } catch (Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage(), ['template' => $this->templateName]);
            throw $e;
        }
    }

    /**
     * Apply email settings dynamically.
     *
     * @param EmailSetting $emailSettings
     * @return void
     */
    private function applyMailSettings(EmailSetting $emailSettings): void
    {
        $globalTemplate = GlobalTemplate::first();

        $settings = $emailSettings->settings;

        $fromName = $globalTemplate->from_name ?? config('app.name', 'YourAppName');
        $fromEmail = $globalTemplate->from_email ?? 'no-reply@example.com';

        switch ($emailSettings->provider) {
            case 'php_mailer':
                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => 'localhost',
                    'mail.mailers.smtp.port' => 25,
                    'mail.mailers.smtp.encryption' => null,
                    'mail.mailers.smtp.username' => null,
                    'mail.mailers.smtp.password' => null,
                    'mail.from.address' => $fromEmail,
                    'mail.from.name' => $fromName,
                ]);
                break;

            case 'smtp':
                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => $settings['host'],
                    'mail.mailers.smtp.port' => $settings['port'],
                    'mail.mailers.smtp.encryption' => $settings['encryption'],
                    'mail.mailers.smtp.username' => $settings['username'],
                    'mail.mailers.smtp.password' => $settings['password'],
                    'mail.from.address' => $fromEmail,
                    'mail.from.name' => $fromName,
                ]);
                break;

            case 'sendgrid':
                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => 'smtp.sendgrid.net',
                    'mail.mailers.smtp.port' => 587,
                    'mail.mailers.smtp.encryption' => 'tls',
                    'mail.mailers.smtp.username' => 'apikey',
                    'mail.mailers.smtp.password' => $settings['app_key'] ?? env('SENDGRID_API_KEY'),
                    'mail.from.address' => $fromEmail,
                    'mail.from.name' => $fromName,
                ]);
                break;

            case 'mailjet':
                config([
                    'mail.default' => 'mailjet',
                    'mail.mailers.smtp.host' => 'in-v3.mailjet.com',
                    'mail.mailers.smtp.port' => 587,
                    'mail.mailers.smtp.username' => $settings['api_public_key'] ?? env('MAILJET_APIKEY'),
                    'mail.mailers.smtp.password' => $settings['api_secret_key'] ?? env('MAILJET_APISECRET'),
                    'services.mailjet.key' => $settings['api_public_key'] ?? env('MAILJET_APIKEY'),
                    'services.mailjet.secret' => $settings['api_secret_key'] ?? env('MAILJET_APISECRET'),
                    'mail.from.address' => $fromEmail,
                    'mail.from.name' => $fromName,
                ]);
                break;
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

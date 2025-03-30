<?php

namespace App\Providers;

use Modules\Email\Jobs\SendEmail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    public function sendDynamicEmail(string $templateName, array $data)
    {
        try {
            // Dispatch email job to the queue
            SendEmail::dispatch($templateName, $data);

            Log::info("Email job dispatched for template: {$templateName}", ['recipient' => $data['email']]);
        } catch (\Exception $e) {
            Log::error('Failed to dispatch email job: ' . $e->getMessage());
            throw $e;
        }
    }
}

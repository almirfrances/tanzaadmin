<?php

namespace Modules\Ticket\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable; // Add this line
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AutoCloseTicketsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels; // Add Dispatchable here

    public function handle()
    {
        try {
            // Fetch auto-close settings
            $settings = TicketSetting::pluck('value', 'key')->toArray();

            // Close open tickets
            if (isset($settings['auto_close_open_days'])) {
                $closeOpenDays = (int) $settings['auto_close_open_days'];
                $closeOpenDate = Carbon::now()->subDays($closeOpenDays);

                $closedOpenCount = Ticket::where('status', 'open')
                    ->where('updated_at', '<', $closeOpenDate)
                    ->update(['status' => 'closed']);

                Log::info("AutoCloseTicketsJob: Closed {$closedOpenCount} open tickets older than {$closeOpenDays} days.");
            }

            // Close answered tickets
            if (isset($settings['auto_close_answered_days'])) {
                $closeAnsweredDays = (int) $settings['auto_close_answered_days'];
                $closeAnsweredDate = Carbon::now()->subDays($closeAnsweredDays);

                $closedAnsweredCount = Ticket::where('status', 'answered')
                    ->where('updated_at', '<', $closeAnsweredDate)
                    ->update(['status' => 'closed']);

                Log::info("AutoCloseTicketsJob: Closed {$closedAnsweredCount} answered tickets older than {$closeAnsweredDays} days.");
            }

            // Close pending tickets
            if (isset($settings['auto_close_pending_days'])) {
                $closePendingDays = (int) $settings['auto_close_pending_days'];
                $closePendingDate = Carbon::now()->subDays($closePendingDays);

                $closedPendingCount = Ticket::where('status', 'pending')
                    ->where('updated_at', '<', $closePendingDate)
                    ->update(['status' => 'closed']);

                Log::info("AutoCloseTicketsJob: Closed {$closedPendingCount} pending tickets older than {$closePendingDays} days.");
            }
        } catch (\Exception $e) {
            Log::error("AutoCloseTicketsJob failed: " . $e->getMessage());
            throw $e;
        }
    }
}

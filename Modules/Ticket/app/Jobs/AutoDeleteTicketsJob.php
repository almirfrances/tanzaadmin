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

class AutoDeleteTicketsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels; // Add Dispatchable here

    public function handle()
    {
        try {
            // Fetch the auto-delete days setting
            $deleteDays = (int) TicketSetting::where('key', 'auto_delete_days')->value('value');

            if ($deleteDays > 0) {
                $deleteDate = Carbon::now()->subDays($deleteDays);

                // Delete tickets older than the specified days
                $deletedCount = Ticket::where('created_at', '<', $deleteDate)->delete();

                Log::info("AutoDeleteTicketsJob: Deleted {$deletedCount} tickets older than {$deleteDays} days.");
            }
        } catch (\Exception $e) {
            Log::error("AutoDeleteTicketsJob failed: " . $e->getMessage());
            throw $e;
        }
    }
}

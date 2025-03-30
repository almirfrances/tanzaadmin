<?php

namespace Modules\Ticket\Console;

use Illuminate\Console\Command;
use Modules\Ticket\Jobs\AutoCloseTicketsJob;
use Modules\Ticket\Jobs\AutoDeleteTicketsJob;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class DispatchTicketJobsCommand extends Command
{
    protected $signature = 'tickets:dispatch-jobs';
    protected $description = 'Dispatch the jobs to auto-delete and auto-close tickets.';

    public function handle()
    {
        AutoDeleteTicketsJob::dispatch();
        AutoCloseTicketsJob::dispatch();

        $this->info('AutoDeleteTicketsJob and AutoCloseTicketsJob dispatched successfully.');
    }
}

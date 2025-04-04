<x-layouts.app>
    @section('title', 'Ticket Settings')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Tickets', 'url' => route('admin.tickets.index')],
            ['name' => 'Ticket Settings'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Ticket Settings</h4>
        <p class="mb-4">Configure ticket-related settings such as auto-deletion, auto-closure, and other behaviors.</p>
        @php
            $command = '* * * * * php ' . base_path('artisan') . ' tickets:dispatch-jobs >> /dev/null 2>&1';
        @endphp
         <p class="mb-4">Add this cron job<code>{{ $command }}</code></p>
        <div class="row g-4">
            <!-- Auto-Delete Tickets -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Auto-Delete Tickets</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.tickets.settings.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="auto_delete_days" class="form-label">Delete Tickets After (Days)</label>
                                <input type="number" class="form-control" id="auto_delete_days" name="auto_delete_days"
                                    value="{{ $settings['auto_delete_days'] ?? 30 }}" min="1">
                                <small class="form-text text-muted">
                                    Set the number of days after which tickets will be automatically deleted from the system.
                                    <br><br>
                                    <strong>Why is this important?</strong>
                                    <ul>
                                        <li>Helps maintain a clean and organized database by removing old or resolved tickets.</li>
                                        <li>Reduces storage usage by deleting unnecessary data.</li>
                                        <li>Ensures compliance with data retention policies (if applicable).</li>
                                    </ul>
                                    <strong>Default:</strong> 30 days
                                    <br>
                                    <strong>Note:</strong> Once deleted, tickets cannot be recovered. Ensure the chosen duration aligns with your organization's needs.
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Auto-Close Tickets -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Auto-Close Tickets</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.tickets.settings.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="auto_close_open_days" class="form-label">Close Open Tickets After (Days)</label>
                                <input type="number" class="form-control" id="auto_close_open_days" name="auto_close_open_days"
                                    value="{{ $settings['auto_close_open_days'] ?? 7 }}" min="1">
                                <small class="form-text text-muted">
                                    Open tickets will be automatically closed after the specified number of days.
                                </small>
                            </div>
                            <div class="mb-3">
                                <label for="auto_close_answered_days" class="form-label">Close Answered Tickets After (Days)</label>
                                <input type="number" class="form-control" id="auto_close_answered_days" name="auto_close_answered_days"
                                    value="{{ $settings['auto_close_answered_days'] ?? 3 }}" min="1">
                                <small class="form-text text-muted">
                                    Answered tickets will be automatically closed after the specified number of days.
                                </small>
                            </div>
                            <div class="mb-3">
                                <label for="auto_close_pending_days" class="form-label">Close Pending Tickets After (Days)</label>
                                <input type="number" class="form-control" id="auto_close_pending_days" name="auto_close_pending_days"
                                    value="{{ $settings['auto_close_pending_days'] ?? 5 }}" min="1">
                                <small class="form-text text-muted">
                                    Pending tickets will be automatically closed after the specified number of days.
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Other Ticket Settings -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Ticket Attachments</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.tickets.settings.update') }}" method="POST">
                            @csrf
                            <!-- Hidden input for unchecked state -->
                            <input type="hidden" name="allow_ticket_attachments" value="0">

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="allow_ticket_attachments" name="allow_ticket_attachments"
                                    value="1" {{ $settings['allow_ticket_attachments'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_ticket_attachments">Allow Ticket Attachments</label>
                            </div>

                            <!-- Description -->
                            <small class="form-text text-muted">
                                Enable this option to allow users to upload attachments (e.g., images, documents) when creating or replying to tickets.
                                Disabling this will prevent users from adding any attachments.
                            </small>

                            <div>
                                <button type="submit" class="btn btn-primary mt-3">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

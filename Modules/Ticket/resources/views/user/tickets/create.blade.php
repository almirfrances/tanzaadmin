<x-user.user>
    @section('title', 'Create New Ticket')

    <!-- Breadcrumb -->
    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('user.dashboard')],
            ['name' => 'Tickets', 'url' => route('user.tickets.index')],
            ['name' => 'Create Ticket'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Create New Ticket</h4>
        <p class="text-muted">Submit a new support ticket by filling in the details below.</p>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('user.tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Ticket Subject -->
                    <div class="mb-3">
                        <x-form.input-text id="subject" name="subject" label="Ticket Subject" placeholder="Enter the ticket subject" required />
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <x-form.select
                            id="category"
                            name="category"
                            label="Category"
                            :options="['General Support' => 'General Support', 'Technical Support' => 'Technical Support', 'Sales Support' => 'Sales Support']"
                            required
                        />
                    </div>

                    <!-- Priority -->
                    <div class="mb-3">
                        <x-form.select
                            id="priority"
                            name="priority"
                            label="Priority"
                            :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']"
                            required
                        />
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <x-form.textarea
                            id="description"
                            name="description"
                            label="Description"
                            rows="5"
                            placeholder="Describe your issue in detail"
                            required
                        />
                    </div>
                    @if (isset($settingTickets['allow_ticket_attachments']) && $settingTickets['allow_ticket_attachments'] == 1)

                    <!-- Attachments -->
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Attachments (optional)</label>
                        <input type="file" id="attachments" name="attachments[]" class="form-control" multiple>
                        <small class="text-muted">You can upload multiple files. Supported formats: jpg, png, pdf, docx.</small>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> File attachments are currently disabled by the administrator.
                    </div>
                @endif
                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <x-partials.button type="primary" label="Submit Ticket" />
                        <a href="{{ route('user.tickets.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user.user>

<x-user.user>
    @section('title', 'My Tickets')

    <!-- Breadcrumb -->
    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('user.dashboard')],
            ['name' => 'Tickets'],
        ]"
        style="style1"
    />

    <!-- Tickets List -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">My Tickets</h4>
        <p class="text-muted">View and manage your support tickets.</p>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Status Filter -->
                <form action="{{ route('user.tickets.index') }}" method="GET" class="d-flex">
                    <select name="status" class="form-select me-2">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="answered" {{ request('status') === 'answered' ? 'selected' : '' }}>Answered</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <!-- Create Ticket Button -->
                <a href="{{ route('user.tickets.create') }}" class="btn btn-success">
                    <i class="ti ti-plus"></i> Create Ticket
                </a>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ Str::limit($ticket->subject, 50, '...') }}</strong>
                                </td>
                                <td>
                                    @php
                                        $categoryColors = [
                                            'General Support' => 'bg-primary',
                                            'Technical Support' => 'bg-warning',
                                            'Sales Support' => 'bg-info',
                                        ];
                                    @endphp
                                    <span class="badge {{ $categoryColors[$ticket->category] ?? 'bg-secondary' }}">
                                        {{ $ticket->category }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $priorityColors = [
                                            'High' => 'bg-danger',
                                            'Medium' => 'bg-warning',
                                            'Low' => 'bg-success',
                                        ];
                                    @endphp
                                    <span class="badge {{ $priorityColors[$ticket->priority] ?? 'bg-secondary' }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'open' => 'bg-success',
                                            'pending' => 'bg-warning',
                                            'answered' => 'bg-info',
                                            'closed' => 'bg-danger',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusColors[$ticket->status] ?? 'bg-secondary' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>{{ $ticket->updated_at->format('d M Y, h:i A') }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a href="{{ route('user.tickets.show', $ticket->id) }}" class="dropdown-item">
                                                    <i class="ti ti-eye me-2"></i> View
                                                </a>
                                            </li>
                                            @if ($ticket->status !== 'closed')
                                                <li>
                                                    <form action="{{ route('user.tickets.close', $ticket->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="ti ti-lock me-2"></i> Close
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <h5 class="text-muted">No tickets found</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $tickets->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</x-user.user>

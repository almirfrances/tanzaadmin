<x-layouts.app>
    @section('title', 'Manage Tickets')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Tickets', 'url' => route('admin.tickets.index')],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Manage Tickets</h4>
        <p class="text-muted">View and manage support tickets efficiently.</p>

        <!-- Tickets Table -->
        <div class="card shadow-sm mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Search Form -->
                <form action="{{ route('admin.tickets.index') }}" method="GET" class="d-flex w-100">
                    <input type="text" name="search" class="form-control" placeholder="Search tickets..."
                        value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-secondary ms-2">Search</button>
                </form>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td>#{{ $ticket->id }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->category }}</td>
                                <td>
                                    @php
                                        $statusClass = match ($ticket->status) {
                                            'open' => 'bg-primary',
                                            'waiting_for_user' => 'bg-warning',
                                            'waiting_for_admin' => 'bg-info',
                                            'closed' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span>
                                </td>
                                <td>
                                    @php
                                        $bgColor = '#' . substr(md5($ticket->user->name ?? 'A'), 0, 6);
                                        $r = hexdec(substr($bgColor, 1, 2));
                                        $g = hexdec(substr($bgColor, 3, 2));
                                        $b = hexdec(substr($bgColor, 5, 2));
                                        $textColor = ($r * 0.299 + $g * 0.587 + $b * 0.114) > 186 ? '#000' : '#fff';
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <span class="avatar-initials rounded-circle d-flex justify-content-center align-items-center"
                                            style="background-color: {{ $bgColor }}; width: 40px; height: 40px; font-size: 18px; font-weight: bold; color: {{ $textColor }};">
                                            {{ strtoupper($ticket->user->name[0] ?? 'A') }}
                                        </span>
                                        <span class="ms-2">{{ $ticket->user->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="dropdown-item">
                                                    <i class="ti ti-eye me-2"></i>View
                                                </a>
                                            </li>
                                            @if ($ticket->status !== 'closed')
                                                <li>
                                                    <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="ti ti-lock me-2"></i>Close
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
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $tickets->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </div>
</x-layouts.app>

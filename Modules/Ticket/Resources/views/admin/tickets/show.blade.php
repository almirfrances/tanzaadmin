<x-layouts.app>
    @section('title', "View Ticket #{{ $ticket->id }}")

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Tickets', 'url' => route('admin.tickets.index')],
            ['name' => 'Ticket Details'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Main Content: Conversation and Reply Form -->
            <div class="col-lg-8">
                <!-- Conversation Timeline -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Conversation Timeline</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($replies as $reply)
                            <div class="mb-4">
                                <!-- Avatar and User Info -->
                                <div class="d-flex align-items-center mb-2">
                                    @php
                                        $sender = $reply->sender_type === 'admin' ? Auth::guard('admin')->user() : $reply->user;
                                        $bgColor = '#' . substr(md5($sender->name ?? 'A'), 0, 6);
                                        $r = hexdec(substr($bgColor, 1, 2));
                                        $g = hexdec(substr($bgColor, 3, 2));
                                        $b = hexdec(substr($bgColor, 5, 2));
                                        $textColor = ($r * 0.299 + $g * 0.587 + $b * 0.114) > 186 ? '#000' : '#fff';
                                    @endphp

                                    <div class="avatar avatar-online me-3">
                                        <span class="avatar-initials rounded-circle d-flex justify-content-center align-items-center"
                                            style="background-color: {{ $bgColor }}; width: 40px; height: 40px; font-size: 18px; font-weight: bold; color: {{ $textColor }};">
                                            {{ strtoupper($sender->name[0] ?? 'A') }}
                                        </span>
                                    </div>

                                    <div>
                                        <strong>{{ $reply->sender_type === 'admin' ? 'Admin' : $reply->user->name }}</strong>
                                        <small class="text-muted d-block">{{ $reply->created_at->format('F d, Y h:i A') }}</small>
                                    </div>
                                </div>

                                <!-- Reply Message -->
                                <p class="ms-5">{{ $reply->message }}</p>

                                <!-- Attachments -->
                                @if (!empty($reply->attachment))
                                    <p class="ms-5"><strong>Attachments:</strong></p>
                                    <div class="d-flex flex-wrap gap-3 ms-5">
                                        @foreach (json_decode($reply->attachment, true) as $attachment)
                                            <div class="attachment-item">
                                                <a href="{{ Storage::url($attachment) }}" download="{{ basename($attachment) }}" class="text-decoration-none">
                                                    <div class="file-icon">
                                                        @if (Str::endsWith($attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                                                            <i class="ti ti-photo"></i>
                                                        @elseif (Str::endsWith($attachment, '.pdf'))
                                                            <i class="ti ti-file-text"></i>
                                                        @elseif (Str::endsWith($attachment, ['.doc', '.docx']))
                                                            <i class="ti ti-file-word"></i>
                                                        @else
                                                            <i class="ti ti-file"></i>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <hr>
                        @empty
                            <p class="text-muted">No replies yet.</p>
                        @endforelse

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $replies->links('vendor.pagination.simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>

                <!-- Admin Reply Form -->
                @if ($ticket->status !== 'closed')
                    <div class="card shadow-sm mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Reply to Ticket</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="attachments" class="form-label">Attachments</label>
                                    <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                                    <small class="text-muted">You can attach multiple files.</small>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-send"></i> Send Reply
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <i class="ti ti-info-circle"></i> This ticket is closed. You cannot reply.
                    </div>
                @endif
            </div>

            <!-- Sidebar: Ticket Details and Actions -->
            <div class="col-lg-4">
                <!-- Ticket Details -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ticket Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Ticket ID:</strong> #{{ $ticket->id }}</p>
                        <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
                        <p><strong>Date:</strong> {{ $ticket->created_at->format('d M, Y h:i A') }}</p>
                        <p><strong>Status:</strong>
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
                        </p>
                        <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                        <p><strong>Created By:</strong> {{ $ticket->user->name ?? 'N/A' }}</p>
                        <p><strong>Description:</strong></p>
                        <p class="border p-3 bg-light">{{ $ticket->description }}</p>
                        @if (!empty($ticket->attachments))
                            <p><strong>Attachments:</strong></p>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach (json_decode($ticket->attachments, true) as $attachment)
                                    <div class="attachment-item">
                                        <a href="{{ Storage::url($attachment) }}" download="{{ basename($attachment) }}" class="text-decoration-none">
                                            <div class="file-icon">
                                                @if (Str::endsWith($attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                                                    <i class="ti ti-photo"></i>
                                                @elseif (Str::endsWith($attachment, '.pdf'))
                                                    <i class="ti ti-file-text"></i>
                                                @elseif (Str::endsWith($attachment, ['.doc', '.docx']))
                                                    <i class="ti ti-file-word"></i>
                                                @else
                                                    <i class="ti ti-file"></i>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <!-- Close Ticket Button -->
                        <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST" class="d-inline-block w-100 mb-2">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to close this ticket?')">
                                <i class="ti ti-lock"></i> Close Ticket
                            </button>
                        </form>

                        <!-- Reopen Ticket Button -->
                        @if ($ticket->status === 'closed')
                            <form action="{{ route('admin.tickets.reopen', $ticket->id) }}" method="POST" class="d-inline-block w-100 mb-2">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100" onclick="return confirm('Are you sure you want to reopen this ticket?')">
                                    <i class="ti ti-refresh"></i> Reopen Ticket
                                </button>
                            </form>
                        @endif

                        <!-- Mark as Answered Button -->
                        @if ($ticket->status !== 'closed' && $ticket->status !== 'answered')
                            <form action="{{ route('admin.tickets.mark-as-answered', $ticket->id) }}" method="POST" class="d-inline-block w-100">
                                @csrf
                                <button type="submit" class="btn btn-success w-100" onclick="return confirm('Are you sure you want to mark this ticket as answered?')">
                                    <i class="ti ti-check"></i> Mark as Answered
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

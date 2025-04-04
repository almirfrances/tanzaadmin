<x-user.user>
    @section('title', 'Ticket Details')

    <!-- Breadcrumb -->
    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('user.dashboard')],
            ['name' => 'Tickets', 'url' => route('user.tickets.index')],
            ['name' => 'Ticket Details'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Ticket Details</h4>

        <div class="row">
            <!-- Main Content: Conversation and Reply Form -->
            <div class="col-lg-8">
                <!-- Ticket Replies -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Conversation</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($replies as $reply)
                            <div class="mb-4">
                                <!-- Avatar and User Info -->
                                <div class="d-flex align-items-center mb-2">
                                    @php
                                        $sender = $reply->sender_type === 'user' ? Auth::guard('web')->user() : Auth::guard('admin')->user();
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
                                        <strong>{{ $reply->sender_type === 'user' ? 'You' : 'Admin' }}</strong>
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

                <!-- Reply Form -->
                @if($ticket->status === 'open' || $ticket->status === 'answered')
                    <div class="card shadow-sm mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Add a Reply</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <x-form.textarea id="reply" name="message" label="Message" rows="5" required />
                                @if (isset($settingTickets['allow_ticket_attachments']) && $settingTickets['allow_ticket_attachments'] == 1)
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
                                <div class="text-end mt-3">
                                    <x-partials.button type="primary" label="Submit Reply" />
                                </div>
                            </form>
                        </div>
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
                        <p><strong>Status:</strong>
                            <span class="badge bg-{{ $ticket->status === 'open' ? 'success' : ($ticket->status === 'closed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </p>
                        <p><strong>Category:</strong> {{ $ticket->category }}</p>
                        <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                        <p><strong>Description:</strong></p>
                        <p class="text-muted">{{ $ticket->description }}</p>

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

                        <p><small class="text-muted">Created on: {{ $ticket->created_at->format('F d, Y h:i A') }}</small></p>
                    </div>
                </div>

                <!-- Actions -->
                @if($ticket->status === 'open' || $ticket->status === 'closed' || $ticket->status === 'answered')
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Actions</h5>
                        </div>
                        <div class="card-body">
                            @if($ticket->status === 'open' || $ticket->status === 'answered')
                                <form action="{{ route('user.tickets.close', $ticket->id) }}" method="POST">
                                    @csrf
                                    <x-partials.button type="danger" label="Close Ticket" class="w-100 mb-2" />
                                </form>
                            @elseif($ticket->status === 'closed')
                                <form action="{{ route('user.tickets.reopen', $ticket->id) }}" method="POST">
                                    @csrf
                                    <x-partials.button type="success" label="Reopen Ticket" class="w-100 mb-2" />
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


</x-user.user>

<?php

namespace Modules\Ticket\Http\Controllers;

use App\Models\AdminModule;
use Illuminate\Http\Request;
use Modules\Ticket\Models\Reply;
use Modules\Ticket\Models\Ticket;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Models\Setting;
use Modules\Ticket\Models\TicketSetting;

class AdminTicketController extends Controller
{

        /**
     * Display the ticket settings page.
     */
    public function settings()
    {
        // Fetch all ticket settings
        $settings = TicketSetting::pluck('value', 'key')->toArray();

        return view('ticket::admin.tickets.settings', compact('settings'));
    }

    /**
     * Update ticket settings.
     */
    public function updateSettings(Request $request)
    {
        // Validate the request
        $request->validate([
            'auto_delete_days' => 'nullable|integer|min:1',
            'auto_close_open_days' => 'nullable|integer|min:1',
            'auto_close_answered_days' => 'nullable|integer|min:1',
            'auto_close_pending_days' => 'nullable|integer|min:1',
            'allow_ticket_attachments' => 'nullable|boolean',
        ]);

        // Update or create settings
        foreach ($request->except('_token') as $key => $value) {
            TicketSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        sweetalert()->success('Ticket settings updated successfully.');

        return redirect()->back();
    }
    /**
     * Display all tickets.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::query()
            ->when($request->query('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->query('search'), function ($query, $search) {
                $query->where('subject', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('ticket::admin.tickets.index', compact('tickets'));
    }

    /**
     * View a specific ticket and its replies.
     */
    public function show($id)
    {
        $ticket = Ticket::with(['replies.user', 'replies.admin', 'user'])->findOrFail($id);
        $replies = $ticket->replies()->orderBy('created_at', 'asc')->paginate(10);

        return view('ticket::admin.tickets.show', compact('ticket', 'replies'));
    }

    /**
     * Add a reply to a ticket.
     */
    public function reply(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $attachments = [];

        // Handle attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                try {
                    $attachments[] = $file->store('ticket_replies', 'public');
                } catch (\Exception $e) {
                    Log::error('Attachment upload failed', ['error' => $e->getMessage()]);
                    sweetalert()->error('Failed to upload attachments. Please try again.');
                    return back()->withInput();
                }
            }
        }

        Reply::create([
            'ticket_id' => $ticket->id,
            'admin_id' => Auth::guard('admin')->id(),
            'message' => $request->message,
            'attachment' => !empty($attachments) ? json_encode($attachments) : null,
            'sender_type' => 'admin',
        ]);

        // Mark the ticket as answered if it's not already closed
        if ($ticket->status !== 'closed') {
            $ticket->update(['status' => 'answered']);
        }

        // Notify the user about the admin reply
         // Send notification email to user
         if (AdminModule::isModuleEnabled('Email')) {
            $emailController = new \Modules\Email\Http\Controllers\EmailController();

            $emailController->sendDynamicEmail('Admin Ticket Reply', [
                'email' => $ticket->user->email,
                'name' => $ticket->user->name,
                'username' => $ticket->user->username,
                'ticket_subject' => $ticket->subject,
                'site_name' => $settings['site_name'] ?? config('app.name'),
            ]);
        }

        sweetalert()->success('Reply added successfully.');
        return back();
    }

    /**
     * Close a ticket.
     */
    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Allow closing a ticket regardless of its current status
        $ticket->update(['status' => 'closed']);

          // Send notification email to user
          if (AdminModule::isModuleEnabled('Email')) {
            $emailController = new \Modules\Email\Http\Controllers\EmailController();

            // Send notification to the user
            $emailController->sendDynamicEmail('Ticket Closed Notification', [
                'email' => $ticket->user->email,
                'name' => $ticket->user->name,
                'username' => $ticket->user->username,
                'ticket_subject' => $ticket->subject,
                'ticket_id' => $ticket->id,
                'ticket_category' => $ticket->category,
                'ticket_priority' => $ticket->priority,
                'ticket_description' => $ticket->description,
                'site_name' => $settings['site_name'] ?? config('app.name'),
            ]);

        }

        sweetalert()->success('Ticket closed successfully.');
        return back();
    }

    /**
     * Reopen a ticket.
     */
    public function reopen($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Allow reopening a ticket regardless of its current status
        $ticket->update(['status' => 'open']);

        sweetalert()->success('Ticket reopened successfully.');
        return back();
    }

    /**
     * Mark a ticket as answered.
     */
    public function markAsAnswered($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Mark the ticket as answered if it's not already closed
        if ($ticket->status !== 'closed') {
            $ticket->update(['status' => 'answered']);
            sweetalert()->success('Ticket marked as answered.');
            return back();
        }

        sweetalert()->error('Cannot mark a closed ticket as answered.');
        return back();
    }
}

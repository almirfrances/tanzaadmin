<?php

namespace Modules\Ticket\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminModule;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Modules\Ticket\Models\Reply;
use Modules\Ticket\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Models\Setting;
use Modules\Ticket\Models\TicketSetting;

class TicketController extends Controller
{
    /**
     * Display a list of the user's tickets.
     */
    public function index(Request $request)
    {
        try {
            $tickets = Ticket::where('user_id', Auth::guard('web')->id())
                ->when($request->query('status'), function ($query, $status) {
                    $query->where('status', $status);
                })
                ->when($request->query('start_date'), function ($query, $startDate) {
                    $query->whereDate('created_at', '>=', $startDate);
                })
                ->when($request->query('end_date'), function ($query, $endDate) {
                    $query->whereDate('created_at', '<=', $endDate);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('ticket::user.tickets.index', compact('tickets'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch tickets', ['error' => $e->getMessage()]);
            sweetalert()->error('Failed to load tickets. Please try again later.');
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        $categories = ['General Support', 'Technical Support', 'Sales Support'];
        $priorities = ['High', 'Medium', 'Low'];

        return view('ticket::user.tickets.create', compact('categories', 'priorities'));
    }




/**
 * Store a newly created ticket.
 */
public function store(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|in:General Support,Technical Support,Sales Support',
        'priority' => 'required|in:low,medium,high',
        'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
    ]);

    // Ensure the user is authenticated
    $user = Auth::guard('web')->user();

    if (!$user) {
        sweetalert()->error('You must be logged in to create a ticket.');
        return redirect()->route('login');
    }

    $attachments = [];

    // Handle attachments upload
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            try {
                $attachments[] = $file->store('ticket_attachments', 'public');
            } catch (\Exception $e) {

                sweetalert()->error('Failed to upload attachments.');
                return back()->withErrors(['error' => 'Failed to upload attachments.'])->withInput();
            }
        }
    }

    DB::beginTransaction();
    try {
        // Create the ticket
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'subject' => $validatedData['subject'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'priority' => ucfirst($validatedData['priority']),
            'status' => Ticket::STATUS_OPEN,
            'auto_close_at' => now()->addDays(7),
        ]);

        // Save attachments if any
        if (!empty($attachments)) {
            $ticket->attachment = $attachments; // Automatically casted to JSON
            $ticket->save();
        }

        DB::commit();



                    // Send notification email to user
                    if (AdminModule::isModuleEnabled('Email')) {
                        $emailController = new \Modules\Email\Http\Controllers\EmailController();

                        // Send notification to the user
                        $emailController->sendDynamicEmail('New Ticket Created', [
                            'email' => Auth::guard('web')->user()->email,
                            'name' => Auth::guard('web')->user()->name,
                            'username' => Auth::guard('web')->user()->username,
                            'ticket_subject' => $ticket->subject,
                            'ticket_category' => $ticket->category,
                            'ticket_priority' => $ticket->priority,
                            'ticket_description' => $ticket->description,
                            'site_name' => $settings['site_name'] ?? config('app.name'),
                        ]);

                        //  send notification to the admin

                        $emailController->sendDynamicEmail('New Ticket Alert', [
                            'email' => Setting::getValue('site_email'),
                            'username' => Setting::getValue('site_name'),
                            'name' => Setting::getValue('site_name'),
                            'ticket_subject' => $ticket->subject,
                            'ticket_category' => $ticket->category,
                            'ticket_priority' => $ticket->priority,
                            'ticket_description' => $ticket->description,
                            'user_name' => Auth::guard('web')->user()->name,
                            'user_email' => Auth::guard('web')->user()->email,
                            'site_name' => config('app.name'),
                        ]);
                    }

        sweetalert()->success('Ticket created successfully.');
        return redirect()->route('user.tickets.index');
    } catch (\Exception $e) {
        DB::rollBack();


        sweetalert()->error('Failed to create the ticket. Please try again.');
        return back()->withErrors(['error' => 'Failed to create the ticket.'])->withInput();
    }
}





/**
 * Display the specified ticket.
 */
public function show($id)
{
    try {
        // Fetch the ticket for the authenticated user
        $ticket = Ticket::where('user_id', Auth::guard('web')->id())->findOrFail($id);

        // Paginate replies (10 per page, ordered from oldest to newest)
        $replies = $ticket->replies()->orderBy('created_at', 'asc')->paginate(10);
        $settingTickets = TicketSetting::pluck('value', 'key')->toArray();
        return view('ticket::user.tickets.show', compact('ticket', 'replies', 'settingTickets'));
    } catch (\Exception $e) {
        sweetalert()->error('Failed to load ticket details.');
        return redirect()->route('user.tickets.index');
    }
}

    public function reply(Request $request, $id)
    {
        try {
            // Fetch the ticket for the authenticated user
            $ticket = Ticket::where('user_id', Auth::guard('web')->id())->findOrFail($id);

            // Prevent replies to closed tickets
            if ($ticket->status === 'closed') {
                sweetalert()->error('This ticket is closed. You cannot reply to it.');
                return back();
            }

            // Validate the input
            $validated = $request->validate([
                'message' => 'required|string|max:5000',
                'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt,html|max:5120',
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

            // Save the reply
            Reply::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::guard('web')->id(),
                'message' => $validated['message'],
                'attachment' => !empty($attachments) ? json_encode($attachments) : null,
                'sender_type' => 'user',
            ]);

            // Update ticket status to 'pending'
            $ticket->update(['status' => 'pending']);


             // Send notification email to admin
             if (AdminModule::isModuleEnabled('Email')) {
                $emailController = new \Modules\Email\Http\Controllers\EmailController();

                $emailController->sendDynamicEmail('New Reply Notification Admin', [
                    'email' => Setting::getValue('site_email'),
                    'username' => Setting::getValue('site_name'),
                    'name' => Setting::getValue('site_name'),
                    'ticket_subject' => $ticket->subject,
                    'ticket_category' => $ticket->category,
                    'ticket_priority' => $ticket->priority,
                    'ticket_description' => $ticket->description,
                    'user_name' => Auth::guard('web')->user()->name,
                    'user_email' => Auth::guard('web')->user()->email,
                    'site_name' => config('app.name'),
                ]);
            }

            sweetalert()->success('Reply added successfully.');
            return back();
        } catch (\Exception $e) {


            sweetalert()->error('Failed to add reply. Please try again.');
            return back()->withErrors(['error' => 'Failed to add reply.'])->withInput();
        }
    }


    /**
     * Close the ticket.
     */
    public function close($id)
    {
        try {
            $ticket = Ticket::where('user_id', Auth::guard('web')->id())->findOrFail($id);

            if ($ticket->status === 'closed') {
                sweetalert()->info('This ticket is already closed.');
                return back();
            }

            $ticket->update(['status' => 'closed']);
             // Send notification email to user
             if (AdminModule::isModuleEnabled('Email')) {
                $emailController = new \Modules\Email\Http\Controllers\EmailController();

                // Send notification to the user
                $emailController->sendDynamicEmail('Ticket Closed Notification', [
                    'email' => Auth::guard('web')->user()->email,
                    'name' => Auth::guard('web')->user()->name,
                    'username' => Auth::guard('web')->user()->username,
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
        } catch (\Exception $e) {
            sweetalert()->error('Failed to close ticket.');
            return back()->withErrors(['error' => 'Failed to close ticket.']);
        }
    }

    /**
     * Reopen the ticket.
     */
    public function reopen($id)
    {
        try {
            $ticket = Ticket::where('user_id', Auth::guard('web')->id())->findOrFail($id);

            if ($ticket->status !== 'closed') {
                sweetalert()->info('This ticket is not closed.');
                return back();
            }

            $ticket->update(['status' => 'open']);

             // Send notification email to user
            //  if (AdminModule::isModuleEnabled('Email')) {
            //     $emailController = new \Modules\Email\Http\Controllers\EmailController();

            //     // Send notification to the user
            //     $emailController->sendDynamicEmail('Ticket Closed Notification', [
            //         'email' => Auth::guard('web')->user()->email,
            //         'name' => Auth::guard('web')->user()->name,
            //         'username' => Auth::guard('web')->user()->username,
            //         'ticket_subject' => $ticket->subject,
            //         'ticket_id' => $ticket->id,
            //         'ticket_category' => $ticket->category,
            //         'ticket_priority' => $ticket->priority,
            //         'ticket_description' => $ticket->description,
            //         'site_name' => $settings['site_name'] ?? config('app.name'),
            //     ]);

            // }
            sweetalert()->success('Ticket reopened successfully.');
            return back();
        } catch (\Exception $e) {
            sweetalert()->error('Failed to reopen ticket.');
            return back()->withErrors(['error' => 'Failed to reopen ticket.']);
        }
    }
}

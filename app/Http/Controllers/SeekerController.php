<?php

namespace App\Http\Controllers;

use App\Models\Seeker;
use App\Mail\SeekerEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Facades\Client;

class SeekerController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is not logged in
        if (!auth()->check()) {
            return redirect()->route('auth.login'); // Redirect to the login page
        }
    
        // Initialize the query to retrieve seekers
        $query = Seeker::where('seeker_missionary', auth()->id());
    
        // Check if there's a search query in the request
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Filter seekers based on the search term for first name, last name, or email
            $query->where(function($q) use ($searchTerm) {
                $q->where('seeker_fname', 'like', '%' . $searchTerm . '%') // Search by first name
                  ->orWhere('seeker_lname', 'like', '%' . $searchTerm . '%') // Search by last name
                  ->orWhere('seeker_email', 'like', '%' . $searchTerm . '%'); // Search by email
            });
        }
    
        // Retrieve the filtered seekers
        $seekers = $query->get();
    
        // Return the pages/seekerList view and pass the seekers data
        return view('pages.seekersList', compact('seekers'));
    }      

    // Show the sign-up form for seekers
    public function showSignupForm()
    {
        return view('pages.signupseeker');
    }

    // Handle the sign-up for seekers
    public function signup(Request $request)
    {
        // Validate the request
        $request->validate([
            'seeker_fname' => 'required|string|max:255',
            'seeker_lname' => 'required|string|max:255',
            'seeker_nickname' => 'nullable|string|max:255',
            'seeker_gender' => 'required|string',
            'seeker_age' => 'required|integer',
            'seeker_email' => 'required|string|email|max:255|unique:seekers',
            'seeker_country' => 'required|string|max:255',
            'seeker_city' => 'required|string|max:255',
            'seeker_catch_from' => 'nullable|string|max:255',
        ]);
    
        // Create a new seeker with default values
        Seeker::create(array_merge($request->all(), [
            'seeker_missionary' => null,          // Default to null
            'seeker_dgroup_leader' => null,       // Default to null
            'seeker_status' => 'Infant',           // Default to 'Infant'
        ]));
    
        // Redirect or return response
        return redirect()->route('seekers.signup')->with('success', 'Thank you for registering and decided to become part of our community.');
    }
    
    // Show the details of a specific seeker
    public function show($id)
    {
        // Retrieve the seeker by ID
        $seeker = Seeker::findOrFail($id);

        // Return the seeker detail view and pass the seeker data
        return view('pages.seekerDetail', compact('seeker'));
    }

    public function changeStatus(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'seeker_status' => 'required|string|in:Infant,Child,Adult,Parent',
        ]);

        // Find the seeker by ID
        $seeker = Seeker::findOrFail($id);
        
        // Update the status
        $seeker->seeker_status = $request->seeker_status;
        $seeker->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    // Send email to selected seekers
    public function sendSeekerEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'emails' => 'required|string', // Validate the emails field
        ]);
    
        // Get the authenticated user's first name
        $fname = auth()->user()->user_fname;
    
        // Split the emails into an array
        $emails = explode(',', $request->emails);
    
        // Send an email to each address
        foreach ($emails as $email) {
            Mail::to(trim($email))->send(new SeekerEmail($fname, $request->subject, $request->body));
        }
    
        return redirect()->back()->with('success', 'Emails sent successfully!');
    }    

    public function fetchMessageIds()
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }
    
        // Connect to the IMAP account
        $client = Client::account('default');
        $client->connect();
    
        // Retrieve messages from both INBOX and Sent folders
        $inboxFolder = $client->getFolder('INBOX');
        $sentFolder = $client->getFolder('Sent Mail');
    
        $inboxMessages = $inboxFolder->query()->all()->get();
        $sentMessages = $sentFolder->query()->all()->get();
    
        // Combine messages from both folders
        $allMessages = array_merge($inboxMessages->all(), $sentMessages->all());
    
        // Sort messages by date (oldest first)
        usort($allMessages, function($a, $b) {
            return strtotime($a->getDate()) - strtotime($b->getDate());
        });
    
        // Group messages by a normalized subject
        $groupedMessages = [];
    
        foreach ($allMessages as $message) {
            // Normalize the subject
            $normalizedSubject = preg_replace('/^Re:\s+/i', '', $message->getSubject());
            $normalizedSubject = trim($normalizedSubject); // Trim whitespace
    
            // Use Message-ID as a thread reference
            $threadKey = $message->getMessageId() ?? $normalizedSubject;
    
            // Group by normalized subject
            $groupedMessages[$normalizedSubject][] = [
                'id' => $message->getMessageId(),
                'subject' => $normalizedSubject,
                'from' => $message->getFrom()[0]->mail ?? 'Unknown',
                'to' => $message->getTo()[0]->mail ?? 'Unknown',
                'date' => $message->getDate(),
                'body' => $message->getHTMLBody() ?? $message->getTextBody(),
                'folder' => $message->getFolderPath()
            ];
        }
    
        // Pass the grouped messages to the view
        return view('pages.fetchEmialIds', compact('groupedMessages'));
    }
    
    
    /*
    public function fetchEmails()
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            return redirect()->route('auth.login'); // Redirect to login if not authenticated
        }
    
        // Get the IMAP client for the default account
        $client = Client::account('default');
    
        // Connect to the IMAP server
        try {
            $client->connect();
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to connect to email server.');
            return redirect()->back(); // Redirect back if connection fails
        }
    
        try {
            $folders = $client->getFolders();
        } catch (\Exception $e) {
            \Log::error('Failed to fetch folders: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to fetch folders.');
        }
    
        // Prepare to collect messages
        $emails = [];
    
        // Loop through each Mailbox
        foreach ($folders as $folder) {
            try {
                $messages = $folder->messages()->all()->get();
            } catch (\Exception $e) {
                \Log::warning('Failed to retrieve messages from folder: ' . $folder->name);
                continue; // Skip to the next folder
            }
    
            // Check if there are any messages
            if ($messages->isEmpty()) {
                \Log::info('No messages found in folder: ' . $folder->name);
                continue;
            }
    
            // Loop through each message
            foreach ($messages as $message) {
                $messageId = $message->getId(); // Get the unique Message-ID
                $from = $message->getFrom()[0]; // Get the first sender
                $timestamp = $message->getDate(); // Get the email date
    
                // Prepare the email data
                \Log::info('MESSAGE ID: ', ['message_id' => $messageId]);

                $emailData = [
                    'body' => $message->getHTMLBody(),
                    'attachments' => $message->getAttachments()->count(),
                    'sender' => $from->mail, // Use mail property for the email address
                    'sender_name' => $from->personal ?? 'Unknown', // Use personal for the name or default to 'Unknown'
                    'timestamp' => $timestamp, // Email date
                    'subject' => $message->getSubject() ?? 'No subject', // Get subject
                ];
    
                // Group emails by Message-ID
                if (isset($emails[$messageId])) {
                    // Increment the count if the Message-ID already exists
                    $emails[$messageId]['count']++;
                    // Update the latest email timestamp if necessary
                    if (strtotime($timestamp) > strtotime($emails[$messageId]['latest_timestamp'])) {
                        $emails[$messageId]['latest_timestamp'] = $timestamp;
                        $emails[$messageId]['latest_email'] = $emailData; // Update latest email data
                    }
                } else {
                    // Create a new entry for this Message-ID
                    $emails[$messageId] = [
                        'count' => 1,
                        'latest_timestamp' => $timestamp,
                        'latest_email' => $emailData, // Store the latest email data
                    ];
                }
            }
        }
    
        // Prepare the final email data for the view
        $finalEmails = [];
        foreach ($emails as $data) {        
            $finalEmails[] = [
                'subject' => $data['latest_email']['subject'],
                'count' => $data['count'],
                'latest_email' => $data['latest_email'],
                'latest_timestamp' => $data['latest_timestamp'],
            ];
        }        
    
        // Return a view with the collected emails
        return view('pages.fetchedEmails', compact('finalEmails'));
    }     
    
    // In EmailController.php
    public function showEmailThread($id)
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        // Get the IMAP client for the default account
        $client = Client::account('default');
        
        try {
            $client->connect();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to connect to email server.');
        }

        // Fetch all folders and filter messages with the provided Message-ID
        $threadMessages = [];
        $folders = $client->getFolders();

        foreach ($folders as $folder) {
            try {
                $messages = $folder->messages()->all()->get();
                foreach ($messages as $message) {
                    if ($message->getId() === $id) {
                        $threadMessages[] = [
                            'subject' => $message->getSubject(),
                            'sender' => $message->getFrom()[0]->mail,
                            'sender_name' => $message->getFrom()[0]->personal ?? 'Unknown',
                            'timestamp' => $message->getDate(),
                            'body' => $message->getHTMLBody(),
                            'attachments' => $message->getAttachments(),
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to retrieve messages from folder: ' . $folder->name);
                continue;
            }
        }

        // Return the thread view with all the messages
        return view('pages.emailThread', compact('threadMessages'));
    }
    */
}

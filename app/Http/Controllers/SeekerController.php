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
        \Log::info('Request data:', $request->all()); // Log all incoming request data
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'emails' => 'required|string', // Validate the emails field
        ]);
    
        // Split the emails into an array
        $emails = explode(',', $request->emails);
    
        // Log the email addresses
        \Log::info('Sending emails to the following addresses:', $emails);
    
        // Send an email to each address
        foreach ($emails as $email) {
            Mail::to(trim($email))->send(new SeekerEmail($email, $request->subject, $request->body));
        }
    
        return redirect()->back()->with('success', 'Emails sent successfully!');
    }  
    
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
                $from = $message->getFrom()[0]; // Get the first sender
            
                // Get the replies (you may need to implement this logic depending on your IMAP setup)
                $replies = $message->getReplies(); // Hypothetical method; adjust based on your actual implementation
            
                $emails[] = [
                    'subject' => $message->getSubject() ?? 'No subject', // Default to 'No subject' if empty
                    'body' => $message->getHTMLBody(),
                    'attachments' => $message->getAttachments()->count(),
                    'sender' => $from->mail, // Use mail property for the email address
                    'sender_name' => $from->personal ?? 'Unknown', // Use personal for the name or default to 'Unknown'
                    'timestamp' => $message->getDate(), // Assuming this method returns the email date
                    'replies' => $replies, // Add replies to the email data
                ];
            }                       
        }
    
        // Return a view with the collected emails
        return view('pages.fetchedEmails', compact('emails'));
    }        
}

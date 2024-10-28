<?php

namespace App\Http\Controllers;

use App\Models\Seeker;
use App\Mail\SeekerEmail;
use App\Mail\ReplyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Facades\Client;
use Carbon\Carbon;

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
    
        // Get the authenticated user's first and last names
        $fname = auth()->user()->user_fname;
        $lname = auth()->user()->user_lname; // Get last name
    
        // Get the current time in Asia/Manila timezone
        $dateTime = Carbon::now('Asia/Manila')->format('F j, Y, g:i a'); // Format it as desired
    
        // Split the emails into an array
        $emails = explode(',', $request->emails);
    
        // Send an email to each address
        foreach ($emails as $email) {
            Mail::to(trim($email))->send(new SeekerEmail($fname, $lname, $request->subject, $request->body, $dateTime));
        }
    
        return redirect()->back()->with('success', 'Emails sent successfully!');
    }





    public function fetchMessageIds()
    {
        // Authentication check
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }
    
        // Connect to the IMAP account
        try {
            $client = Client::account('default');
            $client->connect();
        } catch (Exception $e) {
            // Handle IMAP connection errors
            Log::error($e->getMessage());
            return view('errors.imap-connection-failed');
        }
    
        // Retrieve messages from INBOX folder
        $inboxFolder = $client->getFolder('INBOX');
        $inboxMessages = $inboxFolder->query()->all()->get();
    
        // Retrieve sent messages and filter by sender name
        $sentFolder = $client->getFolder('Sent Mail');
        $sentMessages = $sentFolder->query()->all()->get();
        
        // Get authenticated user's full name
        $fullName = 'WOTG Mission ' . auth()->user()->user_fname . ' ' . auth()->user()->user_lname;
    
        // Filter sent messages by sender name
        $filteredSentMessages = array_filter($sentMessages->all(), function($message) use ($fullName) {
            $from = $message->getFrom()[0];
            $senderName = $from->personal ?? 'Unknown';
            return $senderName === $fullName; // Check if the sender name matches
        });

        $filteredInboxMessages = array_filter($inboxMessages->all(), function($message) use ($fullName) {
            $to = $message->getTo();
            
            // Check if there are any recipients and extract the first one
            if (!empty($to)) {
                $recipientName = $to[0]->personal ?? 'Unknown'; // Extract recipient's name if available
            } else {
                $recipientName = null; // No recipients
            }
        
            // Use "WOTG $fullName" if recipient name is null or empty
            if (empty($recipientName)) {
                $recipientName = "WOTG $fullName";
            }
        
            return $recipientName === $fullName; // Check if the recipient name matches
        });
        
    
        // Combine messages from both folders
        $allMessages = array_merge($filteredInboxMessages, $filteredSentMessages);
    
        // Sort messages by date (oldest first)
        usort($allMessages, function($a, $b) {
            return strtotime($a->getDate()) - strtotime($b->getDate());
        });
    
        // Group messages by normalized subject
        $groupedMessages = [];
        foreach ($allMessages as $message) {
            // Normalize the subject
            $normalizedSubject = preg_replace('/^(Re:\s+)+/i', '', $message->getSubject());
            $normalizedSubject = trim($normalizedSubject);
    
            // Use Message-ID as a thread reference (or fall back to normalized subject)
            $threadKey = $message->getMessageId() ?? $normalizedSubject;
    
            // Extract sender's name and email
            $from = $message->getFrom()[0];
            $senderName = $from->personal ?? 'Unknown'; // Extract name if available
            $senderEmail = $from->mail ?? 'Unknown'; // Extract email

            $to = $message->getTo()[0];
            $reciepientName = $to->personal ?? 'Unknown'; // Extract name if available
            $reciepientEmail = $to->mail ?? 'Unknown'; // Extract email
    
            // Group by normalized subject
            $groupedMessages[$normalizedSubject][] = [
                'id' => $message->getMessageId(),
                'subject' => $normalizedSubject,
                'from' => $senderName . ' <' . $senderEmail . '>', // Combine name and email
                'to' => $reciepientName . ' <' . $reciepientEmail . '>', 
                'date' => $message->getDate(),
                'body' => $message->getHTMLBody() ?? $message->getTextBody(),
                'folder' => $message->getFolderPath(),
            ];
        }
    
        // Pass the grouped messages to the view
        return view('pages.fetchEmialIds', compact('groupedMessages'));
    } 
    




    public function sendReply(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'to' => 'required|email',
        ]);
    
        // Get the authenticated user's first and last names
        $fname = auth()->user()->user_fname;
        $lname = auth()->user()->user_lname;
    
        // Get the current time in Asia/Manila timezone
        $dateTime = Carbon::now('Asia/Manila')->format('F j, Y, g:i a');
    
        // Send the reply email
        Mail::to($request->to)->send(new ReplyEmail($fname, $lname, $request->subject, $request->body, $dateTime));
    
        return redirect()->back()->with('success', 'Reply sent successfully!');
    }
}

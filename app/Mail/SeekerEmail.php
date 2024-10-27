<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeekerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname; // Renamed to fname
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param $fname
     * @param $subject
     * @param $body
     */
    public function __construct($fname, $subject, $body)
    {
        $this->fname = $fname; // Use fname from the authenticated user
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@wotgonline.com', 'WOTG Mission ' . $this->fname) // Include the authenticated user's fname here
                    ->subject($this->subject) // Use the custom subject
                    ->view('emails.seekerEmail') // Ensure the view is correct
                    ->with(['body' => $this->body]); // Pass the body to the view
    }
}



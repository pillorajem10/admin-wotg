<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeekerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname; // First name
    public $lname; // Last name
    public $subject;
    public $body;
    public $dateTime; // Add the dateTime property

    /**
     * Create a new message instance.
     *
     * @param $fname
     * @param $lname
     * @param $subject
     * @param $body
     * @param $dateTime
     */
    public function __construct($fname, $lname, $subject, $body, $dateTime)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->subject = $subject;
        $this->body = $body;
        $this->dateTime = $dateTime; // Set the dateTime
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hoperefresh@wotgonline.com', 'Hope Refresh - WOTG - ' . $this->fname . ' ' . $this->lname)
                    ->subject($this->subject)
                    ->view('emails.seekerEmail') // View name
                    ->with([
                        'body' => $this->body,
                        'dateTime' => $this->dateTime, // Pass the dateTime to the view
                        'subject' => $this->subject, // Pass the subject to the view
                    ]);
    }    
}

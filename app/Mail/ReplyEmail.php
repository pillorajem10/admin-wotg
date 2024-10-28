<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname;
    public $lname;
    public $subject;
    public $body;
    public $dateTime;

    public function __construct($fname, $lname, $subject, $body, $dateTime)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->subject = $subject;
        $this->body = $body;
        $this->dateTime = $dateTime;
    }

    public function build()
    {
        return $this
            ->from('hoperefresh@wotgonline.com', 'WOTG Mission ' . $this->fname . ' ' . $this->lname)
            ->subject($this->subject)
            ->view('emails.reply') // Ensure this view exists
            ->with([
                'body' => $this->body,
                'dateTime' => $this->dateTime, // Pass dateTime to the view
            ]);
    }
}

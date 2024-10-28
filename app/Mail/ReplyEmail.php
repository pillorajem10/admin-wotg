<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReplyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname;
    public $lname;
    public $subject;
    public $body;
    public $dateTime;
    public $originalMessageId;

    public function __construct($fname, $lname, $subject, $body, $dateTime, $originalMessageId)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->subject = $subject;
        $this->body = $body;
        $this->dateTime = $dateTime;
        $this->originalMessageId = $originalMessageId;

        Log::info('Original Message ID Mailable: ' . $this->originalMessageId);
    }

    public function build()
    {
        return $this
            ->from('hoperefresh@wotgonline.com', 'WOTG Mission ' . $this->fname . ' ' . $this->lname)
            ->view('emails.reply')
            ->with([
                'body' => $this->body,
                'dateTime' => $this->dateTime,
            ])
            ->withSwiftMessage(function ($message) {
                // Ensure the headers are correctly set
                $message->getHeaders()->addTextHeader('In-Reply-To', $this->originalMessageId);
                $message->getHeaders()->addTextHeader('References', $this->originalMessageId);
            });
    }
}

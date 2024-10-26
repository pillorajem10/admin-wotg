<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    use HasFactory;

    protected $table = 'email_messages';

    protected $fillable = [
        'email_thread_id',
        'body',             // Keeping body in fillable, remove subject if not needed
        'sender_email',
        'receiver_email',
    ];

    // Define the relationship with the EmailThread model
    public function emailThread()
    {
        return $this->belongsTo(EmailThread::class, 'email_thread_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailThread extends Model
{
    use HasFactory;

    protected $table = 'email_threads'; // Specify the table name

    protected $fillable = [
        'subject',       // Include subject in fillable
        'email_messages', // Keep email_messages in fillable
    ];

    protected $casts = [
        'email_messages' => 'array', // Automatically handle JSON
    ];

    // Optional: Define relationships if needed
    public function messages()
    {
        return $this->hasMany(EmailMessage::class, 'email_thread_id');
    }
}

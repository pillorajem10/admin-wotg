<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    use HasFactory;

    protected $table = 'prayer_requests'; // Specify the table name if it differs from the default

    protected $fillable = [
        'pr_missionary',
        'pr_seeker',
        'pr_prayer',
        'pr_progress',
        'pr_private',                  
        'pr_answered_prayer_date',     
    ];

    // Define the relationship with User (pr_missionary)
    public function missionary()
    {
        return $this->belongsTo(User::class, 'pr_missionary');
    }

    // Define the relationship with Seeker (pr_seeker)
    public function seeker()
    {
        return $this->belongsTo(Seeker::class, 'pr_seeker');
    }
}

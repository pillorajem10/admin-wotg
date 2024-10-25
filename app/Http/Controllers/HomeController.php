<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seeker;
use App\Models\Blog;
use Carbon\Carbon; 

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        
        // Set the timezone to Manila
        $today = Carbon::now('Asia/Manila');
    
        // Count approved blogs with a release date less than or equal to today
        $blogCount = Blog::where('blog_release_date_and_time', '<=', $today)
                         ->where('blog_approved', true)
                         ->count();
    
        // Count seekers associated with the authenticated user
        $seekerCount = Seeker::where('seeker_missionary', $user->id)->count();
    
        return view('pages.home', compact('user', 'seekerCount', 'blogCount')); // Pass user, seekerCount, and blogCount to the view
    }      
}

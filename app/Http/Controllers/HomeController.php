<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seeker;
use App\Models\Blog;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $seekerCount = Seeker::where('seeker_missionary', $user->id)->count(); 
        $blogCount = Blog::count(); // Count all blogs
    
        return view('pages.home', compact('user', 'seekerCount', 'blogCount')); // Pass user, seekerCount, and blogCount to the view
    }    
}

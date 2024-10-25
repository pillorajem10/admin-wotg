<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Seeker;
use Illuminate\Http\Request;
use App\Mail\DailyBlogReport; 
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail; 


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    public function index(Request $request)
    {
        // Set the timezone to Manila
        $today = Carbon::now('Asia/Manila');
    
        // Initialize the query to fetch approved blogs with a release date less than or equal to today
        $query = Blog::where('blog_release_date_and_time', '<=', $today)
                      ->where('blog_approved', true);
    
        // Check if there's a search query in the request
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Filter blogs based on the search term for blog_title
            $query->where('blog_title', 'like', '%' . $searchTerm . '%');
        }
    
        // Paginate the results (10 per page)
        $blogs = $query->paginate(10);
    
        return view('pages.blogs', compact('blogs'));
    }          

    // Show the details of a specific blog
    public function show($id)
    {
        $blog = Blog::findOrFail($id); // Fetch the specific blog or fail if not found
        return view('pages.blogDetails', compact('blog'));
    }
}

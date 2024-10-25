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
        // Get the search term from the request
        $search = $request->input('search');
    
        // Fetch blogs with pagination, applying the search filter if provided
        $blogs = Blog::when($search, function ($query, $search) {
            return $query->where('blog_title', 'like', '%' . $search . '%');
        })->paginate(5);
    
        return view('pages.blogs', compact('blogs', 'search'));
    }       

    // Show the details of a specific blog
    public function show($id)
    {
        $blog = Blog::findOrFail($id); // Fetch the specific blog or fail if not found
        return view('pages.blogDetails', compact('blog'));
    }
}

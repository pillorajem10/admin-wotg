<?php

namespace App\Http\Controllers;

use App\Models\Seeker;
use Illuminate\Http\Request;

class SeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Apply middleware to all methods in this controller
    }

    public function index()
    {
        // Retrieve all seekers from the database
        $seekers = Seeker::all();

        // Return the pages/seekerList view and pass the seekers data
        return view('pages.seekersList', compact('seekers'));
    }

    // Show the sign-up form for seekers
    public function showSignupForm()
    {
        return view('pages.signupseeker');
    }

    // Handle the sign-up for seekers
    public function signup(Request $request)
    {
        // Validate the request
        $request->validate([
            'seeker_fname' => 'required|string|max:255',
            'seeker_lname' => 'required|string|max:255',
            'seeker_nickname' => 'nullable|string|max:255',
            'seeker_gender' => 'required|string',
            'seeker_age' => 'required|integer',
            'seeker_email' => 'required|string|email|max:255|unique:seekers',
            'seeker_country' => 'required|string|max:255',
            'seeker_city' => 'required|string|max:255',
            'seeker_catch_from' => 'nullable|string|max:255',
        ]);
    
        // Create a new seeker with default values
        Seeker::create(array_merge($request->all(), [
            'seeker_missionary' => null,          // Default to null
            'seeker_dgroup_leader' => null,       // Default to null
            'seeker_status' => 'Infant',           // Default to 'Infant'
        ]));
    
        // Redirect or return response
        return redirect()->route('seekers.signup')->with('success', 'Seeker registration successful!');
    }
    
    // Show the details of a specific seeker
    public function show($id)
    {
        // Retrieve the seeker by ID
        $seeker = Seeker::findOrFail($id);

        // Return the seeker detail view and pass the seeker data
        return view('pages.seekerDetail', compact('seeker'));
    }
}

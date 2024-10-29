<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrayerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Seeker;

class PrayerRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch prayer requests with pagination
        $prayerRequests = PrayerRequest::paginate(10); // Adjust the number 10 as needed for the number of items per page
    
        // Pass the paginated prayer requests to the view
        return view('pages.prayerRequestsList', compact('prayerRequests'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve seekers where seeker_missionary is the authenticated user's ID
        $seekers = Seeker::where('seeker_missionary', $userId)->get();

        // Pass the seekers to the view
        return view('pages.addPrayerRequest', compact('seekers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'pr_seeker' => 'required|exists:seekers,id', // Ensure seeker exists
            'pr_prayer' => 'required|string', // Validate prayer request content
        ]);
    
        // Create the prayer request entry using the authenticated user's ID for missionary
        PrayerRequest::create([
            'pr_missionary' => auth()->id(), // Get the authenticated user's ID
            'pr_seeker' => $request->pr_seeker, // Get seeker ID
            'pr_prayer' => $request->pr_prayer, // Get prayer request
            'pr_progress' => 'requested', // Default value for progress
        ]);
    
        // Redirect or return response
        return redirect()->route('prayerRequest.index')->with('success', 'Prayer request created successfully.');
    }    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

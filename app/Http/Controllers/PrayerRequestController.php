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
    public function index(Request $request)
    {
        // Fetch the authenticated user's ID
        $authId = auth()->id();
    
        // Get the filter value from the request
        $filter = $request->input('filter', 'all'); // Default to 'all'
    
        // Build the query
        $query = PrayerRequest::where(function($query) use ($authId) {
            $query->where('pr_private', false) // Public requests
                  ->orWhere('pr_missionary', $authId); // Private requests for the authenticated user
        });
    
        // Apply the filter
        if ($filter === 'answered') {
            $query->whereNotNull('pr_answered_prayer_date');
        } elseif ($filter === 'unanswered') {
            $query->whereNull('pr_answered_prayer_date');
        }
    
        // Fetch prayer requests with pagination
        $prayerRequests = $query->paginate(10); // Adjust the number as needed
    
        // Pass the paginated prayer requests to the view along with the filter
        return view('pages.prayerRequestsList', compact('prayerRequests', 'filter'));
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
            'pr_progress' => 'unanswered', // Default value for progress
            'pr_private' => $request->pr_private, // Default value for pr_private
            'pr_answered_prayer_date' => null, // Default value for pr_answered_prayer_date
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
        // Fetch the existing prayer request by ID
        $prayerRequest = PrayerRequest::findOrFail($id);
        
        // Fetch all seekers to populate the dropdown
        $seekers = Seeker::all();
        
        // Return the view with the prayer request and seekers
        return view('pages.editPrayerRequest', compact('prayerRequest', 'seekers'));
    }    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'pr_seeker' => 'required|exists:seekers,id', // Ensure seeker exists
            'pr_prayer' => 'required|string', // Validate prayer request content
            'pr_private' => 'required|boolean', // Ensure privacy field is a boolean
            'pr_answered_prayer_date' => 'nullable|date', // Validate answered prayer date
        ]);
    
        // Find the existing prayer request
        $prayerRequest = PrayerRequest::findOrFail($id);
    
        // Determine the progress status
        $pr_progress = !is_null($request->pr_answered_prayer_date) ? 'answered' : $prayerRequest->pr_progress;
    
        // Update the prayer request with the new values
        $prayerRequest->update([
            'pr_seeker' => $request->pr_seeker,
            'pr_prayer' => $request->pr_prayer,
            'pr_private' => $request->pr_private,
            'pr_answered_prayer_date' => $request->pr_answered_prayer_date, // Add the answered prayer date
            'pr_progress' => $pr_progress, // Update progress based on answered date
        ]);
    
        // Redirect back with a success message
        return redirect()->route('prayerRequest.index')->with('success', 'Prayer request updated successfully.');
    }
     
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PrayerRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

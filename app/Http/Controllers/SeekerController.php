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
}

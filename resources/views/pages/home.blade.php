@extends('layouts.layout')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css?v=1.9') }}">
@endsection

@section('content')
    <h2>Welcome, {{ $user->user_fname }}!</h2>

    <div class="page-header">
        <div>
            Romans 1:16
        </div>
        <div>
            “For I am not ashamed of the gospel, because it is the power of God that brings salvation to everyone who believes…”
        </div>
    </div>

    <div class="custom-card">
        <div class="card-header">
            Seekers Count
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $seekerCount }}</h5>
            <p class="card-text">Total number of seekers associated with you.</p>
            <a href="{{ route('seekers.index') }}" class="btn-view">View Seekers</a> <!-- Button for Seekers -->
        </div>
    </div>

    <div class="custom-card">
        <div class="card-header">
            Blogs Count
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $blogCount }}</h5>
            <p class="card-text">Total number of blogs.</p>
            <a href="{{ route('blogs.index') }}" class="btn-view">View Blogs</a> <!-- Button for Blogs -->
        </div>
    </div>
@endsection

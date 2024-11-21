@extends('layouts.layout')

@section('title', 'Home')

@section('styles')
    <!-- Link the external loading overlay CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="header-container">
        <div>
            Romans 1:16<br>
            “For I am not ashamed of the gospel, because it is the power of God that brings salvation to everyone who believes…”
        </div>
    </div>

    <div class="home-container">
        <!-- Loading Overlay -->
        <div id="loading-overlay">
            <div class="spinner"></div> <!-- Spinner inside the overlay -->
        </div>

        <h2>Welcome, {{ $user->user_fname }}!</h2>

        <!-- Custom Cards Section - COMMENTED OUT -->
        <div class="custom-card">
            <div class="card-header">
                Seekers Count
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $seekerCount }}</h5>
                <p class="card-text">Total number of seekers associated with you.</p>
                <a href="{{ route('seekers.index') }}" class="btn-view">View Seekers</a>
            </div>
        </div>

        <div class="custom-card">
            <div class="card-header">
                Blogs Count
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $blogCount }}</h5>
                <p class="card-text">Total number of blogs.</p>
                <a href="{{ route('blogs.index') }}" class="btn-view">View Blogs</a>
            </div>
        </div>

        {{--<div class="custom-card">
            <div class="card-header">
                Resources and Tools
            </div>
            <div class="card-body">
                <div class="btn-container">
                    <a href="{{ route('static.faq') }}" class="btn btn-main">FAQs</a>
                    <a href="{{ route('static.daan') }}" class="btn btn-main">Ang Daan Papuntang Langit</a>
                    <a href="{{ route('static.plantDisc') }}" class="btn btn-main">PLANT Discipleship</a>
                    <a href="{{ route('static.tipsForBuildingRelationships') }}" class="btn btn-main">Practical Tips for Building Relationships</a>
                    <a href="{{ route('static.gabay') }}" class="btn btn-main">Gabay para sa Missionaries: ANG DAAN PATUNGONG LANGIT</a>
                </div>
            </div>
        </div>--}}            
        <script src="{{ asset('js/home.js') }}"></script>
    </div>
@endsection

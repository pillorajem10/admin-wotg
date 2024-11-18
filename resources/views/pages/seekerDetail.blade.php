@extends('layouts.layout')

@section('title', 'Seeker Details')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/seekerDetails.css?v=2.1') }}">
@endsection

@section('content')
    <div class="seeker-deets-cont">
        <div class="back-link">
            <a href="/seekers" class="back-button">
                <span class="arrow">&larr;</span> Go Back
            </a>
        </div>
        <div class="seeker-detail">
            <h2>{{ $seeker->seeker_fname }} {{ $seeker->seeker_lname }}</h2>
            <p><strong>Nickname:</strong> {{ $seeker->seeker_nickname }}</p>
            <p><strong>Gender:</strong> {{ $seeker->seeker_gender }}</p>
            <p><strong>Age:</strong> {{ $seeker->seeker_age }}</p>
            <p><strong>Email:</strong> {{ $seeker->seeker_email }}</p>
            <p><strong>Country:</strong> {{ $seeker->seeker_country }}</p>
            <p><strong>City:</strong> {{ $seeker->seeker_city }}</p>
            <p><strong>Catch From:</strong> {{ $seeker->seeker_catch_from }}</p>
            
            <form action="{{ route('seeker.updateStatus', $seeker->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <strong>Status:</strong>
                    <select name="seeker_status" id="seeker_status" onchange="this.form.submit()">
                        <option value="New Seeker" {{ $seeker->seeker_status == 'New Seeker' ? 'selected' : '' }}>New Seeker</option>
                        <option value="Engaged" {{ $seeker->seeker_status == 'Engaged' ? 'selected' : '' }}>Engaged</option>
                        <option value="Gospel Shared" {{ $seeker->seeker_status == 'Gospel Shared' ? 'selected' : '' }}>Gospel Shared</option>
                        <option value="D-group Member" {{ $seeker->seeker_status == 'D-group Member' ? 'selected' : '' }}>D-group Member</option>
                        <option value="Not Ready" {{ $seeker->seeker_status == 'Not Ready' ? 'selected' : '' }}>Not Ready</option>
                    </select>                
                </div>
            </form>
        </div>
    </div>
@endsection

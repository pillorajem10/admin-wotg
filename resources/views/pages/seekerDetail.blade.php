@extends('layouts.layout')

@section('title', 'Seeker Details')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/seekerDetails.css?v=1.8') }}">
@endsection

@section('content')
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
                    <option value="Infant" {{ $seeker->seeker_status == 'Infant' ? 'selected' : '' }}>Infant</option>
                    <option value="Child" {{ $seeker->seeker_status == 'Child' ? 'selected' : '' }}>Child</option>
                    <option value="Adult" {{ $seeker->seeker_status == 'Adult' ? 'selected' : '' }}>Adult</option>
                    <option value="Parent" {{ $seeker->seeker_status == 'Parent' ? 'selected' : '' }}>Parent</option>
                </select>
            </div>
        </form>
    </div>
@endsection

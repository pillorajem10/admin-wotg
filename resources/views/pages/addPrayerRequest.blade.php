@extends('layouts.layout')

@section('title', 'Add Prayer Request')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/addPrayerRequest.css?v=2.1') }}">
@endsection

@section('content')
    <div class="prayer-request-container">
        <form action="{{ route('prayerRequest.store') }}" method="POST" class="prayer-request-form">
            @csrf

            <div class="form-group">
                <label for="pr_seeker" class="form-label">Seeker:</label>
                <select id="pr_seeker" name="pr_seeker" class="form-select" required>
                    <option value="">Select a seeker</option>
                    @foreach($seekers as $seeker)
                        <option value="{{ $seeker->id }}">{{ $seeker->seeker_fname }} {{ $seeker->seeker_lname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pr_prayer" class="form-label">Prayer Request:</label>
                <textarea id="pr_prayer" name="pr_prayer" class="form-textarea" required></textarea>
            </div>

            <div class="form-group">
                <label for="pr_private" class="form-label">Privacy:</label>
                <select id="pr_private" name="pr_private" class="form-select" required>
                    <option value=1>Private</option>
                    <option value=0>Public</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ route('prayerRequest.index') }}" class="btn-back">Back to Prayer Requests</a>
        </div>
    </div>
@endsection

@extends('layouts.layout')

@section('title', 'Edit Prayer Request')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/addPrayerRequest.css?v=1.9') }}">
@endsection

@section('content')
    <div class="prayer-request-container">
        <form action="{{ route('prayerRequest.update', $prayerRequest->id) }}" method="POST" class="prayer-request-form">
            @csrf
            @method('PUT') <!-- Add this for PUT request -->

            <div class="form-group">
                <label for="pr_seeker" class="form-label">Seeker:</label>
                <select id="pr_seeker" name="pr_seeker" class="form-select" required>
                    <option value="">Select a seeker</option>
                    @foreach($seekers as $seeker)
                        <option value="{{ $seeker->id }}" {{ $seeker->id == $prayerRequest->pr_seeker ? 'selected' : '' }}>
                            {{ $seeker->seeker_fname }} {{ $seeker->seeker_lname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pr_prayer" class="form-label">Prayer Request:</label>
                <textarea id="pr_prayer" name="pr_prayer" class="form-textarea" required>{{ old('pr_prayer', $prayerRequest->pr_prayer) }}</textarea>
            </div>

            <div class="form-group">
                <label for="pr_private" class="form-label">Privacy:</label>
                <select id="pr_private" name="pr_private" class="form-select" required>
                    <option value="1" {{ $prayerRequest->pr_private ? 'selected' : '' }}>Private</option>
                    <option value="0" {{ !$prayerRequest->pr_private ? 'selected' : '' }}>Public</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pr_answered_prayer_date" class="form-label">Answered Prayer Date:</label>
                <input type="date" id="pr_answered_prayer_date" name="pr_answered_prayer_date" class="form-select" value="{{ old('pr_answered_prayer_date', $prayerRequest->pr_answered_prayer_date ? \Carbon\Carbon::parse($prayerRequest->pr_answered_prayer_date)->format('Y-m-d') : '') }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ route('prayerRequest.index') }}" class="btn-back">Back to Prayer Requests</a>
        </div>
    </div>
@endsection

{{-- resources/views/pages/emailThread.blade.php --}}
@extends('layouts.layout')

@section('content')
    <h2>Email Thread</h2>

    @foreach ($threadMessages as $message)
        <div class="email-message">
            <h3>{{ $message['subject'] }}</h3>
            <p><strong>From:</strong> {{ $message['sender_name'] }} ({{ $message['sender'] }})</p>
            <p><strong>Date:</strong> {{ $message['timestamp'] }}</p>
            <div>{!! $message['body'] !!}</div>
            <hr>
        </div>
    @endforeach
@endsection

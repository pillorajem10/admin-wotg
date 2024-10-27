@extends('layouts.layout')

@section('title', 'Inbox')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/inbox.css?v=1.4') }}">
@endsection

@section('content')
    <div class="fetched-emails">
        @if(empty($groupedMessages))
            <p class="no-emails">No emails found.</p>
        @else
            @foreach($groupedMessages as $key => $messages)
                @php
                    $subject = $key; // Subject from the thread key
                @endphp

                <h2 class="email-subject">{{ $subject }}</h2> <!-- Main subject -->

                <ul class="email-list">
                    @foreach($messages as $message)
                        @php
                            $sender = $message['from'];
                            $alignmentClass = ($sender === 'wotgmission@gmail.com') ? 'from-left' : 'from-right';
                            // Use Carbon to format the date
                            $formattedDate = \Carbon\Carbon::parse($message['date'])->format('F j, Y, g:i a'); // Example format
                        @endphp
                        <li class="email-item {{ $alignmentClass }}">
                            <div class="message-body">
                                <strong class="email-from">From:</strong> {{ $sender }}<br>
                                <strong class="email-date">Date:</strong> {{ $formattedDate }}<br>
                                <strong class="email-message">Message:</strong> {!! $message['body'] !!}
                            </div>
                        </li>
                        <hr class="divider">
                    @endforeach
                </ul>
            @endforeach
        @endif
    </div>
@endsection

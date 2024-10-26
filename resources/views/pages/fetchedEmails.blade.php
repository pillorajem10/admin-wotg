@extends('layouts.layout')

@section('title', 'Emails')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/emails.css?v=1.7') }}">
@endsection

@section('content')
    <div class="email-container">
        <h1 class="inbox-title">Inbox</h1>

        @if(empty($emails))
            <div class="no-emails">
                <p>No emails received.</p>
            </div>
        @else
            <div class="email-list">
                @foreach($emails as $email)
                    <div class="email-card">
                        <div class="email-header">
                            <strong class="sender-name">{{ $email['sender_name'] }}</strong>
                            <span class="email-timestamp">
                                {{ $email['timestamp'] ? \Carbon\Carbon::parse($email['timestamp'])->format('F j, Y') : 'Unknown Date' }}
                            </span>
                        </div>
                        <div class="email-body">
                            <span class="email-subject">{{ $email['subject'] }}</span>
                        </div>
                        <div class="email-body">
                            <span class="email-body-text">{!! Str::limit($email['body'], 50) !!}</span>
                        </div>
                    </div>
                
                    <hr class="email-divider">
                @endforeach
            </div>
        @endif
    </div>
@endsection

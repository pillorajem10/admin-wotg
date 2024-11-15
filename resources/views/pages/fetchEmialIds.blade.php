@extends('layouts.layout')

@section('title', 'Inbox')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/inbox.css?v=1.9') }}">
@endsection

@section('content')
    <!-- Loading Overlay -->
    <div id="loading-overlay">
        <div class="spinner"></div> <!-- Spinner -->
    </div>

    <div class="inbox-container">
        <h1 class="inbox-title">Inbox</h1>
        
        <div class="fetched-emails">
            @if(empty($groupedMessages))
                <p class="no-emails">No emails found.</p>
            @else
                @foreach($groupedMessages as $key => $messages)
                    @php
                        $subject = $key; // Subject from the thread key
                    @endphp

                    <h2 class="email-subject"><strong>Subject:</strong> {{ $subject }}</h2>

                    <ul class="email-list">
                        @foreach($messages as $message)
                            @php
                                $sender = $message['from'];
                                $recipient = $message['to'];
                                $senderEmail = '';
                                if (preg_match('/<([^>]+)>/', $sender, $matches)) {
                                    $senderEmail = $matches[1]; // Get the email from the matches
                                } else {
                                    $senderEmail = $sender; // Fallback to the sender string if no match
                                }
                                $alignmentClass = ($senderEmail === 'hoperefresh@wotgonline.com') ? 'from-left' : 'from-right';
                                // Use Carbon to format the date
                                $formattedDate = \Carbon\Carbon::parse($message['date'])->format('F j, Y, g:i a');
                            @endphp
                            <li class="email-item {{ $alignmentClass }}">
                                <div class="message-body">
                                    <strong class="email-from from-label">From:</strong> {{ $sender }}<br>
                                    <strong class="email-from from-label">To:</strong> {{ $recipient }}<br>
                                    <strong class="email-date">Date:</strong> {{ $formattedDate }}<br>
                                    <strong class="email-message">Message:</strong> {!! $message['body'] !!}
                                </div>
                                
                                <!-- Reply Button -->
                                <button class="reply-btn" data-subject="{{ $subject }}" data-to="{{ $senderEmail }}" data-original-message-id="{{ $message['message_id'] }}">Reply</button>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="divider">
                @endforeach
            @endif
        </div>

        <!-- Reply Modal -->
        <div id="replyModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Reply to Email</h2>
                <form id="replyForm" action="{{ route('reply.email') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subject" id="replySubject">
                    <input type="hidden" name="to" id="replyTo">
                    <input type="hidden" name="original_message_id" id="replyOriginalMessageId"> <!-- Hidden input for original message ID -->
                    <textarea name="body" id="replyBody" rows="4" placeholder="Your reply..."></textarea>
                    <button type="submit" class="send-reply-btn">Send Reply</button>
                </form>            
            </div>
        </div>
    </div>

    <script src="{{ asset('js/emails.js?v=1.9') }}"></script>
@endsection

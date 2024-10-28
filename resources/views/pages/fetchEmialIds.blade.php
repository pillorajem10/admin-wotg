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

                <h2 class="email-subject"><strong>Subject:</strong> {{ $subject }}</h2>

                <ul class="email-list">
                    @foreach($messages as $message)
                        @php
                            $sender = $message['from'];
                            $alignmentClass = ($sender === 'wotgmission@gmail.com') ? 'from-left' : 'from-right';
                            // Use Carbon to format the date
                            $formattedDate = \Carbon\Carbon::parse($message['date'])->format('F j, Y, g:i a');

                            // Extract email from the sender string
                            $senderEmail = '';
                            if (preg_match('/<([^>]+)>/', $sender, $matches)) {
                                $senderEmail = $matches[1]; // Get the email from the matches
                            } else {
                                $senderEmail = $sender; // Fallback to the sender string if no match
                            }
                        @endphp
                        <li class="email-item {{ $alignmentClass }}">
                            <div class="message-body">
                                <strong class="email-from">From:</strong> {{ $sender }}<br>
                                <strong class="email-date">Date:</strong> {{ $formattedDate }}<br>
                                <strong class="email-message">Message:</strong> {!! $message['body'] !!}
                            </div>
                            
                            <!-- Reply Button -->
                            <button class="reply-btn" data-subject="{{ $subject }}" data-to="{{ $senderEmail }}">Reply</button>
                        </li>
                        <hr class="divider">
                    @endforeach
                </ul>
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
                <textarea name="body" id="replyBody" rows="4" placeholder="Your reply..."></textarea>
                <button type="submit">Send Reply</button>
            </form>            
        </div>
    </div>

    <script src="{{ asset('js/emails.js') }}"></script>
@endsection

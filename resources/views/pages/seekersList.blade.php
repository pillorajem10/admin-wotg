@extends('layouts.layout')

@section('title', 'Seekers List')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/seekersList.css?v=2.3') }}">
@endsection

@section('content')
    <div class="seeker-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search Form -->
        <div class="search-container">
            <form method="GET" action="{{ route('seekers.index') }}">
                <input type="text" name="search" placeholder="Search seekers..." value="{{ request('search') }}" class="search-input">
                <button type="submit" class="custom-search">Search</button>
            </form>
            <a href="{{ route('seekers.index') }}" class="clear-button">Clear</a> <!-- Clear button -->
        </div>        

        <div class="table-responsive">
            <table class="seeker-table">
                <thead>
                    <tr>
                        <th>
                            <!-- Select All Checkbox -->
                            <input type="checkbox" id="selectAll" class="select-all-checkbox">
                        </th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seekers as $seeker)
                    <tr>
                        <td>
                            <input type="checkbox" name="seeker_ids[]" value="{{ $seeker->id }}" class="seeker-checkbox">
                        </td>
                        <td>{{ $seeker->seeker_fname }}</td>
                        <td>{{ $seeker->seeker_lname }}</td>
                        <td>{{ $seeker->seeker_email }}</td>
                        <td>{{ $seeker->seeker_status }}</td>
                        <td>
                            <a href="{{ route('seekers.view', $seeker->id) }}" class="view-button">View</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>

        <button id="openModal" class="btn view-button">Write Email</button>

        <!-- Modal Structure -->
        <div id="nameModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close-button" id="closeModal">&times;</span>
                <h2>Send Email to Selected Seekers</h2>

                <!-- Display selected emails here -->
                <div id="selectedEmailsContainer">
                    <label for="emailsTo">To: </label>
                    <input type="text" id="emailsTo" name="emailsTo" readonly class="emails-display" placeholder="No emails selected" />
                </div>

                <form id="contactForm" action="{{ route('seekers.sendEmail') }}" method="POST">
                    @csrf
                    <input type="text" id="subject" name="subject" placeholder="Subject" required>
                    <textarea id="body" name="body" placeholder="Body" required></textarea>
                    <button type="submit" class="btn view-button">Submit</button>
                </form>                             
            </div>
        </div>

        <script src="{{ asset('js/seekers.js?v=2.3') }}"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    </div>
@endsection

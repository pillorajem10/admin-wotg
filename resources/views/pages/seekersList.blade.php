@extends('layouts.layout')

@section('title', 'Seekers List')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/seekersList.css?v=1.1') }}">
@endsection

@section('content')
    <div class="seeker-body">
        <div class="table-responsive">
            <table class="seeker-table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seekers as $seeker)
                    <tr>
                        <td>{{ $seeker->seeker_fname }}</td>
                        <td>{{ $seeker->seeker_lname }}</td>
                        <td>{{ $seeker->seeker_status }}</td>
                        <td>
                            <a href="{{ route('seekers.view', $seeker->id) }}" class="view-button">View</a>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
@endsection

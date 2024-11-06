@extends('layouts.layout')

@section('title', 'Prayer Requests List')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/prayerRequestList.css?v=1.7') }}">
@endsection

@section('content')
    <div>
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

        <div class="mb-3">
            <a href="{{ route('prayerRequest.create') }}" class="btn-custom">Add Prayer Request</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('prayerRequest.index') }}" class="filter-form mb-3">
            <label for="filter" class="form-label">Status:</label>
            <select id="filter" name="filter" class="form-select filter-select" onchange="this.form.submit()">
                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All</option>
                <option value="answered" {{ $filter === 'answered' ? 'selected' : '' }}>Answered</option>
                <option value="unanswered" {{ $filter === 'unanswered' ? 'selected' : '' }}>Unanswered</option>
            </select>
        </form>

        <div class="table-container">
            <table class="table prayer-requests-table table-bordered">
                <thead class="table-header">
                    <tr>
                        <th class="table-header-cell">Requested Date</th>
                        <th class="table-header-cell">Name</th>
                        <th class="table-header-cell">Request</th>
                        <th class="table-header-cell">Date Answered</th>
                        <th class="table-header-cell">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($prayerRequests as $request)
                        <tr class="table-row" style="{{ $request->pr_progress === 'answered' ? 'background-color: lightgreen;' : '' }}">
                            <td class="table-cell">{{ \Carbon\Carbon::parse($request->created_at)->format('F j, Y') }}</td>
                            <td class="table-cell">{{ $request->seeker->seeker_fname . ' ' . $request->seeker->seeker_lname ?? 'N/A' }}</td>
                            <td class="table-cell">{{ $request->pr_prayer }}</td>
                            <td class="table-cell">{{ $request->pr_answered_prayer_date ?? 'Not Yet Answered' }}</td>
                            <td class="table-cell">
                                <a href="{{ route('prayerRequest.edit', $request->id) }}" class="btn btn-warning btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $prayerRequests->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@extends('layouts.layout')

@section('title', 'Prayer Requests List')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/prayerRequestList.css?v=1.5') }}">
@endsection

@section('content')
    <div>
        <h2 class="mb-4">Prayer Requests</h2>

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

        <table class="table prayer-requests-table table-bordered">
            <thead class="table-header">
                <tr>
                    <th class="table-header-cell">ID</th>
                    <th class="table-header-cell">Seeker ID</th>
                    <th class="table-header-cell">Prayer Request</th>
                    <th class="table-header-cell">Progress</th>
                    <th class="table-header-cell">Created At</th>
                    {{--<th class="table-header-cell">Actions</th>--}}
                </tr>
            </thead>
            <tbody class="table-body">
                @foreach ($prayerRequests as $request)
                    <tr class="table-row">
                        <td class="table-cell">{{ $request->id }}</td>
                        <td class="table-cell">{{ $request->pr_seeker }}</td>
                        <td class="table-cell">{{ $request->pr_prayer }}</td>
                        <td class="table-cell">{{ $request->pr_progress }}</td>
                        <td class="table-cell">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                        {{--<td class="table-cell">
                            <a href="{{ route('prayer_requests.edit', $request->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('prayer_requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-container">
            {{ $prayerRequests->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
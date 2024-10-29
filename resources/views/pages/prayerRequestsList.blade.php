@extends('layouts.layout')

@section('title', 'Prayer Requests List')

@section('content')
    <div class="container">
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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Seeker ID</th>
                    <th>Prayer Request</th>
                    <th>Progress</th>
                    <th>Created At</th>
                    {{--<th>Actions</th>--}}
                </tr>
            </thead>
            <tbody>
                @foreach ($prayerRequests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->pr_seeker }}</td>
                        <td>{{ $request->pr_prayer }}</td>
                        <td>{{ $request->pr_progress }}</td>
                        <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                        {{--<td>
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

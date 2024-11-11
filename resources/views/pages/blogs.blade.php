@extends('layouts.layout')

@section('title', 'Blogs')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/blogs.css?v=1.8') }}">
@endsection

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="search-container">
            <form method="GET" action="{{ route('blogs.index') }}">
                <input type="text" name="search" placeholder="Search blogs by title" value="{{ request('search') }}" class="search-input">
                <button type="submit" class="custom-search">Search</button>
            </form>
            <a href="{{ route('seekers.index') }}" class="clear-button">Clear</a> <!-- Clear button -->
        </div>  
        
        <div class="table-container">
            <table class="blog-table">
                <thead>
                    <tr class="blog-table-header">
                        <th class="blog-table-header-cell">Blog Title</th>
                        <th class="blog-table-header-cell">Release Date</th>
                        <th class="blog-table-header-cell">Thumbnail</th>
                        <th class="blog-table-header-cell">Actions</th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr class="blog-table-row">
                            <td class="blog-table-cell">{{ $blog->blog_title }}</td>
                            <td class="blog-table-cell">
                                {{ $blog->blog_release_date_and_time ? \Carbon\Carbon::parse($blog->blog_release_date_and_time)->format('F j, Y') : 'Not Set' }}
                            </td>
                            <td class="blog-table-cell">
                                @if($blog->blog_thumbnail)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($blog->blog_thumbnail) }}" alt="{{ $blog->blog_title }}" style="max-width: 100px; height: auto;">
                                @else
                                    No Thumbnail
                                @endif
                            </td>
                            <td class="blog-table-cell">
                                <div class="action-container">
                                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn-view">View</a>
                                </div>
                            </td>                            
                        </tr>
                    @empty
                        <tr class="blog-table-row">
                            <td colspan="7" class="blog-table-empty text-center">No blogs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $blogs->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

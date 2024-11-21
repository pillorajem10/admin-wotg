@extends('layouts.layout')

@section('title', 'Resources And Tools')

@section('styles')
    <!-- Link the external loading overlay CSS -->
    <link rel="stylesheet" href="{{ asset('css/resourcesAndTools.css') }}">
@endsection

@section('content')
        <div class="home-container">
            <div class="custom-card">
                <div class="card-header">
                    Resources and Tools
                </div>
                <div class="card-body">
                    <div class="btn-container">
                        <a href="{{ route('static.faq') }}" class="btn btn-main">FAQs</a>
                        <a href="{{ route('static.daan') }}" class="btn btn-main">Ang Daan Papuntang Langit</a>
                        <a href="{{ route('static.plantDisc') }}" class="btn btn-main">PLANT Discipleship</a>
                        <a href="{{ route('static.tipsForBuildingRelationships') }}" class="btn btn-main">Practical Tips for Building Relationships</a>
                        <a href="{{ route('static.gabay') }}" class="btn btn-main">Gabay para sa Missionaries: ANG DAAN PATUNGONG LANGIT</a>
                    </div>
                </div>
            </div>              
            <script src="{{ asset('js/home.js') }}"></script>
        </div>
    </div>
@endsection

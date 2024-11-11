@extends('layouts.authLayout')

@section('title', 'Forgot Password')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/forgotPassword.css?v=1.8') }}">
@endsection

@section('content')
    <div class="forgot-password-container">
        <h2>Forgot Your Password?</h2>
        <p>Enter your email address below and we’ll send you a link to reset your password.</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <form method="POST" action="{{ route('password.send') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="auth-button">Send Password Reset Link</button>
            </div>
        </form>
    </div>
@endsection
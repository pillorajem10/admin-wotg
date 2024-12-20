@extends('layouts.authLayout')

@section('title', 'Sign Up Seeker')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/signUpSeeker.css?v=2.5') }}">
    <div class="signup-container">
        <h2 class="signup-title">Become part of our community.</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('seekers.signup.submit') }}" method="POST" class="custom-signup-form">
            @csrf
            <div class="signup-form">
                <div>
                    <div class="form-group">
                        <label for="seeker_fname">First Name</label>
                        <input type="text" name="seeker_fname" id="seeker_fname" class="input-field" required>
                    </div>
        
                    <div class="form-group">
                        <label for="seeker_lname">Last Name</label>
                        <input type="text" name="seeker_lname" id="seeker_lname" class="input-field" required>
                    </div>
        
                    <div class="form-group">
                        <label for="seeker_nickname">Nickname</label>
                        <input type="text" name="seeker_nickname" id="seeker_nickname" class="input-field" required>
                    </div>
        
                    <div class="form-group">
                        <label for="seeker_gender">Gender</label>
                        <select name="seeker_gender" id="seeker_gender" class="input-select" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Removed age field, added DOB -->
                    <div class="form-group">
                        <label for="seeker_dob">Date of Birth</label>
                        <input type="date" name="seeker_dob" id="seeker_dob" class="input-field" required>
                    </div>

                    <div class="form-group" id="dgroup_leader_group" style="display: none;">
                        <label for="seeker_dgroup_leader">Who is your discipleship group leader?</label>
                        <input type="text" name="seeker_dgroup_leader" id="seeker_dgroup_leader" class="input-field">
                    </div>                    
                </div>
    
                <div>
                    <div class="form-group">
                        <label for="seeker_email">Email</label>
                        <input type="email" name="seeker_email" id="seeker_email" class="input-field" required>
                    </div>
        
                    <div class="form-group">
                        <label for="seeker_country">Country</label>
                        <input type="text" name="seeker_country" id="seeker_country" class="input-field" required>
                    </div>
        
                    <div class="form-group">
                        <label for="seeker_city">City</label>
                        <input type="text" name="seeker_city" id="seeker_city" class="input-field" required>
                    </div>
        
                    <div class="form-group">
                        <label for="seeker_catch_from">How did you hear about us?</label>
                        <select name="seeker_catch_from" id="seeker_catch_from" class="input-select" required>
                            <option value="FB Ads">FB Ads</option>
                            <option value="Google Forms">Google Forms</option>
                            <option value="DM Engagement">DM Engagement</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="seeker_already_member">Are you a member of a discipleship group?</label>
                        <select name="seeker_already_member" id="seeker_already_member" class="input-select" required>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-register">Register</button>
            </div>
        </form>

        <script src="{{ asset('js/signupSeeker.js?v=2.5') }}"></script>
    </div>
@endsection

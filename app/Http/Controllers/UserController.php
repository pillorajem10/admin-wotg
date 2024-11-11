<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the form for requesting a password reset link
    public function showForgotPasswordForm()
    {
        return view('pages.forgotPassword');
    }

    // Handle the request to send a password reset link
    public function sendPasswordResetLink(Request $request)
    {
        // Validate the email address
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Generate a custom 9-character verification token with numbers and letters
        $token = $this->generateVerificationToken();

        // Save the token in the database (in the `verification_token` column)
        $user->verification_token = $token;
        $user->save();

        // Send the password reset email with the verification token
        Mail::to($user->email)->send(new PasswordResetMail($token, $user));

        // Return response
        return back()->with('success', 'We have emailed your password reset link!');
    }

    // Custom method to generate a 9-character token with numbers and letters
    private function generateVerificationToken()
    {
        // Generate a random string with 9 characters (letters and numbers)
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < 9; $i++) {
            $token .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $token;
    }

    // Show the form for resetting the password
    public function showResetPasswordForm($token)
    {
        // Check if the token exists in the database
        $user = User::where('verification_token', $token)->first();

        // If no user is found or the token is invalid, redirect back with an error
        if (!$user) {
            return redirect()->route('password.forgot')->with('error', 'Token is invalid or expired.');
        }

        // Return the reset password form with the token
        return view('pages.resetPassword', ['token' => $token]);
    }

    // Handle the password reset logic
    public function resetPassword(Request $request)
    {
        // Validate the new password
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed', // Confirm the password
        ]);

        // Find the user with the provided token
        $user = User::where('verification_token', $request->token)->first();

        if (!$user) {
            return redirect()->route('password.forgot')->with('error', 'Token is invalid or expired.');
        }

        // Update the user's password and clear the verification token
        $user->password = Hash::make($request->password); // Hash the password
        $user->verification_token = null; // Reset the token after successful password change
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Your password has been successfully reset.');
    }
}

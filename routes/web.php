<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// SEEKER CONTROLLER 
Route::get('/seekers', [SeekerController::class, 'index'])->name('seekers.index');
Route::get('/seekers/signup', [SeekerController::class, 'showSignupForm'])->name('seekers.signup');
Route::post('/seekers/signup', [SeekerController::class, 'signup'])->name('seekers.signup.submit');
Route::get('seekers/{id}', [SeekerController::class, 'show'])->name('seekers.view');
Route::post('/seekers/send-email', [SeekerController::class, 'sendSeekerEmail'])->name('seekers.sendEmail');
Route::get('/fetch-emails', [SeekerController::class, 'fetchEmails'])->name('seekers.fetchEmails');
Route::put('/seeker/{id}/update-status', [SeekerController::class, 'changeStatus'])->name('seeker.updateStatus');


// AUTH CONTOLLER 
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// BLOGS
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
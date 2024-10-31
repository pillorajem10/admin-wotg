<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PrayerRequestController;

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
Route::put('/seeker/{id}/update-status', [SeekerController::class, 'changeStatus'])->name('seeker.updateStatus');
Route::get('/fetch-email-ids', [SeekerController::class, 'fetchMessageIds'])->name('emails.fetch');
Route::post('/reply-email', [SeekerController::class, 'sendReply'])->name('reply.email');



// AUTH CONTOLLER 
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// BLOGS
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

// PRAYER REQUEST
Route::get('/prayer-requests', [PrayerRequestController::class, 'index'])->name('prayerRequest.index');
Route::get('/prayer-requests/create', [PrayerRequestController::class, 'create'])->name('prayerRequest.create');
Route::post('/prayer-requests', [PrayerRequestController::class, 'store'])->name('prayerRequest.store');
Route::get('/prayer-requests/{id}/edit', [PrayerRequestController::class, 'edit'])->name('prayerRequest.edit');
Route::put('/prayer-requests/{id}', [PrayerRequestController::class, 'update'])->name('prayerRequest.update');

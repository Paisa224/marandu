<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación con verificación de correo electrónico
Auth::routes(['verify' => true]);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta protegida que requiere verificación de correo electrónico
Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');

// Rutas adicionales para verificación personalizada
Route::get('verify', [VerificationController::class, 'show'])->name('verify');
Route::post('verify', [VerificationController::class, 'verify'])->name('verify.post');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Agrupación de rutas protegidas por middleware de autenticación y verificación de email
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/settings', [UserController::class, 'updateSettings'])->name('settings.update');
    Route::get('/users/{id}/audits', [UserController::class, 'showAudits'])->name('users.audits');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/user/{username}', [UserController::class, 'show'])->name('user.show');
    Route::post('/follow/{user}', [UserController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [UserController::class, 'unfollow'])->name('unfollow');
    Route::get('/users/following', [UserController::class, 'followingList'])->name('users.following');
    Route::get('/users/followers', [UserController::class, 'followersList'])->name('users.followers');

    Route::post('/check-username', [UserController::class, 'checkUsername'])->name('check.username');

    Route::get('/tweets', [TweetController::class, 'index'])->name('tweets.index');
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::post('/tweets/{id}/like', [TweetController::class, 'like'])->name('tweets.like');
    Route::post('/tweets/{id}/unlike', [TweetController::class, 'unlike'])->name('tweets.unlike');

    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');
    Route::post('/tweets/{tweet}/delete', [TweetController::class, 'destroy'])->name('tweets.delete');
    Route::get('/suggestions', [UserController::class, 'suggestions'])->name('suggestions');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/search', [SearchController::class, 'search'])->name('search');

});  

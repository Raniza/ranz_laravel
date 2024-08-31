<?php

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/home');
Route::resource('home', App\Http\Controllers\HomeController::class)->only(['index', 'edit', 'update']);

/* ---------------------------- Verifikasi Email ---------------------------- */
Route::controller(App\Http\Controllers\Admin\EmailVerificationController::class)->group(function(){
    Route::get('/email/verify', 'notice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resend')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});


/* ------------------------------- Auth Route ------------------------------- */
Route::prefix('user')->group(function() {
    Route::name('user.')->group(function() {
        Route::post('/auth',  [App\Http\Controllers\Admin\AuthController::class, 'auth'])->name('auth');
        Route::post('/logout',  [App\Http\Controllers\Admin\AuthController::class, 'logout'])->middleware('auth')->name('logout');
        Route::get('/register', [App\Http\Controllers\Admin\AuthController::class, 'registerForm'])->name('register.form');
        Route::post('/register', [App\Http\Controllers\Admin\AuthController::class, 'registerAction'])->name('register.action');
        Route::post('/change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'])->name('change.password');
    });

    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
});

Route::post('/forgot-password', [App\Http\Controllers\Admin\AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Admin\AuthController::class, 'resetPasswordForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Admin\AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

/* ----------------------------- Tutorial route ----------------------------- */
Route::prefix('tutorials')->group(function() {
    Route::name('tutorials.')->group(function() {
        Route::resource('/all',  App\Http\Controllers\Tutorial\TutorialController::class);
        Route::resource('/title',  App\Http\Controllers\Tutorial\TitleController::class)->only(['store', 'show', 'destroy']);
        Route::resource('/comment',  App\Http\Controllers\Tutorial\CommentController::class);
    });
});

/* ------------------------------- Admin route ------------------------------ */
Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/admin', App\Http\Controllers\Admin\AdminController::class)->name('admin');
    Route::resource('/users', App\Http\Controllers\Admin\UserController::class);
});

/* ------------------------------- ABout route ------------------------------ */
Route::resource('about',App\Http\Controllers\Admin\AboutController::class);
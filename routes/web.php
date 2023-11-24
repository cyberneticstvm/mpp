<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/terms-of-use', function () {
    return view('terms-of-use');
})->name('terms.of.use');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::middleware(['web'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/login', 'login')->name('signin');
        Route::post('/register', 'register')->name('signup');
        Route::get('/success/register', 'registerSuccess')->name('register.success');
        Route::get('/verify/mobile/{user}', 'verifyMobileNumberForm')->name('form.verify.mobile.number');
        Route::post('/verify/mobile', 'verifyMobileNumber')->name('verify.mobile.number');
        Route::get('/resend/verification/otp/{user}', 'resendVerificationOtp')->name('resend.verification.otp');
        Route::get('/logut', 'logout')->name('logout');
    });
});

Route::middleware(['web', 'auth', 'mobile'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
});

Route::middleware(['web', 'auth', 'mobile', 'premium'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        //
    });
});

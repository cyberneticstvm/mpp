<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmailController;
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

Route::get('/otp-login', function () {
    return view('otp-login');
})->name('otplog');

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgotpwd');

Route::middleware(['web'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/login', 'login')->name('signin');
        Route::post('/otplogin', 'otpLoginValidate')->name('otp.login');
        Route::post('/register', 'register')->name('signup');
        Route::get('/success/register', 'registerSuccess')->name('register.success');
        Route::get('/verify/mobile/{user}', 'verifyMobileNumberForm')->name('form.verify.mobile.number');
        Route::post('/verify/mobile', 'verifyMobileNumber')->name('verify.mobile.number');
        Route::get('/resend/verification/otp/{user}', 'resendVerificationOtp')->name('resend.verification.otp');
        Route::get('/password/reset/{token}', 'passwordReset')->name('reset.password');
        Route::post('/password/reset', 'resetPassword')->name('password.reset');
    });

    Route::controller(EmailController::class)->group(function () {
        Route::post('/forgot-password', 'forgotPassword')->name('forgot.password');
    });
});

Route::middleware(['web', 'auth', 'mobile'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard/default', 'dashboard')->name('dashboard');
        Route::post('/profile/update', 'profileUpdate')->name('profile.update');
    });
});

Route::middleware(['web', 'auth', 'mobile', 'profile'])->group(function () {

    Route::controller(AjaxController::class)->group(function () {
        Route::post('/get/appointments', 'getAppointments')->name('appointments.get');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard/dragable', 'dragableDashboard')->name('dragable.dashboard');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::prefix('appointment')->controller(AppointmentController::class)->group(function () {
        Route::get('/today', 'index')->name('appointment');
        Route::get('/all', 'show')->name('appointment.all');
        Route::get('/create', 'create')->name('appointment.create');
        Route::post('/create', 'store')->name('appointment.save');
    });
});

Route::middleware(['web', 'auth', 'mobile', 'profile', 'premium'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        //
    });
});

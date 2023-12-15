<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
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
        Route::get('/logout', 'logout')->name('logout');
    });
});

Route::middleware(['web', 'auth', 'mobile', 'profile'])->group(function () {

    Route::prefix('payment')->controller(PaymentController::class)->group(function () {
        Route::get('/', 'payment')->name('payment');
    });

    Route::prefix('export/pdf')->controller(PdfController::class)->group(function () {
        Route::get('/appointment', 'exportAppointments')->name('appointment.pdf.export');
    });
    Route::prefix('export/excel')->controller(ImportExportController::class)->group(function () {
        Route::get('/appointment', 'exportAppointments')->name('appointment.excel.export');
    });

    Route::controller(AjaxController::class)->group(function () {
        Route::post('/get/appointments', 'getAppointments')->name('appointments.get');
        Route::post('/symptom/add', 'saveSymptom')->name('symptom.save');
        Route::post('/diagnosis/add', 'saveDiagnosis')->name('diagnosis.save');
        Route::post('/test/add', 'saveTest')->name('test.save');
        Route::post('/medicine/add', 'saveMedicine')->name('medicine.save');
        Route::get('/medicine/row/add', 'getMedicines')->name('medicines.get');
    });

    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('user.profile');
        Route::get('/edit/{id}', 'edit')->name('user.profile.edit');
        Route::post('/edit/{id}', 'update')->name('user.profile.update');
        Route::get('/delete/{id}', 'destroy')->name('user.profile.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard/dragable', 'dragableDashboard')->name('dragable.dashboard');
        Route::get('/settings', 'settings')->name('settings');
        Route::post('/general/settings', 'generalSettingsUpdate')->name('general.settings.update');
        Route::post('/personal/settings', 'personalSettingsUpdate')->name('personal.settings.update');
    });

    Route::prefix('appointment')->controller(AppointmentController::class)->group(function () {
        Route::get('/today', 'index')->name('appointment');
        Route::get('/all', 'show')->name('appointment.all');
        Route::get('/create', 'create')->name('appointment.create');
        Route::post('/create', 'store')->name('appointment.save');
        Route::get('/edit/{id}', 'edit')->name('appointment.edit');
        Route::post('/edit/{id}', 'update')->name('appointment.update');
        Route::get('/delete/{id}', 'destroy')->name('appointment.delete');
    });

    Route::prefix('patient')->controller(PatientController::class)->group(function () {
        Route::get('/', 'index')->name('patient');
        Route::get('/create/{id}', 'create')->name('patient.create');
        Route::post('/create/{id}', 'store')->name('patient.save');
        Route::get('/edit/{id}', 'edit')->name('patient.edit');
        Route::post('/edit/{id}', 'update')->name('patient.update');
        Route::get('/delete/{id}', 'destroy')->name('patient.delete');

        Route::post('/search', 'search')->name('patient.search');
    });

    Route::prefix('consultation')->controller(ConsultationController::class)->group(function () {
        Route::get('/', 'index')->name('consultation');
        Route::get('/create/{id}', 'create')->name('consultation.create');
        Route::post('/create', 'store')->name('consultation.save');
        Route::get('/edit/{id}', 'edit')->name('consultation.edit');
        Route::post('/edit/{id}', 'update')->name('consultation.update');
        Route::get('/delete/{id}', 'destroy')->name('consultation.delete');
    });

    Route::prefix('prescription')->controller(PdfController::class)->group(function () {
        Route::get('/all/{id}', 'prescriptionAll')->name('prescription.all.pdf');
        Route::get('/clinic/{id}', 'prescriptionClinic')->name('prescription.clinic.pdf');
        Route::get('/medicine/{id}', 'prescriptionMedicine')->name('prescription.medicine.pdf');
        Route::get('/test/{id}', 'prescriptionTest')->name('prescription.test.pdf');
    });

    Route::prefix('report')->controller(ReportController::class)->group(function () {
        Route::get('/apmnt', 'appointment')->name('report.appointment');
        Route::post('/apmnt', 'appointmentFetch')->name('report.appointment.fetch');
        Route::get('/patnt', 'patient')->name('report.patient');
        Route::post('/patnt', 'patientFetch')->name('report.patient.fetch');
        Route::get('/consult', 'consultation')->name('report.consultation');
        Route::post('/consult', 'consultationFetch')->name('report.consultation.fetch');
    });

    Route::prefix('search')->controller(SearchController::class)->group(function () {
        Route::get('/apntmnt', 'appointment')->name('search.appointment');
        Route::post('/apntmnt', 'appointmentFetch')->name('search.appointment.fetch');
        Route::get('/ptnt', 'patient')->name('search.patient');
        Route::post('/ptnt', 'patientFetch')->name('search.patient.fetch');
        Route::get('/cons', 'consultation')->name('search.consultation');
        Route::post('/cons', 'consultationFetch')->name('search.consultation.fetch');
    });
});

Route::middleware(['web', 'auth', 'mobile', 'profile', 'premium'])->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/create', 'create')->name('user.profile.create');
        Route::post('/profile/create', 'store')->name('user.profile.save');
    });

    Route::prefix('document')->controller(DocumentController::class)->group(function () {
        Route::get('/', 'index')->name('document');
        Route::post('/', 'store')->name('document.save');
        Route::post('/show', 'show')->name('document.show');
        Route::get('/delete/{id}', 'destroy')->name('document.delete');
    });
});

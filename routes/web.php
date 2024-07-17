<?php

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
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['prefix' => 'reset'], function () {
	Route::post('password', [ResetPassword::class, 'resetPassword']);
	Route::post('password-code', [ResetPassword::class, 'resetPasswordCode']);
	Route::post('change-password', [ResetPassword::class, 'changePassword']);
});

Route::group(['middleware' => 'auth'], function () {

	Route::group(['prefix' => 'create'], function () {
		Route::post('time-slots', [AppointmentController::class, 'createTimeSlots']);
		Route::post('date-schedule', [AppointmentController::class, 'createDateSchedule']);
		Route::post('appointment', [AppointmentController::class, 'createAppointment']);
		Route::post('feedback', [FeedbackController::class, 'createFeedback']);
    });

	Route::group(['prefix' => 'update'], function () {
        Route::post('verify-client', [ClientController::class, 'verifyClient']);
		Route::post('decline-client', [ClientController::class, 'declineClient']);
		Route::post('admin', [AccountController::class, 'updateAdmin']);
		Route::post('client', [AccountController::class, 'updateClient']);
		Route::post('resubmit-credentials', [AccountController::class, 'resubmitCredentials']);
		Route::post('time-slots', [AppointmentController::class, 'updateTimeSlots']);
		Route::post('appointment', [AppointmentController::class, 'updateAppointment']);
		Route::post('approve-appointment', [AppointmentController::class, 'approveAppointment']);
		Route::post('check-appointment', [AppointmentController::class, 'checkAppointment']);
		Route::post('failed-to-visit', [AppointmentController::class, 'failedToVisit']);
		Route::post('feedback', [FeedbackController::class, 'updateFeedback']);
		Route::post('notify', [AppointmentController::class, 'readNotification']);
		Route::post('sms-configuration', [SMSController::class, 'updateSMS']);
		Route::post('start-serving', [AppointmentController::class, 'startServing']);
		Route::post('pause-serving', [AppointmentController::class, 'pauseServing']);
    });

	Route::group(['prefix' => 'delete'], function () {
		Route::post('time-slots', [AppointmentController::class, 'deleteTimeSlots']);
		Route::post('appointment', [AppointmentController::class, 'deleteAppointment']);
		Route::post('feedback', [FeedbackController::class, 'deleteFeedback']);
    });

	Route::group(['prefix' => 'search'], function () {
		Route::post('client', [ClientController::class, 'searchClient']);
		Route::post('client-appointment', [AppointmentController::class, 'searchClientAppointment']);
		Route::post('client-appointment-date', [AppointmentController::class, 'searchClientAppointmentDate']);
    });

	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
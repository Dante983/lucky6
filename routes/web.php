<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::controller(LoginController::class)->group(function (){

    Route::get('login', 'index')->name('login');

    Route::get('logout', 'logout')->name('logout');

    Route::get('dashboard', 'dashboard')->name('dashboard');
});

Route::controller(AdminUserController::class)->group(function (){

    Route::get('admin_login', 'admin_login')->name('admin_login');

    Route::get('admin_dashboard/register_admin', 'admin_registration')->name('admin_register');

    Route::get('admin_dashboard/registration', 'registration')->name('registration');

    Route::post('admin_validate_registration', 'admin_validate_registration')->name('admin_validate_registration');

    Route::post('admin_validate_login', 'admin_validate_login')->name('admin_validate_login');

    Route::get('admin_dashboard', 'admin_dashboard')->name('admin_dashboard');

    Route::post('admin_dashboard/validate_registration', 'validate_registration')->name('validate_registration');

    Route::post('validate_login', 'validate_login')->name('validate_login');

    Route::get('admin_logout', 'admin_logout')->name('admin_logout');
});

Route::controller(\App\Http\Controllers\TicketController::class)->group(function (){

    Route::post('submit-ticket', 'store')->name('submit.ticket');

});



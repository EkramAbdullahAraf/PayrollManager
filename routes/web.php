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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('leave-request', 'LeaveRequestController');
// Employee routes
Route::get('/leave-requests/create', 'LeaveRequestController@create')->name('leave-requests.create');
Route::post('/leave-requests', 'LeaveRequestController@store')->name('leave-requests.store');

// Manager routes
Route::get('/manager/leave-requests', 'LeaveRequestController@index')->name('manager.leave-requests.index');
Route::put('/manager/leave-requests/{leaveRequest}', 'LeaveRequestController@update')->name('manager.leave-requests.update');

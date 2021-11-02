<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\AttendanceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// szdfsdgsdfhdfhdfhdfh dfh dfh 
//Route::view('login','pages.home');
//Route::get('login',[LogInController::class,'index'])->name('index');
Route::post('login',[LogInController::class,'logIn'])->name('logIn');
Route::post('signup',[LogInController::class,'signUp'])->name('signUp');

//Info Controller
Route::get('employee/{emp_id?}',[InfoController::class,'getInfo']);//get specific employee data 
Route::patch('employee/update/{emp_id?}',[InfoController::class,'updateInfo']);//update specific employee data

//Attendance Controller
//Get all Information
Route::get('attendance',[AttendanceController::class,'HistoryLogAPI'])->name('HistoryLogAPI');
//getCurrentAttendance
Route::get('current_attendance/{id?}',[AttendanceController::class,'CurrentMonthLogAPI']);

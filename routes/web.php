<?php

use App\Http\Controllers\CoachController;
use App\Http\Controllers\Dashboard;


use Illuminate\Support\Facades\Route;

Route::get('/Dashboard', [Dashboard::class, 'index']);
Route::get('/Daily_Logs', [Dashboard::class, 'Daily_logs']);
Route::get('/Members_Logs', [Dashboard::class, 'Members_logs']);
Route::post('/DailyPost', [Dashboard::class, 'DailyPost']);
Route::get('/Members', [Dashboard::class, 'client_page']);
Route::get('/coaches/{category_id}', [Dashboard::class, 'getCoachesByCategory']);
Route::post('/add_client', [Dashboard::class, 'insertNewClient']);
Route::post('/client_log', [Dashboard::class, 'client_log']);
Route::get('/Coaches',[CoachController::class,'index']);
Route::post('/add_coach',[CoachController::class,'insertCoach']);
Route::get('/Settings',[CoachController::class,'ShowSettings']);

// Route::get('/', function () {
//     $loginDate = Carbon::now()->toDateString();
//     $loginTime = Carbon::now()->toTimeString();
//     $carbonTime = Carbon::createFromFormat('H:i:s', $loginTime);
//     $formattedTime = $carbonTime->format('h:i A');
//     Mail::to('althirdysanger@gmail.com')->send(new LogEmail('John Doe', $loginDate,  $formattedTime));

//     return 'Email sent successfully';
// });

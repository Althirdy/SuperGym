<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;
use App\Models\client_category;
use App\Models\subscriptions;

Route::get('/',function(){
    $clientCategories = client_category::all();
    $subscription = subscriptions::all();
    $subs = $subscription->pluck('price');
    $prices = $clientCategories->pluck('price');
    // print_r($prices);
    return view('landing',['data_price'=>$prices,"data_subs"=>$subs]);
});

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
Route::post('/updatePrice',[Dashboard::class,'Update_Price']);
Route::get('/login_admin',function(){

    return view('login');
});

Route::post('/validate_login',[Auth::class, 'checkLogin'])->name('validate_login');


Route::get('/session',function(){
    session()->forget('gymbilog_user');
    return redirect('/');
});

Route::get('/Logout',[Auth::class,'logout']);
// Route::get('/', function () {
//     $loginDate = Carbon::now()->toDateString();
//     $loginTime = Carbon::now()->toTimeString();
//     $carbonTime = Carbon::createFromFormat('H:i:s', $loginTime);
//     $formattedTime = $carbonTime->format('h:i A');
//     Mail::to('althirdysanger@gmail.com')->send(new LogEmail('John Doe', $loginDate,  $formattedTime));

//     return 'Email sent successfully';
// });

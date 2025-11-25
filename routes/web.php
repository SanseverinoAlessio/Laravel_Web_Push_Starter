<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\UserIsLogged;
use App\Http\Controllers\UserController;
use App\Http\Middleware\userNotLogged;
use App\Models\User;
use App\Notifications\WebPushNotification;
use Illuminate\Support\Facades\Notification;


Route::get('test-notification',function(){
    Notification::send(User::all(), new WebPushNotification());
    return redirect()->back();
});

Route::group(['middleware' => userNotLogged::class], function () {
    Route::get('/', function(){
        return redirect('/login');
    });
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'createUser']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
});


Route::group(['prefix' => 'user', 'middleware' => UserIsLogged::class], function () {
    Route::get('dashboard', [UserController::class, 'dashboard']);
    Route::get('logout',[AuthController::class,'logout']);
    Route::post('subscribe-to-notifications',[UserController::class,'subscribeNotification']);
});

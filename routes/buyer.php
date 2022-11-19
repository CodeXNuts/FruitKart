<?php

use App\Http\Controllers\Buyer\Auth\LoginController;
use App\Http\Controllers\Buyer\Auth\RegisterController;
use App\Http\Controllers\Buyer\HomeController;
use Illuminate\Support\Facades\Route;


Route::prefix('buyer')->name('buyer.')->namespace('Buyer')->group(function(){
    Route::namespace('Auth')->middleware('guest:buyer')->group(function(){

        //Register Route

        Route::get('/register',[RegisterController::class,'index'])->name('register');
        Route::post('/register',[RegisterController::class,'create'])->name('register');

        //Login route
        Route::get('/login',[LoginController::class,'index'])->name('login');
        Route::post('/login',[LoginController::class,'create'])->name('login');

       
    });

    Route::middleware('auth:buyer')->group(function(){

        Route::get('/home',[HomeController::class,'index'])->name('home');
        Route::get('/{seller:username}/view',[HomeController::class,'getOrangeBySeller'])->name('viewOrangeChart');
        Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    });
});

Route::get('/',function(){
    return redirect()->route('buyer.home');
});
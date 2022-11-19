<?php

use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\Auth\RegisterController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProfileController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->namespace('Seller')->group(function(){

    Route::namespace('Auth')->middleware('guest:seller')->group(function(){
        
        //Register Route

        Route::get('/register',[RegisterController::class,'index'])->name('register');
        Route::post('/register',[RegisterController::class,'create'])->name('register');
        Route::get('/veryfy-email',[RegisterController::class,'verifyEmail'])->name('verify-email');

        //Login route
        Route::get('/login',[LoginController::class,'index'])->name('login');
        Route::post('/login',[LoginController::class,'create'])->name('login');
    });
    
    Route::middleware('auth:seller')->group(function(){
        Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
        Route::prefix('profile')->name('profile.')->group(function(){
            Route::get('/',[ProfileController::class,'index'])->name('view');
            Route::post('/{seller}',[ProfileController::class,'update'])->name('update');
        });

        Route::prefix('product')->name('product.')->group(function(){

            Route::post('/add',[ProductController::class,'store'])->name('add');
            Route::get('/{product}/edit',[ProductController::class,'edit'])->name('edit');
            Route::put('/{product}/update',[ProductController::class,'update'])->name('update');
        });

        
    });
});
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
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
Route::middleware('auth')->prefix('/')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/update-status',[HomeController::class,'edit'])->name('screen.edit');
    Route::post('/update-status',[HomeController::class,'update'])->name('screen.update');
    
    Route::get('/staff',[UserController::class,'index'])->name('staff.index');
    Route::get('/edit-staff',[UserController::class,'edit'])->name('staff.edit');
    Route::post('/edit-staff',[UserController::class,'update'])->name('staff.update');
    Route::get('/destroy-staff',[UserController::class,'destroy'])->name('staff.destroy');

    Route::get('/work',[WorkController::class,'index'])->name('work.index');
    Route::get('/create-work',[WorkController::class,'create'])->name('work.create');
    Route::post('/create-work',[WorkController::class,'store'])->name('work.store');
    Route::get('/edit-work',[WorkController::class,'edit'])->name('work.edit');
    Route::post('/edit-work',[WorkController::class,'update'])->name('work.update');
    Route::get('/destroy-work',[WorkController::class,'destroy'])->name('work.destroy');

    Route::get('/changePass',[UserController::class,'changePass'])->name('changePass');
    Route::post('/changePass',[UserController::class,'updatePass'])->name('updatePass');
});




// Auth 
Route::prefix('/login')->group(function(){
    Route::get('/',[AuthController::class,'loginShow'])->name('loginShow');
    Route::post('/',[AuthController::class,'checkLogin'])->name('checkLogin');
});

Route::get('/logout',[AuthController::class,'logOut'])->name('logOut');


Route::prefix('/register')->group(function(){
    Route::get('/',[AuthController::class,'registerShow'])->name('registerShow');         
    Route::post('/register',[UserController::class,'store'])->name('register');         
});


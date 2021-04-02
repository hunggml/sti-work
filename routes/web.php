<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
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
Route::middleware('auth')->prefix('/home')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/edit-status',[HomeController::class,'edit'])->name('screen.edit');
    Route::post('/update-status',[HomeController::class,'update'])->name('screen.update');
    
    Route::get('/profile',[UserController::class,'index'])->name('profile.index');
    Route::get('/edit-profile',[UserController::class,'edit'])->name('profile.edit');
    Route::post('/update-profile',[UserController::class,'update'])->name('profile.update');
    Route::get('/destroy-profile',[UserController::class,'destroy'])->name('profile.destroy');


    Route::get('/staff-list',[ManagerController::class,'allStaff'])->name('staff.list');
    Route::get('/edit-staff',[ManagerController::class,'editLevel'])->name('staff.editLevel');
    Route::post('/update-staff',[ManagerController::class,'updateLevel'])->name('staff.updateLevel');
    Route::get('/staff-destroy',[ManagerController::class,'destroyStaff'])->name('staff.destroy');

  
    Route::get('/check-job',[ManagerController::class,'listWorkCheck'])->name('check.list');
    Route::get('/check-job-edit',[ManagerController::class,'editWorkCheck'])->name('check-job.edit');
    Route::post('/check-job-update',[ManagerController::class,'updateWorkCheck'])->name('check-job.update');
    Route::get('/check-job-destroy',[ManagerController::class,'deleteWorkCheck'])->name('check-job.destroy');

    Route::get('/work',[WorkController::class,'index'])->name('work.index');
    Route::get('/create-work',[WorkController::class,'create'])->name('work.create');
    Route::post('/create-work',[WorkController::class,'store'])->name('work.store');
    Route::get('/edit-work',[WorkController::class,'edit'])->name('work.edit');
    Route::post('/update-work',[WorkController::class,'update'])->name('work.update');
    Route::get('/destroy-work',[WorkController::class,'destroy'])->name('work.destroy');

    Route::get('/changePass',[UserController::class,'changePass'])->name('changePass');
    Route::post('/changePass',[UserController::class,'updatePass'])->name('updatePass');

});

Route::get('/', [HomeController::class,'home'])->name('trangchu');


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


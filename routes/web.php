<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
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
    
    // Profile
    Route::get('/profile',[UserController::class,'index'])->name('profile.index');
    Route::get('/edit-profile',[UserController::class,'edit'])->name('profile.edit');
    Route::post('/update-profile',[UserController::class,'update'])->name('profile.update');
    Route::get('/destroy-profile',[UserController::class,'destroy'])->name('profile.destroy');

    // Staff
    Route::get('/staff-list',[ManagerController::class,'stafflist'])->name('staff.stafflist');

    Route::get('/edit-staff',[ManagerController::class,'editLevel'])->name('staff.editLevel');
    Route::post('/update-staff',[ManagerController::class,'updateLevel'])->name('staff.updateLevel');
    Route::get('/staff-destroy',[ManagerController::class,'destroyStaff'])->name('staff.destroy');


    // Group
    Route::get('group-list',[GroupController::class,'index'])->name('group.list');
    Route::get('/create-group',[GroupController::class,'create'])->name('group.create');
    Route::post('/store-group',[GroupController::class,'store'])->name('group.store');
    Route::get('/edit-group',[GroupController::class,'edit'])->name('group.edit');
    Route::post('/update-group',[GroupController::class,'update'])->name('group.update');
    Route::get('/destroy-group',[GroupController::class,'destroy'])->name('group.destroy');

    // List Work of staff
    Route::get('staff-list-work',[ManagerController::class,'workStaff'])->name('staff.listwork');
    Route::get('/staff-history-work',[ManagerController::class,'history'])->name('staff.history-work');

    // Check Work
    Route::get('/check-job',[ManagerController::class,'listWorkCheck'])->name('check.list');
    Route::get('/check-job-edit',[ManagerController::class,'editWorkCheck'])->name('check-job.edit');
    Route::post('/check-job-update',[ManagerController::class,'updateWorkCheck'])->name('check-job.update');
    Route::get('/check-job-destroy',[ManagerController::class,'deleteWorkCheck'])->name('check-job.destroy');

    // Statistical
    Route::get('/statistical',[ManagerController::class,'statistical'])->name('statistical.list');
    Route::get('/chart',[ManagerController::class,'chart'])->name('chart'); 

    // Work
    Route::get('/work',[WorkController::class,'index'])->name('work.index');
    Route::get('/create-work',[WorkController::class,'create'])->name('work.create');
    Route::post('/store-work',[WorkController::class,'store'])->name('work.store');
    Route::get('/edit-work',[WorkController::class,'edit'])->name('work.edit');
    Route::post('/update-work',[WorkController::class,'update'])->name('work.update');
    Route::get('/destroy-work',[WorkController::class,'destroy'])->name('work.destroy');
    Route::get('/work/hide/{id}',[WorkController::class,'storage'])->name('storage');
    Route::get('/work/un-hide/{id}',[WorkController::class,'restore'])->name('warehouse.restore');
    Route::get('/work-warehouse',[WorkController::class,'listWarehouse'])->name('warehouse.list');
    Route::get('/work-history',[WorkController::class,'history'])->name('work.history');

    // Change password
    Route::get('/changePass',[UserController::class,'changePass'])->name('changePass');
    Route::post('/changePass',[UserController::class,'updatePass'])->name('updatePass');

});

// home
Route::get('/', [HomeController::class,'index'])->name('trangchu');
Route::get('metting',[HomeController::class,'metting'])->name('metting');

// notification
Route::get('notification',[HomeController::class,'notification'])->name('notification');


// Login 
Route::prefix('/login')->group(function(){
    Route::get('/',[AuthController::class,'loginShow'])->name('loginShow');
    Route::post('/',[AuthController::class,'checkLogin'])->name('checkLogin');
});
// Logout
Route::get('/logout',[AuthController::class,'logOut'])->name('logOut');
// Register
Route::prefix('/register')->group(function(){
    Route::get('/',[AuthController::class,'registerShow'])->name('registerShow');         
    Route::post('/register',[UserController::class,'store'])->name('register');         
});


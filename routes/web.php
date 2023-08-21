<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\HolidayController;
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

   Route::prefix('admin')->middleware(['auth'])->group(function()
   {
         Route::get('/dashboard',[AdminController::class,'dashboard']);
          
         //Desigantion
         Route::get('/designation/index',[DesignationController::class,'index'])->name('designation.index');
         Route::post('/designation/index',[DesignationController::class,'store'])->name('designation.store');
         Route::delete('/designation/delete/{id}',[DesignationController::class,'destroy'])->name('designation.delete');
         Route::put('/designation/update',[DesignationController::class,'update'])->name('designation.update');
         Route::get('/designation/edit/{id}',[DesignationController::class,'edit'])->name('designation.edit');

         //Staff
         Route::get('/staff/index',[StaffController::class,'index'])->name('staff.index');
         Route::post('/staff/index',[StaffController::class,'store'])->name('staff.store');
         Route::get('/staff/edit/{id}',[StaffController::class,'edit'])->name('staff.edit');
         Route::put('/staff/update',[StaffController::class,'update'])->name('staff.update');
         Route::delete('/staff/delete/{id}',[StaffController::class,'destroy'])->name('staff.delete');

         //shift
         Route::get('/shift/index',[ShiftController::class,'index'])->name('shift.index');
         Route::post('/shift/index',[ShiftController::class,'store'])->name('shift.store'); 
         Route::get('/shift/edit/{id}',[ShiftController::class,'edit'])->name('shift.edit');
         Route::put('/shift/update',[ShiftController::class,'update'])->name('shift.update');
         Route::delete('/shift/index/{id}',[ShiftController::class,'destroy'])->name('shift.delete');

         //holiday
         Route::get('/holidays/index',[HolidayController::class,'index'])->name('holiday.index');
   });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

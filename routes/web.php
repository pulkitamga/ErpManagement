<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DesignationController;
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
   });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

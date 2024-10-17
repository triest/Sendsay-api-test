<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\HomeController::class,'index']);

Route::resource('pet',\App\Http\Controllers\PetController::class)->only('create','store');

Route::get('email-confirmation/{token}',[PetController::class,'confirmation'])->name('confirmation');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

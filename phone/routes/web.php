<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

//new route
Route::resource('/phones', App\Http\Controllers\PhoneController::class);
Route::resource('/tablets', App\Http\Controllers\TabletController::class);
Route::resource('/laptops', App\Http\Controllers\LaptopController::class);
Route::resource('/members', App\Http\Controllers\MemberController::class);
Route::resource('/watches', App\Http\Controllers\WatchController::class);
Route::resource('/transactions', App\Http\Controllers\WatchController::class);

//api
Route::get('/api/tablets', [App\Http\Controllers\TabletController::class, 'api']);
Route::get('/api/laptops', [App\Http\Controllers\laptopController::class, 'api']);
Route::get('/api/members', [App\Http\Controllers\memberController::class, 'api']);
Route::get('/api/watches', [App\Http\Controllers\watchController::class, 'api']);

// Route Admin
Route::get('Graphics', [App\Http\Controllers\AdminController::class, 'dashboard']);
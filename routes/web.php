<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
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
    $title = 'Main';
    return view('welcome', compact('title'));
})->name('main');

Route::resource('specializations', SpecializationController::class);
Route::resource('users', UserController::class);
Route::resource('books', BookController::class);
Route::resource('workers', WorkerController::class);

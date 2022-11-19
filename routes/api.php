<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('specializations', SpecializationController::class)->except(['create', 'edit']);
Route::resource('users', UserController::class)->except(['create', 'edit']);
Route::resource('books', BookController::class)->except(['create', 'edit']);
Route::resource('workers', WorkerController::class)->except(['create', 'edit']);

<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class)
->except(['edit'])->middleware('auth');

//Route::prefix('users')->group(function () {
//    Route::get('', [UserController::class, 'index'])->name('users.index');
//    Route::get('{id}', [UserController::class, 'show'])->name('users.show');
//    Route::post('', [UserController::class, 'store'])->name('users.store');
//    Route::delete('{id}', [UserController::class, 'destroy'])->name('users.destroy');
//    Route::patch('{id}', [UserController::class, 'update'])->name('users.update');
//});

Auth::routes();


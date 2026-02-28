<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {
    // USER CONTROLLER
    Route::resource('users', UserController::class)
        ->except(['edit']);

    // VIDEO CONTROLLER
    Route::prefix('videos')->name('videos.')->group(function () {
        Route::get('', [VideoController::class, 'index'])->name('index');
        Route::post('', [VideoController::class, 'store'])->name('store');
        Route::get('create', [VideoController::class, 'create'])->name('create');
        Route::get('{video}', [VideoController::class, 'show'])->name('show');
    });

    // CHANNEL CONTROLLER
    Route::prefix('channels')->name('channels.')->group(function () {
        Route::get('{channel}', [ChannelController::class, 'show'])->name('show');
    });
});
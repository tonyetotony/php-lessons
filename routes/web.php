<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {
    // DASHBOARD CONTROLLER
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('my-channel', [DashboardController::class, 'myChannel'])->name('dashboard.my-channel');

    // PUBLIC VIDEOS CONTROLLER
    Route::get('videos/public', [VideoController::class, 'publicIndex'])->name('videos.public');

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
        Route::get('create', [ChannelController::class, 'create'])->name('create');
        Route::post('', [ChannelController::class, 'store'])->name('store');
        Route::get('{channel}', [ChannelController::class, 'show'])->name('show');
        Route::get('{channel}/edit', [ChannelController::class, 'edit'])->name('edit');
        Route::put('{channel}', [ChannelController::class, 'update'])->name('update');
    });

    Route::resource('settings', SettingController::class);
    Route::get('/test-create', function () {
    return view('channels.create');
});
});

<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminRedirect;
use Illuminate\Support\Facades\Route;


Route::get('dashboard/login', [AuthController::class, 'login'])->name('dashboard.login');

// Route::group(['middleware' => AdminRedirect::class], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //Users controller
    Route::group(['controller' => UserController::class, 'as' => 'user.'], function () {
        Route::get('users', 'index')->name('index');
        Route::get('user/details/{id]', 'show')->name('show');
    });

    
// });

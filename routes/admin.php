<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminRedirect;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => AdminRedirect::class, 'prefix' => 'dashboard'], function () {
    Route::get('login',         [AuthController::class, 'login'])->name('dashboard.login');
    Route::post('verify/login', [AuthController::class, 'verifyLogin'])->name('dashboard.verifyLogin');
});

Route::group(['middleware' => AdminAuth::class, 'prefix' => 'dashboard'], function () {
    Route::get('/',      [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('dashboard.logout');


    Route::group(['controller' => UserController::class, 'as' => 'user.', 'prefix' => 'users'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('details/{id}', 'show')->name('show');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });

    Route::group(['controller' => PagesController::class, 'as' => 'pages.', 'prefix' => 'pages'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('pricing', 'pricing')->name('pricing');
        Route::get('maintenance', 'maintenance')->name('maintenance');
        Route::get('404', 'fourzerofour')->name('fourzerofour');
        Route::get('500', 'fivezerozero')->name('fivezerozero');
    });

    Route::group(['controller' => RolesController::class, 'as' => 'roles.', 'prefix' => 'roles'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/permissions', 'permissions')->name('permissions');
        Route::get('/permission/create', 'createPermission')->name('createPermission');
        Route::post('/permission/store', 'storePermission')->name('storePermission');
        Route::get('/permission/edit/{id}', 'editPermission')->name('editPermission');
        Route::post('/permission/update/{id}', 'updatePermission')->name('updatePermission');
        Route::get('/permission/delete/{id}', 'deletePermission')->name('deletePermission');
        Route::get('/roles', 'roles')->name('roles');
        Route::get('/role/edit/{id}', 'editRole')->name('editRole');
        Route::post('/role/update/{id}', 'updateRole')->name('updateRole');
    });


    Route::get('/settings',               [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/profile',                [SettingsController::class, 'profile'])->name('dashboard.profile');
    Route::post('/profile/update',        [SettingsController::class, 'updateProfile'])->name('dashboard.updateProfile');
    Route::post('/password/update',       [SettingsController::class, 'updatePassword'])->name('dashboard.updatePassword');
    
});

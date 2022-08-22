<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 *****************************************************************************
 ************************** ADMIN PANEL ROUTES *******************************
 *****************************************************************************
 */
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/dashboard', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    });

    Route::prefix('portal')->group(function () {
        Route::match(['get', 'post'], '/login', 'AdminController@login')->name('admin.login');

        Route::group(['middleware' => ['adminCheckSuspend']], function () {
            Route::group(['middleware' => ['admin']], function () {
                Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
                Route::get('/logout', 'AdminController@logout')->name('admin.logout');

                Route::group(['middleware' => ['permission:manage-admin-users']], function () {
                    Route::group(['prefix' => 'admin-users'], function () {
                        Route::get('/', 'AdminUserController@index')->name('admins.index');
                        Route::get('/create', 'AdminUserController@create')->name('admins.create');
                        Route::post('/store', 'AdminUserController@store')->name('admins.store');
                        Route::get('/edit/{id}', 'AdminUserController@edit')->name('admins.edit');
                        Route::post('/update/{id}', 'AdminUserController@update')->name('admins.update');
                    });
                });
            });
        });
    });
});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

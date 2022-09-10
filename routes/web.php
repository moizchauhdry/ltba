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

    Route::prefix('admin')->group(function () {
        Route::match(['get', 'post'], '/login', 'AdminController@login')->name('admin.login');

        Route::group(['middleware' => ['adminCheckSuspend']], function () {
            Route::group(['middleware' => ['admin']], function () {
                Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
                Route::get('/rest-password/{id}', 'AdminController@restPassword')->name('admins.reset-password');
                Route::post('/passwordUpdate', 'AdminController@passwordUpdate')->name('admins.password-update');
                Route::get('/getDashboardRecord', 'AdminController@mangeDashBoard')->name('admin.manage-dashboard');
                Route::get('/profile', 'AdminController@profile')->name('admin.profile');
                Route::post('/profile-update', 'AdminController@profileUpdate')->name('admin.profile.update');
                Route::post('/password-check', 'AdminController@checkPassword')->name('admin.check-password');
                Route::get('/logout', 'AdminController@logout')->name('admin.logout');

                Route::group(['middleware' => ['permission:manage_operators']], function () {
                    Route::group(['prefix' => 'admin-users'], function () {
                        Route::get('/', 'AdminUserController@index')->name('admins.index');
                        Route::get('/create', 'AdminUserController@create')->name('admins.create');
                        Route::post('/store', 'AdminUserController@store')->name('admins.store');
                        Route::get('/edit/{id}', 'AdminUserController@edit')->name('admins.edit');
                        Route::post('/update/{id}', 'AdminUserController@update')->name('admins.update');
                        Route::post('/destroy', 'AdminUserController@destroy')->name('admins.destroy');
                        Route::post('/status', 'AdminUserController@status')->name('admins.status');
                    });
                });

                Route::group(['middleware' => ['permission:manage_members']], function () {
                    Route::group(['prefix' => 'members'], function () {
                        Route::get('/', 'MemberController@index')->name('members.index');
                        Route::get('/create', 'MemberController@create')->name('members.create');
                        Route::post('/store', 'MemberController@store')->name('members.store');
                        Route::get('/edit/{id}', 'MemberController@edit')->name('members.edit');
                        Route::get('/detail/{id}', 'MemberController@show')->name('members.detail');
                        Route::post('/update/{id}', 'MemberController@update')->name('members.update');
                        Route::post('/destroy', 'MemberController@destroy')->name('members.destroy');
                        Route::post('/status', 'MemberController@status')->name('members.status');
                        Route::post('/payment/update/{id}', 'MemberController@paymentUpdate')->name('members.paymentUpdate');
                    });
                });

                Route::group(['middleware' => ['permission:manage_elections']], function () {
                    Route::group(['prefix' => 'elections'], function () {
                        Route::get('/', 'ElectionController@index')->name('elections.index');
                        Route::get('/create', 'ElectionController@create')->name('elections.create');
                        Route::post('/store', 'ElectionController@store')->name('elections.store');
                        Route::get('/edit/{id}', 'ElectionController@edit')->name('elections.edit');
                        Route::post('/update/{id}', 'ElectionController@update')->name('elections.update');
                        Route::post('/destroy', 'ElectionController@destroy')->name('elections.destroy');
                        Route::post('/status', 'ElectionController@status')->name('elections.status');
                        Route::get('/assign-seats/{id}', 'ElectionController@assignSeats')->name('elections.assignSeat');
                        Route::get('/get-member', 'ElectionController@getMember')->name('elections.getMember');
                        Route::get('/get-candidate', 'ElectionController@getCandidates')->name('elections.getCandidates');
                        Route::post('/store-assign-member-seat', 'ElectionController@storeAssignMemberSeat')->name('elections.storeAssignMemberSeat');
                    });
                });

                Route::group(['middleware' => ['permission:manage_seats']], function () {
                    Route::group(['prefix' => 'seats'], function () {
                        Route::get('/', 'SeatController@index')->name('seats.index');
                        Route::get('/create', 'SeatController@create')->name('seats.create');
                        Route::post('/store', 'SeatController@store')->name('seats.store');
                        Route::get('/edit/{id}', 'SeatController@edit')->name('seats.edit');
                        Route::post('/update/{id}', 'SeatController@update')->name('seats.update');
                        Route::post('/destroy', 'SeatController@destroy')->name('seats.destroy');
                        Route::post('/status', 'SeatController@status')->name('seats.status');
                    });
                });


                Route::group(['middleware' => ['permission:manage_inquires']], function () {
                    Route::group(['prefix' => 'inquires'], function () {
                        Route::get('/', 'InquiryController@index')->name('inquires.index');
                        Route::get('/edit/{id}', 'InquiryController@edit')->name('inquires.edit');
                        Route::post('/update/{id}', 'InquiryController@update')->name('inquires.update');
                    });
                });
            });
        });
    });
});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Login Routes
Route::group(['namespace' => 'Admin','middleware' => 'guest:admin'],function (){
    Route::get('login','LoginController@getLogin')->name('get.admin.login');
    Route::post('login','LoginController@login')->name('admin.login');
});
Route::get('/',function () {
    return redirect()->route('admin.dashboard');
});
// Admin Routes
Route::group(['namespace' => 'Admin','middleware' => 'auth:admin'],function (){

    // Dashboard Page
    Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

    /* Freelancers */

    // Freelancers
    Route::get('/freelancers', 'UsersController@get_freelancers')->name('admin.users.freelancers');
    // Show Freelancer
    Route::get('/freelancer/{id}', 'UsersController@show')->name('admin.users.freelancers.show');
    // Edit Freelancer
    Route::get('/freelancer/{id}/edit', 'UsersController@edit')->name('admin.users.freelancers.edit');
    // Update Freelancer
    Route::post('/freelancer/{id}/update', 'UsersController@update')->name('admin.users.freelancers.update');
    // Delete Freelancer
    Route::post('/freelancer/delete', 'UsersController@delete')->name('admin.users.freelancers.delete');

    /* Users */
    Route::get('/users', 'UsersController@get_users')->name('admin.users.index');


    /* Orders */

    // Orders
    Route::get('/orders', 'OrdersController@index')->name('admin.orders.index');
    // Show Order
    Route::get('/order/{id}', 'OrdersController@show')->name('admin.orders.show');
    // Change Order Status
    Route::post('/order/change-status', 'OrdersController@change_status')->name('admin.orders.change');
    // Delete Order
    Route::post('/order/delete', 'OrdersController@delete')->name('admin.orders.delete');


    /* Coupons */

    // Coupons
    Route::get('/coupons', 'CouponsController@index')->name('admin.coupons.index');
    // Add Coupon
    Route::get('/coupons/add', 'CouponsController@add')->name('admin.coupons.add');
    // Save Coupon
    Route::post('/coupons/save', 'CouponsController@save')->name('admin.coupons.save');
    // Delete Coupon
    Route::post('/coupons/delete', 'CouponsController@delete')->name('admin.coupons.delete');


    /* Admin Area */

    // Profile Page
    Route::get('/profile','loginController@profile')->name('admin.profile');
    // Profile Edit Page
    Route::post('/profile','loginController@profileUpdate')->name('admin.profile.update');
    // Logout
    Route::get('/logout', 'loginController@logout')->name('admin.logout');
});

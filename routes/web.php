<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();


Route::group(['prefix' => 'request'], function () {
    Route::get('/get-countries', function () {
        return \App\Country::all();
    });
    Route::get('/get-categories', function () {
        return \App\Category::all();
    });
    /* Auth */
    Route::post('/register', 'Auth\RegisterController@register_action');
    Route::post('/login', 'Auth\LoginController@login_action');
    /* Search */
    Route::get('/search', 'SearchController@index');
    /* Category */
    Route::get('/get-users-category/{id}', 'CategoryController@index');
    /* User Profile */
    Route::get('/get-user/{id}', 'UsersController@index');
    /* Add New Video */
    Route::post('/add-video', 'VideosController@add');
    /* Get user Videos */
    Route::get('/get-videos', 'VideosController@index');
    /* Update Account */
    Route::post('/update-account', 'UsersController@update');
    Route::post('/update-password', 'UsersController@update_password');
    /* Orders */
    Route::get('/check-coupon/{c}','OrdersController@checkCoupon');
    Route::get('/get-target/{id}', 'UsersController@get_target');
    Route::post('/create-order', 'OrdersController@create');

    Route::get('get-user-orders', 'OrdersController@get_user_orders');

//    Route::post('/create-order', 'OrdersController@create');
    /* Home */
    Route::get('/get-latest', 'HomeController@get_latest');
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect("/login");
});


Route::get('/{any?}', 'HomeController@index')
    ->where('any', '^(?!admin).*$');

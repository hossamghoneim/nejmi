<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();


 Route::get('fill-tinker',function() {

    for($i = 0 ; $i < 100 ; $i++) {
        $rand = rand(2,18000);
        $user = \App\User::where('id',$rand)->first();
        if($user != null) {
            echo '<p>'.  $user->name . '<\p>';
            $feat =  new \App\FeaturedUser([
                'user_id' => $rand,
            ]);
            $feat->save();
        }
    }
 });

Route::group(['prefix' => 'request'], function () {
    Route::get('/get-sliders', function () {
        return \App\slider::all();
    });
    Route::get('/get-countries', function () {
        return \App\Country::all();
    });
    Route::get('/get-categories', function () {
        return \App\Category::with(["users"=>(function($query) {
            $query->with(['category','country'])->take(10);
        })])->latest()->get();
    });
    Route::get('/get-pages', function () {
        return \App\Page::latest()->get();
    });
    Route::get('/get-page/{slug}', function ($slug) {
        $page = \App\Page::where('slug',$slug)->first();
        if(!$page) return response()->json("الصفحة غير موجودة", 404);
        return response()->json($page, 200);
    });
    /* Auth */
    Route::post('/register', 'Auth\RegisterController@register_action');
    Route::post('/login', 'Auth\LoginController@login_action');
    /* Search */
    Route::get('/search', 'SearchController@index');
    /* Category */
    Route::get('/get-users-category/{id}', 'CategoryController@index');
    Route::get('/get-best-category', 'CategoryController@best');
    Route::get('/get-latest-category', 'CategoryController@latest');
    /* User Profile */
    Route::get('/get-user/{username}', 'UsersController@index');
    /* Add New Video */
    Route::post('/add-video', 'VideosController@add');
    Route::post('/delete-video', 'VideosController@delete');
    /* Get user Videos */
    Route::get('/get-videos', 'VideosController@index');
    /* Update Account */
    Route::post('/update-account', 'UsersController@update');
    Route::post('/update-password', 'UsersController@update_password');
    Route::post('/update-image-video', 'UsersController@update_image_video');

    // Toggle Accept Orders
    Route::post('/toggle-accept-orders', 'UsersController@toggleAcceptOrders');

    /* Orders */
    Route::get('/check-coupon/{c}','OrdersController@checkCoupon');
    Route::get('/get-target/{id}/{type}', 'UsersController@get_target');
    Route::post('/create-temp-order', 'OrdersController@create_temp_order');
    Route::post('/create-order', 'OrdersController@create');


    // Get Gifts
    Route::get('/get-gifts', function () {
        return \App\Gift::latest()->get();
    });

    Route::get('/get-user-orders', 'OrdersController@get_user_orders');

    /* Home */
    Route::get('/get-latest', 'HomeController@get_latest');
    Route::get('/get-featured', 'HomeController@get_featured');
    Route::get('/get-special-videos', 'HomeController@get_special_videos');
    Route::get('/get-views', 'HomeController@get_views');
    Route::get('/get-price-filter', function () {
        return \App\Setting::first()->price_filter;
    });

    // Toggle Order Status
    Route::post('/toggle-order-status', 'OrdersController@toggleOrderStatus');

    // Send Activation
    Route::post('/send-activation', 'ActivationController@store');
    // Check Activation
    Route::get('/get-user-activation', 'ActivationController@check');


    /* Alerts */
    Route::get('/get-user-alerts', 'AlertController@index');
    Route::post('/add-alert', 'AlertController@add');
    Route::post('/delete-alert', 'AlertController@delete');

    // Logs
    Route::get('/get-user-logs', 'HomeController@get_user_logs');

    Route::get('/get-donation-image', function () {
        return \App\Setting::first()->donation_image;
    });

    Route::get('/checkAuth',function(){
        if(auth()->user()) {
            return true;
        } else {
            return false;
        }
    });
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect("/login");
});

Route::get('/{any?}', 'HomeController@index')->where('any', '^(?!admin).*$');

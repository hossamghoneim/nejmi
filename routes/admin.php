<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();

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


    Route::get('/sliders','SliderController@index')->name('admin.sliders');
    Route::get('/sliders-create','SliderController@create')->name('admin.create.sliders');
    Route::get('/sliders-delete/{id}','SliderController@destroy')->name('admin.destroy.sliders');
    Route::post('/sliders-store','SliderController@store')->name('admin.store.sliders');
    /* Freelancers */

    // Freelancers
    Route::get('/freelancers', 'UsersController@get_freelancers')->name('admin.users.freelancers');
    // Show Freelancer
    Route::get('/freelancer/{id}', 'UsersController@show')->name('admin.users.freelancers.show');
    // Edit Freelancer
    Route::get('/freelancer/{id}/edit', 'UsersController@edit')->name('admin.users.freelancers.edit');
    // Update Freelancer
    Route::post('/freelancer/update', 'UsersController@update')->name('admin.users.freelancers.update');
    // Delete Freelancer
    Route::post('/freelancer/delete', 'UsersController@delete')->name('admin.users.freelancers.delete');
    // Toggle Activation
    Route::post('/toggle-activation', 'UsersController@toggleActivation')->name('admin.users.freelancers.toggleActivation');
    // Add User
    Route::get('/freelancers/add', 'UsersController@add')->name('admin.users.freelancers.add');
    // Store User
    Route::post('/freelancers/store', 'UsersController@store')->name('admin.users.freelancers.store');

    // Send Money
    Route::post('/freelancers/send', 'UsersController@send')->name('admin.users.send');
    // Send Money to Freelancers Page
    Route::get('/send-money', 'UsersController@send_money_page')->middleware('can:send_money_page')->name('admin.users.send_money_page');


    // Featured Users
    Route::get('/featured-users', 'FeaturedController@index')->name('admin.featured_users.index');
    // Add Featured User
    Route::get('/featured-users/add', 'FeaturedController@add')->name('admin.featured_users.add');
    // Save Featured User
    Route::post('/featured-users/add', 'FeaturedController@save')->name('admin.featured_users.save');
    // Delete Featured User
    Route::post('/featured-users/delete', 'FeaturedController@delete')->name('admin.featured_users.delete');


    // Videos
    // Delete Video
    Route::get('/video/delete-main/{id}', 'UsersController@delete_main_video')->name('admin.video.delete_main_video');
    Route::get('/video/delete/{id}', 'UsersController@delete_video')->name('admin.video.delete');

    /* Users */

    // Users
    Route::get('/users', 'UsersController@get_users')->name('admin.users.index');
    // Show User
    Route::get('/user/{id}', 'UsersController@show_user')->name('admin.users.show');


    /* Orders */

    // Orders
    Route::get('/orders', 'OrdersController@index')->name('admin.orders.index');
    // Show Order
    Route::get('/order/{id}', 'OrdersController@show')->name('admin.orders.show');
    // Change Order Status
    Route::post('/order/change-status', 'OrdersController@change_status')->name('admin.orders.change');
    // Delete Order
    Route::post('/order/delete', 'OrdersController@delete')->name('admin.orders.delete');
    // Incomplete Orders
    Route::get('/orders/incomplete', 'OrdersController@incomplete')->name('admin.orders.incomplete');



    /* Categories */

    // Categories
    Route::get('/categories', 'CategoriesController@index')->name('admin.categories.index');
    // Add Category
    Route::get('/categories/add', 'CategoriesController@add')->name('admin.categories.add');
    // Save Category
    Route::post('/categories/save', 'CategoriesController@save')->name('admin.categories.save');
    // Edit Category
    Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('admin.categories.edit');
    // Update Category
    Route::post('/categories/update', 'CategoriesController@update')->name('admin.categories.update');
    // Delete Category
    Route::post('/categories/delete', 'CategoriesController@delete')->name('admin.categories.delete');



    /* Coupons */

    // Coupons
    Route::get('/coupons', 'CouponsController@index')->name('admin.coupons.index');
    // Add Coupon
    Route::get('/coupons/add', 'CouponsController@add')->name('admin.coupons.add');
    // Save Coupon
    Route::post('/coupons/save', 'CouponsController@save')->name('admin.coupons.save');
    // Edit Coupon
    Route::get('/coupons/{id}/edit', 'CouponsController@edit')->name('admin.coupons.edit');
    // Update Coupon
    Route::post('/coupons/update', 'CouponsController@update')->name('admin.coupons.update');
    // Delete Coupon
    Route::post('/coupons/delete', 'CouponsController@delete')->name('admin.coupons.delete');



    /* Special Videos */

    // Special Videos
    Route::get('/special-videos', 'SpecialVideosController@index')->name('admin.special_videos.index');
    // Save Video
    Route::post('/special-videos/save', 'SpecialVideosController@save')->name('admin.special_videos.save');
    // Delete Video
    Route::post('/special-videos/delete', 'SpecialVideosController@delete')->name('admin.special_videos.delete');



    /* Gifts */

    // Gifts
    Route::get('/gifts','GiftsController@index')->name('admin.gifts.index');
    // Add Gift
    Route::get('/gifts/add', 'GiftsController@add')->name('admin.gifts.add');
    // Save Gift
    Route::post('/gifts/save', 'GiftsController@save')->name('admin.gifts.save');
    // Edit Gift
    Route::get('/gifts/{id}/edit', 'GiftsController@edit')->name('admin.gifts.edit');
    // Update Gift
    Route::post('/gifts/update', 'GiftsController@update')->name('admin.gifts.update');
    // Delete Gift
    Route::post('/gifts/delete', 'GiftsController@delete')->name('admin.gifts.delete');


    /* Pages */

    // Pages
    Route::get('/pages', 'PagesController@index')->name('admin.pages.index');
    // Add Page
    Route::get('/pages/add', 'PagesController@add')->name('admin.pages.add');
    // Save Page
    Route::post('/pages/save', 'PagesController@save')->name('admin.pages.save');
    // Edit Page
    Route::get('/pages/{id}/edit', 'PagesController@edit')->name('admin.pages.edit');
    // Update Page
    Route::post('/pages/update', 'PagesController@update')->name('admin.pages.update');
    // Delete Page
    Route::post('/pages/delete', 'PagesController@delete')->name('admin.pages.delete');



    /* Alerts */

    // Alerts
    Route::get('/alerts', 'AlertController@index')->name('admin.alerts.index');
    // Delete Alert
    Route::post('/alerts/delete', 'AlertController@delete')->name('admin.alerts.delete');
    // Send Alert
    Route::get('/alerts/{id}/send', 'AlertController@send')->name('admin.alerts.send');


    /* Website Settings */

    // Website Settings
    Route::get('/settings', 'SettingsController@index')->name('admin.settings.index');
    // Save Settings
    Route::post('/settings', 'SettingsController@save')->name('admin.settings.save');



    /* Ads */

    // Ads
    Route::get('/ads', 'AdsController@index')->name('admin.ads.index');
    // Save Ads
    Route::post('/ads', 'AdsController@save')->name('admin.ads.save');

    /* Reports */

    // Reports
    Route::get('/reports', 'ReportsController@index')->name('admin.reports.index');



    /* Affiliates */

    // Affiliates
    Route::get('/affiliates', 'AffiliateController@index')->name('admin.affiliates.index');
    // Add Affiliate
    Route::get('/affiliates/add', 'AffiliateController@add')->name('admin.affiliates.add');
    // Show Affiliates
    Route::get('/affiliates/{id}', 'AffiliateController@show')->name('admin.affiliates.show');
    // Save Affiliate
    Route::post('/affiliates/save', 'AffiliateController@save')->name('admin.affiliates.save');
    // Edit Affiliate
    Route::get('/affiliates/edit/{id}', 'AffiliateController@edit')->name('admin.affiliates.edit');
    // Update Affiliate
    Route::post('/affiliates/update', 'AffiliateController@update')->name('admin.affiliates.update');
    // Delete Affiliate
    Route::post('/affiliates/delete', 'AffiliateController@delete')->name('admin.affiliates.delete');

    // Affiliate Send Money
    Route::post('/affiliates/send', 'AffiliateController@send')->name('admin.affiliates.send');





    /* Activations */

    // Activations
    Route::get('/activations', 'ActivationController@index')->name('admin.activations.index');
    // Show Activation
    Route::get('/activations/{id}', 'ActivationController@show')->name('admin.activations.show');
    // Delete Activation
    Route::post('/activations/delete', 'ActivationController@delete')->name('admin.activations.delete');
    // Change Status
    Route::post('/activation-change-status', 'ActivationController@change_status')->name('admin.activations.change_status');



    /* Roles */

    Route::get('/roles', 'RolesController@index')->name('admin.roles.index');
    // Create Role
    Route::get('/roles/add', 'RolesController@add')->name('admin.roles.add');
    // Save Role
    Route::post('/roles/add', 'RolesController@save')->name('admin.roles.save');
    // Edit Role
    Route::get('/roles/{id}/edit', 'RolesController@edit')->name('admin.roles.edit');
    // Update Role
    Route::post('/roles/update', 'RolesController@update')->name('admin.roles.update');
    // Delete Role
    Route::post('/roles/delete', 'RolesController@delete')->name('admin.roles.delete');


    /* Supervisors */

    Route::get('/supervisors', 'SupervisorsController@index')->name('admin.supervisors.index');
    Route::get('/supervisors/add', 'SupervisorsController@add')->name('admin.supervisors.add');
    Route::post('/supervisors/add', 'SupervisorsController@save')->name('admin.supervisors.save');
    Route::get('/supervisors/{id}/edit', 'SupervisorsController@edit')->name('admin.supervisors.edit');
    Route::post('/supervisors/update', 'SupervisorsController@update')->name('admin.supervisors.update');
    Route::post('/supervisors/delete', 'SupervisorsController@delete')->name('admin.supervisors.delete');




    /* Admin Area */

    // Profile Page
    Route::get('/profile','LoginController@profile')->name('admin.profile');
    // Profile Edit Page
    Route::post('/profile','LoginController@profileUpdate')->name('admin.profile.update');
    // Logout
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
});

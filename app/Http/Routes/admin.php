<?php
Route::group(['middleware' => ['auth:admin']], function ($router) {
    // Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
    Route::get('/', 'PostController@index');
    //account
    Route::post('account/updateStatus', 'AccountController@updateStatus');
    Route::get('account/{id}/password', ['uses' => 'AccountController@password', 'as' => 'admin.account.password']);
    Route::post('account/{id}/password', ['uses' => 'AccountController@doPassword', 'as' => 'admin.account.password']);
    Route::resource('account', 'AccountController');
    //menu
    Route::post('menu/updateParentIdSelectBox', 'MenuController@updateParentIdSelectBox');
    Route::post('menu/updateStatus', 'MenuController@updateStatus');
    Route::post('menu/callupdate', 'MenuController@callupdate');
    Route::resource('menu', 'MenuController');
    //post tag
    Route::post('posttag/updateStatus', 'PostTagController@updateStatus');
    Route::resource('posttag', 'PostTagController');
    //post type
    Route::post('posttype/updateStatus', 'PostTypeController@updateStatus');
    Route::post('posttype/callupdate', 'PostTypeController@callupdate');
    Route::resource('posttype', 'PostTypeController');
    //post
    Route::post('post/updateStatus', 'PostController@updateStatus');
    Route::get('post/search', ['uses' => 'PostController@search', 'as' => 'admin.post.search']);
    Route::resource('post', 'PostController');
    //ads
    Route::post('ad/updateStatus', 'AdController@updateStatus');
    Route::resource('ad', 'AdController');
    //config
    Route::resource('config', 'ConfigController');
    //clear all cache & views
    Route::get('clearallstorage', 'AdminController@clearallstorage');
    //page
    Route::post('page/updateStatus', 'PageController@updateStatus');
    Route::resource('page', 'PageController');
    //contact
    Route::resource('contact', 'ContactController');
    //slider
    Route::post('slider/updateStatus', 'SliderController@updateStatus');
    Route::post('slider/callupdate', 'SliderController@callupdate');
    Route::resource('slider', 'SliderController');
});
Route::get('login', ['uses' => 'AuthController@index', 'as' => 'admin.auth.index']);
Route::post('login', ['uses' => 'AuthController@login', 'as' => 'admin.auth.login', 'middleware' => 'checkstatus']);
Route::get('logout', ['uses' => 'AuthController@logout', 'as' => 'admin.auth.logout']);
// Route::get('password/reset/{token?}', ['uses' => 'PasswordController@showResetForm', 'as' => 'admin.password.reset']);
// Route::post('password/reset', ['uses' => 'PasswordController@reset', 'as' => 'admin.password.reset']);
// Route::post('password/email', ['uses' => 'PasswordController@sendResetLinkEmail', 'as' => 'admin.password.email']);

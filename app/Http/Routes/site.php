<?php

// api for app
Route::get('/api/getlistpost', 'ApiController@getlistpost');
Route::get('/api/getpost/{id}', 'ApiController@getpost');
Route::get('/api/getposttype', 'ApiController@getposttype');
// end api for app

// Route::resource('test', 'TestController');

Route::post('/contact', 'SiteController@contact');
Route::get('/sitemap.xml', 'SiteController@sitemap');
Route::get('/tim-kiem', ['uses' => 'SiteController@search', 'as' => 'site.search']);
Route::get('/', ['uses' => 'SiteController@index', 'as' => 'site.index']);
Route::get('tag/{slug}', ['uses' => 'SiteController@tag', 'as' => 'site.tag']);
Route::get('{slug1}/{slug2}', 'SiteController@page2');
Route::get('{slug}', 'SiteController@page');
<?php

Route::view('/', 'welcome')->middleware('guest')->name('welcome');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/auth/{provider}', 'Auth\LoginController@create')->name('auth');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@store');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('companies', 'CompaniesController', ['only' => ['create', 'store']]);
Route::resource('channels.messages', 'ChannelMessagesController', ['only' => ['store']]);

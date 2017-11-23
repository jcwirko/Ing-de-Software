<?php


Route::get('/', function () {
    return view('users.index');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Authentication Routes...
Route::get('smn/dashboard', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);


<?php

Route::group(['middleware' => ['auth']], function () {

    Route::get('smn/dashboard/index','Admin\HomeController@index');

    Route::get('smn/dashboard/encenderTodo','Admin\HomeController@encenderTodo');

    Route::get('smn/dashboard/apagarTodo','Admin\HomeController@apagarTodo');

    Route::get('smn/dashboard/apagarEncenderSensor/{id}','Admin\HomeController@apagarEncenderSensor');

    Route::get('smn/dashboard/calibrarSensor/{id}','Admin\HomeController@calibrarSensor');

    Route::get('smn/dashboard/testearTodo','Admin\HomeController@testearTodo');

});

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

Route::post('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@login'
]);

Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

/**
 * HUMEDAD
 */

Route::get('humedad/getHumedadMax','HumedadController@getHumedadMax');
Route::get('humedad/getHumedadMin','HumedadController@getHumedadMin');
Route::get('humedad/getHumedadMaxMonthly','HumedadController@getHumedadMaxMonthly');
Route::get('humedad/getHumedadMinMonthly','HumedadController@getHumedadMinMonthly');
Route::get('humedad/getHumedadActual','HumedadController@getHumedadActual');
Route::get('humedad/getLabels','HumedadController@getLabels');
Route::get('humedad/getDataChart','HumedadController@getDataChart');

/**
 * TEMPERATURA
 */

Route::get('temperatura/getTemperaturaMax','TemperaturaController@getTemperaturaMax');
Route::get('temperatura/getTemperaturaMin','TemperaturaController@getTemperaturaMin');
Route::get('temperatura/getTemperaturaMaxMonthly','TemperaturaController@getTemperaturaMaxMonthly');
Route::get('temperatura/getTemperaturaMinMonthly','TemperaturaController@getTemperaturaMinMonthly');
Route::get('temperatura/getTemperaturaActual','TemperaturaController@getTemperaturaActual');
Route::get('temperatura/getLabels','TemperaturaController@getLabels');
Route::get('temperatura/getDataChart','TemperaturaController@getDataChart');

/*
 * PRESION
 */

Route::get('presion/getPresionActual','PresionController@getPresionActual');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

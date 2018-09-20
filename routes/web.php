<?php

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->namespace('Admin')
        ->group(function () {
            Route::get('/', 'IndexController@show')->name('index');
        });






Auth::routes();

Route::match(['get', 'post'], '/resend', ['uses' => 'Auth\ResendTokenController@index', 'as' => 'resend_activation']);
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');



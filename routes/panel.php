<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'as' => 'panel.'
    ], function () {

    Route::group(['prefix' => 'panel'], function () {

        Route::get('login', 'Auth\LoginController@showLoginForm')->name('showLogin');
          Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        Route::post('login', 'Auth\LoginController@login')->name('login');


        Route::group(['middleware'=>'auth:admin'] , function(){
            Route::get('/', function () {
                return view('panel.index');
    });

        });
});


});



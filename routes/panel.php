<?php


use App\Http\Controllers\Panel\BlogController;
use App\Http\Controllers\Panel\CoursesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Panel\AdminController;
use App\Http\Controllers\Panel\FaqController;

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
                return view('panel.index');})->name('index');

                //routes for admins :
            Route::group(['prefix' => 'admins' , 'as' => 'admins.'], function () {

                Route::get('/', [AdminController::class, 'index'])->name('index');
                Route::get('/datatable', [AdminController::class, 'datatable'])->name('datatable');

                Route::group(['prefix' => 'create'], function (){
                    Route::get('/',[AdminController::class , 'create'])->name('create');
                    Route::post('/',[AdminController::class , 'store'])->name('store');
                });

                Route::group(['prefix' => '{id}'], function (){
                    Route::get('/edit',[AdminController::class , 'edit'])->name('edit');
                    Route::put('/edit',[AdminController::class , 'update'])->name('update');
                    Route::delete('/',[AdminController::class , 'destroy'])->name('destroy');
                    Route::post('/operation',[AdminController::class , 'operation'])->name('operation');
                });

            });
            //routes for blogs
            Route::group(['prefix' => 'blogs' , 'as' => 'blogs.'], function () {

                Route::get('/', [BlogController::class, 'index'])->name('index');
                Route::get('/datatable', [BlogController::class, 'datatable'])->name('datatable');


                Route::group(['prefix' => 'create'], function (){
                    Route::get('/',[BlogController::class , 'create'])->name('create');
                    Route::post('/',[BlogController::class , 'store'])->name('store');
                });

                Route::group(['prefix' => '{id}'], function (){
                    Route::get('/edit',[BlogController::class , 'edit'])->name('edit');
                    Route::put('/edit',[BlogController::class , 'update'])->name('update');
                    Route::delete('/',[BlogController::class , 'destroy'])->name('destroy');
                    Route::post('/operation',[BlogController::class , 'operation'])->name('operation');
                });

            });

            // routes for faqs

            Route::group(['prefix' => 'faqs' , 'as' => 'faqs.'], function () {

                Route::get('/', [FaqController::class, 'index'])->name('index');
                Route::get('/datatable', [FaqController::class, 'datatable'])->name('datatable');


                Route::group(['prefix' => 'create'], function (){
                    Route::get('/',[FaqController::class , 'create'])->name('create');
                    Route::post('/',[FaqController::class , 'store'])->name('store');
                });

                Route::group(['prefix' => '{id}'], function (){
                    Route::get('/edit',[FaqController::class , 'edit'])->name('edit');
                    Route::put('/edit',[FaqController::class , 'update'])->name('update');
                    Route::delete('/',[FaqController::class , 'destroy'])->name('destroy');
                    Route::post('/operation',[FaqController::class , 'operation'])->name('operation');
                });

            });
            // routes for courses

            Route::group(['prefix' => 'courses' , 'as' => 'courses.'], function () {

                Route::get('/', [CoursesController::class, 'index'])->name('index');
                Route::get('/datatable', [CoursesController::class, 'datatable'])->name('datatable');


                Route::group(['prefix' => 'create'], function (){
                    Route::get('/',[CoursesController::class , 'create'])->name('create');
                    Route::post('/',[CoursesController::class , 'store'])->name('store');
                });

                Route::group(['prefix' => '{id}'], function (){
                    Route::get('/edit',[CoursesController::class , 'edit'])->name('edit');
                    Route::put('/edit',[CoursesController::class , 'update'])->name('update');
                    Route::delete('/',[CoursesController::class , 'destroy'])->name('destroy');
                    Route::post('/operation',[CoursesController::class , 'operation'])->name('operation');
                });

            });



        });
});


});



<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::any('site/acceptConfirmationCallback2' , 'PaymentsApi@actionAcceptConfirmationCallback2');  
Route::any('site/FawryConfirmationCallback' , 'PaymentsApi@actionFawryConfirmationCallback');

Route::middleware("localization")->group(function () {



    Route::prefix('auth')->group(function () {
        Route::post('/register', 'AuthControllerApi@register');
        Route::post('/login', 'AuthControllerApi@login');
        Route::post('/confirm', 'AuthControllerApi@confirm');
        Route::post('/resetPasswordRequest', 'AuthControllerApi@resetPasswordRequest');
        Route::post('/resetPasswordConfirm', 'AuthControllerApi@resetPasswordConfirm');
        Route::post('/resetPassword',  'AuthControllerApi@resetPassword');
        Route::post('/resendotp',  'AuthControllerApi@resendotp');
    });
    Route::group(array('prefix' => 'v1'), function () {

        Route::middleware('authApi:api')->group( function () {
            Route::get('cart', 'UserApi@cart');
            Route::get('whishlist', 'UserApi@whishlist');
            Route::post('addToCart', 'UserApi@addToCart');
            Route::post('removeFromCart', 'UserApi@removeFromCart');
            Route::post('toggleFavourite', 'UserApi@toggleFavourite');
            Route::post('myLearning', 'AccountControllerApi@myLearning');
            Route::get('myCertifications', 'AccountControllerApi@myCertifications');
        });

        //Home
        Route::get('categories', 'CategoriesApi@index');
        Route::post('courses', 'CoursesApi@index');
        Route::get('categoriesInHome', 'CategoriesApi@categoriesInHome');
        Route::get('instructors', 'UserApi@instructors');
        Route::get('countersHome', 'HomeApi@countersHome');
        Route::get('reviews', 'CoursereviewsApi@index');
        Route::get('topSearches', 'HomeApi@topSearches');
        Route::get('quickLinks', 'HomeApi@quickLinks');




        require __DIR__.'/appendApi.php';
    });
});

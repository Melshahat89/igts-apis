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
    Route::group(array('prefix' => 'v1'), function () {

        Route::prefix('auth')->group(function () {
            Route::post('/register', 'AuthControllerApi@register');
            Route::post('/login', 'AuthControllerApi@login');
            Route::post('/confirm', 'AuthControllerApi@confirm');
            Route::post('/resetPasswordRequest', 'AuthControllerApi@resetPasswordRequest');
            Route::post('/resetPasswordConfirm', 'AuthControllerApi@resetPasswordConfirm');
            Route::post('/resetPassword',  'AuthControllerApi@resetPassword');
            Route::post('/resendotp',  'AuthControllerApi@resendotp');
        });

        Route::middleware('authApi:api')->group( function () {
            Route::get('cart', 'UserApi@cart');
            Route::get('whishlist', 'UserApi@whishlist');
            Route::post('addToCart', 'UserApi@addToCart');
            Route::post('removeFromCart', 'UserApi@removeFromCart');
            Route::post('toggleFavourite', 'UserApi@toggleFavourite');
            Route::post('myLearning', 'AccountControllerApi@myLearning');
            Route::get('myCertifications', 'AccountControllerApi@myCertifications');

            Route::post('exam', 'CoursesApi@exam');
            Route::post('examResult', 'CoursesApi@examResult');


            Route::prefix('account')->group(function () {
                Route::post('/myExams', 'AccountControllerApi@myExams');
                Route::post('/settings', 'AccountControllerApi@settings');
                Route::post('/getAllNotifications', 'AccountControllerApi@getAllNotifications');
                Route::post('/readAllNotifications', 'AccountControllerApi@readAllNotifications');
                Route::post('/notificationsCount', 'AccountControllerApi@notificationsCount');
            });


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
        Route::post('instructor', 'UserApi@instructor');
        Route::post('contactUs', 'HomeApi@contactUs');
        Route::get('partners', 'HomeApi@partners');

        Route::prefix('course')->group(function () {
            Route::post('/inner', 'CoursesApi@inner');
            Route::post('/lectures', 'CoursesApi@lectures');
            Route::post('/requirements', 'CoursesApi@requirements');
            Route::post('/willlearn', 'CoursesApi@willlearn');
            Route::post('/instructors', 'CoursesApi@instructors');
            Route::post('/qa', 'CoursesApi@qa');
            Route::post('/resources', 'CoursesApi@resources');
            Route::post('/addReview', 'CoursesApi@addReview');
            Route::post('/addReport', 'CoursesApi@addReport');
            Route::post('/notes', 'CoursesApi@notes');
            Route::post('/addNotes', 'CoursesApi@addNotes');
        });





        require __DIR__.'/appendApi.php';
    });
});

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(array('prefix' => 'v1'), function () {

    //Home
    Route::get('categories', 'CategoriesApi@index');
    Route::get('courses', 'CoursesApi@index');
    Route::get('categoriesInHome', 'CategoriesApi@categoriesInHome');
    Route::get('instructors', 'UserApi@instructors');
    Route::get('countersHome', 'HomeApi@countersHome');
    Route::get('reviews', 'CoursereviewsApi@index');


    require __DIR__.'/appendApi.php';
});
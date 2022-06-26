<?php

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('contact' , 'ContactController@index');
Route::post('contact' , 'ContactController@storeContact');
Route::get('deleteFile/{model}/{id}', 'HomeController@deleteImage');
Route::get('joinAsInstructor', 'HomeController@joinAsInstructor');



Route::get('page' , 'PageController@index');
Route::get('page/{id}/view' , 'PageController@getById');
Route::get('page/{slug}' , 'PageController@getBySlug');

Route::get('/faq', 'HomeController@faq');
Route::get('/ourteam', 'HomeController@ourteam');
Route::get('careers' , 'CareersController@index');
Route::post('careers/sendJobApp/{emailFrom}/{career}/{cv}' , 'CareersController@sendJobApp');




// ******** Courses *********

Route::get('courses/view/{slug}' , 'CoursesController@page');
// Route::get('courses/courseLecture/id/{id}' , 'CoursesController@lecture');
Route::get('courses/category/{slug?}' , 'CoursesController@category');
Route::get('bundles/category/{slug?}' , 'CoursesController@bundleCategory');
Route::get('masters/category/{slug?}' , 'CoursesController@mastersCategory');
Route::get('diplomas/category/{slug?}' , 'CoursesController@diplomasCategory');


// ******** Talks *********

Route::get('talks/view/{slug}' , 'TalksController@page');
Route::get('talks/category' , 'TalksController@category');

// ******** Events *********

Route::get('events/view/{id}' , 'EventsController@page');
Route::get('events/confirmation/{id}', 'EventsController@confirm');
Route::get('events/category/{slug?}' , 'EventsController@category');

// ******** Instructors *********
Route::get('instructors/view/{slug}' , 'HomeController@instructor');
Route::get('instructors/courses/{slug}' , 'HomeController@instructor');

Route::get('instructors/All' , 'HomeController@AllInstructors');

// ******** Partners *********

Route::get('partners/all' , 'HomeController@AllPartners');
Route::get('partners/view/{slug}' , 'HomeController@partner');



// ******** Partnership *********
Route::get('partnership/index' , 'HomeController@landing');
Route::get('partnership' , 'HomeController@landing');
Route::get('partnership/thankyou' , 'HomeController@thankyou');

#### Business control
Route::get('business/index' , 'HomeController@business');
Route::get('business' , 'HomeController@business');

Route::get('business/businessCourses' , 'HomeController@businessCourses');
// ******** Social *********
Route::get('social/redirect/{service}' , 'SocialController@redirect');
Route::get('social/callback/{service}' , 'SocialController@callback');

// ******** verifyUser *********
Route::get('user/verify/{token}/{redirectUrl}' , 'UserController@verifyUser');  


// Route::any('site/acceptConfirmationCallback2' , 'HomeController@actionAcceptConfirmationCallback2');  
// Route::any('site/FawryConfirmationCallback' , 'HomeController@actionFawryConfirmationCallback'); 

Auth::routes();

Route::get('partnership/register-individual' , 'PartnershipController@register_individual');
Route::post('partnership/register-individual' , 'Auth\RegisterController@register_individual');
Route::get('partnership/register-institution' , 'PartnershipController@register_institution');
Route::post('partnership/register-institution' , 'Auth\RegisterController@register_institution');

//admin login
Route::get('lazyadmin/login' , 'Auth\LoginController@lazyadmin_login_view');
Route::post('lazyadmin/login' , 'Auth\LoginController@lazyadmin_login');



Route::post('businessLogin' , 'Auth\LoginController@businessLogin');

Route::any('verifycertificate', 'HomeController@verifyCertificate');

Route::post('businessinputfieldsresponses', 'BusinessdataController@storeBusinessinputfieldsresponses');

Route::get('directpay', 'HomeController@directPay');
Route::get('directpay/{id}', 'HomeController@directPay2');

Route::get('allcourses/category/{slug?}', 'CoursesController@allCourses');


Route::get('checkoutApi', 'HomeController@checkoutApi');
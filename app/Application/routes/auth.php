<?php
Route::get('/courses/toggleFavourite/id/{id}', 'CoursesController@ToggleFavourite');
Route::get('/courses/toggleFavouriteAjax/id/{id}', 'CoursesController@ToggleFavouriteAjax');
Route::get('/courses/addToCart/id/{id?}', 'CoursesController@addToCart');
Route::get('/events/addEventToCart/{id}', 'EventsController@addEventToCart');
Route::get('/courses/addToCartAjax/id/{id}', 'CoursesController@addToCartAjax');
Route::get('/courses/removeFromCartAjax/id/{id}', 'CoursesController@removeFromCartAjax');
Route::get('/courses/enrollNow/id/{id}', 'CoursesController@enrollNow');
Route::get('/events/enrollEventNow/{id}', 'EventsController@enrollEventNow');
Route::any('/cart', 'HomeController@cart');
Route::get('/site/cartPayments', 'HomeController@cartPayments');
Route::get('/site/cartFinish', 'HomeController@cartFinish');
Route::get('/site/cartFinishVodafone', 'HomeController@cartFinishVodafone');
Route::get('/site/cartFinishKiosk/{type}', 'HomeController@cartFinishKiosk');
Route::any('/site/cartFinishMobileWallet', 'HomeController@cartFinishMobileWallet');
Route::get('/site/cartFinishFawry', 'HomeController@cartFinishFawry');
Route::post('/site/insertCoupon', 'HomeController@insertCoupon');
Route::get('/removePromo', 'HomeController@removePromo');
Route::get('/courses/removeFromCart/id/{id}', 'CoursesController@removeFromCart');
Route::get('/courses/clearCart', 'CoursesController@clearCart');
Route::get('/payments/acceptConfirmation2', 'PaymentsController@acceptConfirmation2');
Route::get('/payments/paypalconfirmation/{id?}', 'PaymentsController@paypalconfirmation');


Route::get('/addcerttocart', 'CoursesController@addCertsToCart');

//Direct Buy
Route::get('/site/cartFinishDirect', 'HomeController@cartFinishDirect');
Route::get('/site/cartFinishFawryDirect', 'HomeController@cartFinishFawryDirect');
Route::get('/site/cartFinishKioskDirect/{type}', 'HomeController@cartFinishKioskDirect');
Route::get('/site/cartFinishVodafoneDirect', 'HomeController@cartFinishVodafoneDirect');
Route::any('/site/cartFinishMobileWalletDirect', 'HomeController@cartFinishMobileWalletDirect');
Route::get('/site/insertCouponAjax', 'HomeController@insertCouponAjax');
Route::get('/site/payments', 'HomeController@payments');
Route::get('/site/cartFinishPaypal/{id?}', 'HomeController@paypal');

Route::get('/removePromoAjax', 'HomeController@removePromoAjax');

Route::post('lecturequestionsanswers/item' , 'LecturequestionsanswersController@store');
Route::get('lecturequestionsanswers/item/{id?}' , 'LecturequestionsanswersController@show');
Route::any('lecturequestionsanswersajax/item' , 'LecturequestionsanswersController@storeAjax');



Route::get('lecturequestions/item/{id?}' , 'LecturequestionsController@show');
Route::post('lecturequestions/item' , 'LecturequestionsController@store');
Route::any('lecturequestionsajax/item' , 'LecturequestionsController@storeAjax');

Route::get('/site/hasWallet/{id}', 'HomeController@actionHasWallet');

// Account
Route::get('account/edit', 'AccountController@edit');
Route::post('account/update/{id}', 'AccountController@update');
Route::post('account/delete/{id}', 'AccountController@delete');
Route::get('account/analysis', 'AccountController@analysis');
Route::get('account/myCourses', 'AccountController@myCourses');
Route::get('account/myFavourites', 'AccountController@myFavourites');
Route::get('account/myCertificates', 'AccountController@myCertificates');
Route::get('account/clearAllFavourites', 'AccountController@clearAllFavourites');
Route::get('account/complete', 'AccountController@complete');
Route::any('account/otp', 'AccountController@otp');
Route::get('account/sendOtp', 'AccountController@sendOtp');

//Courses
Route::any('courses/startExam/{slug}' , 'CoursesController@startExam');
Route::any('courses/examResults/{slug}' , 'CoursesController@examResults');
Route::any('courses/certificatesContainer/id/{id}', 'CoursesController@certificatesContainer');
Route::get('courses/courseLecture/id/{id}' , 'CoursesController@lecture');


// Quiz
Route::any('quiz/answers/{id}', 'QuizstudentsstatusController@answers');

Route::post('talksreviews/item' , 'TalksreviewsController@store');
Route::post('eventsreviews/item' , 'EventsreviewsController@store');

Route::post('masterrequest/item' , 'MasterrequestController@store');
// Route::get('masterrequest/item/{id?}' , 'MasterrequestController@show');
Route::get('masterrequest/{id}/view' , 'MasterrequestController@getById');
Route::post('masterrequest/item/{id}' , 'MasterrequestController@update');



Route::get('talks/like/{talkID}/{status}', 'TalksController@like');
Route::get('talks/likeAjax/{talkID}/{status}', 'TalksController@likeAjax');



Route::get('test/testNotifi', 'HomeController@testNotifi');


Route::get('/site/ajaxPayVisa/{orderID?}', 'HomeController@ajaxPayVisa');

Route::get('/site/enrollWebinar/{id}', 'CoursesController@enrollWebinar');
Route::post('savewebinarcertificate/{id}', 'CoursesController@saveWebinarCertificate');
<?php

#### page control
Route::get('page/item/{id?}', 'PageController@show');
Route::post('page/item', 'PageController@store');
Route::post('page/item/{id}', 'PageController@update');
Route::get('page/{id}/delete', 'PageController@destroy');
#### page comment
Route::post('page/add/comment/{id}', 'PageCommentController@addComment');
Route::post('page/update/comment/{id}', 'PageCommentController@updateComment');
Route::get('page/delete/comment/{id}', 'PageCommentController@deleteComment');


#### categorie control
Route::get('categorie', 'CategorieController@index');
Route::get('categorie/item/{id?}', 'CategorieController@show');
Route::post('categorie/item', 'CategorieController@store');
Route::post('categorie/item/{id}', 'CategorieController@update');
Route::get('categorie/{id}/delete', 'CategorieController@destroy');
Route::get('categorie/{id}/view', 'CategorieController@getById');


#### partnership control
Route::get('partnership/addCourse/{id?}' , 'PartnershipController@addCourse');
Route::post('partnership/saveCourse' , 'PartnershipController@saveCourse');
Route::post('partnership/saveCourse/{id}' , 'PartnershipController@updateCourse');
Route::get('partnership/addLectures/{course_id}' , 'PartnershipController@addLectures');
Route::post('partnership/saveLectures/{course_id}' , 'PartnershipController@saveLectures');
Route::post('partnership/saveLecturesSections/{course_id}' , 'PartnershipController@saveLecturesSections');
Route::post('partnership/item/{id}' , 'PartnershipController@update');
Route::get('partnership/{id}/delete' , 'PartnershipController@destroyLecture');
Route::get('partnership/addResources/{course_id}' , 'PartnershipController@addResources');
Route::post('partnership/saveResources/{course_id}' , 'PartnershipController@saveResources');
Route::get('partnership/addExams/{course_id}' , 'PartnershipController@addExams');
Route::post('partnership/saveExams/{course_id}/{id?}' , 'PartnershipController@saveExams');
Route::post('partnership/saveQuestion/{course_id}' , 'PartnershipController@saveQuestion');
Route::post('partnership/saveAnswer/{course_id}' , 'PartnershipController@saveAnswer');

Route::get('partnership/myCourses' , 'PartnershipController@myCourses');

#### Business control
Route::get('business/home' , 'BusinessdataController@home');
Route::any('business/settings' , 'BusinessdataController@settings');
Route::get('business/users' , 'BusinessdataController@users');
Route::get('business/groups' , 'BusinessdataController@groups');
Route::get('business/groups/{id}' , 'BusinessdataController@groups');
Route::get('business/users-information' , 'BusinessdataController@usersInformation');
Route::get('business/invite-users' , 'BusinessdataController@inviteUsers');
Route::get('business/enrollments' , 'BusinessdataController@enrollments');
Route::get('business/user-adoption-funnel' , 'BusinessdataController@userAdoptionFunnel');
Route::get('business/courses-insight' , 'BusinessdataController@coursesInsight');
Route::get('business/users-insight' , 'BusinessdataController@usersInsight');
Route::get('business/user-activity' , 'BusinessdataController@userActivity');
Route::get('business/user-activity/{id}' , 'BusinessdataController@userActivityUser');

Route::post('business/addDomian' , 'BusinessdataController@addDomian');
Route::post('business/addGroup' , 'BusinessdataController@addGroup');
Route::get('business/editgroup/{id}' , 'BusinessdataController@editGroup');
Route::post('business/updateGroup/{id}' , 'BusinessdataController@updateGroup');
Route::get('businessdata/{id}/delete' , 'BusinessdataController@destroy');
Route::post('businessdata/{id}/update' , 'BusinessdataController@update');
Route::get('businessgroups/{id}/delete' , 'BusinessgroupsController@destroy');
Route::post('business/invite-bulk-users' , 'BusinessdataController@inviteBulkUsers');
Route::get('business/tickets' , 'BusinessdataController@tickets');

Route::get('business/tickets/replays/{ticket_id}' , 'BusinessdataController@replays');
Route::get('generateQrCode', 'BusinessdataController@generateQrCodeAjax');
Route::post('business/inputs', 'BusinessdataController@addInputFields');
Route::get('business/editinputfield/{id}', 'BusinessdataController@editInputFields');
Route::get('business/deleteinputfield/{id}', 'BusinessdataController@deleteInputFields');



#### Events control
Route::get('events/home' , 'EventsdataController@home');
Route::get('events/settings' , 'EventsdataController@settings');
Route::post('eventsdata/item/{id}' , 'EventsdataController@update');
Route::get('events/add-event/{id?}' , 'EventsdataController@addEvent');
Route::get('events/all' , 'EventsdataController@all');
Route::get('events/{id}/delete' , 'EventsController@destroy');
Route::get('events/add-ticket/{id?}' , 'EventsdataController@addTicket');
Route::post('eventstickets/item' , 'EventsticketsController@store');
Route::get('eventstickets/{id}/delete' , 'EventsticketsController@destroy');
Route::get('events/all-ticket' , 'EventsdataController@allTicket');
Route::get('events/enrollments' , 'EventsdataController@enrollments');
Route::get('events/revenue' , 'EventsdataController@revenue');

Route::post('events/item' , 'EventsController@store');
Route::post('events/item/{id}' , 'EventsController@update');


#### Institution control
Route::get('institution/home' , 'InstitutionController@home');











































































































































































































































































































































































































































#### page Rate
Route::post('page/add/rate/{id}' , 'PageRateController@addRate');


#### categories control
Route::get('categories' , 'CategoriesController@index');
Route::get('categories/item/{id?}' , 'CategoriesController@show');
Route::post('categories/item' , 'CategoriesController@store');
Route::post('categories/item/{id}' , 'CategoriesController@update');
Route::get('categories/{id}/delete' , 'CategoriesController@destroy');
Route::get('categories/{id}/view' , 'CategoriesController@getById');

#### courses control
Route::get('courses' , 'CoursesController@index');
Route::get('courses/item/{id?}' , 'CoursesController@show');
Route::post('courses/item' , 'CoursesController@store');
Route::post('courses/item/{id}' , 'CoursesController@update');
Route::get('courses/{id}/delete' , 'CoursesController@destroy');
Route::get('courses/{id}/view' , 'CoursesController@getById');

#### talks control
Route::get('talks' , 'TalksController@index');
Route::get('talks/item/{id?}' , 'TalksController@show');
Route::post('talks/item' , 'TalksController@store');
Route::post('talks/item/{id}' , 'TalksController@update');
Route::get('talks/{id}/delete' , 'TalksController@destroy');
Route::get('talks/{id}/view' , 'TalksController@getById');

#### partners control
Route::get('partners' , 'PartnersController@index');
Route::get('partners/item/{id?}' , 'PartnersController@show');
Route::post('partners/item' , 'PartnersController@store');
Route::post('partners/item/{id}' , 'PartnersController@update');
Route::get('partners/{id}/delete' , 'PartnersController@destroy');
Route::get('partners/{id}/view' , 'PartnersController@getById');

#### testimonials control
Route::get('testimonials' , 'TestimonialsController@index');
Route::get('testimonials/item/{id?}' , 'TestimonialsController@show');
Route::post('testimonials/item' , 'TestimonialsController@store');
Route::post('testimonials/item/{id}' , 'TestimonialsController@update');
Route::get('testimonials/{id}/delete' , 'TestimonialsController@destroy');
Route::get('testimonials/{id}/view' , 'TestimonialsController@getById');





#### coursewishlist control
Route::get('coursewishlist' , 'CoursewishlistController@index');
Route::get('coursewishlist/item/{id?}' , 'CoursewishlistController@show');
Route::post('coursewishlist/item' , 'CoursewishlistController@store');
Route::post('coursewishlist/item/{id}' , 'CoursewishlistController@update');
Route::get('coursewishlist/{id}/delete' , 'CoursewishlistController@destroy');
Route::get('coursewishlist/{id}/view' , 'CoursewishlistController@getById');

#### coursereviews control
Route::get('coursereviews' , 'CoursereviewsController@index');
Route::get('coursereviews/item/{id?}' , 'CoursereviewsController@show');
Route::post('coursereviews/item' , 'CoursereviewsController@store');
Route::post('coursereviews/item/{id}' , 'CoursereviewsController@update');
Route::get('coursereviews/{id}/delete' , 'CoursereviewsController@destroy');
Route::get('coursereviews/{id}/view' , 'CoursereviewsController@getById');

#### coursereviews control
Route::get('coursereviews' , 'CoursereviewsController@index');
Route::get('coursereviews/item/{id?}' , 'CoursereviewsController@show');
Route::post('coursereviews/item' , 'CoursereviewsController@store');
Route::post('coursereviews/item/{id}' , 'CoursereviewsController@update');
Route::get('coursereviews/{id}/delete' , 'CoursereviewsController@destroy');
Route::get('coursereviews/{id}/view' , 'CoursereviewsController@getById');

#### coursesections control
Route::get('coursesections' , 'CoursesectionsController@index');
Route::get('coursesections/item/{id?}' , 'CoursesectionsController@show');
Route::post('coursesections/item' , 'CoursesectionsController@store');
Route::post('coursesections/item/{id}' , 'CoursesectionsController@update');
Route::get('coursesections/{id}/delete' , 'CoursesectionsController@destroy');
Route::get('coursesections/{id}/view' , 'CoursesectionsController@getById');

#### courselectures control
Route::get('courselectures' , 'CourselecturesController@index');
Route::get('courselectures/item/{id?}' , 'CourselecturesController@show');
Route::post('courselectures/item' , 'CourselecturesController@store');
Route::post('courselectures/item/{id}' , 'CourselecturesController@update');
Route::get('courselectures/{id}/delete' , 'CourselecturesController@destroy');
Route::get('courselectures/{id}/view' , 'CourselecturesController@getById');

#### courseenrollment control
Route::get('courseenrollment' , 'CourseenrollmentController@index');
Route::get('courseenrollment/item/{id?}' , 'CourseenrollmentController@show');
Route::post('courseenrollment/item' , 'CourseenrollmentController@store');
Route::post('courseenrollment/item/{id}' , 'CourseenrollmentController@update');
Route::get('courseenrollment/{id}/delete' , 'CourseenrollmentController@destroy');
Route::get('courseenrollment/{id}/view' , 'CourseenrollmentController@getById');

#### courseresources control
Route::get('courseresources' , 'CourseresourcesController@index');
Route::get('courseresources/item/{id?}' , 'CourseresourcesController@show');
Route::post('courseresources/item' , 'CourseresourcesController@store');
Route::post('courseresources/item/{id}' , 'CourseresourcesController@update');
Route::get('courseresources/{id}/delete' , 'CourseresourcesController@destroy');
Route::get('courseresources/{id}/view' , 'CourseresourcesController@getById');

#### courserelated control
Route::get('courserelated' , 'CourserelatedController@index');
Route::get('courserelated/item/{id?}' , 'CourserelatedController@show');
Route::post('courserelated/item' , 'CourserelatedController@store');
Route::post('courserelated/item/{id}' , 'CourserelatedController@update');
Route::get('courserelated/{id}/delete' , 'CourserelatedController@destroy');
Route::get('courserelated/{id}/view' , 'CourserelatedController@getById');

#### lecturequestions control
// Route::get('lecturequestions' , 'LecturequestionsController@index');
// Route::get('lecturequestions/item/{id?}' , 'LecturequestionsController@show');
// Route::post('lecturequestions/item' , 'LecturequestionsController@store');
// Route::post('lecturequestions/item/{id}' , 'LecturequestionsController@update');
// Route::get('lecturequestions/{id}/delete' , 'LecturequestionsController@destroy');
// Route::get('lecturequestions/{id}/view' , 'LecturequestionsController@getById');

#### lecturequestionsanswers control
// Route::get('lecturequestionsanswers' , 'LecturequestionsanswersController@index');
// // Route::get('lecturequestionsanswers/item/{id?}' , 'LecturequestionsanswersController@show');
// // Route::post('lecturequestionsanswers/item' , 'LecturequestionsanswersController@store');
// // Route::post('lecturequestionsanswers/item/{id}' , 'LecturequestionsanswersController@update');
// Route::get('lecturequestionsanswers/{id}/delete' , 'LecturequestionsanswersController@destroy');
// Route::get('lecturequestionsanswers/{id}/view' , 'LecturequestionsanswersController@getById');

#### talksreviews control
Route::get('talksreviews' , 'TalksreviewsController@index');
Route::get('talksreviews/item/{id?}' , 'TalksreviewsController@show');

Route::post('talksreviews/item/{id}' , 'TalksreviewsController@update');
Route::get('talksreviews/{id}/delete' , 'TalksreviewsController@destroy');
Route::get('talksreviews/{id}/view' , 'TalksreviewsController@getById');

#### talksrelated control
Route::get('talksrelated' , 'TalksrelatedController@index');
Route::get('talksrelated/item/{id?}' , 'TalksrelatedController@show');
Route::post('talksrelated/item' , 'TalksrelatedController@store');
Route::post('talksrelated/item/{id}' , 'TalksrelatedController@update');
Route::get('talksrelated/{id}/delete' , 'TalksrelatedController@destroy');
Route::get('talksrelated/{id}/view' , 'TalksrelatedController@getById');

#### orders control
Route::get('orders' , 'OrdersController@index');
Route::get('orders/item/{id?}' , 'OrdersController@show');
Route::post('orders/item' , 'OrdersController@store');
Route::post('orders/item/{id}' , 'OrdersController@update');
Route::get('orders/{id}/delete' , 'OrdersController@destroy');
Route::get('orders/{id}/view' , 'OrdersController@getById');

#### ordersposition control
Route::get('ordersposition' , 'OrderspositionController@index');
Route::get('ordersposition/item/{id?}' , 'OrderspositionController@show');
Route::post('ordersposition/item' , 'OrderspositionController@store');
Route::post('ordersposition/item/{id}' , 'OrderspositionController@update');
Route::get('ordersposition/{id}/delete' , 'OrderspositionController@destroy');
Route::get('ordersposition/{id}/view' , 'OrderspositionController@getById');

#### promotions control
Route::get('promotions' , 'PromotionsController@index');
Route::get('promotions/item/{id?}' , 'PromotionsController@show');
Route::post('promotions/item' , 'PromotionsController@store');
Route::post('promotions/item/{id}' , 'PromotionsController@update');
Route::get('promotions/{id}/delete' , 'PromotionsController@destroy');
Route::get('promotions/{id}/view' , 'PromotionsController@getById');

#### promotionusers control
Route::get('promotionusers' , 'PromotionusersController@index');
Route::get('promotionusers/item/{id?}' , 'PromotionusersController@show');
Route::post('promotionusers/item' , 'PromotionusersController@store');
Route::post('promotionusers/item/{id}' , 'PromotionusersController@update');
Route::get('promotionusers/{id}/delete' , 'PromotionusersController@destroy');
Route::get('promotionusers/{id}/view' , 'PromotionusersController@getById');

#### promotioncourses control
Route::get('promotioncourses' , 'PromotioncoursesController@index');
Route::get('promotioncourses/item/{id?}' , 'PromotioncoursesController@show');
Route::post('promotioncourses/item' , 'PromotioncoursesController@store');
Route::post('promotioncourses/item/{id}' , 'PromotioncoursesController@update');
Route::get('promotioncourses/{id}/delete' , 'PromotioncoursesController@destroy');
Route::get('promotioncourses/{id}/view' , 'PromotioncoursesController@getById');

#### promotionactive control
Route::get('promotionactive' , 'PromotionactiveController@index');
Route::get('promotionactive/item/{id?}' , 'PromotionactiveController@show');
Route::post('promotionactive/item' , 'PromotionactiveController@store');
Route::post('promotionactive/item/{id}' , 'PromotionactiveController@update');
Route::get('promotionactive/{id}/delete' , 'PromotionactiveController@destroy');
Route::get('promotionactive/{id}/view' , 'PromotionactiveController@getById');

#### courseincludes control
Route::get('courseincludes' , 'CourseincludesController@index');
Route::get('courseincludes/item/{id?}' , 'CourseincludesController@show');
Route::post('courseincludes/item' , 'CourseincludesController@store');
Route::post('courseincludes/item/{id}' , 'CourseincludesController@update');
Route::get('courseincludes/{id}/delete' , 'CourseincludesController@destroy');
Route::get('courseincludes/{id}/view' , 'CourseincludesController@getById');

#### payments control
Route::get('payments' , 'PaymentsController@index');
Route::get('payments/item/{id?}' , 'PaymentsController@show');
Route::post('payments/item' , 'PaymentsController@store');
Route::post('payments/item/{id}' , 'PaymentsController@update');
Route::get('payments/{id}/delete' , 'PaymentsController@destroy');
Route::get('payments/{id}/view' , 'PaymentsController@getById');

#### transactions control
Route::get('transactions' , 'TransactionsController@index');
Route::get('transactions/item/{id?}' , 'TransactionsController@show');
Route::post('transactions/item' , 'TransactionsController@store');
Route::post('transactions/item/{id}' , 'TransactionsController@update');
Route::get('transactions/{id}/delete' , 'TransactionsController@destroy');
Route::get('transactions/{id}/view' , 'TransactionsController@getById');

#### searchkeys control
Route::get('searchkeys' , 'SearchkeysController@index');
Route::get('searchkeys/item/{id?}' , 'SearchkeysController@show');
Route::post('searchkeys/item' , 'SearchkeysController@store');
Route::post('searchkeys/item/{id}' , 'SearchkeysController@update');
Route::get('searchkeys/{id}/delete' , 'SearchkeysController@destroy');
Route::get('searchkeys/{id}/view' , 'SearchkeysController@getById');

#### quiz control
Route::get('quiz' , 'QuizController@index');
Route::get('quiz/item/{id?}' , 'QuizController@show');
Route::post('quiz/item' , 'QuizController@store');
Route::post('quiz/item/{id}' , 'QuizController@update');
Route::get('quiz/{id}/delete' , 'QuizController@destroy');
Route::get('quiz/{id}/view' , 'QuizController@getById');

#### quizquestions control
Route::get('quizquestions' , 'QuizquestionsController@index');
Route::get('quizquestions/item/{id?}' , 'QuizquestionsController@show');
Route::post('quizquestions/item' , 'QuizquestionsController@store');
Route::post('quizquestions/item/{id}' , 'QuizquestionsController@update');
Route::get('quizquestions/{id}/delete' , 'QuizquestionsController@destroy');
Route::get('quizquestions/{id}/view' , 'QuizquestionsController@getById');

#### quizquestionschoice control
Route::get('quizquestionschoice' , 'QuizquestionschoiceController@index');
Route::get('quizquestionschoice/item/{id?}' , 'QuizquestionschoiceController@show');
Route::post('quizquestionschoice/item' , 'QuizquestionschoiceController@store');
Route::post('quizquestionschoice/item/{id}' , 'QuizquestionschoiceController@update');
Route::get('quizquestionschoice/{id}/delete' , 'QuizquestionschoiceController@destroy');
Route::get('quizquestionschoice/{id}/view' , 'QuizquestionschoiceController@getById');

#### quizstudentsanswers control
Route::get('quizstudentsanswers' , 'QuizstudentsanswersController@index');
Route::get('quizstudentsanswers/item/{id?}' , 'QuizstudentsanswersController@show');
Route::post('quizstudentsanswers/item' , 'QuizstudentsanswersController@store');
Route::post('quizstudentsanswers/item/{id}' , 'QuizstudentsanswersController@update');
Route::get('quizstudentsanswers/{id}/delete' , 'QuizstudentsanswersController@destroy');
Route::get('quizstudentsanswers/{id}/view' , 'QuizstudentsanswersController@getById');

#### quizstudentsstatus control
Route::get('quizstudentsstatus' , 'QuizstudentsstatusController@index');
Route::get('quizstudentsstatus/item/{id?}' , 'QuizstudentsstatusController@show');
Route::post('quizstudentsstatus/item' , 'QuizstudentsstatusController@store');
Route::post('quizstudentsstatus/item/{id}' , 'QuizstudentsstatusController@update');
Route::get('quizstudentsstatus/{id}/delete' , 'QuizstudentsstatusController@destroy');
Route::get('quizstudentsstatus/{id}/view' , 'QuizstudentsstatusController@getById');

#### lectures3d control
Route::get('lectures3d' , 'Lectures3dController@index');
Route::get('lectures3d/item/{id?}' , 'Lectures3dController@show');
Route::post('lectures3d/item' , 'Lectures3dController@store');
Route::post('lectures3d/item/{id}' , 'Lectures3dController@update');
Route::get('lectures3d/{id}/delete' , 'Lectures3dController@destroy');
Route::get('lectures3d/{id}/view' , 'Lectures3dController@getById');

#### businessdata control
// Route::get('businessdata' , 'BusinessdataController@index');
// Route::get('businessdata/item/{id?}' , 'BusinessdataController@show');
// Route::post('businessdata/item' , 'BusinessdataController@store');
// Route::post('businessdata/item/{id}' , 'BusinessdataController@update');
// Route::get('businessdata/{id}/delete' , 'BusinessdataController@destroy');
// Route::get('businessdata/{id}/view' , 'BusinessdataController@getById');

#### businessdomains control
Route::get('businessdomains' , 'BusinessdomainsController@index');
Route::get('businessdomains/item/{id?}' , 'BusinessdomainsController@show');
Route::post('businessdomains/item' , 'BusinessdomainsController@store');
Route::post('businessdomains/item/{id}' , 'BusinessdomainsController@update');
Route::get('businessdomains/{id}/delete' , 'BusinessdomainsController@destroy');
Route::get('businessdomains/{id}/view' , 'BusinessdomainsController@getById');
Route::get('businessdomains/{id}/verify', 'BusinessdomainsController@verify');

#### businessgroups control
Route::get('businessgroups' , 'BusinessgroupsController@index');
Route::get('businessgroups/item/{id?}' , 'BusinessgroupsController@show');
Route::post('businessgroups/item' , 'BusinessgroupsController@store');
Route::post('businessgroups/item/{id}' , 'BusinessgroupsController@update');

Route::get('businessgroups/{id}/view' , 'BusinessgroupsController@getById');
Route::get('businessgroups/{id}/edit', 'BusinessgroupsController@update');

#### businessgroupsusers control
Route::get('businessgroupsusers' , 'BusinessgroupsusersController@index');
Route::get('businessgroupsusers/item/{id?}' , 'BusinessgroupsusersController@show');
Route::post('businessgroupsusers/item' , 'BusinessgroupsusersController@store');
Route::post('businessgroupsusers/item/{id}' , 'BusinessgroupsusersController@update');
Route::get('businessgroupsusers/{id}/delete' , 'BusinessgroupsusersController@destroy');
Route::get('businessgroupsusers/{id}/view' , 'BusinessgroupsusersController@getById');

#### events control
// Route::get('events' , 'EventsController@index');
// Route::get('events/item/{id?}' , 'EventsController@show');
// Route::post('events/item' , 'EventsController@store');
// Route::post('events/item/{id}' , 'EventsController@update');
// Route::get('events/{id}/delete' , 'EventsController@destroy');
// Route::get('events/{id}/view' , 'EventsController@getById');

#### eventsdata control
// Route::get('eventsdata' , 'EventsdataController@index');
// Route::get('eventsdata/item/{id?}' , 'EventsdataController@show');
// Route::post('eventsdata/item' , 'EventsdataController@store');
// Route::post('eventsdata/item/{id}' , 'EventsdataController@update');
// Route::get('eventsdata/{id}/delete' , 'EventsdataController@destroy');
// Route::get('eventsdata/{id}/view' , 'EventsdataController@getById');

#### eventstickets control
// Route::get('eventstickets' , 'EventsticketsController@index');
// Route::get('eventstickets/item/{id?}' , 'EventsticketsController@show');
// Route::post('eventstickets/item' , 'EventsticketsController@store');
// Route::post('eventstickets/item/{id}' , 'EventsticketsController@update');
// Route::get('eventstickets/{id}/delete' , 'EventsticketsController@destroy');
// Route::get('eventstickets/{id}/view' , 'EventsticketsController@getById');

#### partnership control
// Route::get('partnership' , 'PartnershipController@index');
// Route::get('partnership/item/{id?}' , 'PartnershipController@show');
// Route::post('partnership/item' , 'PartnershipController@store');
// Route::post('partnership/item/{id}' , 'PartnershipController@update');
// Route::get('partnership/{id}/delete' , 'PartnershipController@destroy');
// Route::get('partnership/{id}/view' , 'PartnershipController@getById');

#### eventsreviews control
Route::get('eventsreviews' , 'EventsreviewsController@index');
Route::get('eventsreviews/item/{id?}' , 'EventsreviewsController@show');

Route::post('eventsreviews/item/{id}' , 'EventsreviewsController@update');
Route::get('eventsreviews/{id}/delete' , 'EventsreviewsController@destroy');
Route::get('eventsreviews/{id}/view' , 'EventsreviewsController@getById');

#### institution control
Route::get('institution' , 'InstitutionController@index');
Route::get('institution/item/{id?}' , 'InstitutionController@show');
Route::post('institution/item' , 'InstitutionController@store');
Route::post('institution/item/{id}' , 'InstitutionController@update');
Route::get('institution/{id}/delete' , 'InstitutionController@destroy');
Route::get('institution/{id}/view' , 'InstitutionController@getById');

#### masterrequest control
Route::get('masterrequest' , 'MasterrequestController@index');

Route::get('masterrequest/{id}/delete' , 'MasterrequestController@destroy');




#### social control
Route::get('social' , 'SocialController@index');
Route::get('social/item/{id?}' , 'SocialController@show');
Route::post('social/item' , 'SocialController@store');
Route::post('social/item/{id}' , 'SocialController@update');
Route::get('social/{id}/delete' , 'SocialController@destroy');
Route::get('social/{id}/view' , 'SocialController@getById');

#### slider control
Route::get('slider' , 'SliderController@index');
Route::get('slider/item/{id?}' , 'SliderController@show');
Route::post('slider/item' , 'SliderController@store');
Route::post('slider/item/{id}' , 'SliderController@update');
Route::get('slider/{id}/delete' , 'SliderController@destroy');
Route::get('slider/{id}/view' , 'SliderController@getById');

#### talklikes control
Route::get('talklikes' , 'TalklikesController@index');
Route::get('talklikes/item/{id?}' , 'TalklikesController@show');
Route::post('talklikes/item' , 'TalklikesController@store');
Route::post('talklikes/item/{id}' , 'TalklikesController@update');
Route::get('talklikes/{id}/delete' , 'TalklikesController@destroy');
Route::get('talklikes/{id}/view' , 'TalklikesController@getById');



#### eventsenrollment control
Route::get('eventsenrollment' , 'EventsenrollmentController@index');
Route::get('eventsenrollment/item/{id?}' , 'EventsenrollmentController@show');
Route::post('eventsenrollment/item' , 'EventsenrollmentController@store');
Route::post('eventsenrollment/item/{id}' , 'EventsenrollmentController@update');
Route::get('eventsenrollment/{id}/delete' , 'EventsenrollmentController@destroy');
Route::get('eventsenrollment/{id}/view' , 'EventsenrollmentController@getById');

#### businesscourses control
Route::get('businesscourses' , 'BusinesscoursesController@index');
Route::get('businesscourses/item/{id?}' , 'BusinesscoursesController@show');
Route::post('businesscourses/item' , 'BusinesscoursesController@store');
Route::post('businesscourses/item/{id}' , 'BusinesscoursesController@update');
Route::get('businesscourses/{id}/delete' , 'BusinesscoursesController@destroy');
Route::get('businesscourses/{id}/view' , 'BusinesscoursesController@getById');



#### homesettings control
Route::get('homesettings' , 'HomesettingsController@index');
Route::get('homesettings/item/{id?}' , 'HomesettingsController@show');
Route::post('homesettings/item' , 'HomesettingsController@store');
Route::post('homesettings/item/{id}' , 'HomesettingsController@update');
Route::get('homesettings/{id}/delete' , 'HomesettingsController@destroy');
Route::get('homesettings/{id}/view' , 'HomesettingsController@getById');

#### tickets control
Route::get('tickets' , 'TicketsController@index');
Route::get('tickets/item/{id?}' , 'TicketsController@show');
Route::post('tickets/item' , 'TicketsController@store');
Route::post('tickets/item/{id}' , 'TicketsController@update');
Route::get('tickets/{id}/delete' , 'TicketsController@destroy');
Route::get('tickets/{id}/view' , 'TicketsController@getById');



#### ticketsreplay control
Route::get('ticketsreplay' , 'TicketsreplayController@index');
Route::get('ticketsreplay/item/{id?}' , 'TicketsreplayController@show');
Route::post('ticketsreplay/item' , 'TicketsreplayController@store');
Route::post('ticketsreplay/item/{id}' , 'TicketsreplayController@update');
Route::get('ticketsreplay/{id}/delete' , 'TicketsreplayController@destroy');
Route::get('ticketsreplay/{id}/view' , 'TicketsreplayController@getById');





#### faq control
// Route::get('faq' , 'FaqController@index');
// Route::get('faq/item/{id?}' , 'FaqController@show');
// Route::post('faq/item' , 'FaqController@store');
// Route::post('faq/item/{id}' , 'FaqController@update');
// Route::get('faq/{id}/delete' , 'FaqController@destroy');
// Route::get('faq/{id}/view' , 'FaqController@getById');

#### progress control
Route::get('progress' , 'ProgressController@index');
Route::get('progress/item/{id?}' , 'ProgressController@show');
Route::post('progress/item' , 'ProgressController@store');
Route::post('progress/item/{id}' , 'ProgressController@update');
Route::get('progress/{id}/delete' , 'ProgressController@destroy');
Route::get('progress/{id}/view' , 'ProgressController@getById');

#### careers control
// Route::get('careers' , 'CareersController@index');
// Route::get('careers/item/{id?}' , 'CareersController@show');
// Route::post('careers/item' , 'CareersController@store');
// Route::post('careers/item/{id}' , 'CareersController@update');
// Route::get('careers/{id}/delete' , 'CareersController@destroy');
// Route::get('careers/{id}/view' , 'CareersController@getById');

#### careersresponses control
Route::get('careersresponses' , 'CareersresponsesController@index');
Route::get('careersresponses/item/{id?}' , 'CareersresponsesController@show');
Route::post('careersresponses/item' , 'CareersresponsesController@store');
Route::post('careersresponses/item/{id}' , 'CareersresponsesController@update');
Route::get('careersresponses/{id}/delete' , 'CareersresponsesController@destroy');
Route::get('careersresponses/{id}/view' , 'CareersresponsesController@getById');

#### becomeinstructor control
Route::get('becomeinstructor' , 'BecomeinstructorController@index');
Route::get('becomeinstructor/item/{id?}' , 'BecomeinstructorController@show');
Route::post('becomeinstructor/item' , 'BecomeinstructorController@store');
Route::post('becomeinstructor/item/{id}' , 'BecomeinstructorController@update');
Route::get('becomeinstructor/{id}/delete' , 'BecomeinstructorController@destroy');
Route::get('becomeinstructor/{id}/view' , 'BecomeinstructorController@getById');
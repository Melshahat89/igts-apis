<?php
Route::get('/', 'HomeController@index');
Route::get('icons', 'HomeController@icons');
Route::get('docs', 'HomeController@apiDocs');
Route::get('file-manager', 'HomeController@fileManager');
Route::get('theme/open-file', 'Themes\ThemeController@openFile');
Route::get('theme/{theme}', 'Themes\ThemeController@adminPanel');
Route::post('theme/save-file', 'Themes\ThemeController@save');

### commands
Route::get('commands', 'CommandsController@index');
Route::post('command/exe', 'CommandsController@exe');
Route::get('laravel/commands', 'CommandsController@command');
Route::post('command/otherExe', 'CommandsController@otherExe');
Route::post('laravel/haveCommand', 'CommandsController@haveCommand');
Route::get('exportImport', 'CommandsController@exportEmportModels');
Route::post('export', 'CommandsController@export');
Route::post('import', 'CommandsController@import');


### relations
Route::get('relation', 'RelationController@index');
Route::post('relation/exe', 'RelationController@exe');
Route::get('getCols/{model}', 'RelationController@getCols');
Route::post('relation/rollback', 'RelationController@rollback');

#### user control
Route::get('user', 'UserController@index');
Route::get('user/item/{id?}', 'UserController@show');
Route::post('user/item', 'UserController@store');
Route::post('user/item/{id}', 'UserController@update');
Route::get('user/{id}/delete', 'UserController@destroy');
Route::get('user/{id}/view', 'UserController@getById');
Route::get('user/pluck', 'UserController@pluck');

#### Certificates control
Route::get('certificates', 'CertificatesController@index');
Route::get('certificates/item/{id?}', 'CertificatesController@show');
Route::post('certificates/item', 'CertificatesController@store');
Route::post('certificates/item/{id}', 'CertificatesController@update');
Route::get('certificates/{id}/delete', 'CertificatesController@destroy');
Route::get('certificates/{id}/view', 'CertificatesController@getById');
Route::get('certificates/pluck', 'CertificatesController@pluck');

### Payment Methods
Route::get('paymentmethods', 'PaymentmethodsController@index');
Route::get('paymentmethods/item/{id?}', 'PaymentmethodsController@show');
Route::post('paymentmethods/item', 'PaymentmethodsController@store');
Route::post('paymentmethods/item/{id}', 'PaymentmethodsController@update');
Route::get('paymentmethods/{id}/delete', 'PaymentmethodsController@destroy');
Route::get('paymentmethods/{id}/view', 'PaymentmethodsController@getById');
Route::get('paymentmethods/pluck', 'PaymentmethodsController@pluck');

#### translation
Route::get('translation', 'TranslationController@index');
Route::get('translation/readFile/{file}', 'TranslationController@readFile');
Route::post('translation/save', 'TranslationController@save');
Route::get('translation/getAllContent/{file}', 'TranslationController@getAllContent');
Route::post('translation/both/save', 'TranslationController@bothSave');

#### permissions
Route::get('custom-permissions', 'Development\CustomPermissionsController@index');
Route::get('custom-permissions/readFile/{file}', 'Development\CustomPermissionsController@readFile');
Route::post('custom-permissions/save', 'Development\CustomPermissionsController@save');
Route::get('getControllerByType/{type}', 'Development\PermissionController@getControllerByType');
Route::get('getMethodByController/{controller}/{type}', 'Development\PermissionController@getMethodByController');


#### group control
Route::get('group', 'GroupController@index');
Route::get('group/item/{id?}', 'GroupController@show');
Route::post('group/item', 'GroupController@store');
Route::post('group/item/{id}', 'GroupController@update');
Route::get('group/{id}/delete', 'GroupController@destroy');
Route::get('group/{id}/view', 'GroupController@getById');
Route::get('group/pluck', 'GroupController@pluck');

#### role control
Route::get('role', 'RoleController@index');
Route::get('role/item/{id?}', 'RoleController@show');
Route::post('role/item', 'RoleController@store');
Route::post('role/item/{id}', 'RoleController@update');
Route::get('role/{id}/delete', 'RoleController@destroy');
Route::get('role/{id}/view', 'RoleController@getById');
Route::get('role/pluck', 'RoleController@pluck');
#### permission control
Route::get('permission', 'Development\PermissionController@index');
Route::get('permission/item/{id?}', 'Development\PermissionController@show');
Route::post('permission/item', 'Development\PermissionController@store');
Route::post('permission/item/{id}', 'Development\PermissionController@update');
Route::get('permission/{id}/delete', 'Development\PermissionController@destroy');
Route::get('permission/{id}/view', 'Development\PermissionController@getById');
Route::get('permission/pluck', 'PermissionController@pluck');
#### home control
Route::get('home/{pages?}/{limit?}', 'HomeController@index');
#### setting control
Route::get('setting', 'SettingController@index');
Route::get('setting/item/{id?}', 'SettingController@show');
Route::post('setting/item', 'SettingController@store');
Route::post('setting/item/{id}', 'SettingController@update');
Route::get('setting/{id}/delete', 'SettingController@destroy');
Route::get('setting/{id}/view', 'SettingController@getById');
Route::get('setting/pluck', 'SettingController@pluck');
#### menu control
Route::get('menu', 'MenuController@index');
Route::get('menu/item/{id?}', 'MenuController@show');
Route::post('menu/item', 'MenuController@store');
Route::post('menu/item/{id}', 'MenuController@update');
Route::get('menu/{id}/delete', 'MenuController@destroy');
Route::get('menu/{id}/view', 'MenuController@getById');
Route::post('update/menuItem', 'MenuController@menuItem');
Route::post('addNewItemToMenu', 'MenuController@addNewItemToMenu');
Route::get('deleteMenuItem/{id}', 'MenuController@deleteMenuItem');
Route::get('getItemInfo/{id}', 'MenuController@getItemInfo');
Route::post('updateOneMenuItem', 'MenuController@updateOneMenuItem');
Route::get('menu/pluck', 'MenuController@pluck');
#### log control
Route::get('log', 'LogController@index');
Route::get('log/item/{id?}', 'LogController@show');
Route::post('log/item', 'LogController@store');
Route::post('log/item/{id}', 'LogController@update');
Route::get('log/{id}/delete', 'LogController@destroy');
Route::get('log/{id}/view', 'LogController@getById');
Route::get('log/pluck', 'LogController@pluck');
#### contact control
Route::get('contact', 'ContactController@index');
Route::get('contact/item/{id?}', 'ContactController@show');
Route::post('contact/item', 'ContactController@store');
Route::post('contact/item/{id}', 'ContactController@update');
Route::get('contact/{id}/delete', 'ContactController@destroy');
Route::get('contact/{id}/view', 'ContactController@getById');
Route::post('contact/replay/{id}', 'ContactController@replayEmail');
Route::get('contact/pluck', 'ContactController@pluck');

#### page control
Route::get('page', 'PageController@index');
Route::get('page/item/{id?}', 'PageController@show');
Route::post('page/item', 'PageController@store');
Route::post('page/item/{id}', 'PageController@update');
Route::get('page/{id}/delete', 'PageController@destroy');
Route::get('page/{id}/view', 'PageController@getById');
Route::get('page/pluck', 'PageController@pluck');
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
Route::get('categorie/pluck', 'CategorieController@pluck');



#### page Rate
Route::post('page/add/rate/{id}' , 'PageRateController@addRate');

#### categories control
Route::get('categories' , 'CategoriesController@index');
Route::get('categories/item/{id?}' , 'CategoriesController@show');
Route::post('categories/item' , 'CategoriesController@store');
Route::post('categories/item/{id}' , 'CategoriesController@update');
Route::get('categories/{id}/delete' , 'CategoriesController@destroy');
Route::get('categories/{id}/view' , 'CategoriesController@getById');
Route::get('categories/pluck', 'CategoriesController@pluck');
#### courses control
Route::get('courses' , 'CoursesController@index');
Route::get('courses/item/{id?}' , 'CoursesController@show');
Route::post('courses/item' , 'CoursesController@store');
Route::post('courses/item/{id}' , 'CoursesController@update');
Route::get('courses/{id}/delete' , 'CoursesController@destroy');
Route::get('courses/{id}/view' , 'CoursesController@getById');
Route::get('courses/pluck', 'CoursesController@pluck');
#### talks control
Route::get('talks' , 'TalksController@index');
Route::get('talks/item/{id?}' , 'TalksController@show');
Route::post('talks/item' , 'TalksController@store');
Route::post('talks/item/{id}' , 'TalksController@update');
Route::get('talks/{id}/delete' , 'TalksController@destroy');
Route::get('talks/{id}/view' , 'TalksController@getById');
Route::get('talks/pluck', 'TalksController@pluck');
#### partners control
Route::get('partners' , 'PartnersController@index');
Route::get('partners/item/{id?}' , 'PartnersController@show');
Route::post('partners/item' , 'PartnersController@store');
Route::post('partners/item/{id}' , 'PartnersController@update');
Route::get('partners/{id}/delete' , 'PartnersController@destroy');
Route::get('partners/{id}/view' , 'PartnersController@getById');
Route::get('partners/pluck', 'PartnersController@pluck');
#### testimonials control
Route::get('testimonials' , 'TestimonialsController@index');
Route::get('testimonials/item/{id?}' , 'TestimonialsController@show');
Route::post('testimonials/item' , 'TestimonialsController@store');
Route::post('testimonials/item/{id}' , 'TestimonialsController@update');
Route::get('testimonials/{id}/delete' , 'TestimonialsController@destroy');
Route::get('testimonials/{id}/view' , 'TestimonialsController@getById');
Route::get('testimonials/pluck', 'TestimonialsController@pluck');


#### coursewishlist control
Route::get('coursewishlist' , 'CoursewishlistController@index');
Route::get('coursewishlist/item/{id?}' , 'CoursewishlistController@show');
Route::post('coursewishlist/item' , 'CoursewishlistController@store');
Route::post('coursewishlist/item/{id}' , 'CoursewishlistController@update');
Route::get('coursewishlist/{id}/delete' , 'CoursewishlistController@destroy');
Route::get('coursewishlist/{id}/view' , 'CoursewishlistController@getById');
Route::get('coursewishlist/pluck', 'CoursewishlistController@pluck');
#### coursereviews control
Route::get('coursereviews' , 'CoursereviewsController@index');
Route::get('coursereviews/item/{id?}' , 'CoursereviewsController@show');
Route::post('coursereviews/item' , 'CoursereviewsController@store');
Route::post('coursereviews/item/{id}' , 'CoursereviewsController@update');
Route::get('coursereviews/{id}/delete' , 'CoursereviewsController@destroy');
Route::get('coursereviews/{id}/view' , 'CoursereviewsController@getById');
Route::get('coursereviews/pluck', 'CoursereviewsController@pluck');
#### coursereviews control
Route::get('coursereviews' , 'CoursereviewsController@index');
Route::get('coursereviews/item/{id?}' , 'CoursereviewsController@show');
Route::post('coursereviews/item' , 'CoursereviewsController@store');
Route::post('coursereviews/item/{id}' , 'CoursereviewsController@update');
Route::get('coursereviews/{id}/delete' , 'CoursereviewsController@destroy');
Route::get('coursereviews/{id}/view' , 'CoursereviewsController@getById');
Route::get('coursereviews/pluck', 'CoursereviewsController@pluck');
#### coursesections control
Route::get('coursesections' , 'CoursesectionsController@index');
Route::get('coursesections/item/{id?}' , 'CoursesectionsController@show');
Route::post('coursesections/item' , 'CoursesectionsController@store');
Route::post('coursesections/item/{id}' , 'CoursesectionsController@update');
Route::get('coursesections/{id}/delete' , 'CoursesectionsController@destroy');
Route::get('coursesections/{id}/view' , 'CoursesectionsController@getById');
Route::get('coursesections/pluck', 'CoursesectionsController@pluck');
#### courselectures control
Route::get('courselectures' , 'CourselecturesController@index');
Route::get('courselectures/item/{id?}' , 'CourselecturesController@show');
Route::post('courselectures/item' , 'CourselecturesController@store');
Route::post('courselectures/item/{id}' , 'CourselecturesController@update');
Route::get('courselectures/{id}/delete' , 'CourselecturesController@destroy');
Route::get('courselectures/{id}/view' , 'CourselecturesController@getById');
Route::get('courselectures/pluck', 'CourselecturesController@pluck');
#### courseenrollment control
Route::get('courseenrollment' , 'CourseenrollmentController@index');
Route::get('courseenrollment/item/{id?}' , 'CourseenrollmentController@show');
Route::post('courseenrollment/item' , 'CourseenrollmentController@store');
Route::post('courseenrollment/item/{id}' , 'CourseenrollmentController@update');
Route::get('courseenrollment/{id}/delete' , 'CourseenrollmentController@destroy');
Route::get('courseenrollment/{id}/view' , 'CourseenrollmentController@getById');
Route::get('courseenrollment/pluck', 'CourseenrollmentController@pluck');
#### courseresources control
Route::get('courseresources' , 'CourseresourcesController@index');
Route::get('courseresources/item/{id?}' , 'CourseresourcesController@show');
Route::post('courseresources/item' , 'CourseresourcesController@store');
Route::post('courseresources/item/{id}' , 'CourseresourcesController@update');
Route::get('courseresources/{id}/delete' , 'CourseresourcesController@destroy');
Route::get('courseresources/{id}/view' , 'CourseresourcesController@getById');
Route::get('courseresources/pluck', 'CourseresourcesController@pluck');
#### courserelated control
Route::get('courserelated' , 'CourserelatedController@index');
Route::get('courserelated/item/{id?}' , 'CourserelatedController@show');
Route::post('courserelated/item' , 'CourserelatedController@store');
Route::post('courserelated/item/{id}' , 'CourserelatedController@update');
Route::get('courserelated/{id}/delete' , 'CourserelatedController@destroy');
Route::get('courserelated/{id}/view' , 'CourserelatedController@getById');
Route::get('courserelated/pluck', 'CourserelatedController@pluck');
#### lecturequestions control
Route::get('lecturequestions' , 'LecturequestionsController@index');
Route::get('lecturequestions/item/{id?}' , 'LecturequestionsController@show');
Route::post('lecturequestions/item' , 'LecturequestionsController@store');
Route::post('lecturequestions/item/{id}' , 'LecturequestionsController@update');
Route::get('lecturequestions/{id}/delete' , 'LecturequestionsController@destroy');
Route::get('lecturequestions/{id}/view' , 'LecturequestionsController@getById');
Route::get('lecturequestions/pluck', 'LecturequestionsController@pluck');
#### lecturequestionsanswers control
Route::get('lecturequestionsanswers' , 'LecturequestionsanswersController@index');
Route::get('lecturequestionsanswers/item/{id?}' , 'LecturequestionsanswersController@show');
Route::post('lecturequestionsanswers/item' , 'LecturequestionsanswersController@store');
Route::post('lecturequestionsanswers/item/{id}' , 'LecturequestionsanswersController@update');
Route::get('lecturequestionsanswers/{id}/delete' , 'LecturequestionsanswersController@destroy');
Route::get('lecturequestionsanswers/{id}/view' , 'LecturequestionsanswersController@getById');
Route::get('lecturequestionsanswers/pluck', 'LecturequestionsanswersController@pluck');
#### talksreviews control
Route::get('talksreviews' , 'TalksreviewsController@index');
Route::get('talksreviews/item/{id?}' , 'TalksreviewsController@show');
Route::post('talksreviews/item' , 'TalksreviewsController@store');
Route::post('talksreviews/item/{id}' , 'TalksreviewsController@update');
Route::get('talksreviews/{id}/delete' , 'TalksreviewsController@destroy');
Route::get('talksreviews/{id}/view' , 'TalksreviewsController@getById');
Route::get('talksreviews/pluck', 'TalksreviewsController@pluck');
#### talksrelated control
Route::get('talksrelated' , 'TalksrelatedController@index');
Route::get('talksrelated/item/{id?}' , 'TalksrelatedController@show');
Route::post('talksrelated/item' , 'TalksrelatedController@store');
Route::post('talksrelated/item/{id}' , 'TalksrelatedController@update');
Route::get('talksrelated/{id}/delete' , 'TalksrelatedController@destroy');
Route::get('talksrelated/{id}/view' , 'TalksrelatedController@getById');
Route::get('talksrelated/pluck', 'TalksrelatedController@pluck');
#### orders control
Route::get('orders' , 'OrdersController@index');
Route::get('orders/item/{id?}' , 'OrdersController@show');
Route::post('orders/item' , 'OrdersController@store');
Route::post('orders/item/{id}' , 'OrdersController@update');
Route::get('orders/{id}/delete' , 'OrdersController@destroy');
Route::get('orders/{id}/view' , 'OrdersController@getById');
Route::get('orders/pluck', 'OrdersController@pluck');
Route::get('orders/enrollnow/{orderID}', 'OrdersController@enrollnow');
Route::get('orders/{id}/approve', 'OrdersController@approveOfflineOrder');
Route::get('orders/addCourseItem', 'OrdersController@addNewCourseItem');
Route::get('orders/addCertificateItem', 'OrdersController@addNewCertificateItem');
#### ordersposition control
Route::get('ordersposition' , 'OrderspositionController@index');
Route::get('ordersposition/item/{id?}' , 'OrderspositionController@show');
Route::post('ordersposition/item' , 'OrderspositionController@store');
Route::post('ordersposition/item/{id}' , 'OrderspositionController@update');
Route::get('ordersposition/{id}/delete' , 'OrderspositionController@destroy');
Route::get('ordersposition/{id}/view' , 'OrderspositionController@getById');
Route::get('ordersposition/pluck', 'OrderspositionController@pluck');
#### promotions control
Route::get('promotions' , 'PromotionsController@index');
Route::get('promotions/item/{id?}' , 'PromotionsController@show');
Route::post('promotions/item' , 'PromotionsController@store');
Route::post('promotions/item/{id}' , 'PromotionsController@update');
Route::get('promotions/{id}/delete' , 'PromotionsController@destroy');
Route::get('promotions/{id}/view' , 'PromotionsController@getById');
Route::get('promotions/pluck', 'PromotionsController@pluck');
#### promotionusers control
Route::get('promotionusers' , 'PromotionusersController@index');
Route::get('promotionusers/item/{id?}' , 'PromotionusersController@show');
Route::post('promotionusers/item' , 'PromotionusersController@store');
Route::post('promotionusers/item/{id}' , 'PromotionusersController@update');
Route::get('promotionusers/{id}/delete' , 'PromotionusersController@destroy');
Route::get('promotionusers/{id}/view' , 'PromotionusersController@getById');
Route::get('promotionusers/pluck', 'PromotionusersController@pluck');
#### promotioncourses control
Route::get('promotioncourses' , 'PromotioncoursesController@index');
Route::get('promotioncourses/item/{id?}' , 'PromotioncoursesController@show');
Route::post('promotioncourses/item' , 'PromotioncoursesController@store');
Route::post('promotioncourses/item/{id}' , 'PromotioncoursesController@update');
Route::get('promotioncourses/{id}/delete' , 'PromotioncoursesController@destroy');
Route::get('promotioncourses/{id}/view' , 'PromotioncoursesController@getById');
Route::get('promotioncourses/pluck', 'PromotioncoursesController@pluck');
#### promotionactive control
Route::get('promotionactive' , 'PromotionactiveController@index');
Route::get('promotionactive/item/{id?}' , 'PromotionactiveController@show');
Route::post('promotionactive/item' , 'PromotionactiveController@store');
Route::post('promotionactive/item/{id}' , 'PromotionactiveController@update');
Route::get('promotionactive/{id}/delete' , 'PromotionactiveController@destroy');
Route::get('promotionactive/{id}/view' , 'PromotionactiveController@getById');
Route::get('promotionactive/pluck', 'PromotionactiveController@pluck');
#### courseincludes control
Route::get('courseincludes' , 'CourseincludesController@index');
Route::get('courseincludes/item/{id?}' , 'CourseincludesController@show');
Route::post('courseincludes/item' , 'CourseincludesController@store');
Route::post('courseincludes/item/{id}' , 'CourseincludesController@update');
Route::get('courseincludes/{id}/delete' , 'CourseincludesController@destroy');
Route::get('courseincludes/{id}/view' , 'CourseincludesController@getById');
Route::get('courseincludes/pluck', 'CourseincludesController@pluck');
#### payments control
Route::get('payments' , 'PaymentsController@index');
Route::get('payments/item/{id?}' , 'PaymentsController@show');
Route::post('payments/item' , 'PaymentsController@store');
Route::post('payments/item/{id}' , 'PaymentsController@update');
Route::get('payments/{id}/delete' , 'PaymentsController@destroy');
Route::get('payments/{id}/view' , 'PaymentsController@getById');
Route::get('payments/pluck', 'PaymentsController@pluck');
#### transactions control
Route::get('transactions' , 'TransactionsController@index');
Route::get('transactions/item/{id?}' , 'TransactionsController@show');
Route::post('transactions/item' , 'TransactionsController@store');
Route::post('transactions/item/{id}' , 'TransactionsController@update');
Route::get('transactions/{id}/delete' , 'TransactionsController@destroy');
Route::get('transactions/{id}/view' , 'TransactionsController@getById');
Route::get('transactions/pluck', 'TransactionsController@pluck');
#### searchkeys control
Route::get('searchkeys' , 'SearchkeysController@index');
Route::get('searchkeys/item/{id?}' , 'SearchkeysController@show');
Route::post('searchkeys/item' , 'SearchkeysController@store');
Route::post('searchkeys/item/{id}' , 'SearchkeysController@update');
Route::get('searchkeys/{id}/delete' , 'SearchkeysController@destroy');
Route::get('searchkeys/{id}/view' , 'SearchkeysController@getById');
Route::get('searchkeys/pluck', 'SearchkeysController@pluck');
#### quiz control
Route::get('quiz' , 'QuizController@index');
Route::get('quiz/item/{id?}' , 'QuizController@show');
Route::post('quiz/item' , 'QuizController@store');
Route::post('quiz/item/{id}' , 'QuizController@update');
Route::get('quiz/{id}/delete' , 'QuizController@destroy');
Route::get('quiz/{id}/view' , 'QuizController@getById');
Route::get('quiz/pluck', 'QuizController@pluck');
#### quizquestions control
Route::get('quizquestions' , 'QuizquestionsController@index');
Route::get('quizquestions/item/{id?}' , 'QuizquestionsController@show');
Route::post('quizquestions/item' , 'QuizquestionsController@store');
Route::post('quizquestions/item/{id}' , 'QuizquestionsController@update');
Route::get('quizquestions/{id}/delete' , 'QuizquestionsController@destroy');
Route::get('quizquestions/{id}/view' , 'QuizquestionsController@getById');
Route::get('quizquestions/pluck', 'QuizquestionsController@pluck');
#### quizquestionschoice control
Route::get('quizquestionschoice' , 'QuizquestionschoiceController@index');
Route::get('quizquestionschoice/item/{id?}' , 'QuizquestionschoiceController@show');
Route::post('quizquestionschoice/item' , 'QuizquestionschoiceController@store');
Route::post('quizquestionschoice/item/{id}' , 'QuizquestionschoiceController@update');
Route::get('quizquestionschoice/{id}/delete' , 'QuizquestionschoiceController@destroy');
Route::get('quizquestionschoice/{id}/view' , 'QuizquestionschoiceController@getById');
Route::get('quizquestionschoice/pluck', 'QuizquestionschoiceController@pluck');
#### quizstudentsanswers control
Route::get('quizstudentsanswers' , 'QuizstudentsanswersController@index');
Route::get('quizstudentsanswers/item/{id?}' , 'QuizstudentsanswersController@show');
Route::post('quizstudentsanswers/item' , 'QuizstudentsanswersController@store');
Route::post('quizstudentsanswers/item/{id}' , 'QuizstudentsanswersController@update');
Route::get('quizstudentsanswers/{id}/delete' , 'QuizstudentsanswersController@destroy');
Route::get('quizstudentsanswers/{id}/view' , 'QuizstudentsanswersController@getById');
Route::get('quizstudentsanswers/pluck', 'QuizstudentsanswersController@pluck');
#### quizstudentsstatus control
Route::get('quizstudentsstatus' , 'QuizstudentsstatusController@index');
Route::get('quizstudentsstatus/item/{id?}' , 'QuizstudentsstatusController@show');
Route::post('quizstudentsstatus/item' , 'QuizstudentsstatusController@store');
Route::post('quizstudentsstatus/item/{id}' , 'QuizstudentsstatusController@update');
Route::get('quizstudentsstatus/{id}/delete' , 'QuizstudentsstatusController@destroy');
Route::get('quizstudentsstatus/{id}/view' , 'QuizstudentsstatusController@getById');
Route::get('quizstudentsstatus/pluck', 'QuizstudentsstatusController@pluck');
Route::get('quizstudentsstatus/{id}/reexam', 'QuizstudentsstatusController@reExam');

#### lectures3d control
Route::get('lectures3d' , 'Lectures3dController@index');
Route::get('lectures3d/item/{id?}' , 'Lectures3dController@show');
Route::post('lectures3d/item' , 'Lectures3dController@store');
Route::post('lectures3d/item/{id}' , 'Lectures3dController@update');
Route::get('lectures3d/{id}/delete' , 'Lectures3dController@destroy');
Route::get('lectures3d/{id}/view' , 'Lectures3dController@getById');
Route::get('lectures3d/pluck', 'Lectures3dController@pluck');
#### businessdata control
Route::get('businessdata' , 'BusinessdataController@index');
Route::get('businessdata/item/{id?}' , 'BusinessdataController@show');
Route::post('businessdata/item' , 'BusinessdataController@store');
Route::post('businessdata/item/{id}' , 'BusinessdataController@update');
Route::get('businessdata/{id}/delete' , 'BusinessdataController@destroy');
Route::get('businessdata/{id}/view' , 'BusinessdataController@getById');
Route::get('businessdata/pluck', 'BusinessdataController@pluck');
#### businessdomains control
Route::get('businessdomains' , 'BusinessdomainsController@index');
Route::get('businessdomains/item/{id?}' , 'BusinessdomainsController@show');
Route::post('businessdomains/item' , 'BusinessdomainsController@store');
Route::post('businessdomains/item/{id}' , 'BusinessdomainsController@update');
Route::get('businessdomains/{id}/delete' , 'BusinessdomainsController@destroy');
Route::get('businessdomains/{id}/view' , 'BusinessdomainsController@getById');
Route::get('businessdomains/pluck', 'BusinessdomainsController@pluck');
#### businessgroups control
Route::get('businessgroups' , 'BusinessgroupsController@index');
Route::get('businessgroups/item/{id?}' , 'BusinessgroupsController@show');
Route::post('businessgroups/item' , 'BusinessgroupsController@store');
Route::post('businessgroups/item/{id}' , 'BusinessgroupsController@update');
Route::get('businessgroups/{id}/delete' , 'BusinessgroupsController@destroy');
Route::get('businessgroups/{id}/view' , 'BusinessgroupsController@getById');
Route::get('businessgroups/pluck', 'BusinessgroupsController@pluck');
#### businessgroupsusers control
Route::get('businessgroupsusers' , 'BusinessgroupsusersController@index');
Route::get('businessgroupsusers/item/{id?}' , 'BusinessgroupsusersController@show');
Route::post('businessgroupsusers/item' , 'BusinessgroupsusersController@store');
Route::post('businessgroupsusers/item/{id}' , 'BusinessgroupsusersController@update');
Route::get('businessgroupsusers/{id}/delete' , 'BusinessgroupsusersController@destroy');
Route::get('businessgroupsusers/{id}/view' , 'BusinessgroupsusersController@getById');
Route::get('businessgroupsusers/pluck', 'BusinessgroupsusersController@pluck');
#### events control
Route::get('events' , 'EventsController@index');
Route::get('events/item/{id?}' , 'EventsController@show');
Route::post('events/item' , 'EventsController@store');
Route::post('events/item/{id}' , 'EventsController@update');
Route::get('events/{id}/delete' , 'EventsController@destroy');
Route::get('events/{id}/view' , 'EventsController@getById');
Route::get('events/pluck', 'EventsController@pluck');
#### eventsdata control
Route::get('eventsdata' , 'EventsdataController@index');
Route::get('eventsdata/item/{id?}' , 'EventsdataController@show');
Route::post('eventsdata/item' , 'EventsdataController@store');
Route::post('eventsdata/item/{id}' , 'EventsdataController@update');
Route::get('eventsdata/{id}/delete' , 'EventsdataController@destroy');
Route::get('eventsdata/{id}/view' , 'EventsdataController@getById');
Route::get('eventsdata/pluck', 'EventsdataController@pluck');
#### eventstickets control
Route::get('eventstickets' , 'EventsticketsController@index');
Route::get('eventstickets/item/{id?}' , 'EventsticketsController@show');
Route::post('eventstickets/item' , 'EventsticketsController@store');
Route::post('eventstickets/item/{id}' , 'EventsticketsController@update');
Route::get('eventstickets/{id}/delete' , 'EventsticketsController@destroy');
Route::get('eventstickets/{id}/view' , 'EventsticketsController@getById');
Route::get('eventstickets/pluck', 'EventsticketsController@pluck');
#### partnership control
Route::get('partnership' , 'PartnershipController@index');
Route::get('partnership/item/{id?}' , 'PartnershipController@show');
Route::post('partnership/item' , 'PartnershipController@store');
Route::post('partnership/item/{id}' , 'PartnershipController@update');
Route::get('partnership/{id}/delete' , 'PartnershipController@destroy');
Route::get('partnership/{id}/view' , 'PartnershipController@getById');
Route::get('partnership/pluck', 'PartnershipController@pluck');
#### eventsreviews control
Route::get('eventsreviews' , 'EventsreviewsController@index');
Route::get('eventsreviews/item/{id?}' , 'EventsreviewsController@show');
Route::post('eventsreviews/item' , 'EventsreviewsController@store');
Route::post('eventsreviews/item/{id}' , 'EventsreviewsController@update');
Route::get('eventsreviews/{id}/delete' , 'EventsreviewsController@destroy');
Route::get('eventsreviews/{id}/view' , 'EventsreviewsController@getById');
Route::get('eventsreviews/pluck', 'EventsreviewsController@pluck');
#### institution control
Route::get('institution' , 'InstitutionController@index');
Route::get('institution/item/{id?}' , 'InstitutionController@show');
Route::post('institution/item' , 'InstitutionController@store');
Route::post('institution/item/{id}' , 'InstitutionController@update');
Route::get('institution/{id}/delete' , 'InstitutionController@destroy');
Route::get('institution/{id}/view' , 'InstitutionController@getById');
Route::get('institution/pluck', 'InstitutionController@pluck');
#### masterrequest control
Route::get('masterrequest' , 'MasterrequestController@index');
Route::get('masterrequest/item/{id?}' , 'MasterrequestController@show');
Route::post('masterrequest/item' , 'MasterrequestController@store');
Route::post('masterrequest/item/{id}' , 'MasterrequestController@update');
Route::get('masterrequest/{id}/delete' , 'MasterrequestController@destroy');
Route::get('masterrequest/{id}/view' , 'MasterrequestController@getById');
Route::get('masterrequest/pluck', 'MasterrequestController@pluck');

#### social control
Route::get('social' , 'SocialController@index');
Route::get('social/item/{id?}' , 'SocialController@show');
Route::post('social/item' , 'SocialController@store');
Route::post('social/item/{id}' , 'SocialController@update');
Route::get('social/{id}/delete' , 'SocialController@destroy');
Route::get('social/{id}/view' , 'SocialController@getById');
Route::get('social/pluck', 'SocialController@pluck');
#### slider control
Route::get('slider' , 'SliderController@index');
Route::get('slider/item/{id?}' , 'SliderController@show');
Route::post('slider/item' , 'SliderController@store');
Route::post('slider/item/{id}' , 'SliderController@update');
Route::get('slider/{id}/delete' , 'SliderController@destroy');
Route::get('slider/{id}/view' , 'SliderController@getById');
Route::get('slider/pluck', 'SliderController@pluck');
#### talklikes control
Route::get('talklikes' , 'TalklikesController@index');
Route::get('talklikes/item/{id?}' , 'TalklikesController@show');
Route::post('talklikes/item' , 'TalklikesController@store');
Route::post('talklikes/item/{id}' , 'TalklikesController@update');
Route::get('talklikes/{id}/delete' , 'TalklikesController@destroy');
Route::get('talklikes/{id}/view' , 'TalklikesController@getById');
Route::get('talklikes/pluck', 'TalklikesController@pluck');

#### eventsenrollment control
Route::get('eventsenrollment' , 'EventsenrollmentController@index');
Route::get('eventsenrollment/item/{id?}' , 'EventsenrollmentController@show');
Route::post('eventsenrollment/item' , 'EventsenrollmentController@store');
Route::post('eventsenrollment/item/{id}' , 'EventsenrollmentController@update');
Route::get('eventsenrollment/{id}/delete' , 'EventsenrollmentController@destroy');
Route::get('eventsenrollment/{id}/view' , 'EventsenrollmentController@getById');
Route::get('eventsenrollment/pluck', 'EventsenrollmentController@pluck');
#### businesscourses control
Route::get('businesscourses' , 'BusinesscoursesController@index');
Route::get('businesscourses/item/{id?}' , 'BusinesscoursesController@show');
Route::post('businesscourses/item' , 'BusinesscoursesController@store');
Route::post('businesscourses/item/{id}' , 'BusinesscoursesController@update');
Route::get('businesscourses/{id}/delete' , 'BusinesscoursesController@destroy');
Route::get('businesscourses/{id}/view' , 'BusinesscoursesController@getById');
Route::get('businesscourses/pluck', 'BusinesscoursesController@pluck');

#### homesettings control
Route::get('homesettings' , 'HomesettingsController@index');
Route::get('homesettings/item/{id?}' , 'HomesettingsController@show');
Route::post('homesettings/item' , 'HomesettingsController@store');
Route::post('homesettings/item/{id}' , 'HomesettingsController@update');
Route::get('homesettings/{id}/delete' , 'HomesettingsController@destroy');
Route::get('homesettings/{id}/view' , 'HomesettingsController@getById');
Route::get('homesettings/pluck', 'HomesettingsController@pluck');
#### tickets control
Route::get('tickets' , 'TicketsController@index');
Route::get('tickets/item/{id?}' , 'TicketsController@show');
Route::post('tickets/item' , 'TicketsController@store');
Route::post('tickets/item/{id}' , 'TicketsController@update');
Route::get('tickets/{id}/delete' , 'TicketsController@destroy');
Route::get('tickets/{id}/view' , 'TicketsController@getById');
Route::get('tickets/pluck', 'TicketsController@pluck');

#### ticketsreplay control
Route::get('ticketsreplay' , 'TicketsreplayController@index');
Route::get('ticketsreplay/item/{id?}' , 'TicketsreplayController@show');
Route::post('ticketsreplay/item' , 'TicketsreplayController@store');
Route::post('ticketsreplay/item/{id}' , 'TicketsreplayController@update');
Route::get('ticketsreplay/{id}/delete' , 'TicketsreplayController@destroy');
Route::get('ticketsreplay/{id}/view' , 'TicketsreplayController@getById');
Route::get('ticketsreplay/pluck', 'TicketsreplayController@pluck');


#### faq control
Route::get('faq' , 'FaqController@index');
Route::get('faq/item/{id?}' , 'FaqController@show');
Route::post('faq/item' , 'FaqController@store');
Route::post('faq/item/{id}' , 'FaqController@update');
Route::get('faq/{id}/delete' , 'FaqController@destroy');
Route::get('faq/{id}/view' , 'FaqController@getById');
Route::get('faq/pluck', 'FaqController@pluck');

#### progress control
Route::get('progress' , 'ProgressController@index');
Route::get('progress/item/{id?}' , 'ProgressController@show');
Route::post('progress/item' , 'ProgressController@store');
Route::post('progress/item/{id}' , 'ProgressController@update');
Route::get('progress/{id}/delete' , 'ProgressController@destroy');
Route::get('progress/{id}/view' , 'ProgressController@getById');
Route::get('progress/pluck', 'ProgressController@pluck');


#### careers control
Route::get('careers' , 'CareersController@index');
Route::get('careers/item/{id?}' , 'CareersController@show');
Route::post('careers/item' , 'CareersController@store');
Route::post('careers/item/{id}' , 'CareersController@update');
Route::get('careers/{id}/delete' , 'CareersController@destroy');
Route::get('careers/{id}/view' , 'CareersController@getById');
Route::get('careers/pluck', 'CareersController@pluck');

#### careersresponses control
Route::get('careersresponses' , 'CareersresponsesController@index');
Route::get('careersresponses/item/{id?}' , 'CareersresponsesController@show');
Route::post('careersresponses/item' , 'CareersresponsesController@store');
Route::post('careersresponses/item/{id}' , 'CareersresponsesController@update');
Route::get('careersresponses/{id}/delete' , 'CareersresponsesController@destroy');
Route::get('careersresponses/{id}/view' , 'CareersresponsesController@getById');
Route::get('careersresponses/pluck', 'CareersresponsesController@pluck');

#### Course Control - Admin Edits
Route::get('courses/item/{id}/update' , 'CoursesController@showUpdate');
Route::get('/courselectures/item/{id}/updatePosition' , 'CourselecturesController@updateLecturePos');
Route::get('/coursesections/item/{id}/updatePosition' , 'CoursesectionsController@updateSectionPos');
Route::get('/courseresources/item/{id}/updatePosition' , 'CourseresourcesController@updateResourcePos');

### Quiz Control - Admin Edits
Route::get('quiz/item/{id}/update' , 'QuizController@showUpdate');

Route::get('quizquestions/addInput/{counter}', 'QuizquestionsController@addInput');

### Optimize Select2 users
Route::get('/loadAllUsers', 'HomeController@loadAllUsers');
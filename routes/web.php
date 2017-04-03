<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();

/*  Admin    */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    CRUD::resource('study', 'Admin\StudyInfoPageCrudController');
    CRUD::resource('location', 'Admin\LocationCrudController');
    CRUD::resource('category', 'Admin\CategoryCrudController');
    CRUD::resource('faq', 'Admin\FaqItemCrudController');
    CRUD::resource('feedback', 'Admin\FeedbackCrudController');
    CRUD::resource('comment', 'Admin\CommentCrudController');
});

/*  Auth    */
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('log', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('ajax-recovery', 'Auth\ForgotPasswordController@reset');
Route::get('login', 'HomeController@index');
Route::get('registration', 'HomeController@index');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register/verify/{confirmationCode}', [
	'as' => 'confirmation_path',
	'uses' => 'Auth\RegisterController@confirm'
]);

/*
Route::get('reg', 'Auth\RegisterController@register');

Route::post('registration', 'Auth\RegisterController@register');
*/
// Password Reset Routes...
Route::get('recovery', 'HomeController@index');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('ajax-registration', 'Auth\RegisterController@ajaxRegistration');
Route::post('simply-registration', 'Auth\RegisterController@simplyRegistration');

Route::get('restore/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('restore', 'Auth\ResetPasswordController@reset');



/*  Info    */
Route::get('/project/create/info', 'ProjectInfoController@index');
Route::get('/', 'HomeController@index');

//  Study
Route::get('/study', 'ProjectInfoController@study');
Route::get('/study/{page}', 'ProjectInfoController@studyPage');

//  Profile
Route::get('/profile/{user}', 'ProfileController@index')->name('profile');
Route::post('/get-client-bio', 'ProfileController@bio');

Route::post('/profile/projects', 'ProfileController@viewTab')->name('profile.projects');
Route::post('/profile/comments', 'ProfileController@viewTab')->name('profile.comments');
Route::post('/profile/sponsored', 'ProfileController@viewTab')->name('profile.sponsored');

//  Settings
Route::get('/settings', 'SettingsController@settings')->name('settings');
Route::post('/settings', 'SettingsController@saveSettings');
Route::post('/get-settings-profile', 'SettingsController@tabProfile');
Route::post('/get-settings-access', 'SettingsController@tabAccess');
Route::post('/get-settings-notify', 'SettingsController@tabNotify');
Route::post('/remove-social', 'SettingsController@removeSocial');
Route::post('/change-email', 'SettingsController@changeEmail');
Route::post('/change-password', 'SettingsController@changePassword');
Route::post('/set-notifications', 'SettingsController@setNotifications');

//  Notifications
Route::get('/notifications', 'NotificationsController@notifications');


/*  Web-Sites   */
Route::post('/website-add', 'WebSiteController@store');
Route::post('/website/delete', 'WebSiteController@destroy');


/*  Projects    */
Route::get('/projects', 'ProjectController@index');
Route::post('/get-projects-by-page', 'ProjectController@page');
Route::post('/project-categories', 'ProjectController@category');
Route::get('/project/create', 'ProjectController@create')->middleware('auth');
Route::get('/project/{project}', 'ProjectController@view')->name('project');
Route::get('/project/{project}/update', 'ProjectController@update')->name('project.update')->middleware('auth');
Route::post('/project/{project}/update', 'ProjectController@updateSave')->middleware('auth');
Route::get('/project/{project}/complete', 'ProjectController@complete')->middleware('auth');
Route::get('/project/{project}/delete', 'ProjectController@delete')->name('project.delete')->middleware('auth');
Route::get('/project/{project}/pay1', 'ProjectController@pay1')->name('project.pay1');
Route::match(['get', 'post'], '/project/{project}/pay2/{gift?}', 'ProjectController@pay2')->name('project.pay2');
Route::post('/save-project-field', 'ProjectController@storeField')->middleware('auth');
Route::post('/save-project-info', 'ProjectController@store')->middleware('auth');
Route::post('/save-client-field', 'ProjectController@storeClientField');

Route::post('/project/{project}/about', 'ProjectController@viewTab')->name('project.about');
Route::post('/project/{project}/comments', 'ProjectController@viewTab')->name('project.comments');
Route::post('/project/{project}/sponsors', 'ProjectController@viewTab')->name('project.sponsors');
Route::post('/save-pay-data', 'ProjectController@savePaymentData');


//  Payment
Route::post('/donate', 'PaymentController@donate');
Route::get('/payment/{order}', 'PaymentController@paymentForm')->name('payment');
Route::get('/payment/{type}/{result}', 'PaymentController@paymentResult');
Route::get('/donations', 'PaymentController@donations');


/* comments */
Route::post('/add-comment', 'CommentController@store');
Route::post('/comment-delete', 'CommentController@destroy');


/*  FAQ   */
Route::post('/faq/add', 'FaqController@store');
Route::post('/faq/update', 'FaqController@update');
Route::post('/faq/delete', 'FaqController@delete');


/*  Gifts   */
Route::post('/gift/add', 'GiftController@store');
Route::post('/gift/update', 'GiftController@update');
Route::post('/gift/delete', 'GiftController@delete');

/*  Comments    */
Route::post('/get-comments-for-project', 'CommentsController@comments');



/*  Upload  */
Route::post('/upload-image', 'UploadController@uploadImage');
Route::post('/upload-image-about-project', 'UploadController@uploadProjectImage');
Route::post('/upload-video-preview', 'UploadController@uploadVideo');
Route::get('/images/{type}/{template}/{file}', 'UploadController@image');


/*  Misc    */
Route::get('/error', 'HomeController@error');
Route::get('/search', 'HomeController@index');
Route::get('/faq', 'HomeController@faq');
Route::post('/set-back-url', 'HomeController@setBackUrl');
Route::post('/send-feedback-form', 'HomeController@sendFeedback');
Route::post('/ajax-search', 'ProjectController@search');


/*  Messages    */
Route::post('/get-message-container', 'MessageController@create');
Route::post('/send-message', 'MessageController@store');



/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])
     ->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);


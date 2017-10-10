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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'HomeController@showWelcome');
Route::post('/forgetpassword/email','Auth\ForgotPasswordController@forgetForm');
Route::get('/reset-password/{id}','Auth\ResetPasswordController@resetPassword');
Route::post('/reset-password','Auth\ResetPasswordController@reset');
Auth::routes();
Route::group(array('prefix' => 'admin'), function()
{
  Route::any('/','AdminController@login');
  Route::any('/dashboard','AdminController@admin_dashboard');
  Route::any('/profile','AdminController@profile');
  Route::post('/profile-information','AdminController@profile_information');
  Route::post('/admin_image','AdminController@admin_image');
  Route::post('/change_pass','AdminController@change_pass');
  Route::any('/logout','AdminController@logout');
  Route::any('/how_it_works','AdminController@how_it_works');
  Route::any('/how_it_works/edit/{id?}','AdminController@edit_how_it_works');
  Route::any('/how_it_works/add','AdminController@add_how_it_works');
  Route::any('/contact_us','AdminController@contact_us');
  Route::any('/about_us','AdminController@about_us');
  Route::any('/contact_us_customers','AdminController@contact_us_customers');
  Route::any('/home_page','AdminController@home_page');
  Route::any('/testimonials','AdminController@testimonials');
  Route::any('/addTestimonials','AdminController@addTestimonials');
  Route::any('/deleteTestimonial','AdminController@deleteTestimonial');
  Route::get('/settings','AdminController@settingsPage');
  Route::post('/save_settings','AdminController@saveSettings');
  Route::any('/all_cms_pages','AdminController@CmsPages');
  Route::get('/add_new_page','AdminController@AddCmsPage');
  Route::post('/saveNewPage','AdminController@SaveCmsPage');
  Route::any('/delete-cms-page/{id}','AdminController@deleteCmsPage');
  Route::any('/editCmsPage/{id}','AdminController@editCmsPage');
  Route::any('/updateCmsPage','AdminController@updateCmspage');
  Route::any('/users','AdminController@ShowUsers');
  Route::any('/delete-user','AdminController@deleteUsers');
  Route::any('/edit-user/{id}','AdminController@EditUsers');
  Route::any('/update-user','AdminController@updateUser');
  Route::any('/add_new_user','AdminController@ShowUserSavepage');
  Route::any('/save-new-user','AdminController@saveNewUser');
  Route::any('/contact_us_customers','AdminController@ContactUsCustomers');
  Route::any('/getNotification','NotificationController@getNotification');
});

Route::group(array('prefix' => 'user'), function()
{
  Route::get('/settings','UserController@settings');
  Route::get('/notification','UserController@notification');
  Route::get('/location','UserController@location');
  Route::get('/activities','UserController@activities');
  Route::any('/privacy','UserController@privacy');
  Route::get('/photos','UserController@photos');
  Route::any('/message','ChatController@message');
  Route::get('/testimonial','UserController@testimonial');
  Route::get('/subscription','UserController@subscription');
  Route::get('/friends','UserController@friendRequest');
  Route::get('/bookmark','UserController@bookmark');
  Route::get('/deactivate/{id}','UserController@DeactivateUser');
  Route::get('/activate/{id}','UserController@ActivateUser');
  Route::post('/uploadPhotos','UserController@uploadPhotos');
  Route::post('/deletePhotos','UserController@deletePhotos');
  Route::post('/notificationStatus','UserController@notificationStatus');
  Route::post('/frnd_rqst','UserController@frnd_rqst');
  Route::post('/sendMessage','ChatController@sendMessage');
  Route::post('/getUserChat','ChatController@getUserChat');
  Route::post('/getRealTImeChat','ChatController@getRealTImeChat');
  Route::post('/changeMsgStatus','ChatController@changeMsgStatus');
  Route::post('/getPreviousChat','ChatController@getPreviousChat');
});

Route::get('/home', 'HomeController@index');
Route::get('/dashboard','UserController@profile');
Route::any('/register/verify/{code?}','Auth\RegisterController@confirmuser');
Route::get('/edit','UserController@edit');
Route::post('/updateuser','UserController@UpdateUser');
Route::any('/search-results','SearchController@searchResults');
Route::get('/profile/{id}','SearchController@searchDetails');
Route::get('/faq','UserController@faq');
Route::get('/missing-person','SearchController@missingPerson');
Route::post('/save_contact_us','PageController@saveContactUs');
Route::any('/ajax/cafe','Auth\RegisterController@getCafes');
Route::any('/updatesettings','UserController@UpdateSettings');
Route::any('/save_location','UserController@UpdateSaveLocation');
Route::any('/send-request','SearchController@sendRequest');
Route::any('/cancel-request','SearchController@cancelRequest');
Route::get('/page/{slug}','PageController@PageView');

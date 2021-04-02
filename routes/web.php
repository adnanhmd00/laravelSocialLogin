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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/auth/google', 'Auth\LoginController@redirectToProvider');
// Route::get('/auth/google/callback', 'Auth\LoginController@handleProviderCallback');

// Route::get('/auth/redirect/{provider}', 'Auth\LoginController@redirect');
// Route::get('auth/{provider}/callback', 'Auth\LoginController@callback');


Route::get('/facebook/redirect', 'SocialAuthController@redirect')->name('facebook.login');
Route::get('/facebook/callback', 'SocialAuthController@callback')->name('facebook.callback');

Route::get('auth/redirect/google', 'SocialAuthController@redirectGoogle')->name('google.login');
Route::get('auth/google/callback', 'SocialAuthController@callbackGoogle')->name('google.callback');

Route::get('auth/linkedin', 'SocialAuthController@redirectLinkedin')->name('linkedin.login');
Route::get('linkedin/callback', 'SocialAuthController@callbackLinkedin')->name('linkedin.callback');

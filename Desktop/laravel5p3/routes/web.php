<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');


    Route::get('/redirect', 'SocialAuthController@redirect');

    Route::get('/callback', 'SocialAuthController@callback');

    // Auth::routes();  // Estas son las que Auth::routes() trae por defecto -----------------------
    // ubicada en Illuminate\Routing\   Auth - Router

    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->get('confirmation/{token}', 'Auth\RegisterController@getConfirmation')->name('confirmation');
    $this->post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');

    // ---------------------------------------------------------------------- FIN Auth::routes()------

    Route::get('/home', 'HomeController@index')->name('home');


});
Route::group(['middleware' => 'auth'], function () {

    Route::get('account', function () {
        return view('account');
    });

    Route::get('account/password', 'AccountController@getPassword')->name('changePassword');
    Route::post('account/password', 'AccountController@postPassword')->name('postPassword');

    Route::get('account/edit-profile', 'AccountController@EditProfile')->name('editProfile');
    Route::put('account/edit-profile', 'AccountController@UpdateProfile')->name('updateProfile');

    Route::group(['middleware' => 'verified'], function() {

        Route::get('publish', function() {
            return view('publish');
        });

        Route::post('publish', function() {

            $data = Request::all();
            return $data;
            //return response()->json($data);  // devuelve un json
        });

        Route::group(['middleware' => 'role:admin'], function() {
            Route::get('admin/settings', function () {
                return view('admin/settings');
            });
        });

        Route::group(['middleware' => 'role:editor'], function() {
            Route::get('admin/posts', function () {
                return view('admin/posts');
            });
        });

    });



});

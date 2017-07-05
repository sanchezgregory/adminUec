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

use App\Cost;
use App\Mail\Welcome as welcomeEmail;
use App\Month;
use App\Period;
use App\Person;
use App\User;
use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
Auth::routes();

Route::get('/users/users', function() {

    /** CODIGO SQL QUE TRAE LOS REPRESENTANTES Y SUS REPRESENTADOS *********
     * SELECT concat(t1.first_name," ",t1.last_name) as representante, concat( t4.first_name," ",t4.last_name) as hijo from persons t1
    INNER JOIN representants ON representants.person_id = t1.id
    INNER JOIN students ON students.representant_id = representants.id
    INNER JOIN persons t4 ON t4.id = students.person_id
     */

    $term = Request::get('term');
    return Person::findByApi($term);
});
Route::get('/months/months', function() {

    $term = Request::get('id');
    return Month::findByApi($term);
});

Route::group(['middleware' => ['web']], function(){

    Route::get('/login', function() {

        return view('login');
    });
    Route::get('/',function() {

        Period::NewPeriod();

        if (auth()->check()) return view('/home');
        else return view('auth/login');
    })->name('home');

    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login')->name('login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');
    $this->get('logout', 'Auth\LoginController@logout')->name('logout');
    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');
});

// -------Rutas para todos los usuario autenticados....................................................
Route::group(['middleware' => ['auth','verified']], function() {
    Route::get('account', function() {
        return view('account');
    });
    Route::get('profile', function() {
        return view();
    });
    Route::get('/home',function() {
        return view('/home');
    })->name('home');

    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');

    // --------------- RUTAS PARA EL USER = REPRESENTANTE: SOLO CONSULTAS Y PERFIL DE SU USUARIO
    Route::group(['middleware' => 'role:user'], function() {
        Route::get('users/indexuser','PersonController@indexUser')->name('indexUser');
        Route::get('account.edit-profile','AccountController@editProfile')->name('editProfile');
        Route::put('account.edit-profile','AccountController@updateProfile')->name('updateProfile');
        Route::get('users.index', 'AccountController@index')->name('indexUser');
        Route::get('account.password','AccountController@getPassword')->name('getPassword');
        Route::post('account.password', 'AccountController@postPassword')->name('postPassword');
        Route::get('pdf/sections/{id}', 'SectionController@pdf')->name('sections.pdf');
        Route::get('mails/person/{id}', 'PersonController@mail')->name('personMail');
        Route::get('datatables/payments/{id}', 'PaymentController@dataPayment')->name('dataPayment');
    });
    // --------------- RUTAS PARA EL EDITOR y ADMIN DEL SISTEMA ----------------------------------------
    Route::group(['middleware' => 'role:editor'], function() {
        Route::get('persons/indexperson', 'PersonController@indexPerson')->name('indexPerson');
        Route::get('persons/createperson', 'PersonController@createPerson')->name('createPerson');
        Route::post('persons/storeperson', 'PersonController@storePerson')->name('storePerson');
        Route::get('persons/defaulterperson', 'PersonController@defaulter')->name('defaulter');
        Route::get('persons/destroystudent/{id}', 'PersonController@destroyStudent')->name('destroyStudent');

        Route::get('persons/indexstudent', 'PersonController@indexStudent')->name('indexStudent');

        Route::get('payment/indexpayment', 'PaymentController@index')->name('indexpayment');
        Route::get('payment/createpayment/{id}', 'PaymentController@create')->name('createPayment');
        Route::post('payment/storepayment', 'PaymentController@storePayment')->name('storePayment');
        Route::post('payment/storepaymentinsc', 'PaymentController@storePayment2')->name('storePayment2');


    });
    // =========================================================================================
    // ---------------Rutas solo para el admin..................................................
    Route::group(['middleware' => 'role:admin'], function(){
        Route::get('admin.settings', function(){
            return view('admin.settings');
        });
        //------- creacion de usuarios

        Route::get('users', function(){
            $title="Creacion de usuarios para el sistema";
            //return view('users.createuser', compact('title'));
        })->name('createuser');

        Route::get('/settings/conf/', 'SettingController@IndexSetting')->name('indexSetting');
        Route::post('/settings/cong/cost','SettingController@StoreSettingCost')->name('storeSettingCost');
        Route::post('/settings/cong/insc','SettingController@StoreSettingInsc')->name('storeSettingInsc');
        Route::post('/settings/cong/period','SettingController@StoreSettingPeriod')->name('storeSettingPeriod');
        Route::post('/settings/conf/date','SettingController@UpdateSettingDate')->name('updateSettingDate');
        Route::get('/persons/editperson/{id}', 'PersonController@EditPerson')->name('editPerson');
        Route::get('/persons/editstudent/{id}', 'PersonController@EditStudent')->name('editStudent');
        Route::post('/persons/updateperson/', 'PersonController@UpdatePerson')->name('updatePerson');
        Route::post('/persons/updatestudent/', 'PersonController@UpdateStudent')->name('updateStudent');
    });
});

/*
Route::get('welcome', function () {
    /* ----- FORMA VIEJA DE ENVIAR CORREOS -----------------------------------------------
    Mail::send('emails.welcome', ['name' => 'Gregory'], function (Message $message) {
        $message->to('mcgregox@gmail.com', 'Gregory Sanchez')
            ->from('admin@admin.com', 'McG')
            ->subject('Bienvenido');
    });
    // -----------------laravel 5.2 ------------------------------------------------------ */

    // forma actual ------- laravel 5.3 y posteriores ---------------------

    /* haciendo uso de un modelo de usuario
    $user = new App\User([
        'name' => 'Gregory',
        'email' => 'mcgregox@gmail.com'
    ]);

    $user = App\User::find(1);

    Mail::to($user->email,$user->name)
        ->cc('otro@gmail.com')
        ->bcc('copiaoculta@gmail.com')
        ->send(new WelcomeEmail($user));
});

Route::get('points', function() {
    $users = DB::table('users')->get();

    return $users->avg(function ($users) {
        return $users->points;
    });

});

Route::get('reject', function () {

    $user = User::all()->reject('points' > 3);
    dd($user);
    return  $user;
});

Route::get('filter', function (){
    $users = User::all();
    return $users->filter(function ($users) {
        return $users->points > 2;
    });
});


Route::get('posts', function() {
    $users = \App\User::all();
    return view('posts',compact('users'));
});*/
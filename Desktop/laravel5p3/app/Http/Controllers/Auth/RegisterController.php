<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        // se insertan manualmente los campos username y role por seguridad. ya que estos pueden ser cargados desde el navegador
        $username = $user->email;
        $username = explode('@',$username);
        $user->username = $username[0];
        $user->role = 'user';
        $user->registration_token = str_random(40);
        $user->save();

        $url = route('confirmation', ['token' => $user->registration_token]);

        Mail::send('emails/registration', compact('user', 'url'), function($m) use($user) {
           $m->to($user->email, $user->name)->subject('Activa tu cuenta');
        });

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        return redirect()->route('login')
            ->with('alert','Confirma tu cuenta desde tu email: ' . $user->email);
    }

    public function getConfirmation($token)
    {
        $user = User::Where('registration_token', $token)->firstOrFail();
        $user->registration_token = null;
        $user->save();

        return redirect()->route('home')
            ->with('alert','Cuenta confirmada: Bienvenid@' . $user->first_name . ' '.$user->last_name);
    }
}

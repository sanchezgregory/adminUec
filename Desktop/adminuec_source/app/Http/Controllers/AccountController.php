<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function getPassword()
    {
        return view('account.password');
    }

    public function postPassword(Request $request)
    {
        $user = $request->user();

        if (! Hash::check($request->get('current_password'), $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'Password invalido',
            ]);
        }

        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect('account.edit-profile')
            ->with('alert', 'Password Cambiado');
    }

    public function editProfile()
    {
        $user = Auth::User();
        $user->load('person');
        return view('account.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $user = $request->user();

        $this->validate($request, [
            'username' => Rule::unique('users')->ignore($user->id),
            'img' => [
                'image',/*
                Rule::dimensions([
                    'max_width' => '200',
                    'max_height' => '200'
                ])--- Asi puede ser usado, como arreglo. */
                Rule::dimensions()->maxHeight(400)->maxHeight(400),
            ],
        ]);

        $user->fill($request->only(['username']));  // esta una forma de guardar

        if ($request->hasFile('img')) {
            $user->img = $request->file('img')->store('avatars');
        }

        $user->save();
        //$user->username = $request->get('username'); // esta es una forma de hacerlo

        return redirect('account.edit-profile')
            ->with('alert', 'perfil cambiado');

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
            'username' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required'
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
            'username' => $data['username'],
            'role'  => $data['role'],
            'active' => true
        ]);

        $username = $user->email;
        $username = explode('@', $username);
        $user->username = $username[0];
        $user->password = $username;
        $user->save();
        dd($user);
        return $user;

    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        return redirect()->route('indexUser')
            ->with('success','Usuario '.$user->username.' creado satisfactoriamente');
    }

    public function index()
    {
        $users = User::all();
        $title = 'Listado de usuarios del sistema';

        return view('users/index', compact('users','title'));

    }
}

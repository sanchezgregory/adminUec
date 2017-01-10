<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function getPassword()
    {
        return view('account/password');
    }

    public function postPassword(Request $request)
    {
        $user = $request->user();

        if (!Hash::check($request->get('current_password'), $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'Password no valido'
            ]);
        }

        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
            ]);

        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect('account')
            ->with('alert', 'Password cambiado');
    }

    public function EditProfile()
    {
        $user = Auth::User();
        return view('account.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'username' => 'required|min:6'
        ]);

        $user->fill($request->only(['username'])); // otra forma
        // $user->username = $request->get('username'); // esto es una manera
        $user->save();

        return redirect('account')
            ->with('alert','Perfil cambiado');
    }
}

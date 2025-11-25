<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function loginUser()
    {
     
        $credentials = request()->except('_token');

        if (!Auth::attempt($credentials))
            return redirect()->back()->with('errore', 1);


        request()->session()->regenerate();
        return redirect()->to('user/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    public function createUser()
    {
        //TODO: validation here


        $user = new User();
        $user->name = request('username');
        $user->email = request('email');
        $user->password = request('password');
        $user->save();

        return redirect()->to('/login')->with('registrato', 1);
    }
}

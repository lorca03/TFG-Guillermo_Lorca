<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = encrypt($request->input('password'));
        $user->save();
        Auth::login($user);
        return redirect(route('perfil'));
    }
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];
//        $remember
        if (Auth::attempt($credentials,true)){
            $request->session()->regenerate();
            return redirect()->intended(route('perfil'));
        }else{
            return redirect('login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

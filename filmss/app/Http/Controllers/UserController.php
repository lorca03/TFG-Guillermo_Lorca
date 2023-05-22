<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Registra a un usuario en la base de datos.
     *
     * @param  Request  $request  Datos del usuario.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = encrypt($request->input('password'));
        $user->save();
        Auth::login($user);
        return redirect(route('/'));
    }
    /**
     * Realiza el inicio de sesión del usuario.
     *
     * @param  Request  $request  Datos del usuario.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];
        if (Auth::attempt($credentials,true)){
            $request->session()->regenerate();
            return redirect('/');
        }else{
            return redirect('login');
        }
    }
    /**
     * Cierra la sesión del usuario conectado.
     *
     * @param  Request  $request  Datos del usuario.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

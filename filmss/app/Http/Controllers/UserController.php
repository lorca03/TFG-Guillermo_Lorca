<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


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
        $user->password = Hash::make($request->input('password'));
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
    /**
     * Cierra la sesión del usuario conectado.
     *
     * @param  Request  $request  Datos del usuario.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $credentials = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];
        var_dump($credentials);
        $user=Auth::user();
        $user->password=$credentials['password']==null ? $user->password : Hash::make($credentials['password']);
        $user->name=$credentials['name']==null ? $user->name : $credentials['name'];
        $user->email=$credentials['email']==null ? $user->email : $credentials['email'];
        $user->save();
        return  redirect(route('perfil',['seccion'=> 'cuenta']));
    }
    /**
     * Cierra la sesión del usuario conectado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function perfil(Request $request)
    {
        if ($request->input('buscar')!=''){
            $users = $this->search($request->input('buscar'));
        }else{
            $users = User::orderBy('created_at', 'desc')
                ->orWhereNotIn('id', [Auth::id()])
                ->get();
        }
        $friends=\Auth::user()->getFriends();
        $pending=\Auth::user()->getPendingFriendships();
        return view('pages.perfil',['users'=>$users,'friends'=>$friends,'pending'=>$pending]);
    }

    protected function enviar(Request $request)
    {
        $recipient=$request->input('recipient');
        $recipient=User::all()->find($recipient);
        $user=Auth::user();
        $user->befriend($recipient);
        return  redirect(route('perfil',['seccion'=> 'descubre']));
    }
    protected function cancel(Request $request)
    {
        $recipient=$request->input('recipient');
        $sender=$request->input('sender');
        DB::table('friendships')
            ->where('recipient_id',$recipient)
            ->where('sender_id',$sender)
            ->delete();
        return  redirect(route('perfil',['seccion'=> 'amigos']));
    }
    protected function aceptar(Request $request)
    {
        $senderid=$request->input('sender');
        $sender=User::all()->find($senderid);
        \Auth::user()->acceptFriendRequest($sender);
        return  redirect(route('perfil',['seccion'=> 'amigos']));
    }
    protected function denegar(Request $request)
    {
        $senderid=$request->input('sender');
        $sender=User::all()->find($senderid);
        \Auth::user()->denyFriendRequest($sender);
        return  redirect(route('perfil',['seccion'=> 'amigos']));
    }
    protected function search($buscar)
    {
        $users=User::where('name', 'like', '%'.$buscar.'%')
            ->orWhere('email', 'like', '%'.$buscar.'%')->get();
        return $users;
    }
}

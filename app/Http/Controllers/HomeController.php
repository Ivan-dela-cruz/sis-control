<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::where('id', $id)->where('estado_p', 1)->first();

        if (!($user == null)) {
            $rol = $user->roles->implode('name', ', ');
            switch ($rol) {
                case 'admin';
                    return redirect()->route('administrador');
                    break;
                case 'secundario';
                    return redirect()->route('tecnico-secundario');
                    break;
                case 'principal';
                    return redirect()->route('tecnico-principal');
                    break;
                case 'cliente';
                    return redirect()->route('cliente');
                    break;
            }
        } else {

            Auth::logout($user);

            return redirect()->route('login')->with("message", "Usuario no encontrado");
        }
        Auth::logout($user);

        return redirect()->route('login')->with("message", "Usuario no encontrado");
    }

}

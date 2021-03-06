<?php

namespace App\Http\Controllers\admin;

use App\OrdenTrabajo;
use App\Tecnico;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $user = User::where('email', $request->email)->where('estado_p', 1)->first();
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
                Auth::logout($user);

                return redirect()->route('login')->with("message", "Usuario no encontrado");
            } else {
                Auth::logout($user);
                return redirect()->route('login')->with("message", "Usuario no encontrado");
            }

        }
        return redirect()->route('login')->with("message", "Usuario no encontrado");
    }
}

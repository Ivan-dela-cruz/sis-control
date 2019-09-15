<?php

namespace App\Http\Controllers\admin;

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
            if ($user->is_admin() == 0) {
                return redirect()->route('administrador');
            } elseif ($user->is_admin() == 1) {
                $tecnico = Tecnico::find($user->id);
                if ($tecnico->tipo_t == 0) {
                    return redirect()->route('tecnico-principal');
                } else {
                    return redirect()->route('tecnico-secundario');
                }

            } else {
                return redirect()->route('cliente');
            }

        }
        return redirect()->back();

    }
}

<?php

namespace App\Http\Controllers\admin;

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
            $user = User::where('email', $request->email)->where('estado_p',1)->first();
            if ($user->is_admin() == 0) {
                return redirect()->route('dashboard');
            } elseif ($user->is_admin() == 1) {
                return redirect()->route('tecnico');
            } else {
                return redirect()->route('user');
            }

        }
        return redirect()->back();

    }
}

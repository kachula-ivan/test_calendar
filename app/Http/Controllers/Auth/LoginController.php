<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('login');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))){
            return back()->withInput()->withErrors([
                'email' => 'Невірна еклектронна адреса',
                'password' => 'Невірний пароль'
                // 'email' => trans('auth.failed') - З локалізацією
            ]);
        }
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request){
        Auth::logout();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

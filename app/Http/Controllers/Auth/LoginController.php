<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login.index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $role = $request->input('role');

        if ($role == 'admin'){
            $credentials = $request->validate([
                'email'=> 'required|email',
                'password' => 'required|min:8'
            ]);
            if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))){
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            return back()->with('loginError', 'Login failed, please check your credentials');
        }
        return back()->with('loginError', 'Login failed, please check your credentials');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

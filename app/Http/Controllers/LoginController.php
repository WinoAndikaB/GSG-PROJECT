<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    //[Login] Halaman Sign In
    function log(){
        return view('login.sign-in');
    }

    //[Login] Halaman Register User
    function register(){
        return view('login.signup');
    }
    
    function registerUser(Request $req){
       User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'role' => 'user',
       ]);
            return redirect('/login');
    }

    //[Login] Verifikasi User Login
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:100', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)){
            if(Auth::user()->role == 'admin'){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            if(Auth::user()->role == 'user'){
                $request->session()->regenerate();
                return redirect()->intended('/home');
            }
        }
        return back()->withErrors([
            'email' => 'Email and Password invalid'
        ])->onlyInput('email');
    }

    //[Login] Halaman Lupa Password
    function lupaPassword(){
        return view('login.lupaPassword');
    }

    //[Login] Logout User
        function logout(){
            Auth::logout();
            return redirect('/');
        }
    }

<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\donasibarangs;
use App\Models\donasiuangs;
use App\Models\tambahdonases;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    function log(){
        return view('login.sign-in');
    }

    function register(){
        return view('login.signup');
    }

    public function landingPage()
    {
        
        $dt1 = artikels::paginate(5);

        return view('main.landingPage', compact('dt1'));
    }

    function aboutLandingPage(){
        return view('main.aboutLandingPage');
    }
    
    function registerUser(Request $req){
       User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'role' => 'user',
       ]);
            return redirect('/login');
    }

    public function login(Request $request){
        //dd($request);
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

        function logout(){
            Auth::logout();
            return redirect('/');
        }
    }

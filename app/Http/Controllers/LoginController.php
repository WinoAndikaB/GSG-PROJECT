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

    public function landingPage(Request $request)
{
    $search = $request->input('search');

    $query1 = artikels::query();
    $query2 = artikels::query(); 
    $query3 = artikels::query(); 
    $query4 = artikels::query(); 

    if (!empty($search)) {
        $query1->where(function($query) use ($search) {
            $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                  ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        });

        $query2->where(function($query) use ($search) {
            $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                  ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        });
        $query3->where(function($query) use ($search) {
            $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                  ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        });
        $query4->where(function($query) use ($search) {
            $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                  ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        });
    }

        
            // Get trending articles randomly
            $trending = artikels::inRandomOrder()->take(3)->get();

            // Get the latest articles
            $latest = artikels::orderBy('created_at', 'desc')->take(8)->get();

            // Get what's new articles randomly
            $whatsnew = artikels::inRandomOrder()->take(5)->get();

            // Get a box of articles randomly
            $box = artikels::inRandomOrder()->take(8)->get();

            $semua = artikels::all();
            $todayDate = date('l, d M Y H.i');

    return view('main.sebelumLogin.landingPage', compact('trending', 'latest','whatsnew','semua', 'box', 'todayDate'));
}


    

    function aboutLandingPage(){
        return view('main.sebelumLogin.aboutLandingPage');
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

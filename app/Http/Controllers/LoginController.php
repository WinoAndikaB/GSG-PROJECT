<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\donasibarangs;
use App\Models\donasiuangs;
use App\Models\tambahdonases;
use App\Models\ulasans;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\video;
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

    function landingPageVideo(Request $request){

        $search = $request->input('search');

        $query1 = video::query();
        $query2 = video::query(); 
        $query3 = video::query(); 
        $query4 = video::query(); 
    
        if (!empty($search)) {
            $query1->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
    
            $query2->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
            $query3->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
            $query4->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
        }
    
            
                // Get trending articles randomly
                $trendingVideo = video::orderBy('created_at', 'desc')->paginate(3);
    
                // Get the latest articles
                $latestVideo = video::orderBy('created_at', 'desc')->take(8)->get();
    
                // Get what's new articles randomly
                $whatsNewVideo = video::inRandomOrder()->take(5)->get();
    
                // Get a box of articles randomly
                $boxVideo = video::inRandomOrder()->take(8)->get();
    
                $semuaVideo = video::all();
                $todayDate = date('l, d M Y H.i');

        return view('main.sebelumLogin.landingPageVideo', compact('trendingVideo', 'latestVideo','whatsNewVideo','semuaVideo', 'boxVideo', 'todayDate'));
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

    function ulasanLandingPage(){
        // Mengambil data ulasan dengan mengurutkannya berdasarkan created_at
        $data1 = ulasans::orderBy('created_at', 'desc')->get();
    
        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
    
        //Hitung Ulasan
        $totalUlasan = ulasans::count();
        

        return view('main.sebelumLogin.ulasanLP', compact('data1', 'averageRating', 'totalUlasan'));
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

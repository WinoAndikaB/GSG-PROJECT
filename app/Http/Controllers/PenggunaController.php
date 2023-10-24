<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\ulasans;
use App\Models\user;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    function HomeSetelahLogin(Request $request){
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
    
        return view('main.setelahLogin.home', compact('trending', 'latest','whatsnew','semua', 'box', 'todayDate'));
    }

    public function showDetailArtikel($id)
    {
        $article = artikels::findOrFail($id);
    
        return view('main.setelahLogin.detailArt', compact('article'));
    }
    
    
    function about(){
        return view('main.setelahLogin.about');
    }

    function ulasan(){
        $data1=ulasans::all();
        return view('main.setelahLogin.ulasan', compact('data1'));
    }

    function storeUlasan(Request $req){
        ulasans::create([
            'rating' => $req->rating,
             'email' => $req->email,
             'nama' => $req->nama,
             'pesan' => $req->pesan,
        ]);
             return redirect('ulasan');
     }

      //Profile User
      public function profileUser()
      {
          return view('main.setelahLogin.profile');
      }  
    

    public function updateUser(Request $request, $id){

    $user = user::findOrFail($id);
    $user->update([
        'name' => $request->input('name'),
        'alamat' => $request->input('alamat'),
        'instagram' => $request->input('instagram'),
        'facebook' => $request->input('facebook'),
        'aboutme' => $request->input('aboutme'),
    ]);

    return redirect('/profileUser');
    }

}

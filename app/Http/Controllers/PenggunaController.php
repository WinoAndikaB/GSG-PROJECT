<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\ulasans;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    function dataArtikelHome(){
        $dt=artikels::all();
        return view('main.articles', compact('dt'));
    }

    function dataArtikelHome1(){
        $dt1=artikels::all();
        return view('main.index', compact('dt1'));
    }

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
    
        $trending = $query1->paginate(2);
        $latest = $query2->paginate(7);
        $whatsnew = $query3->paginate();
        $box = $query4->paginate(8);
        $semua = artikels::all();
        $todayDate = date('l, d M Y H.i');
    
        return view('main.home', compact('trending', 'latest','whatsnew','semua', 'box', 'todayDate'));
    }

    public function showDetailArtikel($id)
    {
        $article = artikels::findOrFail($id);
    
        return view('main.detailArt', compact('article'));
    }
    
    
    function about(){
        return view('main.about');
    }

    function ulasan(){
        $data1=ulasans::all();
        return view('main.ulasan', compact('data1'));
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

}

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

    function HomeSetelahLogin(Request $request,){
        $dt1=artikels::paginate(6);

        $search = $request->input('search');

        if (!empty($search)) {
            $dt1 = artikels::where(function($query) use ($search) {
                $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                      ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            })->get();
        }
        
        return view('main.home', compact('dt1'));
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

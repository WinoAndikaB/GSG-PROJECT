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

    public function showArtikel($id)
    {
        $tips = artikels::find($id);
        $title = "Artikel";
        return view('main.detailArtikel', compact('tips', 'title'));
    }

    function allog(){
        $dt1=artikels::all();
        return view('main.home', compact('dt1'));
    }

    function about(){
        return view('main.about');
    }

    function about1(){
        return view('main.about1');
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

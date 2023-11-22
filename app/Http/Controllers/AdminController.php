<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\Event;
use App\Models\EventKomunitas;
use App\Models\komentar_artikel;
use App\Models\komentar_video;
use App\Models\Likes;
use App\Models\syaratdanketentuans;
use App\Models\ulasans;
use App\Models\user;
use App\Models\video;
use App\Models\kategori;
use App\Models\laporanArtikelUser;
use App\Models\laporanKomentarArtikelUser;
use App\Models\laporanKomentarVideoUser;
use App\Models\LaporanUlasanUser;
use App\Models\LaporanVideoUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    //[Admin-Profile] Profil User
    public function profileAdmin()
    {
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('Admin.profileA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }  
  
    //[Admin-Profile] Edit Profil Admin
    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'instagram' => $request->input('instagram'),
            'facebook' => $request->input('facebook'),
            'aboutme' => $request->input('aboutme'),
        ]);
    
        // Handle Upload Foto
        if ($request->hasFile('fotoProfil')) {
            $image = $request->file('fotoProfil');
    
            $filename = 'fotoProfil.' . $user->name . ' ' . $user->username . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('fotoProfil'), $filename);
    
            $user->fotoProfil = $filename;
            $user->save();
        }

        return redirect('/profileAdmin');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Dashboard] Halaman Dashboard
    function dashboard(){
        $totalArtikel = artikels::count();
        $totalUser = user::count();
        $totalUlasan = ulasans::count();
        $totalUlasan = ulasans::count();
        $data1 = ulasans::all();

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $kategoriArtikel = Artikels::select('kategori', Artikels::raw('count(*) as total'))->groupBy('kategori')->get();
        $kategoriVideo = Video::select('kategoriVideo', Video::raw('count(*) as total'))->groupBy('kategoriVideo')->get();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
        

        return view('admin.dashboard', compact('totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo','kategoriArtikel','kategoriVideo','dataBaruEventKomunitas',  'dataBaruEventKomunitas'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Artikel] Halaman Tables Artikel
    function artikel(Request $request){
        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Start building the query without applying pagination
        $query = artikels::orderBy('created_at', 'desc');
    
        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('judulArtikel', 'like', '%' . $searchQuery . '%')
                    ->orWhere('penulis', 'like', '%' . $searchQuery . '%')
                    ->orWhere('status', 'like', '%' . $searchQuery . '%')
                    ->orWhere('kategori', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // Now, paginate the results
        $data = $query->paginate(15);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.artikel', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas'));
    }

    //[Admin-Artikel] Halaman Komentar Artikel
      function komentarArtikel(){
        $komenarA = komentar_artikel::orderBy('created_at', 'desc')->paginate(20);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.komentar.komentarArtikel', compact('komenarA', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    //[Admin-Artikel] Delete Data Artikel
        function deleteArtikel($id){
            $data=artikels::find($id);
        
            if ($data) {
                $data->delete();
                return redirect('/artikelAdmin');
            } else {
                return redirect('/artikelAdmin')->with('error', 'Video not found');
            }
        }
        

     //[Admin-Artikel] Delete Komentar Artikel
        function deleteKomentarAA($id){
            $data=komentar_artikel::find($id);
        
            if ($data) {
                $data->delete();
                return redirect('/komentarArtikel');
            } else {
                return redirect('/komentarArtikel')->with('error', 'Komentar not found');
            }
        }


    //[Admin-Artikel] Halaman Tambah Artikel
    public function formTambahArtikelA()
    {
         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir

         $kategoris = kategori::all();
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.FormAdmin.formTambahArtikel', compact('kategoris','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    public function storeArtikelA(Request $request)
    {
        // Validate the request data
        $request->validate([
            'judulArtikel' => 'required',
            'penulis' => 'required',
            'email' => 'required|email',
            'kategori' => 'required',
            'tags' => 'required',
            'deskripsi' => 'required',
            'gambarArtikel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $article = new artikels;
    
        $article->kodeArtikel = 'KKA' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
    
        $article->judulArtikel = $request->input('judulArtikel');
        $article->penulis = $request->input('penulis');
        $article->email = $request->input('email');
        $article->kategori = $request->input('kategori');
        
        // Convert array of tags to a string
        $tags = $request->input('tags');
        $tagsString = implode(',', $tags);
        $article->tags = $tagsString;
    
        $article->deskripsi = $request->input('deskripsi');
        $article->status = 'Pending';
    
        // Handle file upload
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
            $image->move(public_path('gambarArtikel'), $filename);
    
            // Set the image file name in the database
            $article->gambarArtikel = $filename;
        }        
    
        $article->save();
    

        return redirect('/artikelAdmin')->with('success', 'Article added successfully.');
    }
    

    //[Admin-Artikel] Edit Data Artikel
    function formEditArtikelA($id){
        $data = artikels::find($id);
        $kategoris = kategori::all();

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();
         
        return view('admin.FormAdmin.formEditArtikel', compact('kategoris','data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

    function updateArtikelA(Request $request, $id){
        $data = artikels::find($id);
    
        $data->judulArtikel = $request->input('judulArtikel');
        $data->email = $request->input('email');
        $data->penulis = $request->input('penulis');
        $data->kategori = $request->input('kategori');
        $data->tags = $request->input('tags');
        $data->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambarArtikel'), $filename);
        
            $data->gambarArtikel = $filename;
        }
    
        $data->save();
    
        return redirect()->route('artikel')->with('success','Data Berhasil di Update');
    }   

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Video] Halaman Tabel Video
    function videoAdmin(Request $request){

        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Start building the query without applying pagination
        $query = video::orderBy('created_at', 'desc');
    
        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('judulVideo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('uploader', 'like', '%' . $searchQuery . '%')
                    ->orWhere('statusVideo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('kategoriVideo', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // Now, paginate the results
        $tableVideo = $query->paginate(15);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.video', compact('tableVideo', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    //[Admin-Artikel] Halaman Komentar Artikel
    function komentarVideo(){
        $komenarV = komentar_video::orderBy('created_at', 'desc')->paginate(20);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.komentar.komentarVideo', compact('komenarV', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    

    //[Admin-Video] Halaman Tambah Video
    function formTambahVideo(){

        $kategoris = kategori::all();

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.FormAdmin.formTambahVideo', compact('kategoris','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    

    public function storeVideo(Request $request)
    {
       // Validate the request data
       $request->validate([
        'judulVideo' => 'required',
        'uploader' => 'required',
        'email' => 'required|email',
        'kategoriVideo' => 'required',
        'tagsVideo' => 'required|array', // Ensure it's an array
        'deskripsiVideo' => 'required',
        'linkVideo' => 'required|url', // Ensure the link is a valid URL
    ]);

    $videos = new Video;

    $videos->kodeVideo = 'KKV' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

    $videos->judulVideo = $request->input('judulVideo');
    $videos->uploader = $request->input('uploader');
    $videos->email = $request->input('email');
    $videos->kategoriVideo = $request->input('kategoriVideo');

    // Convert array of tags to a string
    $tagsVideo = implode(',', $request->input('tagsVideo'));
    $videos->tagsVideo = $tagsVideo;

    $videos->deskripsiVideo = $request->input('deskripsiVideo');
    $videos->linkVideo = $request->input('linkVideo');
    $videos->statusVideo = 'Pending';

    $videoId = '';

    // Extract the video ID from the YouTube link
    if (strpos($request->input('linkVideo'), 'youtube.com/watch?v=') !== false) {
        $videoId = explode('v=', parse_url($request->input('linkVideo'), PHP_URL_QUERY))[1];
    } elseif (strpos($request->input('linkVideo'), 'youtu.be/') !== false) {
        $videoId = explode('/', parse_url($request->input('linkVideo'), PHP_URL_PATH))[1];
    }

    if (!empty($videoId)) {
        $embedUrl = "https://www.youtube.com/embed/$videoId";
        $videos->linkVideo = $embedUrl; // Update the link to the embedded video
    } else {
        return redirect('/videoSuperAdmin')->with('error', 'Invalid YouTube video link.');
    }

    $videos->save();
    
        return redirect('/videoAdmin')->with('success', 'Video added successfully.');
    }
    

      //[Admin-Video] Halaman Edit Video
      function formEditVideo($id){
        $data = video::find($id);
        $kategoris = kategori::all();

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.FormAdmin.formEditVideo', compact('kategoris','data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    

    function updateVideo(Request $request, $id){
        $data = Video::find($id);
    
        $data->linkVideo = $request->input('linkVideo');
        $data->judulVideo = $request->input('judulVideo');
        $data->kategoriVideo = $request->input('kategoriVideo');
        $data->tagsVideo = $request->input('tagsVideo');
        $data->deskripsiVideo = $request->input('deskripsiVideo');
        
        $videoId = '';
    
        // Extract the video ID from the YouTube link
        if (strpos($request->input('linkVideo'), 'youtube.com/watch?v=') !== false) {
            $videoId = explode('v=', parse_url($request->input('linkVideo'), PHP_URL_QUERY))[1];
        } elseif (strpos($request->input('linkVideo'), 'youtu.be/') !== false) {
            $videoId = explode('/', parse_url($request->input('linkVideo'), PHP_URL_PATH))[1];
        }
    
        if (!empty($videoId)) {
            $embedUrl = "https://www.youtube.com/embed/$videoId";
            $data->linkVideo = $embedUrl; // Update the link to the embedded video
        } else {
            return redirect('/videoAdmin')->with('error', 'Invalid YouTube video link.');
        }
    
        $data->save();
    
        return redirect()->route('videoAdmin')->with('success','Data Berhasil di Update');
    }    
    
    //[Admin-Video] Delete Video
    function deleteVideo($id){
        $data = video::find($id);
    
        if ($data) {
            $data->delete();
            return redirect('/videoAdmin');
        } else {
            return redirect('/videoAdmin')->with('error', 'Video not found');
        }
    }
    

       
    //[Admin-Video] Delete Komentar Video
    function deleteKomentarVA($id){
        $data=komentar_video::find($id);
    
        if ($data) {
            $data->delete();
            return redirect('/komentarVideo');
        } else {
            return redirect('/komentarVideo')->with('error', 'Komentar not found');
        }
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Pengguna] Halaman Tabel Pengguna
    function listUserTerdaftar(Request $request){
        $role = $request->input('role'); 
        $searchQuery = $request->input('search'); 

        $users = User::orderBy('created_at', 'desc');

        // Jika ada filter role, tambahkan kondisi where
        if (!empty($role)) {
            $users->where('role', $role);
        }

        // Jika ada query pencarian, tambahkan kondisi where untuk mencocokkan nama pengguna atau informasi lainnya
        if (!empty($searchQuery)) {
            $users->where(function($query) use ($searchQuery) {
                $query->where('username', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%');
            });
        }

        $users = $users->paginate(10);
        
         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
         return view('admin.pengguna', compact('users', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
         'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    


//[Admin-Pengguna] Delete Pengguna
function deletePenggunaA($id)
{
    $user = User::find($id);

    if ($user) {
        if ($user->role === 'superadmin') {
            // Jika pengguna adalah superadmin, Anda dapat memberikan pesan kesalahan atau tindakan lain sesuai kebijakan aplikasi Anda.
            return redirect('pengguna')->with('error', 'Anda tidak dapat menghapus superadmin.');
        } else {
            $user->delete();
            return redirect('pengguna')->with('success', 'Pengguna berhasil dihapus.');
        }
    } else {
        // Handle jika pengguna tidak ditemukan.
        return redirect('pengguna')->with('error', 'Pengguna tidak ditemukan.');
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Ulasan] Halaman Tabel Ulasan 
    function ulasanAdmin(){
        $data1 = ulasans::orderBy('created_at', 'desc')->paginate(10);

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; 
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
    
        //Hitung Ulasan
        $totalUlasan = ulasans::count();

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        
        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.ulasans', compact('data1', 'averageRating', 'totalUlasan', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    //[Admin-Ulasan] Delete Ulasan
    function deleteUlasanA($id){
        $data=ulasans::find($id);
    
        if ($data) {
            $data->delete();
            return redirect('ulasans');
        } else {
            return redirect('ulasans')->with('error', 'Komentar not found');
        }
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Event
    function eventKomAd(){

        $event = Event::orderBy('created_at', 'desc')->paginate(10);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.eventKomunitas', compact('event', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

    //[Admin-Event] Delete Data Artikel
    function deleteEvent($id){
        $data=Event::find($id);
    
        if ($data) {
            $data->delete();
            return redirect('eventKomAd');
        } else {
            return redirect('eventKomAd')->with('error', 'Komentar not found');
        }
    }

     //[Admin-Event] Delete Komentar Artikel
    function deleteKomentarEvent($id){
        $data=komentar_artikel::find($id);
    
        if ($data) {
            $data->delete();
            return redirect('komentarArtikel');
        } else {
            return redirect('komentarArtikel')->with('error', 'Komentar not found');
        }
    }



    //[Admin-Event] Halaman Tambah Artikel
    public function formTambahEvent()
    {
         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.FormAdmin.formTambahEvent', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

    public function storeEvent(Request $request)
    {
         // Validate the request data
         $request->validate([
            'pembuatEvent' => 'required',
            'namaEvent' => 'required',
            'deskripsiEvent' => 'required',
            'tanggalEvent' => 'required',
            'jamEvent' => 'required',
            'lokasiEvent' => 'required',
            'informasiLebihLanjut' => 'required',
            'fotoEvent' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = new Event;

        $event->kodeEvent = 'KKE' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        $event->pembuatEvent = $request->input('pembuatEvent');
        $event->namaEvent = $request->input('namaEvent');
        $event->deskripsiEvent = $request->input('deskripsiEvent');
        $event->tanggalEvent = $request->input('tanggalEvent');
        $event->jamEvent = $request->input('jamEvent');
        $event->lokasiEvent = $request->input('lokasiEvent');
        $event->informasiLebihLanjut = $request->input('informasiLebihLanjut');
        $event->status = 'Pending';

        // Handle file upload
        if ($request->hasFile('fotoEvent')) {
            $image = $request->file('fotoEvent');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('fotoEvent'), $filename);
            $event->fotoEvent = $filename;
        }

        $event->save();

        return redirect('/eventKomAd')->with('success', 'Article added successfully.');
    }
    

    //[Admin-Event] Edit Data Artikel
    function formEditEvent($id){
        $data = Event::find($id);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();
         
        return view('admin.FormAdmin.formEditEvent', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    function updateEvent(Request $request, $id){
        $data = Event::find($id);
    
        if ($request->hasFile('gambarEvent')) {
            $image = $request->file('gambarEvent');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambarEvent'), $filename);
        
            $data->gambarEvent = $filename;
            $data->save();
        }

        $data->save();
    
        return redirect()->route('eventKomAd')->with('success','Data Berhasil di Update');
    }   

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Laporan User] 
    function laporanUser(){

        $laporanArtikelU = laporanArtikelUser::orderBy('created_at', 'desc')->paginate(10);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        
        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.laporan.laporanUser', compact('laporanArtikelU', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

        
    //[Admin-Laporan User] Delete Artikel User
        function deleteLaporanUA($id){
            $data1=laporanArtikelUser::find($id);
            $data1->delete();
            return redirect('/laporanUser');
        }

        //[Admin-Laporan User] Delete Artikel User
        function deleteLaporanVA($id){
            $data1=laporanVideoUser::find($id);
            $data1->delete();
            return redirect('/laporanVideoUser');
        }

    function laporanVideoUser(){

        $laporanVideoUser = LaporanVideoUser::orderBy('created_at', 'desc')->paginate(10);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.laporan.laporanVideoUser', compact('laporanVideoUser', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas'));
    }

}

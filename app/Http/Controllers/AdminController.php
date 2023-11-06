<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\EventKomunitas;
use App\Models\komentar_artikel;
use App\Models\komentar_event;
use App\Models\komentar_video;
use App\Models\Likes;
use App\Models\syaratdanketentuans;
use App\Models\ulasans;
use App\Models\user;
use App\Models\video;
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

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('Admin.profileA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
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

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
        

        return view('admin.dashboard', compact('totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo','kategoriArtikel','kategoriVideo','dataBaruEventKomunitas',  'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Artikel] Halaman Tables Artikel
    function artikel(){
        $data = artikels::orderBy('created_at', 'desc')->paginate(5);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.artikel', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
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

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.komentar.komentarArtikel', compact('komenarA', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }

    //[Admin-Artikel] Delete Data Artikel
    function deleteArtikel($id){
        $data=artikels::find($id);
        $data->delete();
        return redirect('/artikelAdmin');
    }

     //[Admin-Artikel] Delete Komentar Artikel
     function deleteKomentarAA($id){
        $data=komentar_artikel::find($id);
        $data->delete();
        return redirect('/komentarArtikel');
    }


    //[Admin-Artikel] Halaman Tambah Artikel
    public function create()
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

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.FormAdmin.formTambahArtikel', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas' ));
    }

    public function store(Request $request)
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
        $article->judulArtikel = $request->input('judulArtikel');
        $article->penulis = $request->input('penulis');
        $article->email = $request->input('email');
        $article->kategori = $request->input('kategori');
        $article->tags = $request->input('tags');
        $article->deskripsi = $request->input('deskripsi');
        $article->status = 'Pending';

        // Handle file upload
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('gambarArtikel'), $filename);
            $article->gambarArtikel = $filename;
        }

        $article->save();

        return redirect('/artikelAdmin')->with('success', 'Article added successfully.');
    }
    

    //[Admin-Artikel] Edit Data Artikel
    function tampilDataEditArtikel($id){
        $data = artikels::find($id);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 
         
        return view('admin.FormAdmin.formEditArtikel', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }

    function updateArtikel(Request $request, $id){
        $data = artikels::find($id);
    
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambarArtikel'), $filename);
        
            $data->gambarArtikel = $filename;
            $data->save();
        }

        $data->save();
    
        return redirect()->route('artikel')->with('success','Data Berhasil di Update');
    }   

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Video] Halaman Tabel Video
    function videoAdmin(){

        $tableVideo = video::orderBy('created_at', 'desc')->paginate(4);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.video', compact('tableVideo', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
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

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.komentar.komentarVideo', compact('komenarV', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }    

    //[Admin-Video] Halaman Tambah Video
    function formTambahVideo(){

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.FormAdmin.formTambahVideo', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }    

    public function storeVideo(Request $request)
    {
        // Validate the request data
        $request->validate([
            'judulVideo' => 'required',
            'uploader' => 'required',
            'email' => 'required|email',
            'kategoriVideo' => 'required',
            'tagsVideo' => 'required',
            'deskripsiVideo' => 'required',
            'linkVideo' => 'required|url',
        ]);
    
        $videos = new Video;
        $videos->judulVideo = $request->input('judulVideo');
        $videos->uploader = $request->input('uploader');
        $videos->email = $request->input('email');
        $videos->kategoriVideo = $request->input('kategoriVideo');
        $videos->tagsVideo = $request->input('tagsVideo');
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
            return redirect('/videoAdmin')->with('error', 'Invalid YouTube video link.');
        }
    
        $videos->save();
    
        return redirect('/videoAdmin')->with('success', 'Video added successfully.');
    }
    

      //[Admin-Video] Halaman Edit Video
      function formEditVideo($id){
        $data = video::find($id);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.FormAdmin.formEditVideo', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
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
        $data=video::find($id);
        $data->delete();
        return redirect('/videoAdmin');
    }

       
    //[Admin-Video] Delete Komentar Video
    function deleteKomentarVA($id){
        $data=komentar_video::find($id);
        $data->delete();
        return redirect('/komentarVideo');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Pengguna] Halaman Tabel Pengguna
    function listUserTerdaftar(Request $request){
        $role = $request->input('role'); // Mendapatkan nilai filter role dari request
        $users = user::orderBy('created_at', 'desc');
    
        // Jika ada filter role, tambahkan kondisi where
        if (!empty($role)) {
            $users->where('role', $role);
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

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 
    
         return view('admin.pengguna', compact('users', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
         'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }    


//[Admin-Pengguna] Delete Pengguna
function deleteUserTerdaftar($id)
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

        
        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.ulasans', compact('data1', 'averageRating', 'totalUlasan', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas', 'dataBaruKomentarEventKomunitas'));
    }

    //[Admin-Ulasan] Delete Ulasan
    function deleteUlasanA($id){
        $data1=ulasans::find($id);
        $data1->delete();
        return redirect('ulasans');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Event 
    function eventKomAd(){

        $event = EventKomunitas::orderBy('created_at', 'desc')->paginate(10);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.eventKomunitas', compact('event', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

     //[Admin-Event] Halaman Komentar Artikel
     function komentarEvent(){
        $komentarE = komentar_event::orderBy('created_at', 'desc')->paginate(20);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         
        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.komentar.komentarEvent', compact('komentarE', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 
        'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

    //[Admin-Event] Delete Data Artikel
    function deleteEvent($id){
        $data=EventKomunitas::find($id);
        $data->delete();
        return redirect('/eventKomAd');
    }

     //[Admin-Event] Delete Komentar Artikel
     function deleteKomentarEvent($id){
        $data=komentar_artikel::find($id);
        $data->delete();
        return redirect('/komentarArtikel');
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

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.FormAdmin.formTambahEvent', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

    public function storeEvent(Request $request)
    {
        // Validate the request data
        $request->validate([
            'pembuatEvent' => 'required',
            'namaEvent' => 'required',
            'deskripsiEvent' => 'required',
            'fotoEvent' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = new EventKomunitas;
        $event->pembuatEvent = $request->input('pembuatEvent');
        $event->namaEvent = $request->input('namaEvent');
        $event->deskripsiEvent = $request->input('deskripsiEvent');
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
        $data = EventKomunitas::find($id);

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count();
         
        return view('admin.FormAdmin.formEditEvent', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

    function updateEvent(Request $request, $id){
        $data = EventKomunitas::find($id);
    
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

        
        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.laporan.laporanUser', compact('laporanArtikelU', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
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

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.laporan.laporanVideoUser', compact('laporanVideoUser', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // [Syarat & Ketentuan] Halaman Tabel 
    public function syaratdanketentuan()
    {
        $data = syaratdanketentuans::all();

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

        return view('admin.term&Condition', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

    // [Syarat & Ketentuan] Form Tambah T&C
    function formTambahTdanC(){

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 
        
        return view('admin.FormAdmin.formTambahTdanC', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
    }

    function storeTdanC(Request $req){
            syaratdanketentuans::create([
                'judulsyarat' => $req->judulsyarat,
                'deskripsisyarat' => $req->deskripsisyarat,
            ]);
                 return redirect('/syaratdanketentuan');
         }

     // [Syarat & Ketentuan] Form Edit T&C
    function formEditTdanC($id){
            $data = syaratdanketentuans::find($id);

            // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
            $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
            $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
            $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

            $dataBaruEventKomunitas = EventKomunitas::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruKomentarEventKomunitas = komentar_event::where('created_at', '>=',    Carbon::now()->subDay())->count(); 

            return view('admin.FormAdmin.formEditTermOfCondition', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
            'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo',  'dataBaruEventKomunitas','dataBaruKomentarEventKomunitas'));
        }
    
    function updateTdanC(Request $request, $id){
            $data = syaratdanketentuans::find($id);
        
            $data->judulsyarat = $request->input('judulsyarat');
            $data->deskripsisyarat = $request->input('deskripsisyarat');
            $data->save();
        
            return redirect()->route('syaratdanketentuan')->with('success','Data Berhasil di Update');
        }  

    // [Syarat & Ketentuan] Delete T&C
    function deleteTdanC($id)
    {
        $data=syaratdanketentuans::find($id);
        $data->delete();
        return redirect('/syaratdanketentuan');
    }
}

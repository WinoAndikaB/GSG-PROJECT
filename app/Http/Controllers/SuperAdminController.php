<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\komentar_artikel;
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

class SuperAdminController extends Controller
{

    //[SuperAdmin-Profile] Profil User
    public function profileSA()
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

        return view('SuperAdmin.profileSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }  
  
    //[SuperAdmin-Profile] Edit Profil SuperAdmin
    public function updateSA(Request $request, $id)
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

        return redirect('/profileSA');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Dashboard] Halaman Dashboard
    function dashboardSA(){
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

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
        

        return view('SuperAdmin.dashboardSA', compact('totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Artikel] Halaman Tables Artikel
    function artikelSA(){
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

        return view('SuperAdmin.artikelSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Artikel] Halaman Komentar Artikel
      function komentarArtikelSA(){
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

        return view('SuperAdmin.komentarArtikelSA', compact('komenarA', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Artikel] Delete Data Artikel
    function deleteArtikelSA($id){
        $data=artikels::find($id);
        $data->delete();
        return redirect('/artikelSuperAdmin');
    }

     //[SuperAdmin-Artikel] Delete Komentar Artikel
     function deleteKomentarSA($id){
        $data=komentar_artikel::find($id);
        $data->delete();
        return redirect('/komentarArtikelSA');
    }


    //[SuperAdmin-Artikel] Halaman Tambah Artikel
    public function createSA()
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

        return view('SuperAdmin.FormSuperAdmin.formTambahArtikelSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    public function storeSA(Request $request)
    {
        // Validate the request data
        $request->validate([
            'judulArtikel' => 'required',
            'penulis' => 'required',
            'email' => 'required|email',
            'kategori' => 'required',
            'tags' => 'required',
            'deskripsi' => 'required',
            'gambarArtikel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size
        ]);
    
        $article = new artikels;
        $article->judulArtikel = $request->input('judulArtikel');
        $article->penulis = $request->input('penulis');
        $article->email = $request->input('email');
        $article->kategori = $request->input('kategori');
        $article->tags = $request->input('tags');
        $article->deskripsi = $request->input('deskripsi');
    
        // Handle file upload
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
            $image->move(public_path('gambarArtikel'), $filename);
            
            // Set the image file name in the database
            $article->gambarArtikel = $filename;
        }
    
        $article->save();
    
        return redirect('/artikelSuperAdmin')->with('success', 'Article added successfully.');
    }      

    //[SuperAdmin-Artikel] Edit Data Artikel
    function formEditArtikelSA($id){
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
         
        return view('SuperAdmin.FormSuperAdmin.formEditArtikelSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    function updateArtikelSA(Request $request, $id){
        $data = artikels::find($id);
    
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambarArtikel'), $filename);
        
            $data->gambarArtikel = $filename;
            $data->save();
        }

        $data->save();
    
        return redirect()->route('artikelSA')->with('success','Data Berhasil di Update');
    }   

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Video] Halaman Tabel Video
    function videoSuperAdmin(){

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

        return view('SuperAdmin.videoSA', compact('tableVideo', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Artikel] Halaman Komentar Artikel
    function komentarVideoSA(){
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

        return view('SuperAdmin.komentarVideoSA', compact('komenarV', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }    

    //[SuperAdmin-Video] Halaman Tambah Video
    function formTambahVideoSA(){

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.FormSuperAdmin.formTambahVideoSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }    

    public function storeVideoSA(Request $request)
    {
        // Validate the request data
        $request->validate([
            'judulVideo' => 'required',
            'uploader' => 'required',
            'email' => 'required|email',
            'kategoriVideo' => 'required',
            'tagsVideo' => 'required',
            'deskripsiVideo' => 'required',
            'linkVideo' => 'required|url', // Ensure the link is a valid URL
        ]);
    
        $videos = new Video;
        $videos->judulVideo = $request->input('judulVideo');
        $videos->uploader = $request->input('uploader');
        $videos->email = $request->input('email');
        $videos->kategoriVideo = $request->input('kategoriVideo');
        $videos->tagsVideo = $request->input('tagsVideo');
        $videos->deskripsiVideo = $request->input('deskripsiVideo');
        $videos->linkVideo = $request->input('linkVideo'); // Store the original video link
    
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
    
        return redirect('/videoSuperAdmin')->with('success', 'Video added successfully.');
    }
    

      //[SuperAdmin-Video] Halaman Edit Video
      function formEditVideoSA($id){
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

        return view('SuperAdmin.FormSuperAdmin.formEditVideoSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }    

    function updateVideoSA(Request $request, $id){
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
            return redirect('/videoSuperAdmin')->with('error', 'Invalid YouTube video link.');
        }
    
        $data->save();
    
        return redirect()->route('videoSuperAdmin')->with('success','Data Berhasil di Update');
    }    
    
    //[SuperAdmin-Video] Delete Video
    function deleteVideoSA($id){
        $data=video::find($id);
        $data->delete();
        return redirect('/videoSuperAdmin');
    }

       
    //[SuperAdmin-Video] Delete Komentar Video
    function deleteKomentarVideoSA($id){
        $data=komentar_video::find($id);
        $data->delete();
        return redirect('/komentarVideoSA');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Pengguna] Halaman Tabel Pengguna
    function penggunaSA(Request $request){
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
    
         return view('SuperAdmin.penggunaSA', compact('users', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
         'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
    }    
    

    //[SuperAdmin-Pengguna] Tambah Pengguna
    function formTambahUserAdmSA(){
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.FormSuperAdmin.formTambahUserSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }    

    function registerSuperAdminSA(Request $req){
            user::create([
                'username' => $req->username,
                 'name' => $req->name,
                 'email' => $req->email,
                 'password' => bcrypt($req->password),
                 'role' => 'superadmin',
            ]);
                 return redirect('penggunaSA');
         }

    //[SuperAdmin-Pengguna] Delete Pengguna
    function deleteSA($id)
    {
        $data=user::find($id);
        $data->delete();
        return redirect('penggunaSA');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Ulasan] Halaman Tabel Ulasan 
    function ulasansSA(){
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

        return view('SuperAdmin.ulasansSA', compact('data1', 'averageRating', 'totalUlasan', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Ulasan] Delete Ulasan
    function deleteUlasanSA($id){
        $data1=ulasans::find($id);
        $data1->delete();
        return redirect('ulasansSA');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Laporan User] 
    function laporanUserSA(){

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

        return view('SuperAdmin.laporan.laporanUserSA', compact('laporanArtikelU', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

        
    //[SuperAdmin-Laporan User] Delete Artikel User
        function deleteLaporanArtikelSA($id){
            $data1=laporanArtikelUser::find($id);
            $data1->delete();
            return redirect('/laporanUserSA');
        }

        //[SuperAdmin-Laporan User] Delete Artikel User
        function deleteLaporanVideoSA($id){
            $data1=laporanVideoUser::find($id);
            $data1->delete();
            return redirect('/laporanVideoUserSA');
        }

    function laporanVideoUserSA(){

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

        return view('SuperAdmin.laporan.laporanVideoUserSA', compact('laporanVideoUser', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // [Syarat & Ketentuan] Halaman Tabel 
    public function syaratdanketentuanSA()
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

        return view('SuperAdmin.term&ConditionSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    // [Syarat & Ketentuan] Form Tambah T&C
    function formTambahTdanCSA(){

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
        return view('SuperAdmin.FormSuperAdmin.formTambahTdanCSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    function storeTdanCSA(Request $req) {
        $validatedData = $req->validate([
            'judulsyarat' => 'required',
            'deskripsisyarat' => 'required',
        ]);
    
        syaratdanketentuans::create([
            'judulsyarat' => $validatedData['judulsyarat'],
            'deskripsisyarat' => $validatedData['deskripsisyarat'],
        ]);
    
        return redirect('/syaratdanketentuanSA');
    }

     // [Syarat & Ketentuan] Form Edit T&C
    function formEditTdanCSA($id){
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

            return view('SuperAdmin.FormSuperAdmin.formEditTermOfConditionSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
            'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
        }
    
    function updateTdanCSA(Request $request, $id){
            $data = syaratdanketentuans::find($id);
        
            $data->judulsyarat = $request->input('judulsyarat');
            $data->deskripsisyarat = $request->input('deskripsisyarat');
            $data->save();
        
            return redirect()->route('syaratdanketentuanSA')->with('success','Data Berhasil di Update');
        }  

    // [Syarat & Ketentuan] Delete T&C
    function deleteTdanCSA($id)
    {
        $data=syaratdanketentuans::find($id);
        $data->delete();
        return redirect('/syaratdanketentuanSA');
    }
}

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
        

        return view('SuperAdmin.dashboard', compact('totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Artikel] Halaman Tables Artikel
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

        return view('SuperAdmin.artikel', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Artikel] Halaman Komentar Artikel
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

        return view('SuperAdmin.komentarArtikel', compact('komenarA', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Artikel] Delete Data Artikel
    function deleteArtikel($id){
        $data=artikels::find($id);
        $data->delete();
        return redirect('/artikelAdmin');
    }

     //[SuperAdmin-Artikel] Delete Komentar Artikel
     function deleteKomentarAA($id){
        $data=komentar_artikel::find($id);
        $data->delete();
        return redirect('/komentarArtikel');
    }


    //[SuperAdmin-Artikel] Halaman Tambah Artikel
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

        return view('SuperAdmin.FormSuperAdmin.formTambahArtikel', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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
         
        return view('SuperAdmin.FormSuperAdmin.formEditArtikel', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

        return view('SuperAdmin.video', compact('tableVideo', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Artikel] Halaman Komentar Artikel
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

        return view('SuperAdmin.komentarVideo', compact('komenarV', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }    

    //[SuperAdmin-Video] Halaman Tambah Video
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

        return view('SuperAdmin.FormSuperAdmin.formTambahVideo', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

        return view('SuperAdmin.FormSuperAdmin.formEditVideo', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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
            return redirect('/videoSuperAdmin')->with('error', 'Invalid YouTube video link.');
        }
    
        $data->save();
    
        return redirect()->route('videoSuperAdmin')->with('success','Data Berhasil di Update');
    }    
    
    //[SuperAdmin-Video] Delete Video
    function deleteVideo($id){
        $data=video::find($id);
        $data->delete();
        return redirect('/videoSuperAdmin');
    }

       
    //[SuperAdmin-Video] Delete Komentar Video
    function deleteKomentarVA($id){
        $data=komentar_video::find($id);
        $data->delete();
        return redirect('/komentarVideo');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Pengguna] Halaman Tabel Pengguna
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
    
         return view('SuperAdmin.pengguna', compact('users', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
         'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
    }    
    

    //[SuperAdmin-Pengguna] Fungsi Like & Dislike
    public function likes()
    {
        return $this->hasMany(Likes::class, 'user_id', 'id');
    }

    public function dislikes()
    {
        return $this->hasMany(Dislikes::class, 'user_id', 'id');
    }


    //[SuperAdmin-Pengguna] Tambah Pengguna
    function formTambahUserAdm(){
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.FormSuperAdmin.formTambahUserAdm', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }    

    function registerSuperAdmin(Request $req){
            user::create([
                'username' => $req->username,
                 'name' => $req->name,
                 'email' => $req->email,
                 'password' => bcrypt($req->password),
                 'role' => 'SuperAdmin',
            ]);
                 return redirect('pengguna');
         }

    //[SuperAdmin-Pengguna] Delete Pengguna
    function deleteUserTerdaftar($id)
    {
        $data=user::find($id);
        $data->delete();
        return redirect('pengguna');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Ulasan] Halaman Tabel Ulasan 
    function ulasanSuperAdmin(){
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

        return view('SuperAdmin.ulasans', compact('data1', 'averageRating', 'totalUlasan', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    //[SuperAdmin-Ulasan] Delete Ulasan
    function deleteUlasanA($id){
        $data1=ulasans::find($id);
        $data1->delete();
        return redirect('ulasans');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Laporan User] 
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

        return view('SuperAdmin.laporan.laporanUser', compact('laporanArtikelU', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

        
    //[SuperAdmin-Laporan User] Delete Artikel User
        function deleteLaporanUA($id){
            $data1=laporanArtikelUser::find($id);
            $data1->delete();
            return redirect('/laporanUser');
        }

        //[SuperAdmin-Laporan User] Delete Artikel User
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

        return view('SuperAdmin.laporan.laporanVideoUser', compact('laporanVideoUser', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

        return view('SuperAdmin.term&Condition', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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
        
        return view('SuperAdmin.FormSuperAdmin.formTambahTdanC', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

            return view('SuperAdmin.FormSuperAdmin.formEditTermOfCondition', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
            'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

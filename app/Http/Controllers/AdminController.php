<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\komentar_artikel;
use App\Models\komentar_video;
use App\Models\Likes;
use App\Models\syaratdanketentuans;
use App\Models\user;
use App\Models\video;
use App\Models\Follower;
use App\Models\kategori;
use App\Models\laporanArtikelUser;
use App\Models\laporanKomentarArtikelUser;
use App\Models\laporanKomentarVideoUser;
use App\Models\LaporanVideoUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    //[Admin-Profile] Profil User
    public function profileAdmin()
    {
        $user = Auth::user();
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();  
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        // Menghitung total user_id yang sama dengan user auth
        $TotalArtikelId = artikels::where('user_id', $user->id)->count();
        $TotalVideoId = video::where('user_id', $user->id)->count();

        $totalFollowers = Follower::where('user_id', $user->id)->count();
    
        return view('Admin.profileA', compact('dataBaruKomentarArtikel', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'TotalArtikelId','TotalVideoId','totalFollowers'));
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

    function dashboard()
    {
        $totalArtikel = artikels::count();
        $totalVideo = video::count();
        $totalLaporanArtikel = laporanArtikelUser::count();
        $totalLaporanVideo = laporanVideoUser::count();
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        // Menghitung jumlah user_id yang sama pada setiap model
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        $kategoriArtikel = Artikels::select('kategori', Artikels::raw('count(*) as total'))->groupBy('kategori')->get();
        $kategoriVideo = Video::select('kategoriVideo', Video::raw('count(*) as total'))->groupBy('kategoriVideo')->get();
        
        return view('admin.dashboard', compact(
            'totalArtikel', 'totalVideo', 'totalLaporanArtikel', 'totalLaporanVideo',
            'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
            'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'kategoriArtikel', 'kategoriVideo',
            'totalUserArtikel', 'totalUserVideo'
        ));
    }
    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Artikel] Halaman Tables Artikel
    function artikel(Request $request){
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Get the search query from the request
        $searchQuery = $request->input('search');
    
        // Start building the query without applying pagination
        $query = artikels::where('user_id', $userId)->orderBy('created_at', 'desc');
    
        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('judulArtikel', 'like', '%' . $searchQuery . '%')
                    ->orWhere('penulis', 'like', '%' . $searchQuery . '%')
                    ->orWhere('status', 'like', '%' . $searchQuery . '%')
                    ->orWhere('kategori', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // Count the total number of articles
        $totalDataArtikel = $query->count();
    
        // Now, paginate the results
        $data = $query->paginate(15);
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();

        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        return view('admin.artikel', compact('data', 'totalDataArtikel', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
    }
    


    //[Admin-Artikel] Halaman Komentar Artikel
    function komentarArtikel(){
        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Dapatkan artikel yang dibuat oleh pengguna itu sendiri
        $artikels = artikels::where('user_id', $userId)->pluck('id');
    
        // Ambil semua komentar yang terkait dengan artikel-artikel tersebut
        $komentarA = komentar_artikel::whereIn('artikel_id', $artikels)->orderBy('created_at', 'desc')->paginate(20);
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
 
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        return view('admin.komentar.komentarArtikel', compact('komentarA','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'totalUserArtikel','totalUserVideo'));
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
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();


        return view('admin.FormAdmin.formTambahArtikel', compact('kategoris','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
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
    
        // Get the currently authenticated user
        $user = Auth::user();
        $userId = $user->id; // Get the user_id
    
        $article = new artikels;
    
        $article->kodeArtikel = 'KKA' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        $article->user_id = $userId; // Assign the user_id
    
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
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
         
        return view('admin.FormAdmin.formEditArtikel', compact('kategoris','data','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
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
        // Get the ID of the authenticated user
        $userId = Auth::id();
    
        // Get the search query from the request
        $searchQuery = $request->input('search');
    
        // Start building the query without applying pagination
        $query = video::where('user_id', $userId)->orderBy('created_at', 'desc');
    
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
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        return view('admin.video', compact('tableVideo','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
    }
    

    //[Admin-Artikel] Halaman Komentar Artikel
    function komentarVideo(){
        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Dapatkan video yang dibuat oleh pengguna itu sendiri
        $videos = video::where('user_id', $userId)->pluck('id');
    
        // Ambil semua komentar yang terkait dengan video-video tersebut
        $komentarV = komentar_video::whereIn('video_id', $videos)->orderBy('created_at', 'desc')->paginate(20);
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();

        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        return view('admin.komentar.komentarVideo', compact('komentarV','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
    }
    

    //[Admin-Video] Halaman Tambah Video
    function formTambahVideo(){

        $kategoris = kategori::all();

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
         $totalUserVideo = video::where('user_id', auth()->user()->id)->count();

        return view('admin.FormAdmin.formTambahVideo', compact('kategoris','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
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
    
        // Get the ID of the authenticated user
        $userId = Auth::id();
    
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
    
        // Associate the video with the authenticated user
        $videos->user_id = $userId;
    
        $videos->save();
        
        return redirect('/videoAdmin')->with('success', 'Video added successfully.');
    }    

      //[Admin-Video] Halaman Edit Video
      function formEditVideo($id){
        $data = video::find($id);
        $kategoris = kategori::all();

         // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
         $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
 
         $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
         $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

         $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
         $totalUserVideo = video::where('user_id', auth()->user()->id)->count();

        return view('admin.FormAdmin.formEditVideo', compact('kategoris','data','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
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

    //[Admin-Laporan User] 
    function laporanUser(){

        $laporanArtikelU = laporanArtikelUser::orderBy('created_at', 'desc')->paginate(10);

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();

        return view('admin.laporan.laporanUser', compact('laporanArtikelU','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
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
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();

        return view('admin.laporan.laporanVideoUser', compact('laporanVideoUser','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','totalUserArtikel','totalUserVideo'));
    }

}

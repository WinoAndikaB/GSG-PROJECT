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
use App\Models\LaporanKomentarArtikel;
use App\Models\laporanKomentarVideo;
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

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.profileSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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

        $superadminCount = User::where('role', 'superadmin')->count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

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
        

        return view('SuperAdmin.dashboardSA', compact('superadminCount','adminCount','userCount','totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo','kategoriArtikel','kategoriVideo', 'dataBaruEventKomunitas'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Artikel] Halaman Tables Artikel
    function artikelSA(Request $request){
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

        $pendingArticles = artikels::where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(5);
        $publishedArticles = artikels::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(5);

        return view('SuperAdmin.artikelSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'pendingArticles', 'publishedArticles', 'dataBaruEventKomunitas'));
    }

    public function approveArticle($id)
    {
        $article = artikels::find($id);
        if ($article) {
            $article->status = 'Published';
            $article->save();
            return redirect()->back()->with('success', 'Article approved and published.');
        }
    }

    public function rejectArticle($id)
    {
        $article = artikels::find($id);
        if ($article) {
            $article->status = 'Rejected';
            $article->save();
            return redirect()->back()->with('success', 'Article rejected.');
        }
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

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.komentarSA.komentarArtikelSA', compact('komenarA', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    //[SuperAdmin-Artikel] Delete Data Artikel
    function deleteArtikelSA($id){
        // Find the article record with the given ID
        $data = artikels::find($id);

        // Check if the article record exists
        if ($data) {
            // If the article record exists, delete it
            $data->delete();
            return redirect('/artikelSuperAdmin')->with('success', 'Article deleted successfully');
        } else {
            // If the article record does not exist, redirect with an error message
            return redirect('/artikelSuperAdmin')->with('error', 'Article not found');
        }
    }

    //[SuperAdmin-Artikel] Delete Komentar Artikel
    function deleteKomentarSA($id){
        // Find the comment record with the given ID
        $data = komentar_artikel::find($id);

        // Check if the comment record exists
        if ($data) {
            // If the comment record exists, delete it
            $data->delete();
            return redirect('/komentarArtikelSA')->with('success', 'Comment deleted successfully');
        } else {
            // If the comment record does not exist, redirect with an error message
            return redirect('/komentarArtikelSA')->with('error', 'Comment not found');
        }
    }


    //[SuperAdmin-Artikel] Halaman Tambah Artikel
    public function createSA()
    {

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

        return view('SuperAdmin.FormSuperAdmin.formTambahArtikelSA', compact('kategoris','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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
    
        return redirect('/artikelSuperAdmin')->with('success', 'Article added successfully.');
    }
    
    //[SuperAdmin-Artikel] Edit Data Artikel
    function formEditArtikelSA($id){
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
         
        return view('SuperAdmin.FormSuperAdmin.formEditArtikelSA', compact('data', 'kategoris', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    function updateArtikelSA(Request $request, $id)
    {
        $data = artikels::find($id);
    
        $data->judulArtikel = $request->input('judulArtikel');
        $data->penulis = $request->input('penulis');
        $data->email = $request->input('email');
        $data->kategori = $request->input('kategori');
    
        // Convert array of tags to a string
        $tags = $request->input('tags');
        $tagsString = implode(',', $tags);
        $data->tags = $tagsString;
    
        $data->deskripsi = $request->input('deskripsi');
    
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('gambarArtikel'), $filename);
            $data->gambarArtikel = $filename;
        }
    
        $data->save();
    
        return redirect()->route('artikelSA')->with('success', 'Data Berhasil di Update');
    }
    


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Video] Halaman Tabel Video
    function videoSuperAdmin(Request $request){

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

        return view('SuperAdmin.videoSA', compact('tableVideo', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    public function approveVideo($id)
    {
        $video = video::find($id);
        if ($video) {
            $video->statusVideo = 'Published';
            $video->save();
            return redirect()->back()->with('success', 'Article approved and published.');
        }
    }

    public function rejectVideo($id)
    {
        $video = video::find($id);
        if ($video) {
            $video->statusVideo = 'Rejected';
            $video->save();
            return redirect()->back()->with('success', 'Article rejected.');
        }
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

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.komentarSA.komentarVideoSA', compact('komenarV', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    

    //[SuperAdmin-Video] Halaman Tambah Video
    function formTambahVideoSA(){

        $kategoriV = kategori::all();

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

        return view('SuperAdmin.FormSuperAdmin.formTambahVideoSA', compact('kategoriV','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel',
'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    

    public function storeVideoSA(Request $request)
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
    
        return redirect('/videoSuperAdmin')->with('success', 'Video added successfully.');
    }
    
    

      //[SuperAdmin-Video] Halaman Edit Video
      function formEditVideoSA($id){
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

        return view('SuperAdmin.FormSuperAdmin.formEditVideoSA', compact('data', 'kategoris', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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
        // Find the record with the given ID
        $data = video::find($id);

        // Check if the record exists
        if ($data) {
            // If the record exists, delete it
            $data->delete();
            return redirect('/videoSuperAdmin')->with('success', 'Video deleted successfully');
        } else {
            // If the record does not exist, redirect with an error message
            return redirect('/videoSuperAdmin')->with('error', 'Video not found');
        }
    }

       
    //[SuperAdmin-Video] Delete Komentar Video
    function deleteKomentarVideoSA($id){
        // Find the comment record with the given ID
        $data = komentar_video::find($id);

        // Check if the comment record exists
        if ($data) {
            // If the comment record exists, delete it
            $data->delete();
            return redirect('/komentarVideoSA')->with('success', 'Comment deleted successfully');
        } else {
            // If the comment record does not exist, redirect with an error message
            return redirect('/komentarVideoSA')->with('error', 'Comment not found');
        }
    }


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Event]
    function eventKomAdSA(){

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

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('superAdmin.eventKomunitasSA', compact('event', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

    public function approveEvent($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->status = 'Published';
            $event->save();
            return redirect()->back()->with('success', 'Event approved and published.');
        }
    }

    public function rejectEvent($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->status = 'Rejected';
            $event->save();
            return redirect()->back()->with('success', 'Event rejected.');
        }
    }

    //[SuperAdmin-Event] Delete Data Artikel
    function deleteEventSA($id){
        $data=Event::find($id);
        $data->delete();
        return redirect('/eventKomAdSA');
    }

     //[SuperAdmin-Event] Delete Komentar Artikel
     function deleteKomentarEventSA($id){
        $data=komentar_artikel::find($id);
        $data->delete();
        return redirect('/komentarArtikel');
    }


    //[SuperAdmin-Event] Halaman Tambah Artikel
    public function formTambahEventSA()
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

        return view('superAdmin.FormSuperAdmin.formTambahEventSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

    public function storeEventSA(Request $request)
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

        return redirect('/eventKomAdSA')->with('success', 'Article added successfully.');
    }
    

    //[SuperAdmin-Event] Edit Data Artikel
    function formEditEventSA($id){
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

         
        return view('superAdmin.FormSuperAdmin.formEditEventSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    function updateEventSA(Request $request, $id){
        $data = Event::find($id);
    
        if ($request->hasFile('gambarEvent')) {
            $image = $request->file('gambarEvent');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambarEvent'), $filename);
        
            $data->gambarEvent = $filename;
            $data->save();
        }

        $data->save();
    
        return redirect()->route('eventKomAdSA')->with('success','Data Berhasil di Update');
    }   


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Kategori]
    function kategoriTblSA(){

        $kategori = kategori::orderBy('created_at', 'desc')->paginate(10);

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

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('superAdmin.kategoriSA', compact('kategori', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

//[SuperAdmin-Kategori] Delete Data Kategori
function deleteKategoriSA($id){
    // Find the record with the given ID
    $data = kategori::find($id);

    // Check if the record exists
    if ($data) {
        // If the record exists, delete it
        $data->delete();
        return redirect('/kategoriTblSA')->with('success', 'Kategori deleted successfully');
    } else {
        // If the record does not exist, redirect with an error message
        return redirect('/kategoriTblSA')->with('error', 'Kategori not found');
    }
}


    //[SuperAdmin-Kategori] Halaman Tambah Kategori
    public function formTambahKategoriSA()
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

        return view('superAdmin.FormSuperAdmin.formTambahKategoriSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruEventKomunitas'));
    }

    public function storeKategorioSA(Request $request)
    {
        $request->validate([
            'fotoKategori' => 'required',
            'pembuat' => 'required',
            'email' => 'required',
            'kategori' => 'required',
            'deskripsiKategori' => 'required',
            'fotoKategori' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ktgr = new kategori;

        $ktgr->pembuat = $request->input('pembuat');
        $ktgr->email = $request->input('email');
        $ktgr->kategori = $request->input('kategori');
        $ktgr->deskripsiKategori = $request->input('deskripsiKategori');

        if ($request->hasFile('fotoKategori')) {
            $image = $request->file('fotoKategori');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('fotoKategori'), $filename);
            $ktgr->fotoKategori = $filename;
        }

        $ktgr->save();

        return redirect('/kategoriTblSA')->with('success', 'Article added successfully.');
    }
    

    //[SuperAdmin-Kategori] Edit Data Kategori
    function formEditKategoriSA($id){
        $data = kategori::find($id);

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

         
        return view('superAdmin.FormSuperAdmin.formEditKategoriSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    function updateKategoriSA(Request $request, $id){

        $data = kategori::find($id);
    
        $data->pembuat = $request->input('pembuat');
        $data->email = $request->input('email');
        $data->kategori = $request->input('kategori');
        $data->deskripsiKategori = $request->input('deskripsi');

        if ($request->hasFile('fotoKategori')) {
            $image = $request->file('fotoKategori');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('fotoKategori'), $filename);
        
            $data->fotoKategori = $filename;
        }
    
        $data->save();
    
        return redirect()->route('kategoriTblSA')->with('success','Data Berhasil di Update');
    }   
    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Pengguna] Halaman Tabel Pengguna
    function penggunaSA(Request $request){
        $role = $request->input('role'); // Mendapatkan nilai filter role dari request
        $searchQuery = $request->input('search'); // Mendapatkan nilai query pencarian dari request
    
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
                // Add more fields as needed
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
         
    
         return view('SuperAdmin.penggunaSA', compact('users', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
         'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }  
    
    //[SuperAdmin-Pengguna] Promote-Demote Pengguna
    public function promoteUser($id) {
        $user = User::find($id);
        if ($user && auth()->user()->role == 'superadmin') {
            $user->role = 'superadmin';
            $user->save();
        } else {
        }
        return redirect()->back();
    }
    
    public function demoteUser($id) {
        $user = User::find($id);
        if ($user && auth()->user()->role == 'superadmin') {
            $user->role = 'admin';
            $user->save();
        } else {
        }
        return redirect()->back();
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

         $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.FormSuperAdmin.formTambahUserSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }    

    function registerSuperAdminSA(Request $req){
            user::create([
                'username' => $req->username,
                 'name' => $req->name,
                 'email' => $req->email,
                 'password' => bcrypt($req->password),
                 'role' => $req->role,
            ]);
                 return redirect('penggunaSA');
         }

    //[SuperAdmin-Pengguna] Delete Pengguna
    function deletePenggunaSA($id)
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

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.ulasansSA', compact('data1', 'averageRating', 'totalUlasan', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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
        $LaporanKomentarArtikel  = LaporanKomentarArtikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.laporan.laporanUserSA', compact('laporanArtikelU', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'LaporanKomentarArtikel', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

        //[SuperAdmin-Laporan User] Delete Artikel User
        function deleteLaporanArtikelSA($id){
            // Find the reported article record with the given ID
            $data = laporanArtikelUser::find($id);

            // Check if the reported article record exists
            if ($data) {
                // If the reported article record exists, delete it
                $data->delete();
                return redirect('/laporanUserSA')->with('success', 'Reported article deleted successfully');
            } else {
                // If the reported article record does not exist, redirect with an error message
                return redirect('/laporanUserSA')->with('error', 'Reported article not found');
            }
        }

        function laporanKomentarArtikelUserSA(){

            $laporanKomentarArtikelU = LaporanKomentarArtikel::orderBy('created_at', 'desc')->paginate(10);
    
            // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
            $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
            $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
            $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $LaporanKomentarArtikel = LaporanKomentarArtikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
            $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
            $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();
    
            return view('SuperAdmin.laporan.laporanKomentarUserSA', compact('laporanKomentarArtikelU', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
            'dataBaruVideo', 'dataBaruKomentarVideo', 'LaporanKomentarArtikel', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
        }

        //[SuperAdmin-Laporan User] Delete Artikel User
        function deleteLaporanVideoSA($id){
            // Find the reported video record with the given ID
            $data = laporanVideoUser::find($id);

            // Check if the reported video record exists
            if ($data) {
                // If the reported video record exists, delete it
                $data->delete();
                return redirect('/laporanVideoUserSA')->with('success', 'Reported video deleted successfully');
            } else {
                // If the reported video record does not exist, redirect with an error message
                return redirect('/laporanVideoUserSA')->with('error', 'Reported video not found');
            }
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
        $LaporanKomentarArtikel = LaporanKomentarArtikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.laporan.laporanVideoUserSA', compact('laporanVideoUser', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'LaporanKomentarArtikel', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('SuperAdmin.syaratdanketentuanSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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

        $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
        return view('SuperAdmin.FormSuperAdmin.formTambahTdanCSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
    }

    function storeTdanCSA(Request $request){

            $request->validate([
                'judulsyarat' => 'required',
                'deskripsisyarat' => 'required',
            ]);
    
            $syarat = new syaratdanketentuans;
    
            $syarat->judulsyarat = $request->input('judulsyarat');
            $syarat->deskripsisyarat = $request->input('deskripsisyarat');
    
            $syarat->save();

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

            $dataBaruEventKomunitas = Event::where('created_at', '>=',    Carbon::now()->subDay())->count();

            return view('SuperAdmin.FormSuperAdmin.formEditTermOfConditionSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
            'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'dataBaruEventKomunitas'));
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
        // Find the T&C record with the given ID
        $data = syaratdanketentuans::find($id);

        // Check if the T&C record exists
        if ($data) {
            // If the T&C record exists, delete it
            $data->delete();
            return redirect('/syaratdanketentuanSA')->with('success', 'T&C deleted successfully');
        } else {
            // If the T&C record does not exist, redirect with an error message
            return redirect('/syaratdanketentuanSA')->with('error', 'T&C not found');
        }
    }
}

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

class AdminController extends Controller
{

    //[Admin-Profile] Profil User
    public function profileAdmin()
    {
        
        return view('Admin.profileA');
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
        $dataAddedInLast24HoursUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataAddedInLast24HoursUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataAddedInLast24HoursArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataAddedInLast24HoursKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
        

        return view('admin.dashboard', compact('totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataAddedInLast24HoursUlasan','dataAddedInLast24HoursUser','dataAddedInLast24HoursArtikel','dataAddedInLast24HoursKomentarArtikel'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Artikel] Halaman Tables Artikel
    function artikel(){
        $data = artikels::orderBy('created_at', 'desc')->paginate(5);

        $dataAddedInLast24HoursKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataAddedInLast24HoursArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.artikel', compact('data','dataAddedInLast24HoursKomentarArtikel','dataAddedInLast24HoursArtikel'));
    }

    //[Admin-Artikel] Halaman Komentar Artikel
      function komentarArtikel(){
        $komenarA = komentar_artikel::orderBy('created_at', 'desc')->paginate(20);

        $dataAddedInLast24HoursKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataAddedInLast24HoursArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.komentarArtikel', compact('komenarA','dataAddedInLast24HoursArtikel','dataAddedInLast24HoursKomentarArtikel'));
    }

    //[Admin-Artikel] Delete Data Artikel
    function deleteArtikel($id){
        $data=artikels::find($id);
        $data->delete();
        return redirect('/artikelAdmin');
    }

    //[Admin-Artikel] Halaman Tambah Artikel
    public function create()
    {
        return view('admin.FormAdmin.formTambahArtikel');
    }

    public function store(Request $request)
    {
        $article = new artikels;
        $article->judulArtikel = $request->input('judulArtikel');
        $article->penulis = $request->input('penulis');
        $article->email = $request->input('email');
        $article->kategori = $request->input('kategori');
        $article->tags = $request->input('tags');
        $article->deskripsi = $request->input('deskripsi');
    
        // Handle file upload
        if ($request->hasFile('gambarArtikel')) {
            $file = $request->file('gambarArtikel');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('your_upload_folder', $fileName, 'public'); 
    
            $article->gambarArtikel = $fileName;
        }
    
        $article->save();
    
        return redirect('/artikelAdmin')->with('success', 'Article added successfully.');
    }
    

    //[Admin-Artikel] Edit Data Artikel
    function tampilDataEditArtikel($id){
        $data = artikels::find($id);
        return view('admin.FormAdmin.formEditArtikel', compact('data'));
    }

    function updateDataIdArtikel(Request $request, $id){
        $data = artikels::find($id);
        $data->update($request->all());
    
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambarArtikel'), $filename);
        
            $data->gambarArtikel = $filename;
            $data->save();
        }
    
        return redirect()->route('dataArtikel')->with('success','Data Berhasil di Update');
    }    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Video] Halaman Tabel Video
    function videoAdmin(){

        $tableVideo = video::orderBy('created_at', 'desc')->paginate(4);

        $dataAddedInLast24HoursKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataAddedInLast24HoursVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.video', compact('tableVideo','dataAddedInLast24HoursKomentarVideo','dataAddedInLast24HoursVideo'));
    }

    //[Admin-Artikel] Halaman Komentar Artikel
    function komentarVideo(){
        $komenarV = komentar_video::orderBy('created_at', 'desc')->paginate(20);

        $dataAddedInLast24HoursKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataAddedInLast24HoursVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('admin.komentarVideo', compact('komenarV','dataAddedInLast24HoursKomentarVideo','dataAddedInLast24HoursVideo'));
    }    

    //[Admin-Video] Halaman Tambah Video
    function formTambahVideo(){

        return view('admin.FormAdmin.formTambahVideo');
    }

    public function storeVideo(Request $request)
    {
        $videos = new Video;
        $videos->judulVideo = $request->input('judulVideo');
        $videos->uploader = $request->input('uploader');
        $videos->email = $request->input('email');
        $videos->kategoriVideo = $request->input('kategoriVideo');
        $videos->tagsVideo = $request->input('tagsVideo');
        $videos->deskripsiVideo = $request->input('deskripsiVideo');
        
        // Konversi link YouTube ke URL embed
        $linkVideo = $request->input('linkVideo');
        $videoId = '';

        // Cek apakah input mengandung "youtube.com/watch?v="
        if (strpos($linkVideo, 'youtube.com/watch?v=') !== false) {
            $videoId = explode('v=', parse_url($linkVideo, PHP_URL_QUERY))[1];
        }

        // Cek apakah input mengandung "youtu.be/"
        if (strpos($linkVideo, 'youtu.be/') !== false) {
            $videoId = explode('/', parse_url($linkVideo, PHP_URL_PATH))[1];
        }

        // Jika berhasil mengekstrak ID video, buat URL embed
        if (!empty($videoId)) {
            $embedUrl = "https://www.youtube.com/embed/$videoId";
            $videos->linkVideo = $embedUrl;
        } else {
            // Jika ID video tidak dapat diekstrak, mungkin berikan pesan kesalahan atau penanganan lainnya
            return redirect('/videoAdmin')->with('error', 'Invalid YouTube video link.');
        }

        $videos->save();

        return redirect('/videoAdmin')->with('success', 'Video added successfully.');
    }

      //[Admin-Video] Halaman Edit Video
      function formEditVideo($id){
        $data = video::find($id);
        return view('admin.FormAdmin.formEditVideo', compact('data'));
    }

    function updateVideo(Request $request, $id){
        $data = Video::find($id);
    
        $data->linkVideo = $request->input('linkVideo');
        $data->judulVideo = $request->input('judulVideo');
        $data->kategoriVideo = $request->input('kategoriVideo');
        $data->tagsVideo = $request->input('tagsVideo');
        $data->deskripsiVideo = $request->input('deskripsiVideo');
        
        $data->save();
    
        return redirect()->route('videoAdmin')->with('success','Data Berhasil di Update');
    }    
    
    //[Admin-Video] Delete Video
    function deleteVideo($id){
        $data=video::find($id);
        $data->delete();
        return redirect('/videoAdmin');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Pengguna] Halaman Tabel Pengguna
    function listUserTerdaftar(){
        $users = user::orderBy('created_at', 'desc')->paginate(10);
        
        $userId = Auth::user()->id;
        
        $totalLikes = Likes::where('user_id', $userId)->count();
        $totalDislikes = Dislikes::where('user_id', $userId)->count();
    
        return view('admin.pengguna', compact('users', 'totalLikes', 'totalDislikes'));
    }
    

    //[Admin-Pengguna] Fungsi Like & Dislike
    public function likes()
    {
        return $this->hasMany(Likes::class, 'user_id', 'id');
    }

    public function dislikes()
    {
        return $this->hasMany(Dislikes::class, 'user_id', 'id');
    }


    //[Admin-Pengguna] Tambah Pengguna
    function formTambahUserAdm(){
        return view('admin.FormAdmin.formTambahUserAdm');
    }

    function registerAdmin(Request $req){
            user::create([
                'username' => $req->username,
                 'name' => $req->name,
                 'email' => $req->email,
                 'password' => bcrypt($req->password),
                 'role' => 'admin',
            ]);
                 return redirect('pengguna');
         }

    //[Admin-Pengguna] Delete Pengguna
    function deleteUserTerdaftar($id)
    {
        $data=user::find($id);
        $data->delete();
        return redirect('pengguna');
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

        return view('admin.ulasans', compact('data1', 'averageRating', 'totalUlasan'));
    }

    //[Admin-Ulasan] Delete Ulasan
    function deleteUlasanA($id){
        $data1=ulasans::find($id);
        $data1->delete();
        return redirect('ulasans');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Laporan User] 
    function laporanUser(){

        $laporanArtikelU = laporanArtikelUser::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.laporan.laporanUser', compact('laporanArtikelU'));
    }

    function laporanVideoUser(){

        $laporanVideoUser = LaporanVideoUser::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.laporan.laporanVideoUser', compact('laporanVideoUser'));
    }

    function laporanUlasanUser(){

        $laporanUlasanUser = LaporanUlasanUser::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.laporan.laporanUlasanUser', compact('laporanUlasanUser'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // [Syarat & Ketentuan] Halaman Tabel 
    public function syaratdanketentuan()
    {
        $data = syaratdanketentuans::all();

        return view('admin.term&Condition', compact('data'));
    }

    // [Syarat & Ketentuan] Form Tambah T&C
    function formTambahTdanC(){
        return view('admin.FormAdmin.formTambahTdanC');
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
            return view('admin.FormAdmin.formEditTermOfCondition', compact('data'));
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

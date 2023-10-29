<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\Likes;
use App\Models\SyaratDanKetentuan;
use App\Models\syaratdanketentuans;
use App\Models\ulasans;
use App\Models\user;
use App\Models\video;
use Carbon\Carbon;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{

//Menampilkan Data Dashboard Admin
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

    //Rating
    $ratings = $data1->pluck('rating')->map(function ($rating) {
        return (int) $rating; // Mengonversi rating ke integer
    });
    
    $totalRatings = $ratings->sum();
    $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
    

    return view('admin.dashboard', compact('totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 'dataAddedInLast24HoursUlasan','dataAddedInLast24HoursUser','dataAddedInLast24HoursArtikel'));
}

function dataArtikel(){
    $data = artikels::orderBy('created_at', 'desc')->paginate(5);
    return view('admin.tables', compact('data'));
}

    function deleteArtikel($id){
        $data=artikels::find($id);
        $data->delete();
        return redirect('/artikelAdmin');
    }

    public function create()
    {
        return view('admin.formTambahArtikel');
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
    

    //Edit Data Tabel
    function tampilDataEditArtikel($id){
        $data = artikels::find($id);
        return view('admin.formEditArtikel', compact('data'));
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

    
    // [Bagian Video]
    function videoAdmin(){

        $tableVideo = video::orderBy('created_at', 'desc')->paginate(4);

        return view('admin.video', compact('tableVideo'));
    }

    function formTambahVideo(){

        return view('admin.formTambahVideo');
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

      //[Edit Video]
      function formEditVideo($id){
        $data = video::find($id);
        return view('admin.formEditVideo', compact('data'));
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
    
    function deleteVideo($id){
        $data=video::find($id);
        $data->delete();
        return redirect('/videoAdmin');
    }

    //[Bagian Pengguna]
    function listUserTerdaftar(){
        $users = user::orderBy('created_at', 'desc')->paginate(10);
        
        $userId = Auth::user()->id;
        
        $totalLikes = Likes::where('user_id', $userId)->count();
        $totalDislikes = Dislikes::where('user_id', $userId)->count();
    
        return view('admin.pengguna', compact('users', 'totalLikes', 'totalDislikes'));
    }
    

    public function likes()
    {
        return $this->hasMany(Likes::class, 'user_id', 'id');
    }

    public function dislikes()
    {
        return $this->hasMany(Dislikes::class, 'user_id', 'id');
    }


    function formTambahUserAdm(){
        return view('admin.formTambahUserAdm');
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

    function deleteUserTerdaftar($id)
    {
        $data=user::find($id);
        $data->delete();
        return redirect('pengguna');
    }

    //Menampilkan Data Ulasan pada Tabel Admin
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

    //Delete data ulasan pada Tabel Admin
    function deleteUlasan($id){
        $data1=ulasans::find($id);
        $data1->delete();
        return redirect('ulasans');
    }

    //Profile
    public function profileAdmin()
    {
        
        return view('Admin.profileA');
    }  
  

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
    
        // Handle profile picture upload
        if ($request->hasFile('fotoProfil')) {
            $image = $request->file('fotoProfil');
    
            $filename = 'fotoProfil.' . $user->name . ' ' . $user->username . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('fotoProfil'), $filename);
    
            $user->fotoProfil = $filename;
            $user->save();
        }

        return redirect('/profileAdmin');
    }

    // [Syarat & Ketentuan]
    public function syaratdanketentuan()
    {
        $data = syaratdanketentuans::all();

        return view('admin.term&Condition', compact('data'));
    }

    // [Syarat & Ketentuan] Form Tambah T&C
    function formTambahTdanC(){
        return view('admin.formTambahTdanC');
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
            return view('admin.formEditTermOfCondition', compact('data'));
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

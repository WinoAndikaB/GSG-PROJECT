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
use App\Models\RatingPenulis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    //[Admin-Profile] Profil User
    public function profileAdmin()
    {
        $user = Auth::user();
        $userId = Auth::id();
    
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
    
        // Menghitung total user_id yang sama dengan user auth
        $TotalArtikelId = artikels::where('user_id', $user->id)->count();
        $TotalVideoId = video::where('user_id', $user->id)->count();
    
        $totalFollowers = Follower::where('user_id', $user->id)->count();
    
        // Menghitung rata-rata rating penulis
        $averageRating = RatingPenulis::where('user_id_penulis', $user->id)->avg('rating');
    
        return view('Admin.profileA', compact('dataBaruKomentarArtikel', 'dataBaruKomentarVideo', 'averageRating', 
        'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'TotalArtikelId', 'TotalVideoId', 'totalFollowers','dataBaruArtikel','dataBaruVideo'));
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
        } elseif ($request->filled('fotoProfil')) {
            // Jika tidak ada file yang diunggah, tetapi ada URL yang diberikan
            $user->fotoProfil = $request->input('fotoProfil');
        }
    
        $user->save();
    
        return redirect('/profileAdmin');
    }
    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Dashboard] Halaman Dashboard

    function dashboard()
    {

        $userId = Auth::id();
        
        $totalArtikel = Artikels::where('user_id', auth()->user()->id)->where('status', 'Published')->count();
        $totalVideo =  Video::where('user_id', auth()->user()->id)->where('statusVideo', 'Published')->count();
        $totalLaporanArtikel = LaporanArtikelUser::where('user_id', $userId)->count();
        $totalLaporanVideo = LaporanVideoUser::where('user_id', $userId)->count();
        

        $tagsA = Artikels::where('user_id', auth()->user()->id)
        ->where('status', 'Published')
        ->inRandomOrder()
        ->take(10)
        ->get();
    
         $tagsV = Video::where('user_id', auth()->user()->id)
        ->where('statusVideo', 'Published') 
        ->inRandomOrder()
        ->take(10)
        ->get();
    
    
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
    
        // Menghitung jumlah user_id yang sama pada setiap model
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        $kategoriArtikel = Artikels::where('user_id', auth()->user()->id)
        ->where('status', 'Published') 
        ->select('kategori', Artikels::raw('count(*) as total'))
        ->groupBy('kategori')
        ->get();
        
        $kategoriVideo = Video::where('user_id', auth()->user()->id)
        ->where('statusVideo', 'Published')
        ->select('kategoriVideo', Video::raw('count(*) as total'))
        ->groupBy('kategoriVideo')
        ->get();
    
        
    return view('admin.dashboard', compact(
        'totalArtikel', 'totalVideo', 'totalLaporanArtikel', 'totalLaporanVideo','tagsA','tagsV',
        'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'kategoriArtikel', 'kategoriVideo',
        'totalUserArtikel', 'totalUserVideo'
    ));    
    }
    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //[User] Halaman Kategori 
    function kategoriArtA($kategori){

        $userId = Auth::id();
        
        // Mengambil data hanya untuk auth user_id
        $KategoriA = artikels::where('kategori', $kategori)
            ->where('user_id', auth()->user()->id) // Menambahkan kondisi untuk user_id
            ->whereNotIn('status', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();
    
                 // Waktu 24 jam yang lalu
                 $waktu24JamLalu = Carbon::now()->subDay();

                 // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruArtikel = artikels::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                         $query->where('user_id', $userId);
                     })
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruVideo = video::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                         $query->where('user_id', $userId);
                     })
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();
    
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
    
        return view('admin.KategoriArtA', compact('KategoriA', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
    }
    
    function kategoriVidA($kategori){

        $userId = Auth::id();

        $kategoriV = video::where('kategoriVideo', $kategori)
            ->whereNotIn('statusVideo', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();

            $existingTags = artikels::select('tags')->distinct()->get();

                 // Waktu 24 jam yang lalu
                 $waktu24JamLalu = Carbon::now()->subDay();

                 // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruArtikel = artikels::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                         $query->where('user_id', $userId);
                     })
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruVideo = video::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                         $query->where('user_id', $userId);
                     })
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();

                 // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
                 $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
                     ->where('created_at', '>=', $waktu24JamLalu)
                     ->count();
            
        return view('admin.KategoriVidA', compact('existingTags','kategoriV', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
    }

    //[Admin-Artikel] Halaman Tables Artikel
    public function artikel(Request $request)
    {
        // Get the ID of the authenticated user
        $userId = Auth::id();
    
        // Get the search query from the request
        $searchQuery = $request->input('search');
    
        // Get the sort parameter from the request
        $sort = $request->input('sort');
    
        // Get the category filter parameter from the request
        $kategori = $request->input('kategori');
    
        // Get the status filter parameter from the request
        $status = $request->input('status');
    
        // Start building the query without applying pagination
        $query = artikels::where('user_id', $userId)->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc');
    
        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('judulArtikel', 'like', '%' . $searchQuery . '%')
                    ->orWhere('penulis', 'like', '%' . $searchQuery . '%')
                    ->orWhere('status', 'like', '%' . $searchQuery . '%')
                    ->orWhere('kategori', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // If there is a category filter, add the category condition
        if (!empty($kategori)) {
            $query->where('kategori', $kategori);
        }
    
        // If there is a status filter, add the status condition
        if (!empty($status)) {
            $query->where('status', $status);
        }
    
        // Count the total number of articles
        $totalDataArtikel = $query->count();
    
        // Now, paginate the results
        $data = $query->paginate(15);
    
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
                
    
        // Total User Artikel dan Video
        $totalUserArtikel = artikels::where('user_id', $userId)->count();
        $totalUserVideo = video::where('user_id', $userId)->count();
    
        // Fetch unique categories and their counts
        $categories = artikels::where('user_id', $userId)->distinct('kategori')->pluck('kategori');
        $categoryCounts = [];
        foreach ($categories as $category) {
            $categoryCounts[$category] = artikels::where('user_id', $userId)->where('kategori', $category)->count();
        }
    
        // Fetch unique status and their counts
        $statuses = artikels::where('user_id', $userId)->distinct('status')->pluck('status');
        $statusCounts = [];
        foreach ($statuses as $status) {
            $statusCounts[$status] = artikels::where('user_id', $userId)->where('status', $status)->count();
        }
    
        // Pass all the necessary data to the view
        return view('admin.artikel', compact(
            'data',
            'totalDataArtikel',
            'dataBaruArtikel',
            'dataBaruKomentarArtikel',
            'dataBaruVideo',
            'dataBaruKomentarVideo',
            'dataBaruLaporanArtikel',
            'dataBaruLaporanVideo',
            'totalUserArtikel',
            'totalUserVideo',
            'categories',
            'categoryCounts',
            'statuses',
            'statusCounts'
        ));
    }
    
    
    

    public function formatJumlahAkses($jumlah)
    {
        if ($jumlah < 1000) {
            return $jumlah;
        } elseif ($jumlah < 10000) {
            return round($jumlah / 1000, 1) . 'K';
        } elseif ($jumlah < 1000000) {
            return round($jumlah / 1000) . 'K';
        } elseif ($jumlah < 1000000000) {
            return round($jumlah / 1000000, 1) . 'JT';
        } else {
            return round($jumlah / 1000000000, 1) . 'M';
        }
    }

    //[Admin-Artikel] Halaman Komentar Artikel
    function komentarArtikel(){
        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Dapatkan artikel yang dibuat oleh pengguna itu sendiri
        $artikels = artikels::where('user_id', $userId)->pluck('id');
    
        // Ambil semua komentar yang terkait dengan artikel-artikel tersebut
        $komentarA = komentar_artikel::whereIn('artikel_id', $artikels)->orderBy('created_at', 'desc')->paginate(20);
    
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
 
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        return view('admin.komentar.komentarArtikel', compact('komentarA','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo','dataBaruArtikel',
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

         $kategoris = kategori::all();

             // Dapatkan ID pengguna yang sedang login
             $userId = Auth::id();
  
             // Waktu 24 jam yang lalu
             $waktu24JamLalu = Carbon::now()->subDay();

             // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
             $dataBaruArtikel = artikels::where('user_id', $userId)
                 ->where('created_at', '>=', $waktu24JamLalu)
                 ->count();
     
             // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
             $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                     $query->where('user_id', $userId);
                 })
                 ->where('created_at', '>=', $waktu24JamLalu)
                 ->count();
     
             // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
             $dataBaruVideo = video::where('user_id', $userId)
                 ->where('created_at', '>=', $waktu24JamLalu)
                 ->count();
     
             // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
             $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                     $query->where('user_id', $userId);
                 })
                 ->where('created_at', '>=', $waktu24JamLalu)
                 ->count();
     
             // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
             $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
                 ->where('created_at', '>=', $waktu24JamLalu)
                 ->count();
     
            // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
            $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
                ->where('created_at', '>=', $waktu24JamLalu)
                ->count(); // <-- Add this count() method here



        return view('admin.FormAdmin.formTambahArtikel', compact('kategoris','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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
            'gambarArtikel' => 'required', // Remove image validation
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
    
        // Handle file upload or URL input
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
    
            $filename = $image->getClientOriginalName();
            $image->move(public_path('gambarArtikel'), $filename);
    
            // Set the image file name in the database
            $article->gambarArtikel = $filename;
        } else {
            // If no file is uploaded, assume URL input
            $article->gambarArtikel = $request->input('gambarArtikel');
        }        
    
        $article->save();
    
        return redirect('/artikelAdmin')->with('success', 'Article added successfully.');
    }
    
    

    //[Admin-Artikel] Edit Data Artikel
    function formEditArtikelA($id){
        $data = artikels::find($id);

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        $kategoris = kategori::all();

          // Waktu 24 jam yang lalu
          $waktu24JamLalu = Carbon::now()->subDay();

          // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruArtikel = artikels::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruVideo = video::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
         
        return view('admin.FormAdmin.formEditArtikel', compact('kategoris','data','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

public function TagsArtikelA($tagName)
{

    $userId = Auth::id();

    // Cari artikel berdasarkan tag hanya untuk auth user_id
    $artikels = artikels::where('tags', 'like', '%' . $tagName . '%')
                        ->where('user_id', auth()->user()->id)
                        ->get();

    if ($artikels->isEmpty()) {
        abort(404);
    }

    // Ambil semua tag dari artikel-artikel yang ditemukan
    $tags = [];
    foreach ($artikels as $artikel) {
        $artikelTags = explode(',', $artikel->tags);
        $tags = array_merge($tags, $artikelTags);
    }
    $tags = array_unique($tags);

    $existingTags = artikels::select('tags')->distinct()->get();

          // Waktu 24 jam yang lalu
          $waktu24JamLalu = Carbon::now()->subDay();

          // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruArtikel = artikels::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruVideo = video::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();


    // Kirim data artikel, tag name, dan tags ke view
    return view('admin.tagsArtikel', compact('artikels', 'tagName', 'tags' , 'existingTags','dataBaruArtikel', 'dataBaruKomentarArtikel', 
    'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
}

        

public function searchTagsA(Request $request)
{
    // Ambil nilai pencarian dari input pengguna
    $search = $request->input('search');

    // Ambil daftar tag yang sudah ada dari basis data
    $existingTags = artikels::select('tags')->distinct()->get();

    // Cari artikel berdasarkan tag dan user_id
    $artikels = artikels::where('tags', 'like', '%' . $search . '%')
                        ->where('user_id', auth()->user()->id) // Menambahkan kondisi untuk user_id
                        ->get();

    if ($artikels->isEmpty()) {
        abort(404);
    }

    // Set variabel $tagName dengan nilai pencarian
    $tagName = $search;

    // Ambil semua tag dari artikel-artikel yang ditemukan
    $tags = [];
    foreach ($artikels as $artikel) {
        $artikelTags = explode(',', $artikel->tags);
        $tags = array_merge($tags, $artikelTags);
    }
    $tags = array_unique($tags);

          // Waktu 24 jam yang lalu
          $waktu24JamLalu = Carbon::now()->subDay();

          // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruArtikel = artikels::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruVideo = video::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();

    // Kirim data artikel, tag name, tags yang sudah ada ke view
    return view('admin.tagsArtikel', compact('artikels', 'tagName', 'tags', 'existingTags', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
    'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
}

        
            //[Admin-Artikel] Detail Artikel
            function showDetailArtikelA($id){

                $article = artikels::findOrFail($id);

                // Dapatkan ID pengguna yang sedang login
                $userId = Auth::id();

            
                $kategoriA = kategori::all();
            
                $box = artikels::inRandomOrder()->take(8)->get();
            
                // Ambil artikel berdasarkan user_id
                $tagsA = artikels::where('user_id', Auth::id())->get();
            
                $uniqueTags = [];
                foreach ($tagsA as $tag) {
                    $words = explode(",", $tag->tags);
                    foreach ($words as $word) {
                        $trimmedWord = trim($word);
                        // Tambahkan tag ke dalam array unik
                        $uniqueTags[$trimmedWord] = $trimmedWord;
                    }
                }
            
                // Hitung jumlah komentar untuk artikel dengan ID tertentu
                $totalKomentar = komentar_artikel::where('artikel_id', $id)->count();
            
                $detailArtikelLP = komentar_artikel::where('artikel_id', $id)->latest()->paginate(6);
            
                // Ambil data user berdasarkan id penulis artikel
                $user = User::findOrFail($article->user_id); // Assign $user before accessing its properties
                $fotoProfil = $user->fotoProfil;
            
                // Format jumlah akses
                $formattedJumlahAkses = $this->formatJumlahAkses($article->jumlah_akses);
            
                // Hitung total pengikut (followers) berdasarkan user_id
                $totalFollowers = Follower::where('user_id', $user->id)->count();
            
             // Waktu 24 jam yang lalu
          $waktu24JamLalu = Carbon::now()->subDay();

          // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruArtikel = artikels::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruVideo = video::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                  $query->where('user_id', $userId);
              })
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();
  
          // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
          $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
              ->where('created_at', '>=', $waktu24JamLalu)
              ->count();

                return view('admin.detailArtikelA', compact('dataBaruArtikel', 'dataBaruKomentarArtikel', 'fotoProfil', 'user',
                    'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'kategoriA',
                    'article', 'box', 'tagsA', 'uniqueTags', 'detailArtikelLP', 'totalKomentar', 'totalFollowers', 'formattedJumlahAkses'
                ));
            }
            
            

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Video] Halaman Tabel Video

    function videoAdmin(Request $request){
        // Get the ID of the authenticated user
        $userId = Auth::id();
    
        // Get the search query from the request
        $searchQuery = $request->input('search');
    
        // Get the sort parameter from the request
        $sort = $request->input('sort');
    
        // Get the kategoriVideo filter parameter from the request
        $kategoriVideo = $request->input('kategoriVideo');
    
        // Get the statusVideo filter parameter from the request
        $statusVideo = $request->input('statusVideo');
    
        // Start building the query without applying pagination
        $query = video::where('user_id', $userId)->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc');
    
        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('judulVideo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('uploader', 'like', '%' . $searchQuery . '%')
                    ->orWhere('statusVideo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('kategoriVideo', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // If there is a kategoriVideo filter, add the kategoriVideo condition
        if (!empty($kategoriVideo)) {
            $query->where('kategoriVideo', $kategoriVideo);
        }
    
        // If there is a statusVideo filter, add the statusVideo condition
        if (!empty($statusVideo)) {
            $query->where('statusVideo', $statusVideo);
        }
    
        // Now, paginate the results
        $tableVideo = $query->paginate(15);
    
        // Get unique categories
        $categoriesVideo = video::where('user_id', $userId)->select('kategoriVideo')->distinct()->pluck('kategoriVideo');
    
        // Count videos in each category
        $categoryCountsVideo = [];
        foreach ($categoriesVideo as $categoryVideo) {
            $categoryCountsVideo[$categoryVideo] = video::where('user_id', $userId)->where('kategoriVideo', $categoryVideo)->count();
        }
    
        // Get unique statuses
        $statusesVideo = video::where('user_id', $userId)->select('statusVideo')->distinct()->pluck('statusVideo');
    
        // Count videos in each status
        $statusCountsVideo = [];
        foreach ($statusesVideo as $statusVideo) {
            $statusCountsVideo[$statusVideo] = video::where('user_id', $userId)->where('statusVideo', $statusVideo)->count();
        }
    
        // Total number of videos for all users
        $AllTotalVideo = video::where('user_id', $userId)->count();

    
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
    
        // Total User Artikel dan Video
        $totalUserArtikel = artikels::where('user_id', auth()->user()->id)->count();
        $totalUserVideo = video::where('user_id', auth()->user()->id)->count();
    
        return view('admin.video', compact(
            'tableVideo', 
            'dataBaruArtikel', 
            'dataBaruKomentarArtikel', 
            'statusCountsVideo', 
            'dataBaruVideo', 
            'dataBaruKomentarVideo', 
            'dataBaruLaporanArtikel', 
            'dataBaruLaporanVideo', 
            'totalUserArtikel', 
            'totalUserVideo', 
            'categoryCountsVideo', 
            'AllTotalVideo'
        ));
    }
    
    
    

    //[Admin-Artikel] Halaman Komentar Artikel
    function komentarVideo(){
        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Dapatkan video yang dibuat oleh pengguna itu sendiri
        $videos = video::where('user_id', $userId)->pluck('id');
    
        // Ambil semua komentar yang terkait dengan video-video tersebut
        $komentarV = komentar_video::whereIn('video_id', $videos)->orderBy('created_at', 'desc')->paginate(20);
    
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
    
        return view('admin.komentar.komentarVideo', compact('komentarV','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }
    

    //[Admin-Video] Halaman Tambah Video
    function formTambahVideo(){

        // Dapatkan ID pengguna yang sedang login
         $userId = Auth::id();

        $kategoris = kategori::all();

        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        return view('admin.FormAdmin.formTambahVideo', compact('kategoris','dataBaruArtikel', 'dataBaruKomentarArtikel', 
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
        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        $kategoris = kategori::all();

        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        return view('admin.FormAdmin.formEditVideo', compact('kategoris','data','dataBaruArtikel', 'dataBaruKomentarArtikel', 
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

      //Tags Videos
      public function searchTagsV(Request $request)
      {
          // Ambil nilai pencarian dari input pengguna
          $search = $request->input('search');
      
          // Ambil daftar tag yang sudah ada dari basis data
          $existingTags = Video::select('tagsVideo')->distinct()->get();
      
          // Cari video berdasarkan tag hanya untuk user_id tertentu
          $videos = Video::where('tagsVideo', 'like', '%' . $search . '%')
                      ->where('user_id', auth()->user()->id) // Menambahkan kondisi untuk user_id
                      ->get();
      
          if ($videos->isEmpty()) {
              abort(404);
          }
      
          // Set variabel $tagName dengan nilai pencarian
          $tagName = $search;
      
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
      
      
          // Kirim data video, tag name, tags yang sudah ada ke view
          return view('admin.tagsVideo', compact('videos', 'tagName', 'existingTags','dataBaruArtikel', 'dataBaruKomentarArtikel', 
          'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
      }
      
      
      public function TagsVideoA($tagName)
      {

        $userId = Auth::id();

          // Cari video berdasarkan tag dan user_id
          $videos = Video::where('tagsVideo', 'like', '%' . $tagName . '%')
              ->where('user_id', auth()->user()->id)
              ->get();
      
          if ($videos->isEmpty()) {
              abort(404);
          }
      
          // Ambil daftar tag yang sudah ada dari basis data
          $existingTags = Video::select('tagsVideo')->distinct()->get();
      
        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();
      
          // Kirim data video, tag name, tags yang sudah ada ke view
          return view('admin.tagsVideo', compact('videos', 'tagName', 'existingTags','dataBaruArtikel', 'dataBaruKomentarArtikel', 
              'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
      }
      

                //[Admin-Artikel] Detail Artikel
                function showDetailVideoA($id){

                    $video = Video::findOrFail($id);

                   // Dapatkan ID pengguna yang sedang login
                    $userId = Auth::id();

    
                    $kategoriLogV = Kategori::all();
                
                    $boxVideo = Video::inRandomOrder()->take(10)->get();
                    $tagsV = Video::inRandomOrder()->take(5)->get();
                    $kategoriV = Video::inRandomOrder()->take(10)->get();
                
                    $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);
                    
                    $totalKomentarVideo = komentar_video::where('video_id', $id)->count();
                
                    // Ambil data user berdasarkan id pembuat video
                    $user = User::findOrFail($video->user_id);
                    // Ambil foto profil pembuat video
                    $fotoProfil = $user->fotoProfil;

                            // Check if the authenticated user is following the article author
                            $isFollowing = false;
                            if (auth()->check()) {
                                $follower = Follower::where('follower_id', auth()->user()->id)
                                                    ->where('user_id', $user->id)
                                                    ->first();
                                if ($follower && $follower->status == 1) {
                                    $isFollowing = true;
                                }
                            }

                    $existingTags = Video::select('tagsVideo')->distinct()->get();

                    // Hitung total pengikut (followers) berdasarkan user_id
                    $totalFollowers = Follower::where('user_id', $user->id)->count();
                
                    // Waktu 24 jam yang lalu
                    $waktu24JamLalu = Carbon::now()->subDay();

                    // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                    $dataBaruArtikel = artikels::where('user_id', $userId)
                        ->where('created_at', '>=', $waktu24JamLalu)
                        ->count();

                    // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                    $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('created_at', '>=', $waktu24JamLalu)
                        ->count();

                    // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
                    $dataBaruVideo = video::where('user_id', $userId)
                        ->where('created_at', '>=', $waktu24JamLalu)
                        ->count();

                    // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
                    $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('created_at', '>=', $waktu24JamLalu)
                        ->count();

                    // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
                    $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
                        ->where('created_at', '>=', $waktu24JamLalu)
                        ->count();

                    // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
                    $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
                        ->where('created_at', '>=', $waktu24JamLalu)
                        ->count();
                
                    return view('admin.detailVideoA', compact('dataBaruArtikel', 'dataBaruKomentarArtikel', 
                    'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo', 'kategoriLogV',
                    'video','boxVideo','tagsV','kategoriV','komentarVideos','totalKomentarVideo','fotoProfil','user','totalFollowers','existingTags'
                ));
                }


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Admin-Laporan User] 
    function laporanUser(){

        $userId = Auth::id();
        

        $laporanArtikelU = laporanArtikelUser::orderBy('created_at', 'desc')->paginate(10);

        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        return view('admin.laporan.laporanUser', compact('laporanArtikelU','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruVideo','dataBaruArtikel'));
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

        $userId = Auth::id();
        

        $laporanVideoUser = LaporanVideoUser::orderBy('created_at', 'desc')->paginate(10);

        // Waktu 24 jam yang lalu
        $waktu24JamLalu = Carbon::now()->subDay();

        // Hitung jumlah data artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruArtikel = artikels::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarArtikel = komentar_artikel::whereHas('artikel', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruVideo = video::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data komentar video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruKomentarVideo = komentar_video::whereHas('video', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan artikel baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanArtikel = laporanArtikelUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        // Hitung jumlah data laporan video baru dalam 24 jam terakhir yang sesuai dengan user_id
        $dataBaruLaporanVideo = laporanVideoUser::where('user_id', $userId)
            ->where('created_at', '>=', $waktu24JamLalu)
            ->count();

        return view('admin.laporan.laporanVideoUser', compact('laporanVideoUser', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruVideo','dataBaruArtikel'));
    }

}

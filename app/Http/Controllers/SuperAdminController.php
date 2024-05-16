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
use App\Models\Follower;
use App\Models\kategori;
use App\Models\laporanArtikelUser;
use App\Models\LaporanKomentarArtikel;
use App\Models\laporanKomentarVideo;
use App\Models\LaporanUlasanUser;
use App\Models\RatingPenulis;
use App\Models\LaporanVideoUser;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{

    //[SuperAdmin-Profile] Profil User
    public function profileSA()
    {

        $user = Auth::user();

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        // Menghitung total user_id yang sama dengan user auth
        $TotalArtikelId = artikels::where('user_id', $user->id)->count();
        $TotalVideoId = video::where('user_id', $user->id)->count();
        // Hitung total pengikut (followers) berdasarkan user_id
        $totalFollowers = Follower::where('user_id', $user->id)->count();

        // Menghitung rata-rata rating penulis
        $averageRating = RatingPenulis::where('user_id_penulis', $user->id)->avg('rating');

        return view('SuperAdmin.profileSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo','TotalArtikelId','TotalVideoId','totalFollowers','averageRating'));
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
        } elseif ($request->filled('fotoProfil')) {
            // Jika tidak ada file yang diunggah, tetapi ada URL yang diberikan
            $user->fotoProfil = $request->input('fotoProfil');
        }

        $user->save();

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
        $tagsV = video::inRandomOrder()->take(10)->get();
        $tagsA = artikels::inRandomOrder()->take(10)->get();

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

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
        

        return view('SuperAdmin.dashboardSA', compact('superadminCount','adminCount','userCount','totalArtikel', 'totalUser', 'totalUlasan', 'averageRating', 'totalUlasan', 
        'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
        'dataBaruLaporanArtikel','dataBaruLaporanVideo','kategoriArtikel','kategoriVideo','tagsA','tagsV'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

            public function searchTagsASA(Request $request)
            {
                // Ambil nilai pencarian dari input pengguna
                $search = $request->input('search');

                // Ambil daftar tag yang sudah ada dari basis data
                $existingTags = artikels::select('tags')->distinct()->get();

                // Cari artikel berdasarkan tag
                $artikels = artikels::where('tags', 'like', '%' . $search . '%')->get();

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

                // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
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

                // Kirim data artikel, tag name, tags yang sudah ada ke view
                return view('superadmin.tags.tagsArtikel', compact('artikels', 'tagName', 'tags', 'existingTags','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
                'dataBaruLaporanArtikel','dataBaruLaporanVideo','kategoriArtikel','kategoriVideo'));
            } 

            //[SuperAdmin-Artikel] Detail Artikel
            function showDetailArtikelSA($id){

                $article = artikels::findOrFail($id);
            
                // Fetch the user associated with the article
                $user = $article->user;
            
                // Ambil daftar tag yang sudah ada dari basis data
                $existingTags = artikels::select('tags')->distinct()->get();
                
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
                $fotoProfil = $user->fotoProfil;
                
                // Format jumlah akses
                $formattedJumlahAkses = $this->formatJumlahAkses($article->jumlah_akses);

                // Menyiapkan data komentar, menyaring yang lebih muda dari 5 hari
                $komentarArtikels = komentar_artikel::where('artikel_id', $id)
                ->latest()
                ->paginate(6);

                // Rating
                $user_id_penulis = $article->user_id; // Misalnya, mendapatkan user_id_penulis dari artikel yang sedang ditampilkan
                $averageRating = RatingPenulis::where('user_id_penulis', $user_id_penulis)->avg('rating');

                 // Total rating berdasarkan user_id dan artikel_id
                 $AvgArt = RatingPenulis::where('user_id_penulis', $user_id_penulis)
                                ->where('artikel_id', $id)
                                ->avg('rating');

                // Total rating berdasarkan artikel_id
                $totalRatingArt = RatingPenulis::where('artikel_id', $id)->count();
                
                // Hitung total pengikut (followers) berdasarkan user_id
                $totalFollowers = Follower::where('user_id', $user->id)->count();
                
                // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
                $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
            
                $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
            
                $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
            
                $pendingArticles = artikels::where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(5);
                $publishedArticles = artikels::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(5);
                
                return view('superadmin.detail.detailArtikelA', compact('dataBaruArtikel', 'dataBaruKomentarArtikel','article', 'totalFollowers','formattedJumlahAkses','fotoProfil','user','AvgArt','totalRatingArt',
                'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','existingTags', 
                'dataBaruLaporanVideo', 'pendingArticles', 'publishedArticles','komentarArtikels','averageRating'
                ));
            }

    //[User] Halaman Kategori 
    function kategoriArtSA($kategori){

        $KategoriA = artikels::where('kategori', $kategori)
            ->whereNotIn('status', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();

        // Ambil daftar tag yang sudah ada dari basis data
        $existingTags = artikels::select('tags')->distinct()->get();
            
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();

        $pendingArticles = artikels::where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(5);
        $publishedArticles = artikels::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(5);


        return view('superadmin.kategori.KategoriArtA', compact('KategoriA', 'existingTags',
        'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'pendingArticles', 'publishedArticles'));
    }

    function kategoriVidSA($kategori){

        $kategoriV = video::where('kategoriVideo', $kategori)
            ->whereNotIn('statusVideo', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();

            $existingTags = artikels::select('tags')->distinct()->get();

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();

        $pendingArticles = artikels::where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(5);
        $publishedArticles = artikels::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(5);
            
        return view('superadmin.kategori.KategoriVidA', compact('existingTags','kategoriV', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'pendingArticles', 'publishedArticles'));
    }

    public function TagsArtikelSA($tagName)
    {
        // Cari artikel berdasarkan tag
        $artikels = artikels::where('tags', 'like', '%' . $tagName . '%')->get();
    
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

                // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
                $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();

                $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();

                $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();

                $pendingArticles = artikels::where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(5);
                $publishedArticles = artikels::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(5);
    
        // Kirim data artikel, tag name, dan tags ke view
        return view('superadmin.tags.tagsArtikel', compact('artikels', 'tagName', 'tags' , 'existingTags','dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 
        'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'pendingArticles', 'publishedArticles'));
    }

    //[SuperAdmin-Artikel] Halaman Tables Artikel
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


    public function artikelSA(Request $request)
    {
        // Get the search query, selected category, and selected status from the request
        $searchQuery = $request->input('search');
        $selectedCategory = $request->input('kategori');
        $selectedStatus = $request->input('status');
    
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
    
        // If a category is selected, add a where clause to filter by category
        if (!empty($selectedCategory)) {
            $query->where('kategori', $selectedCategory);
        }
    
        // If a status is selected, add a where clause to filter by status
        if (!empty($selectedStatus)) {
            $query->where('status', $selectedStatus);
        }
    
        // Now, paginate the results
        $data = $query->paginate(15);
    
        // Get unique categories
        $categories = artikels::select('kategori')->distinct()->pluck('kategori');
    
        // Count articles in each category
        $categoryCounts = [];
        foreach ($categories as $category) {
            $categoryCounts[$category] = artikels::where('kategori', $category)->count();
        }
    
        // Get unique statuses
        $statuses = artikels::select('status')->distinct()->pluck('status');
    
        // Count articles in each status
        $statusCounts = [];
        foreach ($statuses as $status) {
            $statusCounts[$status] = artikels::where('status', $status)->count();
        }
    
        // Format jumlah akses
        foreach ($data as $article) {
            $article->formattedJumlahAkses = $this->formatJumlahAkses($article->jumlah_akses);
        }
    
        $AllTotalArtikel = artikels::count();
    
        // Query untuk menghitung rata-rata rating untuk setiap artikel
        $averageRatings = RatingPenulis::select('artikel_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('artikel_id')
            ->get();

        // Mengubah data rata-rata rating menjadi array yang dapat diakses menggunakan id artikel
        $ratingsByArticleId = $averageRatings->pluck('average_rating', 'artikel_id')->toArray();

        // Array untuk menyimpan total rating untuk setiap artikel
        $totalRatingsByArticleId = [];

        // Mendapatkan total rating untuk setiap artikel
        foreach ($data as $artikel) {
            $totalRatingArt = RatingPenulis::where('artikel_id', $artikel->id)->count();
            $totalRatingsByArticleId[$artikel->id] = $totalRatingArt;
        }

    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $pendingArticles = artikels::where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(5);
        $publishedArticles = artikels::where('status', 'Published')->orderBy('created_at', 'desc')->paginate(5);
    
        return view('SuperAdmin.artikelSA', compact('data', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'pendingArticles', 'publishedArticles', 
        'categories', 'categoryCounts', 'statuses', 'statusCounts','AllTotalArtikel','averageRatings','totalRatingArt','totalRatingsByArticleId'));
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

        return view('SuperAdmin.komentarSA.komentarArtikelSA', compact('komenarA', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

        return view('SuperAdmin.FormSuperAdmin.formTambahArtikelSA', compact('kategoris','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
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
            'gambarArtikel' => 'required', // Remove image validation
        ]);
    
        // Assuming 'user_id' is coming from an authenticated user
        $user_id = auth()->id(); // Adjust this according to your authentication mechanism
    
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
        $article->user_id = $user_id; // Set the user_id
    
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
         
        return view('SuperAdmin.FormSuperAdmin.formEditArtikelSA', compact('data', 'kategoris', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    function updateArtikelSA(Request $request, $id)
    {
        $data = artikels::find($id);
    
        $data->judulArtikel = $request->input('judulArtikel');
        $data->penulis = $request->input('penulis');
        $data->email = $request->input('email');
        $data->kategori = $request->input('kategori');
    
        // Ambil tags dari input
        $tags = $request->input('tags');
        // Gabungkan tags menjadi string dipisahkan oleh koma
        $tagsString = implode(',', $tags);
        // Simpan string tags ke dalam kolom tags
        $data->tags = $tagsString;
    
        $data->deskripsi = $request->input('deskripsi');
    
        if ($request->hasFile('gambarArtikel')) {
            $image = $request->file('gambarArtikel');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('gambarArtikel'), $filename);
            $data->gambarArtikel = $filename;
        }
    
        // Simpan data yang diperbarui
        $data->save();
    
        return redirect()->route('artikelSA')->with('success', 'Data Berhasil di Update');
    }
    
    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

            public function searchTagsVSA(Request $request)
            {
            
                // Ambil nilai pencarian dari input pengguna
                $search = $request->input('search');

                // Ambil daftar tag yang sudah ada dari basis data
                $existingTags = Video::select('tagsVideo')->distinct()->get();

                // Cari video berdasarkan tag
                $videos = Video::where('tagsVideo', 'like', '%' . $search . '%')->get();

                if ($videos->isEmpty()) {
                    abort(404);
                }

                // Set variabel $tagName dengan nilai pencarian
                $tagName = $search;

                
                // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
                $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
                $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
                $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

                // Kirim data video, tag name, tags yang sudah ada ke view
                return view('superadmin.tags.tagsVideo', compact('videos', 'tagName', 'existingTags','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
                'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
            }

             //[Admin-Artikel] Detail Artikel
             function showDetailVideoSA($id){

                $video = Video::findOrFail($id);

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

                $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);

                // Rating
                $user_id_penulis = $video->user_id; // Misalnya, mendapatkan user_id_penulis dari artikel yang sedang ditampilkan
                $averageRating = RatingPenulis::where('user_id_penulis', $user_id_penulis)->avg('rating');

                // Total rating berdasarkan user_id dan artikel_id
                         $AvgVid = RatingPenulis::where('user_id_penulis', $user_id_penulis)
                         ->where('video_id', $id)
                         ->avg('rating');

                                   // Total rating berdasarkan artikel_id
                    $totalRatingVid = RatingPenulis::where('video_id', $id)->count();

                // Hitung total pengikut (followers) berdasarkan user_id
                $totalFollowers = Follower::where('user_id', $user->id)->count();
            
                // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
                $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
                $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
                $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
            
                return view('superadmin.detail.detailVideoA', compact('video','fotoProfil','user','totalFollowers','existingTags','komentarVideos','AvgVid','totalRatingVid',
                'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruArtikel', 'dataBaruKomentarArtikel','averageRating'
            ));
            }

            public function TagsVideoSA($tagName)
            {
                // Cari video berdasarkan tag
                $videos = Video::where('tagsVideo', 'like', '%' . $tagName . '%')->get();
            
                if ($videos->isEmpty()) {
                    abort(404);
                }
            
                // Ambil daftar tag yang sudah ada dari basis data
                $existingTags = Video::select('tagsVideo')->distinct()->get();
        
                $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
                $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        
                $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
                $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
            
                // Kirim data video, tag name, tags yang sudah ada ke view
                return view('SuperAdmin.Tags.tagsVideo', compact('videos', 'tagName', 'existingTags',
                'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo','dataBaruArtikel', 'dataBaruKomentarArtikel'));
            }

    //[SuperAdmin-Video] Halaman Tabel Video
    public function videoSuperAdmin(Request $request)
    {
        // Get the search query, selected category, selected status, and selected sort from the request
        $searchQuery = $request->input('search');
        $selectedCategory = $request->input('kategoriVideo');
        $selectedStatus = $request->input('statusVideo');
        $selectedSort = $request->input('sort');
    
        // Start building the query without applying pagination
        $query = video::orderBy('created_at', $selectedSort === 'newest' ? 'desc' : 'asc');
    
        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('judulVideo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('uploader', 'like', '%' . $searchQuery . '%')
                    ->orWhere('statusVideo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('kategoriVideo', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // If a category is selected, add a where clause to filter by category
        if (!empty($selectedCategory)) {
            $query->where('kategoriVideo', $selectedCategory);
        }
    
        // If a status is selected, add a where clause to filter by status
        if (!empty($selectedStatus)) {
            $query->where('statusVideo', $selectedStatus);
        }
    
        // Now, paginate the results
        $tableVideo = $query->paginate(15);
    
        // Get unique categories
        $categoriesVideo = video::select('kategoriVideo')->distinct()->pluck('kategoriVideo');
    
        // Count videos in each category
        $categoryCountsVideo = [];
        foreach ($categoriesVideo as $categoryVideo) {
            $categoryCountsVideo[$categoryVideo] = video::where('kategoriVideo', $categoryVideo)->count();
        }
    
        // Get unique statuses
        $statusesVideo = video::select('statusVideo')->distinct()->pluck('statusVideo');
    
        // Count videos in each status
        $statusCountsVideo = [];
        foreach ($statusesVideo as $statusVideo) {
            $statusCountsVideo[$statusVideo] = video::where('statusVideo', $statusVideo)->count();
        }

         $AllTotalVideo = video::count();

        // Rating
        $averageRatings = RatingPenulis::select('video_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('video_id')
            ->get();

        // Mengubah data rata-rata rating menjadi array yang dapat diakses menggunakan id video
        $ratingsByArticleId = $averageRatings->pluck('average_rating', 'video_id')->toArray();

        // Array untuk menyimpan total rating untuk setiap video
        $totalRatingsByArticleId = [];

        // Mendapatkan total rating untuk setiap video
        foreach ($tableVideo as $video) {
            $totalRatingArt = RatingPenulis::where('video_id', $video->id)->count();
            $totalRatingsByArticleId[$video->id] = $totalRatingArt;
        }
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        return view('SuperAdmin.videoSA', compact('tableVideo', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'categoriesVideo', 'categoryCountsVideo', 
        'statusesVideo', 'statusCountsVideo','AllTotalVideo','averageRatings','totalRatingsByArticleId'));
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

        return view('SuperAdmin.komentarSA.komentarVideoSA', compact('komenarV', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

        return view('SuperAdmin.FormSuperAdmin.formTambahVideoSA', compact('kategoriV','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel',
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
            'tagsVideo' => 'required|array', 
            'deskripsiVideo' => 'required',
            'linkVideo' => 'required|url', 
        ]);
    
        // Assuming 'user_id' is coming from an authenticated user
        $user_id = auth()->id(); // Adjust this according to your authentication mechanism
    
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
        $videos->statusVideo = 'Pending';
        $videos->user_id = $user_id; // Set the user_id
    
        $videoId = '';
    
        // Extract the video ID from the YouTube link
        if (strpos($request->input('linkVideo'), 'youtube.com/watch?v=') !== false) {
            $videoId = explode('v=', parse_url($request->input('linkVideo'), PHP_URL_QUERY))[1];
        } elseif (strpos($request->input('linkVideo'), 'youtu.be/') !== false) {
            $videoId = explode('/', parse_url($request->input('linkVideo'), PHP_URL_PATH))[1];
        }
    
        if (!empty($videoId)) {
            $embedUrl = "https://www.youtube.com/embed/$videoId";
            $videos->linkVideo = $embedUrl; 
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

        return view('SuperAdmin.FormSuperAdmin.formEditVideoSA', compact('data', 'kategoris', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
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

        return view('superAdmin.kategoriSA', compact('kategori', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

        return view('superAdmin.FormSuperAdmin.formTambahKategoriSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }

    public function storeKategorioSA(Request $request)
    {
        $request->validate([
            'fotoKategori' => 'required', // Menghapus validasi image agar bisa menerima URL
            'pembuat' => 'required',
            'email' => 'required',
            'kategori' => 'required',
            'deskripsiKategori' => 'required',
            // 'fotoKategori' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Menghapus validasi image agar bisa menerima URL
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
        } elseif ($request->filled('fotoKategori')) {
            // Jika tidak ada file yang diunggah, tetapi ada URL yang diberikan
            $ktgr->fotoKategori = $request->input('fotoKategori');
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

        return view('superAdmin.FormSuperAdmin.formEditKategoriSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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

    //[SuperAdmin-Banner]
    function bannerSA(){

        $banner0 = banner::where('jenis_banner', 0)->orderBy('created_at', 'desc')->paginate(10);
        $banner1 = banner::where('jenis_banner', 1)->orderBy('created_at', 'desc')->paginate(10);
        $banner2 = banner::where('jenis_banner', 2)->orderBy('created_at', 'desc')->paginate(10);
        

        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruVideo = video::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=',    Carbon::now()->subDay())->count();

        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=',    Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=',    Carbon::now()->subDay())->count();

        return view('superAdmin.bannerSA', compact('banner0','banner1','banner2','dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
    }



    function saveBannerSA(Request $request) {
        $request->validate([
            'image_url' => 'nullable|url',
            'file_path' => 'nullable|image',
            'keterangan' => 'nullable|string',
            'jenis_banner' => 'required|integer|in:0,1,2,3', // Validasi jenis_banner
        ]);
    
        // Hitung jumlah banner berdasarkan jenis_banner
        $count = Banner::where('jenis_banner', $request->jenis_banner)->count();
    
        // Batasi jumlah data berdasarkan jenis_banner
        $maxCount = 5; // Default maxCount
        if ($request->jenis_banner === 0 || $request->jenis_banner === 1) {
            $maxCount = 5;
        } elseif ($request->jenis_banner === 2) {
            $maxCount = 4;
        } elseif ($request->jenis_banner === 3) {
            $maxCount = 1;
        }
    
        // Cek apakah jumlah sudah mencapai batas maksimum
        if ($count >= $maxCount) {
            return redirect()->back()->with('error', 'Batas jumlah banner untuk jenis ini telah tercapai.');
        }
    
        $banner = new Banner();
    
        // Handle file upload or URL input
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
    
            // Generate unique file name
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            // Move uploaded file to the 'public/banners' directory
            $file->move(public_path('banners'), $fileName);
    
            // Set the file path in the database
            $banner->file_path = $fileName;
        } else {
            // If no file is uploaded, assume URL input
            $banner->image_url = $request->input('image_url');
        }
    
        $banner->keterangan = $request->keterangan;
        $banner->jenis_banner = $request->jenis_banner; // Simpan jenis_banner
        $banner->save();
    
        // Ambil data dengan batasan jumlah
        $banners = Banner::where('jenis_banner', $request->jenis_banner)->take($maxCount)->get();
    
        return redirect()->back()->with('success', 'Banner berhasil disimpan.')->with('banners', $banners);
    } 
    

        //[SuperAdmin-Banner] Delete Banner
        function deleteBannerSA($id)
        {
            $data=Banner::find($id);
            $data->delete();
            return redirect('bannerSA');
        }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[SuperAdmin-Pengguna] Halaman Tabel Pengguna
    public function penggunaSA(Request $request)
    {
        $role = $request->input('role');
        $searchQuery = $request->input('search');
        $sort = $request->input('sort');
        $freeze = $request->input('freeze'); // Tambahkan parameter freeze
        
        $usersQuery = User::orderBy('created_at', $sort === 'newest' ? 'desc' : 'asc');
        
        // If there's a role filter, add a where clause
        if (!empty($role) && $role !== 'All') { // Periksa apakah peran bukan 'All'
            $usersQuery->where('role', $role);
        }
        
        // If there's a search query, add a where clause to match username or email
        if (!empty($searchQuery)) {
            $usersQuery->where(function($query) use ($searchQuery) {
                $query->where('username', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%');
                // Add more fields as needed
            });
        }
        
        // Filter freeze
        if ($freeze === 'freeze') {
            $usersQuery->whereNotNull('freeze_until');
        }
        
        // Fetch the users
        $users = $usersQuery->get();
        
        // Get unique roles
        $roles = User::select('role')->distinct()->pluck('role');
        
        // Initialize an array to store user counts for each role
        $userCounts = [];
        
        // Iterate through each role to get the user count
        foreach ($roles as $role) {
            $userCounts[$role] = User::where('role', $role)->count();
        }
        
        // Initialize an array to store total followers for each user
        $totalFollowers = [];
        
        // Iterate through each user to get their total followers
        foreach ($users as $user) {
            $totalFollowers[$user->id] = Follower::where('user_id', $user->id)->count();
        }

        // Hitung Ulasan
         $AllTotalUser = User::count();
        
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
        
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
        
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        
        
        return view('SuperAdmin.penggunaSA', compact('users', 'totalFollowers', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
            'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'roles', 'userCounts','AllTotalUser'));
    }
    
    
    
    public function freezePengguna(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer',
            'message' => 'nullable|string',
        ]);
    
        $user = User::find($request->input('user_id'));
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        // Set freeze-related fields based on the selected duration
        $duration = $request->input('duration');
    
        if ($duration > 0) {
            // Check if the duration is unlimited
            if ($duration == -1) {
                $user->freeze_until = null; // Set to null for unlimited
                $user->freezeBy = null;
            } else {
                $user->freeze_until = now()->addDays($duration);
                $user->freezeBy = Auth::user()->name; // Set freezeBy to the current authenticated user's name
            }
        } else {
            // Permanen case: allow for unfreezing
            $user->freeze_until = null;
            $user->freezeBy = null;
        }
    
        $user->pesan_freeze = $request->input('message');
    
        // Save the changes
        $user->save();
    
        return redirect()->back()->with('success', 'User frozen successfully');
    }

    public function unfreezePengguna(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('user_id'));

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Set freeze-related fields to their original state
        $user->freeze_until = null;
        $user->pesan_freeze = null;
        $user->freezeBy = null;

        // Save the changes
        $user->save();

        return redirect()->back()->with('success', 'User unfreeze successfully');
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

        return view('SuperAdmin.FormSuperAdmin.formTambahUserSA', compact('dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel','dataBaruLaporanVideo'));
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
    function ulasansSA(Request $request){
        $sort = $request->input('sort'); // Ambil parameter 'sort' dari request
        
        // Ambil data ulasan berdasarkan parameter sort
        if ($sort === 'highest') {
            $data1 = ulasans::orderBy('rating', 'desc')->paginate(10);
        } else if ($sort === 'lowest') {
            $data1 = ulasans::orderBy('rating', 'asc')->paginate(10);
        } else if (is_numeric($sort)) { // Filter berdasarkan rating
            $data1 = ulasans::where('rating', $sort)->paginate(10);
        } else {
            $data1 = ulasans::orderBy('created_at', $sort === 'newest' ? 'desc' : 'asc')->paginate(10);
        }
    
        // Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; 
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
    
        // Hitung Ulasan
        $totalUlasan = ulasans::count();
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        return view('SuperAdmin.ulasansSA', compact('data1', 'ratings', 'averageRating', 'totalUlasan', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 
        'dataBaruVideo', 'dataBaruKomentarVideo', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo'));
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
    function laporanUserSA(Request $request){
        // Ambil nilai filter dari request
        $filter = $request->input('laporan');
    
        // Query dasar
        $query = laporanArtikelUser::orderBy('created_at', 'desc');
    
        // Tambahkan kondisi filter jika ada
        if ($filter) {
            $query->where('laporan', $filter);
        }
    
        // Paginasi hasil query
        $laporanArtikelU = $query->paginate(10);
    
        // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
        $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        $LaporanKomentarArtikel = LaporanKomentarArtikel::where('created_at', '>=', Carbon::now()->subDay())->count();
        $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
    
        // Data untuk filter
        $FilterLA = laporanArtikelUser::select('laporan')
            ->distinct()
            ->get()
            ->map(function ($item) {
                return [
                    'laporan' => $item->laporan,
                    'count' => laporanArtikelUser::where('laporan', $item->laporan)->count()
                ];
            });
    
        $AllTotalLaporan = laporanArtikelUser::count();
    
        return view('SuperAdmin.laporan.laporanUserSA', compact(
            'laporanArtikelU', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 
            'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
            'LaporanKomentarArtikel', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 
            'FilterLA', 'AllTotalLaporan'
        ));
    }

        //[SuperAdmin-Laporan User] Delete Laporan Artikel User
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

        function laporanKomentarArtikelUserSA(Request $request){
            $laporanQuery = LaporanKomentarArtikel::orderBy('created_at', 'desc');
        
            if ($request->has('laporan')) {
                $laporanQuery->where('laporan', $request->laporan);
            }
        
            $laporanKomentarArtikelU = $laporanQuery->paginate(30);
        
            foreach ($laporanKomentarArtikelU as $laporan) {
                $commentId = $laporan->comment_id;
                $komentarArtikel = komentar_artikel::find($commentId);
                $laporan->user_id_komentar_artikel = $komentarArtikel->user_id;
            }
        
            $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
            $LaporanKomentarArtikel = LaporanKomentarArtikel::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        
            $FilterLA = LaporanKomentarArtikel::select('laporan')->distinct()->pluck('laporan');
            $AllTotalLaporan = LaporanKomentarArtikel::count();
        
            return view('SuperAdmin.laporan.laporanKomentarUserSA', compact(
                'laporanKomentarArtikelU', 
                'dataBaruUlasan', 
                'dataBaruUser', 
                'dataBaruArtikel', 
                'dataBaruKomentarArtikel', 
                'dataBaruVideo', 
                'dataBaruKomentarVideo', 
                'LaporanKomentarArtikel', 
                'dataBaruLaporanArtikel', 
                'dataBaruLaporanVideo',
                'FilterLA',
                'AllTotalLaporan'
            ));
        }
        

                //[SuperAdmin-Laporan User] Delete Laporan Artikel User
                function deleteLaporanKomentarArtikelSA($id){
                    // Find the reported article record with the given ID
                    $data = LaporanKomentarArtikel::find($id);
        
                    // Check if the reported article record exists
                    if ($data) {
                        // If the reported article record exists, delete it
                        $data->delete();
                        return redirect('/laporanKomentarArtikelUserSA')->with('success', 'Reported comment article deleted successfully');
                    } else {
                        // If the reported article record does not exist, redirect with an error message
                        return redirect('/laporanKomentarArtikelUserSA')->with('error', 'Reported comment article not found');
                    }
                }
        
        public function freezeUserArtikelSA(Request $request)
        {
            // Retrieve data from the request
            $commentId = $request->input('comment_id');
            $duration = $request->input('duration');
            $message = $request->input('message');
        
            // Retrieve comment based on comment_id using the relationship
            $komentar = komentar_artikel::find($commentId);
        
            // Check if the comment is not found
            if (!$komentar) {
                return redirect('/freezeUserArtikelSA')->with('error', 'Comment not found');
            }
        
            // Retrieve user_id from the comment relationship
            $userId = $komentar->user ? $komentar->user->id : null;
        
            // Check if the user is not found for the comment
            if (!$userId) {
                return redirect('/freezeUserArtikelSA')->with('error', 'User not found for the comment');
            }
        
            // Get the currently authenticated user's name
            $authenticatedUser = auth()->user()->name;
        
            // Update the user record with freeze information
            User::where('id', $userId)->update([
                'freeze_until' => now()->addDays($duration),
                'pesan_freeze' => $message,
                'freezeBy' => $authenticatedUser,
            ]);
        
            // Redirect with success message
            return redirect('/freezeUserArtikelSA')->with('success', 'User frozen successfully');
        }
        

        function laporanVideoUserSA(Request $request){
            // Ambil nilai filter dari request
            $filter = $request->input('laporan');
        
            // Query dasar
            $query = LaporanVideoUser::orderBy('created_at', 'desc');
        
            // Tambahkan kondisi filter jika ada
            if ($filter) {
                $query->where('laporan', $filter);
            }
        
            // Paginasi hasil query
            $laporanVideoUser = $query->paginate(10);
        
            // Hitung jumlah data yang ditambahkan dalam 24 jam terakhir
            $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
            $LaporanKomentarArtikel = LaporanKomentarArtikel::where('created_at', '>=', Carbon::now()->subDay())->count();
            $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
        
            // Data untuk filter
            $FilterLV = LaporanVideoUser::select('laporan')
                ->distinct()
                ->get()
                ->map(function ($item) {
                    return [
                        'laporan' => $item->laporan,
                        'count' => LaporanVideoUser::where('laporan', $item->laporan)->count()
                    ];
                });
        
            $AllTotalLaporan = LaporanVideoUser::count();
        
            return view('SuperAdmin.laporan.laporanVideoUserSA', compact(
                'laporanVideoUser', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 
                'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 
                'LaporanKomentarArtikel', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 
                'FilterLV', 'AllTotalLaporan'
            ));
        }

        public function updateTindakanArtikelSA(Request $request)
        {
            $laporanId = $request->input('laporan_id');
            $tindakan = $request->input('tindakan');
            
            $laporan = LaporanArtikelUser::findOrFail($laporanId);
            $laporan->tindakan = $tindakan;
            $laporan->save();
            
            return response()->json(['success' => true]);
        }
    
        public function updateTindakanVideoSA(Request $request)
        {
            $laporanId = $request->input('laporan_id');
            $tindakan = $request->input('tindakan');
            
            $laporan = laporanVideoUser::findOrFail($laporanId);
            $laporan->tindakan = $tindakan;
            $laporan->save();
            
            return response()->json(['success' => true]);
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


            function laporanKomentarVideoUserSA(Request $request) {
                $query = LaporanKomentarVideo::orderBy('created_at', 'desc');
            
                if ($request->has('filter')) {
                    $query->where('laporan', $request->input('filter'));
                }
            
                $laporanKomentarVideoUserSA = $query->paginate(30);
            
                foreach ($laporanKomentarVideoUserSA as $laporan) {
                    $commentId = $laporan->comment_id;
                    $komentarVideo = komentar_video::find($commentId);
                    $laporan->user_id_komentar_video = $komentarVideo->user_id;
                }
            
                $dataBaruUlasan = ulasans::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruUser = user::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruArtikel = artikels::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruKomentarArtikel = komentar_artikel::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruVideo = video::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruKomentarVideo = komentar_video::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruLaporanArtikel = laporanArtikelUser::where('created_at', '>=', Carbon::now()->subDay())->count();
                $LaporanKomentarArtikel = LaporanKomentarArtikel::where('created_at', '>=', Carbon::now()->subDay())->count();
                $dataBaruLaporanVideo = laporanVideoUser::where('created_at', '>=', Carbon::now()->subDay())->count();
            
                $FilterLA = LaporanKomentarVideo::select('laporan')->distinct()->pluck('laporan');
                $AllTotalLaporan = LaporanKomentarVideo::count();
            
                return view('SuperAdmin.laporan.laporanKomentarVideoSA', compact('laporanKomentarVideoUserSA', 'dataBaruUlasan', 'dataBaruUser', 'dataBaruArtikel', 'dataBaruKomentarArtikel', 'dataBaruVideo', 'dataBaruKomentarVideo', 'LaporanKomentarArtikel', 'dataBaruLaporanArtikel', 'dataBaruLaporanVideo', 'FilterLA', 'AllTotalLaporan'));
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

        return view('SuperAdmin.syaratdanketentuanSA', compact('data', 'dataBaruUlasan','dataBaruUser','dataBaruArtikel', 'dataBaruKomentarArtikel', 
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

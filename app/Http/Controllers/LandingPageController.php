<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artikels;
use App\Models\komentar_artikel;
use App\Models\komentar_video;
use App\Models\syaratdanketentuans;
use App\Models\RatingPenulis;
use App\Models\ulasans;
use App\Models\video;
use App\Models\Banner;
use App\Models\kategori;
use App\Models\user;
use App\Models\Follower;

class LandingPageController extends Controller
{

    //[Landing Page]  Search Artikel
    public function searchLP(Request $request) {
        $searchTerm = $request->input('search');
        
        $artikels = artikels::where('judulArtikel', 'like', '%' . $searchTerm . '%')
            ->get();
    
        return view('main.sebelumLogin.searchLP', compact('artikels'));
    }

    //[Landing Page] Search Video
    public function searchLPV(Request $request) {
        $searchTerm = $request->input('searchLPV');
        
        $videos = video::where('judulVideo', 'like', '%' . $searchTerm . '%')
            ->get();
    
        return view('main.sebelumLogin.searchLPV', compact('videos'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Landing Page] Halaman Home landing Page
    public function landingPage(Request $request)
    {
        $kategoriA = kategori::all();

        $ratingPenulis = RatingPenulis::all();
  
                $trending = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                ->orderBy('jumlah_akses', 'desc') // Order by jumlah_akses column in descending order
                ->take(4) // Get top 5 trending articles
                ->get();
        
    
                // Get the latest articles excluding "Pending" and "Rejected" articles
                $latest = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();

                // Get what's new articles randomly excluding "Pending" and "Rejected" articles
                $whatsnew = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                ->inRandomOrder()
                ->take(5)
                ->get();
    
                   // Get a box of articles randomly excluding "Pending" and "Rejected" articles
                $boxLong = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                ->inRandomOrder()
                ->take(1)
                ->get();

                $banner0 = Banner::where('jenis_banner', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

                $banner1 = Banner::where('jenis_banner', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

                $banner2 = Banner::where('jenis_banner', 2)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

                $box3 = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                ->orderBy('jumlah_akses', 'desc') // Order by jumlah_akses column in descending order
                ->take(4) // Get top 5 trending articles
                ->get();

                $box2 = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                    ->inRandomOrder()
                    ->take(2)
                    ->get();

                $box = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                    ->inRandomOrder()
                    ->take(8)
                    ->get();

                    $semua = artikels::where('status', 'Published')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
                
                $showLoadMoreButton = $semua->count() > 5;

                $todayDate = date('l, d M Y');
    
        return view('main.sebelumLogin.landingPage', compact('trending', 'latest','whatsnew','semua', 'showLoadMoreButton', 'box', 'box2', 'box3', 'banner0', 'banner1','banner2','boxLong', 'todayDate', 'kategoriA','ratingPenulis'));
    }

    //[Landing Page] Menampilkan Detail Artikel Ketika Di Klik
    public function showDetailLPArtikel($id)
    {
        $article = artikels::findOrFail($id);
    
        $kategoriA = kategori::all();
        
        $box = artikels::inRandomOrder()->take(8)->get();
        $tags = artikels::inRandomOrder()->take(5)->get();
        $kategori = artikels::inRandomOrder()->take(10)->get();
        
        // Hitung jumlah komentar untuk artikel dengan ID tertentu
        $totalKomentar = komentar_artikel::where('artikel_id', $id)->count();
        
        $detailArtikelLP = komentar_artikel::where('artikel_id', $id)->latest()->paginate(6);

           // Rating
        $user_id_penulis = $article->user_id; // Misalnya, mendapatkan user_id_penulis dari artikel yang sedang ditampilkan
        $averageRating = RatingPenulis::where('user_id_penulis', $user_id_penulis)->avg('rating');
        
        // Total rating berdasarkan user_id dan artikel_id
        $AvgArt = RatingPenulis::where('user_id_penulis', $user_id_penulis)
                                     ->where('artikel_id', $id)
                                     ->avg('rating');

        // Total rating berdasarkan artikel_id
        $totalRatingArt = RatingPenulis::where('artikel_id', $id)->count();
        $totalRatingPen = RatingPenulis::where('user_id', $id)->count();
    
        // Ambil data user berdasarkan id penulis artikel
        $user = User::findOrFail($article->user_id);

        // Format jumlah akses
        $formattedJumlahAkses = $this->formatJumlahAkses($article->jumlah_akses);

        // Ambil foto profil penulis artikel
        $fotoProfil = $user->fotoProfil;

               // Hitung total pengikut (followers) berdasarkan user_id
               $totalFollowers = Follower::where('user_id', $user->id)->count();
        
        // Lebih baik menggunakan array asosiatif agar lebih jelas
        return view('main.sebelumLogin.detailArtLP', [
            'kategoriA' => $kategoriA,
            'article' => $article,
            'box' => $box,
            'averageRating' => $averageRating,
            'tags' => $tags,
            'kategori' => $kategori,
            'detailArtikelLP' => $detailArtikelLP,
            'totalKomentar' => $totalKomentar,
            'fotoProfil' => $fotoProfil, // Tambahkan fotoProfil ke dalam data yang dilewatkan ke view
            'totalFollowers' => $totalFollowers,
            'formattedJumlahAkses' => $formattedJumlahAkses,
            'AvgArt' => $AvgArt ,
            'totalRatingArt' => $totalRatingArt,
            'totalRatingPen' => $totalRatingPen
        ]);
    }

        //[Landing Page-Home] Menampilkan Jumlah User Akses Artikel
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

    public function detailProfilPenulisArtikelLP($id)
    {
        $profilPenulis = artikels::findOrFail($id);
    
        // Ambil data user berdasarkan id penulis artikel
        $user = User::findOrFail($profilPenulis->user_id);
    
        // Ambil semua artikel yang tidak dalam status 'Pending' atau 'Rejected' milik penulis yang sama
        $semuaArtikel = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                          ->where('user_id', $profilPenulis->user_id)
                          ->get();
    
        // Ambil semua artikel yang tidak dalam status 'Pending' atau 'Rejected' milik penulis yang sama
        $semuaVideo = video::whereNotIn('statusVideo', ['Pending', 'Rejected'])
                        ->where('user_id', $profilPenulis->user_id)
                        ->get();

                    //rating
                    $user_id_penulis = $profilPenulis->user_id; // Misalnya, mendapatkan user_id_penulis dari artikel yang sedang ditampilkan
                    $averageRating = RatingPenulis::where('user_id_penulis', $user_id_penulis)->avg('rating');


        // Ambil foto profil penulis artikel
        $fotoProfil = $user->fotoProfil; // Pastikan fotoProfil tersedia di model User
    
        // Hitung total pengikut (followers) berdasarkan user_id
        $totalFollowers = Follower::where('user_id', $user->id)->count();
    
    
        $TotalArtikelId = artikels::where('user_id', $user->id)->count();
        $TotalVideoId = video::where('user_id', $user->id)->count();
    
        return view('main.sebelumLogin.profilePenulisArtikelLP', compact('profilPenulis', 'user', 'totalFollowers','fotoProfil','TotalArtikelId','TotalVideoId','semuaArtikel','semuaVideo', 'averageRating'));
    }

    public function TagsArtikelLP($tagName)
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
    
        // Kirim data artikel, tag name, dan tags ke view
        return view('main.sebelumLogin.tagsArtikelLP', compact('artikels', 'tagName', 'tags' , 'existingTags'));
    }
    

    public function searchTagsLP(Request $request)
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
    
        // Kirim data artikel, tag name, tags yang sudah ada ke view
        return view('main.sebelumLogin.tagsArtikelLP', compact('artikels', 'tagName', 'tags', 'existingTags'));
    }
    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Landing Page] Halaman Kategori landing Page

    function kategoriLandingPage(){

        $kategoriA = kategori::all();

        return view('main.sebelumLogin.KategoriSL.kategoriLandingPage', compact('kategoriA'));
    }

    function kategoriLandingPageA($kategori){

        $kategoriLandingPageA = artikels::where('kategori', $kategori)
            ->whereNotIn('status', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();
    
        return view('main.sebelumLogin.KategoriSL.kategoriLandingPageA', compact('kategoriLandingPageA'));
    }
    
    function kategoriLandingPageV($kategori){

        $kategoriLandingPageV = video::where('kategoriVideo', $kategori)
            ->whereNotIn('statusVideo', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();
    
        return view('main.sebelumLogin.KategoriSL.kategoriLandingPageV', compact('kategoriLandingPageV'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Landing Page] Halaman About landing Page

    function aboutLandingPage(){
        return view('main.sebelumLogin.aboutLandingPage');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   
    //[Landing Page] Syarat Ketentuan landing Page

    function syaratKetentuanLP(){
        $syarat = syaratdanketentuans::all();
        return view('main.sebelumLogin.syaratKetentuanLP', compact('syarat'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Landing Page] Halaman Video landing Page

    function landingPageVideo(Request $request){
            
        $semuaVideo = video::whereNotIn('statusVideo', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->get();

        $todayDate = date('l, d M Y');

        $kategoriV = kategori::all();

        return view('main.sebelumLogin.landingPageVideo', compact('semuaVideo', 'todayDate','kategoriV'));
    }

    //[Landing Page] Halaman Detail Video Ketika Di Klik
    public function showDetailLPVideo($id)
    {
        $video = Video::findOrFail($id);
    
        $kategoriV = kategori::all();
    
        $boxVideo = Video::inRandomOrder()->take(10)->get();
        $tagsV = Video::inRandomOrder()->take(5)->get();
    
        $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);
    
        $totalKomentarV = komentar_video::where('video_id', $id)->count();

        // Rating
         $user_id_penulis = $video->user_id; // Misalnya, mendapatkan user_id_penulis dari artikel yang sedang ditampilkan
         $averageRating = RatingPenulis::where('user_id_penulis', $user_id_penulis)->avg('rating');
                   
         // Total rating berdasarkan user_id dan artikel_id
         $AvgVid = RatingPenulis::where('user_id_penulis', $user_id_penulis)
                                               ->where('video_id', $id)
                                               ->avg('rating');
       
          // Total rating berdasarkan artikel_id
         $totalRatingVid = RatingPenulis::where('video_id', $id)->count();
         $totalRatingUp = RatingPenulis::where('user_id', $id)->count();
       
        
        // Ambil data user berdasarkan id penulis video
        $user = User::findOrFail($video->user_id);
        // Ambil foto profil penulis video
        $fotoProfil = $user->fotoProfil;

               // Hitung total pengikut (followers) berdasarkan user_id
               $totalFollowers = Follower::where('user_id', $user->id)->count();

        
        // Lebih baik menggunakan array asosiatif agar lebih jelas
        return view('main.sebelumLogin.detailVidLP', [
            'kategoriV' => $kategoriV,
            'video' => $video,
            'boxVideo' => $boxVideo,
            'tagsV' => $tagsV,
            'kategoriV' => $kategoriV,
            'komentarVideos' => $komentarVideos,
            'totalKomentarV' => $totalKomentarV,
            'fotoProfil' => $fotoProfil, // Tambahkan fotoProfil ke dalam data yang dilewatkan ke view
            'totalFollowers' => $totalFollowers,
            'averageRating' => $averageRating,
            'totalRatingVid' => $totalRatingVid,
            'totalRatingUp' => $totalRatingUp,
            'AvgVid' => $AvgVid
        ]);
    }

    public function detailProfilVideoLP($id)
    {
        $profilPenulis = video::findOrFail($id);
    
        // Ambil data user berdasarkan id penulis artikel
        $user = User::findOrFail($profilPenulis->user_id);
    
        // Ambil semua artikel yang tidak dalam status 'Pending' atau 'Rejected' milik penulis yang sama
        $semuaArtikel = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                          ->where('user_id', $profilPenulis->user_id)
                          ->get();
    
        // Ambil semua artikel yang tidak dalam status 'Pending' atau 'Rejected' milik penulis yang sama
        $semuaVideo = video::whereNotIn('statusVideo', ['Pending', 'Rejected'])
                        ->where('user_id', $profilPenulis->user_id)
                        ->get();

        //rating
        $user_id_penulis = $profilPenulis->user_id; // Misalnya, mendapatkan user_id_penulis dari artikel yang sedang ditampilkan
        $averageRating = RatingPenulis::where('user_id_penulis', $user_id_penulis)->avg('rating');


        // Ambil foto profil penulis artikel
        $fotoProfil = $user->fotoProfil; // Pastikan fotoProfil tersedia di model User
    
        // Hitung total pengikut (followers) berdasarkan user_id
        $totalFollowers = Follower::where('user_id', $user->id)->count();
    
    
        $TotalArtikelId = artikels::where('user_id', $user->id)->count();
        $TotalVideoId = video::where('user_id', $user->id)->count();
    
        return view('main.sebelumLogin.profileUploaderVideoLP', compact('profilPenulis', 'user', 'totalFollowers','fotoProfil','TotalArtikelId','TotalVideoId','semuaArtikel','semuaVideo','averageRating'));
    }

    public function searchTagsVideoLP(Request $request)
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
    
        // Kirim data video, tag name, tags yang sudah ada ke view
        return view('main.sebelumLogin.tagsVideoLP', compact('videos', 'tagName', 'existingTags'));
    }
    
    public function TagsVideosLP($tagName)
    {
        // Cari video berdasarkan tag
        $videos = Video::where('tagsVideo', 'like', '%' . $tagName . '%')->get();
    
        if ($videos->isEmpty()) {
            abort(404);
        }
    
        // Ambil daftar tag yang sudah ada dari basis data
        $existingTags = Video::select('tagsVideo')->distinct()->get();
    
        // Kirim data video, tag name, tags yang sudah ada ke view
        return view('main.sebelumLogin.tagsVideoLP', compact('videos', 'tagName', 'existingTags'));
    }

    

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[Landing Page] Ulasan landing Page

    function ulasanLandingPage(Request $request){
        // Mengambil data ulasan dengan mengurutkannya berdasarkan created_at
        $data1 = ulasans::orderBy('created_at', 'desc')->get();

        // Mengambil data ulasan secara acak
        $query = ulasans::orderBy('created_at', 'desc')->get();

        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
        
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
    
        //Hitung Ulasan
        $totalUlasan = ulasans::count();
        

        return view('main.sebelumLogin.ulasanLP', compact('data1', 'averageRating', 'totalUlasan'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artikels;
use App\Models\komentar_artikel;
use App\Models\komentar_video;
use App\Models\syaratdanketentuans;
use App\Models\ulasans;
use App\Models\video;

class LandingPageController extends Controller
{

    //[Landing Page] Halaman Home landing Page
    public function landingPage(Request $request)
    {
        $search = $request->input('search');
    
        $query1 = artikels::query();
        $query2 = artikels::query(); 
        $query3 = artikels::query(); 
        $query4 = artikels::query(); 
    
        if (!empty($search)) {
            $query1->where(function($query) use ($search) {
                $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                      ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
    
            $query2->where(function($query) use ($search) {
                $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                      ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
            $query3->where(function($query) use ($search) {
                $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                      ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
            $query4->where(function($query) use ($search) {
                $query->where('judulArtikel', 'LIKE', '%' . $search . '%')
                      ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }
    
            
                // Get trending articles randomly
                $trending = artikels::inRandomOrder()->take(3)->get();
    
                // Get the latest articles
                $latest = artikels::orderBy('created_at', 'desc')->take(8)->get();
    
                // Get what's new articles randomly
                $whatsnew = artikels::inRandomOrder()->take(5)->get();
    
                // Get a box of articles randomly
                $boxLong = artikels::inRandomOrder()->take(1)->get();
    
                // Get a box of articles randomly
                $box3 = artikels::inRandomOrder()->take(5)->get();
    
                // Get a box of articles randomly
                $box2 = artikels::inRandomOrder()->take(2)->get();
    
                // Get a box of articles randomly
                $box = artikels::inRandomOrder()->take(8)->get();
    
                $semua = artikels::all();
                $todayDate = date('l, d M Y');
    
        return view('main.sebelumLogin.landingPage', compact('trending', 'latest','whatsnew','semua', 'box', 'box2', 'box3', 'boxLong', 'todayDate'));
    }

    //[Landing Page] Menampilkan Detail Artikel Ketika Di Klik
    public function showDetailLPArtikel($id)
    {
        $article = artikels::findOrFail($id);

        $box = artikels::inRandomOrder()->take(8)->get();

        $tags = artikels::inRandomOrder()->take(10)->get();

        $kategori = artikels::inRandomOrder()->take(10)->get();

        $komentarArtikels = komentar_artikel::where('artikel_id', $id)->latest()->paginate(6);
    
        return view('main.sebelumLogin.detailArtLP', compact('article', 'box', 'tags', 'kategori', 'komentarArtikels'));
    }

    //[Landing Page] Halaman About landing Page

    function aboutLandingPage(){
        return view('main.sebelumLogin.aboutLandingPage');
    }

    //[Landing Page] Syarat Ketentuan landing Page

    function syaratKetentuanLP(){
        $syarat = syaratdanketentuans::all();
        return view('main.sebelumLogin.syaratKetentuanLP', compact('syarat'));
    }

    //[Landing Page] Halaman Video landing Page

    function landingPageVideo(Request $request){

        $search = $request->input('search');

        $query1 = video::query();
        $query2 = video::query(); 
        $query3 = video::query(); 
        $query4 = video::query(); 
    
        if (!empty($search)) {
            $query1->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
    
            $query2->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
            $query3->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
            $query4->where(function($query) use ($search) {
                $query->where('judulVideo', 'LIKE', '%' . $search . '%')
                      ->orWhere('uploader', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsiVideo', 'LIKE', '%' . $search . '%');
            });
        }
    
            
                // Get trending articles randomly
                $trendingVideo = video::orderBy('created_at', 'desc')->paginate(3);
    
                // Get the latest articles
                $latestVideo = video::orderBy('created_at', 'desc')->take(8)->get();
    
                // Get what's new articles randomly
                $whatsNewVideo = video::inRandomOrder()->take(5)->get();

                // Get a box of articles randomly
                 $boxVideo3 = video::inRandomOrder()->take(5)->get();

                // Get a box of articles randomly
                $boxVideo2 = video::inRandomOrder()->take(2)->get();
    
                // Get a box of articles randomly
                $boxVideo = video::inRandomOrder()->take(8)->get();
    
                $semuaVideo = video::all();
                $todayDate = date('l, d M Y');

        return view('main.sebelumLogin.landingPageVideo', compact('trendingVideo', 'latestVideo','whatsNewVideo','semuaVideo', 'boxVideo', 'boxVideo2', 'boxVideo3', 'todayDate'));
    }

    //[Landing Page] Halaman Detail Video Ketika Di Klik
    public function showDetailLPVideo($id)
    {
        $video = Video::findOrFail($id);

        $boxVideo = Video::inRandomOrder()->take(10)->get();
        $tagsV = Video::inRandomOrder()->take(10)->get();
        $kategoriV = Video::inRandomOrder()->take(10)->get();

        $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);
        
        return view('main.sebelumLogin.detailVidLP', compact('video', 'boxVideo', 'tagsV', 'kategoriV', 'komentarVideos'));
    }

    //[Landing Page] Ulasan landing Page

    function ulasanLandingPage(){
        // Mengambil data ulasan dengan mengurutkannya berdasarkan created_at
        $data1 = ulasans::orderBy('created_at', 'desc')->get();
    
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

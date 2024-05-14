<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\Likes;
use App\Models\syaratdanketentuans;
use App\Models\ulasans;
use App\Models\user;
use App\Models\video;
use App\Models\komentar_artikel;
use App\Models\LikeKomentarArtikel;
use App\Models\likeKomentarVideo;
use App\Models\komentar_video;
use App\Models\LaporanArtikelUser;
use App\Models\RatingPenulis;
use App\Models\LaporanUlasanUser;
use App\Models\LaporanKomentarArtikel;
use App\Models\LaporanKomentarVideo;
use App\Models\SimpanArtikel;
use App\Models\SimpanVideo;
use App\Models\Banner;
use App\Models\Follower;
use Illuminate\Support\Facades\Log;
use App\Models\LaporanVideoUser;
use Illuminate\Http\Request;
use App\Models\kategori;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PenggunaController extends Controller
{

        //[User]  Search Artikel
        public function search(Request $request) {
            $searchTerm = $request->input('search');
            
            $artikels = artikels::where('judulArtikel', 'like', '%' . $searchTerm . '%')
            ->where('status', 'published')
            ->get();
        

             // Get the currently authenticated user ID
          $currentUserId = auth()->id();

          // Retrieve user_ids that the current user is following
          $userIds = Follower::where('follower_id', $currentUserId)
              ->pluck('user_id')
              ->toArray();
  
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

  
          // Count the number of notifications
          $jumlahData = $notifArtikel->count();
  
          // Check if the authenticated user is following the article author
          $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow       
        
            return view('main.setelahLogin.search', compact('artikels','isFollowingAuthor','jumlahData','notifArtikel'));
        }
    
        //[User] Search Video
        public function searchV(Request $request) {
            $searchTerm = $request->input('searchV');
            
            $videos = video::where('judulVideo', 'like', '%' . $searchTerm . '%')
                ->get();


              //Notifikasi Penulis
                // Get the currently authenticated user ID
                $currentUserId = auth()->id();
            
                // Retrieve the article object if it's provided in the request
                $video_id = $request->input('video_id'); // Menggunakan objek $request untuk mengambil data dari permintaan
                $video = Video::find($video_id); // Menggunakan huruf besar untuk memanggil model Video
                
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = false;
                
                // Retrieve user_ids that the current user is following
                $userIds = Follower::where('follower_id', $currentUserId)
                    ->pluck('user_id')
                    ->toArray();
            
                // Get the latest notifications for the followed authors
                $notifVideo = Video::whereIn('user_id', $userIds)
                    ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
                    ->where('created_at', '>=', Carbon::now()->subDay())
                    ->latest()
                    ->get();
            
                // Count the number of notifications
                $jumlahData = $notifVideo->count();
            
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow
        
            return view('main.setelahLogin.searchV', compact('videos','isFollowingAuthor','jumlahData','notifVideo'));
        }


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    //[User-Home] Halaman Home
    function HomeSetelahLogin(Request $request){

        $kategoriLogA = kategori::all();

        $ratingPenulis = RatingPenulis::all();

    
        $banner0 = Banner::where('jenis_banner', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Fetch banners for different types
        $banner1 = Banner::where('jenis_banner', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        $banner2 = Banner::where('jenis_banner', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        $banner3 = Banner::where('jenis_banner', 3)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Get trending articles randomly
        $trending = artikels::whereNotIn('status' , ['Pending', 'Rejected'])
            ->orderBy('jumlah_akses', 'desc')
            ->take(3)
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
    
        $box3 = artikels::whereNotIn('status', ['Pending', 'Rejected'])
            ->orderBy('jumlah_akses', 'desc')
            ->take(5)
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
            ->limit(5) // Use limit instead of take for the initial set of data
            ->get();
        

    
        // Get the currently authenticated user ID
        $currentUserId = auth()->id();
    
        // Retrieve the article object if it's provided in the request
        $articleId = $request->input('article_id'); // Assuming you're passing article ID through the request
        $article = artikels::find($articleId); // Retrieve the article object based on the ID
    
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = false;
    
        // Retrieve user_ids that the current user is following
            $userIds = Follower::where('follower_id', $currentUserId)
            ->pluck('user_id')
            ->toArray();

        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();


        // Count the number of notifications
        $jumlahData = $notifArtikel->count();

        // Get the current date
        $todayDate = date('l, d M Y');

        // Check if the authenticated user is following the article author
        $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow
    
        return view('main.setelahLogin.home', compact('ratingPenulis','banner0', 'banner1', 'banner2', 'banner3', 'trending', 'latest', 'whatsnew', 'semua', 'box', 'box2', 'box3', 'boxLong', 'todayDate', 'kategoriLogA', 'isFollowingAuthor', 
        'notifArtikel','jumlahData'));
    }

    //[User-Home] Menampilkan Detail Artikel Ketika Di Klik
    public function showDetailArtikel($id)
    {
        $article = artikels::findOrFail($id);
        $kategoriLogA = kategori::all();
    
        $box = artikels::where('status', 'published')->inRandomOrder()->take(8)->get();
    
        $tags = artikels::inRandomOrder()->take(5)->get();
    
        $kategori = artikels::inRandomOrder()->take(10)->get();
    
        // Ambil ID pengguna saat ini
        $currentUserId = auth()->id();
    
        // Ambil rating pengguna untuk penulis artikel ini (jika ada)
        $userRating = RatingPenulis::where('user_id', $currentUserId)
                                    ->where('user_id_penulis', $article->user_id)
                                    ->where('artikel_id', $id)
                                    ->first();
    
        // Periksa apakah pengguna telah memberikan rating
        $userHasRated = !is_null($userRating);
    
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
    
        // Menyiapkan data komentar, menyaring yang lebih muda dari 5 hari
        $komentarArtikels = komentar_artikel::where('artikel_id', $id)
        ->latest()
        ->paginate(6);

    
        $totalKomentarArtikels = komentar_artikel::where('artikel_id', $id)
                                    ->where('created_at', '>=', Carbon::now()->subDays(5))
                                    ->count();
    
        // Retrieve the latest comment (if any) associated with the article
        $komentar = komentar_artikel::where('artikel_id', $id)->latest()->first();
    
        // Ambil data user berdasarkan id penulis artikel
        $user = User::findOrFail($article->user_id);
        // Ambil foto profil penulis artikel
        $fotoProfil = $user->fotoProfil;
    
        // Periksa waktu terakhir akses
        if ($article->last_accessed_at == null || $article->last_accessed_at->diffInDays(now()) >= 1) {
            // Jika lebih dari sehari yang lalu, tambahkan jumlah akses dan perbarui waktu terakhir akses
            $article->increment('jumlah_akses');
            $article->update(['last_accessed_at' => now()]);
        }
    
        // Format jumlah akses
        $formattedJumlahAkses = $this->formatJumlahAkses($article->jumlah_akses);
    
        // Hitung total pengikut (followers) berdasarkan user_id
        $totalFollowers = Follower::where('user_id', $user->id)->count();
    
        //Notifikasi Penulis
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = false;
    
        // Ambil ID pengguna saat ini
        $currentUserId = auth()->id();
    
        // Ambil user_id yang di-follow oleh pengguna saat ini
        $userIds = [];
        if (auth()->check()) {
            $userIds = Follower::where('follower_id', $currentUserId)
                               ->pluck('user_id')
                               ->toArray();
        }
    
        // Jika artikel yang sedang dilihat merupakan artikel dari user_id yang di-follow, atur $isFollowingAuthor menjadi true
        if (in_array($article->user_id, $userIds)) {
            $isFollowingAuthor = true;
        }
    
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
                                ->where('status', 'published') // Menambahkan kondisi status harus "published"
                                ->where('created_at', '>=', Carbon::now()->subDay())
                                ->latest()
                                ->get();
    
        // Menghitung jumlah data notifikasi
        $jumlahData = $notifArtikel->count();
    
        return view('main.setelahLogin.detailArt', compact('kategoriLogA', 'article', 'box', 'tags', 'kategori', 'komentarArtikels', 'totalKomentarArtikels', 'komentar', 'fotoProfil', 'isFollowingAuthor', 'user', 'totalFollowers', 
        'formattedJumlahAkses', 'averageRating', 'userHasRated', 'notifArtikel', 'jumlahData', 'AvgArt','totalRatingArt','totalRatingPen'));
    }
    

    

    //[User-Home] Menampilkan Jumlah User Akses Artikel
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

    public function storeRatingPenulis(Request $request, $artikel_id)
    {
        // Validasi request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Dapatkan objek artikel berdasarkan artikel_id
        $artikel = Artikels::findOrFail($artikel_id);
    
        // Periksa apakah pengguna sudah memberikan rating sebelumnya untuk artikel ini
        $existingRating = RatingPenulis::where('user_id', $validatedData['user_id'])
                                        ->where('artikel_id', $artikel_id)
                                        ->exists();
    
        // Jika pengguna sudah memberikan rating sebelumnya, berikan pesan kesalahan
        if ($existingRating) {
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk artikel ini sebelumnya.');
        }
    
        // Simpan rating penulis ke database
        RatingPenulis::create([
            'user_id' => $validatedData['user_id'],
            'user_id_penulis' => $artikel->user_id,
            'artikel_id' => $artikel_id,
            'rating' => $validatedData['rating'],
        ]);
    
        // Redirect atau kirim respon sesuai kebutuhan aplikasi
        return redirect()->back()->with('success', 'Rating penulis berhasil disimpan.');
    }
    
    
    public function detailProfilPenulisArtikel($id)
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
    
        // Check if the authenticated user is following the profilPenulis author
        $isFollowing = false;
        if (auth()->check()) {
            $follower = Follower::where('follower_id', auth()->user()->id)
                                ->where('user_id', $user->id)
                                ->first();
            if ($follower && $follower->status == 1) {
                $isFollowing = true;
            }
        }
    
        $TotalArtikelId = artikels::where('user_id', $user->id)->count();
        $TotalVideoId = video::where('user_id', $user->id)->count();


        //Notifikasi Penulis
        
         // Check if the authenticated user is following the profilPenulis author
         $isFollowingAuthor = false;
    
         // Ambil ID pengguna saat ini
         $currentUserId = auth()->id();
     
         // Ambil user_id yang di-follow oleh pengguna saat ini
         $userIds = [];
         if (auth()->check()) {
             $userIds = Follower::where('follower_id', $currentUserId)
                                ->pluck('user_id')
                                ->toArray();
         }
     
         // Jika artikel yang sedang dilihat merupakan artikel dari user_id yang di-follow, atur $isFollowingAuthor menjadi true
         if (in_array($profilPenulis->user_id, $userIds)) {
             $isFollowingAuthor = true;
         }
     
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

     
         // Menghitung jumlah data notifikasi
         $jumlahData = $notifArtikel->count();
    
        return view('main.setelahLogin.profilePenulisArtikel', compact('profilPenulis', 'isFollowing', 'user', 'totalFollowers','fotoProfil','TotalArtikelId','TotalVideoId','semuaArtikel','semuaVideo','averageRating','jumlahData','isFollowingAuthor','notifArtikel'));
    }
    
    

    public function follow(User $user)
    {
        $currentUser = auth()->user();
        $currentUser->following()->attach($user, ['status' => 1]);
    
        return response()->json(['message' => 'You are now following ' . $user->name]);
    }
    
    public function unfollow(User $user)
    {
        $currentUser = auth()->user();
        $currentUser->following()->detach($user);
    
        return response()->json(['message' => 'You have unfollowed ' . $user->name]);
    }
    

        //[User-Home] Simpan Artikel
        public function simpanArtikelView()
        {
            // Get the authenticated user
            $user = auth()->user();
        
            // Retrieve the saved articles for the user
            $savedArtikels = $user->simpanArtikels;

             // Get the currently authenticated user ID
             $currentUserId = auth()->id();

             // Retrieve user_ids that the current user is following
             $userIds = Follower::where('follower_id', $currentUserId)
                 ->pluck('user_id')
                 ->toArray();
     
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

     
             // Count the number of notifications
             $jumlahData = $notifArtikel->count();
     
             // Check if the authenticated user is following the article author
             $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow   
        
            return view('main.setelahLogin.simpanArtikel', compact('savedArtikels','jumlahData','isFollowingAuthor','notifArtikel'));
        }
        
        public function simpanArtikelData(Request $request, $id)
        {
            // Validate the request
            $request->validate([
                'artikel_id' => 'required|exists:artikels,id',
            ]);
        
            // Get the authenticated user
            $user = auth()->user();
        
            // Check if the user has already saved the article
            if ($user->simpanArtikels()->where('artikel_id', $request->artikel_id)->doesntExist()) {
                // If not, create a new SimpanArtikel record for the user
                $user->simpanArtikels()->create(['artikel_id' => $request->artikel_id]);
        
                return redirect()->back()->with('success', 'Artikel disimpan!');
            }
        
            // Article is already saved, you can handle this case as needed
            return redirect()->back()->with('info', 'Artikel sudah disimpan sebelumnya.');
        } 

        public function deleteSimpanArt($id)
        {
            $data = SimpanArtikel::find($id);
        
            if ($data) {
                $data->delete();
                return redirect()->route('simpan.artikelView')->with('success', 'Article Berhasil Dihapus');
            } else {
                return redirect()->route('simpan.artikelView')->with('error', 'Article Tidak Ditemukan');
            }
        }
        
        
    //[User-Detail Artikel] Menampilkan Komentar Pada Detail Artikel Ketika Di Klik
    public function storeKomentarArtikel(Request $request)
    {
        // Validasi data komentar jika diperlukan
        $request->validate([
            'pesan' => 'required',
        ]);
    
        // Simpan komentar ke dalam basis data
        $artikel = artikels::find($request->input('artikel_id'));
        $komentar = new komentar_artikel([
            'pesan' => $request->input('pesan'),
            'user_id' => auth()->id(),
            'created_at' => Carbon::now(), // Tambahkan waktu pembuatan
        ]);
        $artikel->komentarArtikel()->save($komentar);
    
        // Kosongkan waktu pembaruan
        $komentar->updated_at = null;
        $komentar->save();
    
        // Redirect atau tampilkan pesan sukses
        return redirect()->back();
    }

    public function storeLaporanKomentarArtikel(Request $request)
    {
        $request->validate([
            'comment_id' => 'required',
            'article_id' => 'required',
            'laporan' => 'required',
            'alasan' => 'required',
        ]);
    
        LaporanKomentarArtikel::create([
            'user_id_pelapor' => $request->user_id_pelapor,
            'artikel_id' => $request->article_id,
            'comment_id' => $request->comment_id,
            'laporan' => $request->laporan,
            'alasan' => $request->alasan,
            // tambahkan kolom lain sesuai kebutuhan
        ]);
    
        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }

    public function storeLaporanArtikel(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'artikel_id' => 'required|exists:artikels,id',
            'laporan' => 'required|string',
            'alasan' => 'required|string|max:255',
        ]);

        LaporanArtikelUser::create($request->all());

        return response()->json(['message' => 'Laporan berhasil dikirim'], 200);
    }
    
    
    

    public function likeKomentarArtikel($komentar_id)
    {
        $user = auth()->user();
        $komentar = komentar_artikel::find($komentar_id);
    
        // Check if the user has already liked the comment
        if ($komentar->likes()->where('user_id', $user->id)->exists()) {
            // If the user has already liked, delete the like
            $komentar->likes()->where('user_id', $user->id)->delete();
        } else {
            // If the user has not liked, add the like
            $like = new LikeKomentarArtikel(['user_id' => $user->id]);
            $komentar->likes()->save($like);
        }
    
        // Construct the URL based on the provided route
        $url = route('detail.artikel', ['id' => $komentar->artikel_id]);
    
        // Redirect back to the article detail page
        return redirect()->to($url);
    }
    
    
        //[User-Artikel] Delete Komentar Artikel
        public function deleteKomentarArtikel($id)
        {
            $comment = komentar_artikel::find($id);
        
            // Ensure comment is found
            if (!$comment) {
                return redirect()->route('detail.artikel', $id)->with('error', 'Comment not found');
            }
        
            // Ensure the user trying to delete the comment is the owner
            if (Auth::check() && $comment->user_id === Auth::user()->id) {
                $comment->delete();
                return redirect()->route('detail.artikel', $comment->artikel_id);
            } else {
                $errorMessage = 'You are not allowed to delete this comment. <a href="' . route('detail.artikel', ['id' => $comment->artikel_id]) . '">Go back</a>';
                return redirect()->route('detail.artikel', $comment->artikel_id)->with('error', $errorMessage);
            }
        }

        //[User-Artikel] Edit komentar Artikel
        public function simpanEditKomentarArtikel(Request $request, $id) {
            $komentar = komentar_artikel::find($id);
            
            if (!$komentar) {
                return response()->json(['error' => 'Komentar tidak ditemukan'], 404);
            }
        
            if ($request->user()->id !== $komentar->user_id) {
                return response()->json(['error' => 'Anda tidak memiliki izin untuk mengedit komentar ini'], 403);
            }
        
            $komentar->pesan = $request->input('pesan');
            // Tambahkan keterangan "Edited" jika data telah diubah
            $komentar->updated_at = now();
            $komentar->save();
        
            return response()->json(['message' => 'Pesan komentar berhasil diperbarui']);
        }


        public function TagsArtikel($tagName)
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

                         // Get the currently authenticated user ID
                         $currentUserId = auth()->id();

                         // Retrieve user_ids that the current user is following
                         $userIds = Follower::where('follower_id', $currentUserId)
                             ->pluck('user_id')
                             ->toArray();
                 
             // Get the latest notifications for the followed authors
             $notifArtikel = artikels::whereIn('user_id', $userIds)
             ->where('status', 'published') // Menambahkan kondisi status harus "published"
             ->where('created_at', '>=', Carbon::now()->subDay())
             ->latest()
             ->get();
     
                 
                         // Count the number of notifications
                         $jumlahData = $notifArtikel->count();
                 
                         // Check if the authenticated user is following the article author
                         $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow   
        
            // Kirim data artikel, tag name, dan tags ke view
            return view('main.setelahLogin.tagsArtikel', compact('artikels', 'tagName', 'tags' , 'existingTags','jumlahData','isFollowingAuthor','notifArtikel'));
        }
        

        public function searchTags(Request $request)
        {
            // Ambil nilai pencarian dari input pengguna
            $search = $request->input('search');
        
            // Ambil daftar tag yang sudah ada dari basis data
            $existingTags = artikels::select('tags')->distinct()->get();
        
            // Cari artikel berdasarkan tag
            $artikels = artikels::where('tags', 'like', '%' . $search . '%')
            ->where('status', 'published')
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

             // Notification
             $currentUserId = auth()->id();

             // Retrieve user_ids that the current user is following
             $userIds = Follower::where('follower_id', $currentUserId)
                 ->pluck('user_id')
                 ->toArray();
     
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

     
             // Count the number of notifications
             $jumlahData = $notifArtikel->count();
     
             // Check if the authenticated user is following the article author
             $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow   
        
            // Kirim data artikel, tag name, tags yang sudah ada ke view
            return view('main.setelahLogin.tagsArtikel', compact('artikels', 'tagName', 'tags', 'existingTags','jumlahData','isFollowingAuthor','notifArtikel'));
        }
        
        

//----------------------------------------------------------------------------------------------------------- Video Area ---------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------Video Area ---------------------------------------------------------------------------------------------------------------------------------------

    //[User-Video] Halaman Video
    function Video(Request $request){

        $kategoriLogV = Kategori::all();
                             
        $semuaVideo = Video::where('statusVideo', 'Published')
            ->inRandomOrder()
            ->get();


        // Mengambil tanggal hari ini
        $todayDate = date('l, d M Y');

         //Notifikasi Penulis
        // Get the currently authenticated user ID
        $currentUserId = auth()->id();
    
        // Retrieve the article object if it's provided in the request
        $video_id = $request->input('video_id'); // Menggunakan objek $request untuk mengambil data dari permintaan
        $video = Video::find($video_id); // Menggunakan huruf besar untuk memanggil model Video
         
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = false;
         
        // Retrieve user_ids that the current user is following
        $userIds = Follower::where('follower_id', $currentUserId)
            ->pluck('user_id')
            ->toArray();
     
        // Get the latest notifications for the followed authors
        $notifVideo = Video::whereIn('user_id', $userIds)
            ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->latest()
            ->get();
     
        // Count the number of notifications
        $jumlahData = $notifVideo->count();
     
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow
    
            return view('main.setelahLogin.video', compact('semuaVideo', 'todayDate', 'kategoriLogV', 'isFollowingAuthor', 'notifVideo', 'jumlahData'));
        }
    
        public function showDetailVideo($id)
        {
            $video = Video::findOrFail($id);

            $kategoriLogV = Kategori::all();

            $boxVideo = Video::inRandomOrder()->take(10)->get();
            $tagsV = Video::inRandomOrder()->take(5)->get();
            $kategoriV = Video::inRandomOrder()->take(10)->get();

            $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);

            $totalKomentarVideo = komentar_video::where('video_id', $id)->count();

            // Ambil ID pengguna saat ini
            $currentUserId = auth()->id();

            // Ambil rating pengguna untuk pembuat video ini (jika ada)
            $userRating = RatingPenulis::where('user_id', $currentUserId)
                                        ->where('user_id_penulis', $video->user_id)
                                        ->where('video_id', $id)
                                        ->first();

            // Periksa apakah pengguna telah memberikan rating
            $userHasRated = !is_null($userRating);


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

            // Ambil data user berdasarkan id pembuat video
            $user = User::findOrFail($video->user_id);
            // Ambil foto profil pembuat video
            $fotoProfil = $user->fotoProfil;

           //Notifikasi Penulis
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = false;
    
        // Ambil ID pengguna saat ini
        $currentUserId = auth()->id();
    
        // Ambil user_id yang di-follow oleh pengguna saat ini
        $userIds = [];
        if (auth()->check()) {
            $userIds = Follower::where('follower_id', $currentUserId)
                               ->pluck('user_id')
                               ->toArray();
        }
    
        // Jika artikel yang sedang dilihat merupakan artikel dari user_id yang di-follow, atur $isFollowingAuthor menjadi true
        if (in_array($video->user_id, $userIds)) {
            $isFollowingAuthor = true;
        }
    
                // Get the latest notifications for the followed authors
                $notifVideo = video::whereIn('user_id', $userIds)
                ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
                ->where('created_at', '>=', Carbon::now()->subDay())
                ->latest()
                ->get();
        
    
        // Menghitung jumlah data notifikasi
        $jumlahData = $notifVideo->count();

            // Hitung total pengikut (followers) berdasarkan user_id
            $totalFollowers = Follower::where('user_id', $user->id)->count();

            return view('main.setelahLogin.detailVid', [
                'kategoriLogV' => $kategoriLogV,
                'video' => $video,
                'averageRating' => $averageRating,
                'boxVideo' => $boxVideo,
                'tagsV' => $tagsV,
                'kategoriV' => $kategoriV,
                'komentarVideos' => $komentarVideos,
                'totalKomentarVideo' => $totalKomentarVideo,
                'fotoProfil' => $fotoProfil,
                'user' => $user,
                'totalFollowers' => $totalFollowers,
                'userHasRated' => $userHasRated, // Sertakan userHasRated ke dalam data yang dilewatkan ke view
                'isFollowingAuthor' => $isFollowingAuthor,
                'notifVideo' => $notifVideo,
                'jumlahData' => $jumlahData,
                'totalRatingVid' => $totalRatingVid,
                'totalRatingUp' => $totalRatingUp,
                'AvgVid' => $AvgVid
            ]);
        }
   
    
    public function storeRatingUploader(Request $request, $video_id)
    {
        // Validasi request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Dapatkan objek video berdasarkan video_id
        $video = Video::findOrFail($video_id);
    
        // Periksa apakah pengguna sudah memberikan rating sebelumnya untuk video ini
        $existingRating = RatingPenulis::where('user_id', $validatedData['user_id'])
                                        ->where('video_id', $video_id)
                                        ->exists();
    
        // Jika pengguna sudah memberikan rating sebelumnya, berikan pesan kesalahan
        if ($existingRating) {
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk artikel ini sebelumnya.');
        }
    
        // Simpan rating penulis ke database
        RatingPenulis::create([
            'user_id' => $validatedData['user_id'],
            'user_id_penulis' => $video->user_id,
            'video_id' => $video_id,
            'rating' => $validatedData['rating'],
        ]);
    
        // Redirect atau kirim respon sesuai kebutuhan aplikasi
        return redirect()->back()->with('success', 'Rating penulis berhasil disimpan.');
    }

    public function simpanVideoView(Request $request)
    {
        $user = auth()->user();
        $savedVideos = $user->simpanVideos;
    
        //Notifikasi Penulis
        // Get the currently authenticated user ID
        $currentUserId = auth()->id();
    
        // Retrieve the article object if it's provided in the request
        $video_id = $request->input('video_id'); // Menggunakan objek $request untuk mengambil data dari permintaan
        $video = Video::find($video_id); // Menggunakan huruf besar untuk memanggil model Video
         
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = false;
         
        // Retrieve user_ids that the current user is following
        $userIds = Follower::where('follower_id', $currentUserId)
            ->pluck('user_id')
            ->toArray();
     
        // Get the latest notifications for the followed authors
        $notifVideo = Video::whereIn('user_id', $userIds)
            ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->latest()
            ->get();
     
        // Count the number of notifications
        $jumlahData = $notifVideo->count();
     
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow
           
        return view('main.setelahLogin.simpanVideo', compact('savedVideos', 'isFollowingAuthor', 'notifVideo', 'jumlahData'));
    }

    public function storeLaporanKomentarVideo(Request $request)
    {
        $request->validate([
            'comment_id' => 'required',
            'video_id' => 'required',
            'laporan' => 'required',
            'alasan' => 'required',
        ]);
    
        LaporanKomentarVideo::create([
            'user_id_pelapor' => $request->user_id_pelapor,
            'video_id' => $request->video_id,
            'comment_id' => $request->comment_id,
            'laporan' => $request->laporan,
            'alasan' => $request->alasan,
            // tambahkan kolom lain sesuai kebutuhan
        ]);
    
        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }
    
       
       
       public function simpanVideoData(Request $request, $videoId)
        {
            // Assuming you are storing the authenticated user ID
            $userId = auth()->user()->id;

            // Check if the entry already exists
            $existingEntry = SimpanVideo::where('user_id', $userId)
                ->where('video_id', $videoId)
                ->first();

            if ($existingEntry) {
                // Entry already exists, inform the user
                return redirect()->back()->with('info', 'Video sudah disimpan sebelumnya.');
            }

            // Save the data using Eloquent
            SimpanVideo::create([
                'user_id' => $userId,
                'video_id' => $videoId,
            ]);

            return redirect()->back()->with('success', 'Video Berhasil Tersimpan.');
        } 
        
        
        public function deleteSimpanVid($id)
        {
            $data = SimpanVideo::find($id);
        
            if ($data) {
                $data->delete();
                return redirect()->route('simpan.videoView')->with('success', 'Video Berhasil Dihapus');
            } else {
                return redirect()->route('simpan.videoView')->with('error', 'Video Tidak Ditemukan');
            }
        }

    //[User-Detail Video] Komentar Video User
    public function storeKomentarVideo(Request $request)
    {
        // Validasi data komentar jika diperlukan
        $request->validate([
            'pesan' => 'required',
        ]);
    
        // Ambil video berdasarkan ID yang disimpan dalam input tersembunyi
        $video = Video::find($request->input('video_id'));
    
        if (!$video) {
            // Tambahkan penanganan kesalahan jika video tidak ditemukan
            return redirect()->back()->with('error', 'Video tidak ditemukan.');
        }
    
        // Simpan komentar ke dalam basis data dengan mengaitkannya dengan video yang tepat
        $komentar = new komentar_video([
            'pesan' => $request->input('pesan'),
            'user_id' => auth()->id(),
            'created_at' => Carbon::now(), // Tambahkan waktu pembuatan
        ]);
    
        $video->komentarVideo()->save($komentar);
    
        // Kosongkan waktu pembaruan
        $komentar->updated_at = null;
        $komentar->save();
    
        // Redirect atau tampilkan pesan sukses
        return redirect()->back();
    }
    
    public function storeLaporanVideo(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'user_id' => 'required',
            'video_id' => 'required',
            'laporan' => 'required',
            'alasan' => 'required',
        ]);
    
        // Simpan data laporan ke dalam database
        $laporan = new LaporanVideoUser([
            'user_id' => $request->user_id,
            'video_id' => $request->video_id,
            'laporan' => $request->laporan,
            'alasan' => $request->alasan,
            'created_at' => Carbon::now(), // Tambahkan waktu pembuatan
        ]);
    
        // Kosongkan waktu pembaruan
        $laporan->updated_at = null;
        $laporan->save();
    
        return response()->json(['message' => 'Laporan telah berhasil disimpan.']);
    }

        //[User-Video] Delete Komentar Video
        public function deleteKomentarVideo($id)
        {
            $comment = komentar_video::find($id);
            
            // Ensure comment is found
            if (!$comment) {
                return redirect()->back();
            }
            
            // Ensure the user trying to delete the comment is the owner
            if (Auth::check() && $comment->user_id === Auth::user()->id) {
                $videoId = $comment->video_id;
                $comment->delete();
                return redirect()->route('showDetailVideo', ['id' => $videoId]);
            } else {
                $errorMessage = 'You are not allowed to delete this comment. <a href="' . route('showDetailVideo', ['id' => $comment->video_id]) . '">Go back</a>';
                return redirect()->route('showDetailVideo', ['id' => $comment->video_id])->with('error', $errorMessage);
            }
        }
        
        

        //[User-Video] Like Komentar Video
        public function likeKomentarVideo($commentId)
        {
            $user = Auth::user();
            
            $komentar = komentar_video::find($commentId);
            
            if (!$komentar) {
                return redirect()->back()->with('error', 'Comment not found.');
            }
            
            // Check if the user has already liked the comment
            if ($komentar->likes()->where('user_id', $user->id)->exists()) {
                // If the user has already liked, delete the like
                $komentar->likes()->where('user_id', $user->id)->delete();
            } else {
                $like = new LikeKomentarVideo(['user_id' => $user->id]);
                $komentar->likes()->save($like);
            }
            
            $url = route('showDetailVideo', ['id' => $komentar->video_id]);
            

            return redirect()->to($url);
        }

               //[User-Video] Edit komentar Video
               public function simpanEditKomentarVideo(Request $request, $id) {
                $komentar = komentar_video::find($id);
                
                if (!$komentar) {
                    return response()->json(['error' => 'Komentar tidak ditemukan'], 404);
                }
        
                if ($request->user()->id !== $komentar->user_id) {
                    return response()->json(['error' => 'Anda tidak memiliki izin untuk mengedit komentar ini'], 403);
                }
        
                $komentar->pesan = $request->input('pesan');
                $komentar->save();
        
                return response()->json(['message' => 'Pesan komentar berhasil diperbarui']);
            }

            public function detailProfilVideo($id)
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
            
                 //Notifikasi Penulis
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = false;
            
                // Ambil ID pengguna saat ini
                $currentUserId = auth()->id();
            
                // Ambil user_id yang di-follow oleh pengguna saat ini
                $userIds = [];
                if (auth()->check()) {
                    $userIds = Follower::where('follower_id', $currentUserId)
                                    ->pluck('user_id')
                                    ->toArray();
                }
            
                // Jika artikel yang sedang dilihat merupakan artikel dari user_id yang di-follow, atur $isFollowingAuthor menjadi true
                if (in_array($profilPenulis->user_id, $userIds)) {
                    $isFollowingAuthor = true;
                }
            
                        // Get the latest notifications for the followed authors
                        $notifVideo = video::whereIn('user_id', $userIds)
                        ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
                        ->where('created_at', '>=', Carbon::now()->subDay())
                        ->latest()
                        ->get();
                
            
                // Menghitung jumlah data notifikasi
                $jumlahData = $notifVideo->count();

                    // Hitung total pengikut (followers) berdasarkan user_id
                    $totalFollowers = Follower::where('user_id', $user->id)->count();
            
                $TotalArtikelId = artikels::where('user_id', $user->id)->count();
                $TotalVideoId = video::where('user_id', $user->id)->count();
            
                return view('main.setelahLogin.profileUploaderVideo', compact('profilPenulis', 'user', 'totalFollowers','fotoProfil','TotalArtikelId','TotalVideoId','semuaArtikel','semuaVideo', 'averageRating', 'isFollowingAuthor', 'notifVideo', 'jumlahData'));
            }

            public function searchVideos(Request $request)
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


                //Notifikasi Penulis
                // Get the currently authenticated user ID
                $currentUserId = auth()->id();
            
                // Retrieve the article object if it's provided in the request
                $video_id = $request->input('video_id'); // Menggunakan objek $request untuk mengambil data dari permintaan
                $video = Video::find($video_id); // Menggunakan huruf besar untuk memanggil model Video
                
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = false;
                
                // Retrieve user_ids that the current user is following
                $userIds = Follower::where('follower_id', $currentUserId)
                    ->pluck('user_id')
                    ->toArray();
            
                // Get the latest notifications for the followed authors
                $notifVideo = Video::whereIn('user_id', $userIds)
                    ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
                    ->where('created_at', '>=', Carbon::now()->subDay())
                    ->latest()
                    ->get();
            
                // Count the number of notifications
                $jumlahData = $notifVideo->count();
            
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow
            
                // Kirim data video, tag name, tags yang sudah ada ke view
                return view('main.setelahLogin.tagsVideo', compact('videos', 'tagName', 'existingTags','isFollowingAuthor','jumlahData','notifVideo'));
            }
            
            public function TagsVideos(Request $request, $tagName)
            {
                // Cari video berdasarkan tag
                $videos = Video::where('tagsVideo', 'like', '%' . $tagName . '%')->get();
            
                if ($videos->isEmpty()) {
                    abort(404);
                }
            
                // Ambil daftar tag yang sudah ada dari basis data
                $existingTags = Video::select('tagsVideo')->distinct()->get();
            
                //Notifikasi Penulis
                // Get the currently authenticated user ID
                $currentUserId = auth()->id();
            
                // Retrieve the article object if it's provided in the request
                $video_id = $request->input('video_id'); // Menggunakan objek $request untuk mengambil data dari permintaan
                $video = Video::find($video_id); // Menggunakan huruf besar untuk memanggil model Video
                
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = false;
                
                // Retrieve user_ids that the current user is following
                $userIds = Follower::where('follower_id', $currentUserId)
                    ->pluck('user_id')
                    ->toArray();
            
                // Get the latest notifications for the followed authors
                $notifVideo = Video::whereIn('user_id', $userIds)
                    ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
                    ->where('created_at', '>=', Carbon::now()->subDay())
                    ->latest()
                    ->get();
            
                // Count the number of notifications
                $jumlahData = $notifVideo->count();
            
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow

                // Kirim data video, tag name, tags yang sudah ada ke view
                return view('main.setelahLogin.tagsVideo', compact('videos', 'tagName', 'existingTags','isFollowingAuthor','jumlahData','notifVideo'));
            }
        
        
        

//------------------------------------------------------------------------------------------------------------------------ Kategori Area -----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------ Kategori Area -----------------------------------------------------------------------------------------------------------------------------------------------

    //[User] Halaman Kategori 

    function kategori(){

        $kategoriLogA = kategori::all();

        // Get the currently authenticated user ID
        $currentUserId = auth()->id();

        // Retrieve user_ids that the current user is following
        $userIds = Follower::where('follower_id', $currentUserId)
            ->pluck('user_id')
            ->toArray();

        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();


        // Count the number of notifications
        $jumlahData = $notifArtikel->count();

        // Check if the authenticated user is following the article author
        $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow       

        return view('main.setelahLogin.Kategori.kategori', compact('kategoriLogA','isFollowingAuthor','jumlahData','notifArtikel'));
    }

    function KategoriA($kategori){

        $KategoriLogA = artikels::where('kategori', $kategori)
            ->whereNotIn('status', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();


              // Get the currently authenticated user ID
          $currentUserId = auth()->id();

          // Retrieve user_ids that the current user is following
          $userIds = Follower::where('follower_id', $currentUserId)
              ->pluck('user_id')
              ->toArray();
  
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

  
          // Count the number of notifications
          $jumlahData = $notifArtikel->count();
  
          // Check if the authenticated user is following the article author
          $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow    
    
        return view('main.setelahLogin.Kategori.KategoriA', compact('KategoriLogA','isFollowingAuthor','jumlahData','notifArtikel'));
    }
    
    function kategoriV(Request $request,$kategori){

        $kategoriLogV = video::where('kategoriVideo', $kategori)
            ->whereNotIn('statusVideo', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->take(10)
            ->get();

               //Notifikasi Penulis
                // Get the currently authenticated user ID
                $currentUserId = auth()->id();
            
                // Retrieve the article object if it's provided in the request
                $video_id = $request->input('video_id'); // Menggunakan objek $request untuk mengambil data dari permintaan
                $video = Video::find($video_id); // Menggunakan huruf besar untuk memanggil model Video
                
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = false;
                
                // Retrieve user_ids that the current user is following
                $userIds = Follower::where('follower_id', $currentUserId)
                    ->pluck('user_id')
                    ->toArray();
            
                // Get the latest notifications for the followed authors
                $notifVideo = Video::whereIn('user_id', $userIds)
                    ->where('statusVideo', 'published') // Menambahkan kondisi status harus "published"
                    ->where('created_at', '>=', Carbon::now()->subDay())
                    ->latest()
                    ->get();
            
                // Count the number of notifications
                $jumlahData = $notifVideo->count();
            
                // Check if the authenticated user is following the article author
                $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow

    
        return view('main.setelahLogin.Kategori.KategoriV', compact('kategoriLogV','isFollowingAuthor','jumlahData','notifVideo'));
    }


        
//------------------------------------------------------------------------------------------------------------------ About Area ------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------ About Area ------------------------------------------------------------------------------------------------------------------------------------

    //[User-About] Halaman About
    function about(){

          // Get the currently authenticated user ID
          $currentUserId = auth()->id();

          // Retrieve user_ids that the current user is following
          $userIds = Follower::where('follower_id', $currentUserId)
              ->pluck('user_id')
              ->toArray();
  
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

  
          // Count the number of notifications
          $jumlahData = $notifArtikel->count();
  
          // Check if the authenticated user is following the article author
          $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow       

        return view('main.setelahLogin.about', compact('isFollowingAuthor','jumlahData','notifArtikel'));
    }

//----------------------------------------------------------------------------------------------------------------- Syarat & Ketentuan Area -------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------- Syarat & Ketentuan Area -------------------------------------------------------------------------------------------------------------------------------------

    //[User-Syarat & Ketentuan] Halaman Syarat & Ketentuan
    function syaratKetentuanA(){
        $syarat = syaratdanketentuans::all();
        return view('main.setelahLogin.syaratKetentuanA', compact('syarat'));
    } 

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

   //[User-Ulasan] Halaman Ulasan
function ulasan(Request $request){
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

              // Get the currently authenticated user ID
              $currentUserId = auth()->id();

              // Retrieve user_ids that the current user is following
              $userIds = Follower::where('follower_id', $currentUserId)
                  ->pluck('user_id')
                  ->toArray();
      
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published') // Menambahkan kondisi status harus "published"
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->latest()
        ->get();

      
              // Count the number of notifications
              $jumlahData = $notifArtikel->count();
      
              // Check if the authenticated user is following the article author
              $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow         
         

    return view('main.setelahLogin.ulasan', compact('data1', 'averageRating', 'totalUlasan','isFollowingAuthor','jumlahData','notifArtikel'));
}


    //[User-Ulasan] Tambah Ulasan
    public function storeUlasan(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'pesan' => 'required',
        ]);
    
        $ulasan = new Ulasans;
        $ulasan->rating = $request->rating;
        $ulasan->email = $request->email;
        $ulasan->nama = $request->nama;
        $ulasan->pesan = $request->pesan;
    
        // Mengisi user_id dari pengguna yang sedang masuk
        $ulasan->user_id = Auth::id();
    
        // Sisipkan foto profil pengguna
        $user = Auth::user();
        $ulasan->fotoProfil = $user->fotoProfil;
        $ulasan->updated_at = null;
        $ulasan->save();
    
        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
    

    //[User-Ulasan] Edit Ulasan
    public function simpanEditUlasan(Request $request, $id) {

        $ulasan = ulasans::find($id);

        if (!$ulasan) {
            return response()->json(['error' => 'Ulasan tidak ditemukan'], 404);
        }

        // Periksa apakah pengguna saat ini adalah pemilik ulasan
        if ($ulasan->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk mengedit ulasan ini'], 403);
        }

        $ulasan->pesan = $request->input('pesan');
        $ulasan->save();

        return response()->json(['message' => 'Pesan ulasan berhasil diperbarui']);
    }


    //[User-Ulasan] Like Ulasan
    public function likeUlasan($id){
        $userId = Auth::id();
        
        // Cek Jika User Sudah Like atau Dislike
        $existingLike = Likes::where('ulasan_id', $id)->where('user_id', $userId)->first();
        $existingDislike = Dislikes::where('ulasan_id', $id)->where('user_id', $userId)->first();
        
        if (!$existingLike && !$existingDislike) {
            // Jika User Belum Dislike & Like, Tambah ke Like
            $like = new Likes();
            $like->ulasan_id = $id;
            $like->user_id = $userId;
            $like->save();
        } elseif ($existingDislike) {
            // Jika User Sebelumnya Dislike, Hapus Dislike dan Jadikan Like
            $existingDislike->delete();
            $like = new Likes();
            $like->ulasan_id = $id;
            $like->user_id = $userId;
            $like->save();
        }
    
        return redirect('ulasan');
    }
    
    //[User-Ulasan] Dislike Ulasan
    public function dislikeUlasan($id){
        $userId = Auth::id();
        
        // Cek Jika User Sudah Like atau Dislike
        $existingLike = Likes::where('ulasan_id', $id)->where('user_id', $userId)->first();
        $existingDislike = Dislikes::where('ulasan_id', $id)->where('user_id', $userId)->first();
        
        if (!$existingLike && !$existingDislike) {
            // Jika User Belum Dislike & Like, Tambah ke Dislike
            $dislike = new Dislikes();
            $dislike->ulasan_id = $id;
            $dislike->user_id = $userId;
            $dislike->save();
        } elseif ($existingLike) {
            // Jika User Sebelumnya Like, Hapus Like dan Jadikan Dislike
            $existingLike->delete();
            $dislike = new Dislikes();
            $dislike->ulasan_id = $id;
            $dislike->user_id = $userId;
            $dislike->save();
        }
    
        return redirect('ulasan');
    }
    
    //[User-Ulasan] Delete Ulasan
    public function deleteUlasan($id)
    {
        $ulasan = ulasans::find($id);

        // Pastikan ulasan ditemukan
        if (!$ulasan) {
            return redirect('/ulasan')->with('error', 'Ulasan tidak ditemukan');
        }

        // Pastikan pengguna yang mencoba menghapus ulasan adalah pemiliknya
        if (Auth::check() && $ulasan->user_id === Auth::user()->id) {
            $ulasan->delete();
            return redirect('/ulasan')->with('success', 'Ulasan berhasil dihapus');
        } else {
            return redirect('/ulasan')->with('error', 'Anda tidak diizinkan menghapus ulasan ini');
        }
    }


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[User-Profil] Halaman Profil
    public function profileUser()
    {
        // Get the currently authenticated user ID
        $currentUserId = auth()->id();
    
        // Count the number of followers for the authenticated user
        $followerCount = Follower::where('follower_id', $currentUserId)->count();
    
        // Retrieve user_ids that the current user is following
        $userIds = Follower::where('follower_id', $currentUserId)
            ->pluck('user_id')
            ->toArray();
    
        // Get the latest notifications for the followed authors
        $notifArtikel = artikels::whereIn('user_id', $userIds)
            ->where('status', 'published') // Menambahkan kondisi status harus "published"
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->latest()
            ->get();
    
        // Count the number of notifications
        $jumlahData = $notifArtikel->count();
    
        // Check if the authenticated user is following the article author
        $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow
    
        return view('main.setelahLogin.profile', compact('followerCount', 'isFollowingAuthor', 'jumlahData', 'notifArtikel'));
    }
    

        //[User-Profil] Halaman Profil
  public function profilPenulis()
  {
      return view('main.setelahLogin.profilePenulis');
  }  
    

      //[User-Profil] Edit Profil
      public function updateUser(Request $request, $id)
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
          if ($request->has('fotoProfil')) {
              $fotoProfil = $request->input('fotoProfil');
      
              // Cek apakah input adalah URL atau file
              if (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                  // Jika input adalah URL, simpan URL langsung ke database
                  $user->fotoProfil = $fotoProfil;
                  $user->save();
              } else {
                  // Jika input adalah file, proses upload dan simpan file
                  $image = $request->file('fotoProfil');
      
                  // Membuat Nama File Foto
                  $filename = 'fotoProfil_' . $user->name . '_' . $user->username . '.' . $image->getClientOriginalExtension();
      
                  // Menyimpan Foto Sesuai Direktori
                  $image->move(public_path('fotoProfil'), $filename);
      
                  // Update Nama File Foto
                  $user->fotoProfil = $filename;
                  $user->save();
              }
          }
      
          return redirect('/profileUser');
      }
      

      public function profileFollowing($follower_id)
{
    // Find the user being followed
    $followingPenulis = User::findOrFail($follower_id);
    
    // Get the current authenticated user's ID
    $currentUserId = Auth::id();

    // Retrieve user IDs that the current user is following
    $userIds = Follower::where('follower_id', $currentUserId)
        ->pluck('user_id')
        ->toArray();

    // Get the users that the current user is following
    $usersFollowingData = User::whereIn('id', $userIds)->get();

    // Count the number of users the current user is following
    $followerCount = count($userIds);

    // Check if the authenticated user is following the article author
    $isFollowingAuthor = true;

    // Get the latest notifications for the followed authors
    $notifArtikel = artikels::whereIn('user_id', $userIds)
        ->where('status', 'published')
        ->where('created_at', '>=', now()->subDay()) 
        ->latest()
        ->get();

    $jumlahData = $notifArtikel->count();

    // Return the view with the necessary data
    return view('main.setelahLogin.profileFollowing', compact('jumlahData','notifArtikel','followingPenulis', 'isFollowingAuthor','followerCount', 'usersFollowingData'));
}


        function profilPenulisUser($id){

            $penulis = User::findOrFail($id); // Mengambil pengguna berdasarkan ID
            $currentUserId = auth()->id();
        
            // Ambil semua artikel yang tidak dalam status 'Pending' atau 'Rejected' milik penulis yang sama
            $semuaArtikelPenulis = artikels::whereNotIn('status', ['Pending', 'Rejected'])
                    ->where('user_id', $penulis->id)
                    ->get();
        
            // Ambil semua video yang tidak dalam status 'Pending' atau 'Rejected' milik penulis yang sama
            $semuaVideoUploader = Video::whereNotIn('statusVideo', ['Pending', 'Rejected'])
                    ->where('user_id', $penulis->id)
                    ->get();
                    
                            // Retrieve user_ids that the current user is following
          $userIds = Follower::where('follower_id', $currentUserId)
          ->pluck('user_id')
          ->toArray();

            // Get the latest notifications for the followed authors
                $notifArtikel = artikels::whereIn('user_id', $userIds)
                ->where('status', 'published')
                ->where('created_at', '>=', now()->subDay()) // Menggunakan helper now() untuk mendapatkan waktu saat ini
                ->latest()
                ->get();
        
            // Count the number of notifications
            $jumlahData = $notifArtikel->count();
        
            // Check if the authenticated user is following the article author
            $isFollowingAuthor = true; // Langsung diatur ke true, karena kita ingin menampilkan notifikasi tanpa menunggu follow            
        
            // Mengambil data pengguna yang diikuti oleh pengguna saat ini
            $usersFollowingData = User::whereIn('id', $userIds)->get();
        
            // Menghitung jumlah pengikut pengguna saat ini
            $followerCount = count($userIds);
        
            $fotoProfil = $penulis->fotoProfil;
            $averageRating = RatingPenulis::where('user_id_penulis', $penulis->id)->avg('rating');
            $totalFollowers = Follower::where('user_id', $penulis->id)->count();
            $totalArtikelId = artikels::where('user_id', $penulis->id)->count();
            $totalVideoId = Video::where('user_id', $penulis->id)->count();
        
            // Mengembalikan tampilan blade dengan variabel-variabel yang telah didefinisikan
            return view('main.setelahLogin.profilPenulis', compact('penulis', 'fotoProfil', 'totalFollowers', 'totalArtikelId', 'totalVideoId', 'semuaArtikelPenulis', 'semuaVideoUploader', 'averageRating', 'isFollowingAuthor', 'jumlahData', 'notifArtikel'));
        }
    }      

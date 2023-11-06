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
use App\Models\komentar_video;
use App\Models\LaporanArtikelUser;
use App\Models\LaporanUlasanUser;
use App\Models\LaporanVideoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{

        //[Landing Page]  Search Artikel
        public function search(Request $request) {
            $searchTerm = $request->input('search');
            
            $artikels = artikels::where('judulArtikel', 'like', '%' . $searchTerm . '%')
                ->get();
        
            return view('main.setelahLogin.search', compact('artikels'));
        }
    
        //[Landing Page] Search Video
        public function searchV(Request $request) {
            $searchTerm = $request->input('searchV');
            
            $videos = video::where('judulVideo', 'like', '%' . $searchTerm . '%')
                ->get();
        
            return view('main.setelahLogin.searchV', compact('videos'));
        }

    //[User-Home] Halaman Home
    function HomeSetelahLogin(Request $request){

             // Get trending articles randomly
             $trending = artikels::whereNotIn('status' , ['Pending', 'Rejected'])
                ->inRandomOrder()
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
                 ->inRandomOrder()
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

             $semua = artikels::whereNotIn('status', ['Pending', 'Rejected'])->get();

            // Mengambil tanggal hari ini
            $todayDate = date('l, d M Y');
    
        return view('main.setelahLogin.home', compact('trending', 'latest','whatsnew','semua', 'box', 'box2', 'box3', 'boxLong', 'todayDate'));
    }

    //[User-Home] Menampilkan Detail Artikel Ketika Di Klik
    public function showDetailArtikel($id)
    {
        $article = artikels::findOrFail($id);

        $box = artikels::inRandomOrder()->take(8)->get();

        $tags = artikels::inRandomOrder()->take(10)->get();

        $kategori = artikels::inRandomOrder()->take(10)->get();
    
        $komentarArtikels = komentar_artikel::where('artikel_id', $id)->latest()->paginate(6);

        $totalKomentarArtikels = komentar_artikel::where('artikel_id', $id)->count();
    
        return view('main.setelahLogin.detailArt', compact('article', 'box', 'tags', 'kategori', 'komentarArtikels','totalKomentarArtikels'));
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
            $artikel->komentarArtikel()->create([
                'pesan' => $request->input('pesan'),
                'user_id' => auth()->id(),
            ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }

    //[User-Detail Artikel] Delete Komentar Video
    public function deleteKomentarA($id)
    {
        $article = komentar_artikel::find($id);
        if (!$article) {
            return redirect('/detailArtikel/' . $id)->with('error', 'Komentar tidak ditemukan');
        }

        $article->delete();
        return redirect('/detailArtikel/' . $id)->with('success', 'Komentar berhasil dihapus');
    }

    public function storeLaporanArtikel(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'user_id' => 'required',
            'artikel_id' => 'required',
            'laporan' => 'required',
            'alasan' => 'required',
        ]);

        // Simpan data laporan ke dalam database
        $laporan = new LaporanArtikelUser([
            'user_id' => $request->user_id,
            'artikel_id' => $request->artikel_id,
            'laporan' => $request->laporan,
            'alasan' => $request->alasan,
        ]);

        $laporan->save();

        return response()->json(['message' => 'Laporan telah berhasil disimpan.']);
    }


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[User-Video] Halaman Video
    function Video(Request $request){
                             
        $semuaVideo = video::whereNotIn('statusVideo', ['Pending', 'Rejected'])
            ->inRandomOrder()
            ->get();

                    // Mengambil tanggal hari ini
                    $todayDate = date('l, d M Y');
    
            return view('main.setelahLogin.video', compact('semuaVideo', 'todayDate'));
        }
    
    //[User-Detail Video] Halaman Detail Video Ketika Di Klik
    public function showDetailVideo($id)
    {
        $video = Video::findOrFail($id);

        $boxVideo = Video::inRandomOrder()->take(10)->get();
        $tagsV = Video::inRandomOrder()->take(10)->get();
        $kategoriV = Video::inRandomOrder()->take(10)->get();

        $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);
        
        $totalKomentarVideo = komentar_video::where('video_id', $id)->count();
        
        return view('main.setelahLogin.detailVid', compact('video', 'boxVideo', 'tagsV', 'kategoriV', 'komentarVideos', 'totalKomentarVideo'));
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
        ]);
    
        $video->komentarVideo()->save($komentar);
    
        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }

    //[User-Ulasan] Delete Komentar Video
    public function deleteKomentarV($id)
    {
        $video = komentar_video::find($id);
        if (!$video) {
            return redirect('/detailVideo/' . $id)->with('error', 'Komentar tidak ditemukan');
        }

        $video->delete();
        return redirect('/detailVideo/' . $id)->with('success', 'Komentar berhasil dihapus');
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
        ]);

        $laporan->save();

        return response()->json(['message' => 'Laporan telah berhasil disimpan.']);
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[User] Halaman Kategori 

    function kategori(){

        return view('main.setelahLogin.Kategori.kategori');
    }

        function kategoriAnimeLog(){
            $kategori = 'Anime';
        
            $kategoriAnime = artikels::where('kategori', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriAnimeLog', compact('kategoriAnime'));
        }

        function kategoriAnimeLogV(){
            $kategori = 'Anime';
        
            $kategoriAnimeLogV = video::where('kategoriVideo', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriAnimeVideo', compact('kategoriAnimeLogV'));
        }

        function kategoriVTuberLog(){
            $kategori = 'VTuber';
        
            $kategoriVTuber = artikels::where('kategori', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriVTuberLog', compact('kategoriVTuber'));
        }

        function kategoriVTuberLogV(){
            $kategori = 'VTuber';
        
            $kategoriVTuberLogV = video::where('kategoriVideo', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriVTuberVideo', compact('kategoriVTuberLogV'));
        }

        function kategoriGameLog(){
            $kategori = 'Game';
        
            $kategoriGame = artikels::where('kategori', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriGameLog', compact('kategoriGame'));
        }

        
        function kategoriGameLogV(){
            $kategori = 'Game';
        
            $kategoriGameLogV = video::where('kategoriVideo', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriGameVideo', compact('kategoriGameLogV'));
        }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[User-About] Halaman About
    function about(){
        return view('main.setelahLogin.about');
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[User-Syarat & Ketentuan] Halaman Syarat & Ketentuan
    function syaratKetentuanA(){
        $syarat = syaratdanketentuans::all();
        return view('main.setelahLogin.syaratKetentuanA', compact('syarat'));
    } 

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    //[User-Ulasan] Halaman Ulasan
    function ulasan(Request $request){
        // Mengambil data ulasan secara acak
        $query = ulasans::inRandomOrder();
    
       //Filter
        $filter = $request->input('filter'); 

        if ($filter === 'newest') {
            // Urutkan ulasan berdasarkan yang terbaru
            $query->orderByRaw('created_at DESC');
        } elseif ($filter === 'oldest') {
            // Urutkan ulasan berdasarkan yang terlama
            $query->orderByRaw('created_at ASC');
        } elseif ($filter === 'mine') {
            // Filter ulasan yang dimiliki oleh pengguna yang sedang login
            $query->where('user_id', auth()->user()->id);
        }

        $data1 = $query->get();
    
        //Rating
        $ratings = $data1->pluck('rating')->map(function ($rating) {
            return (int) $rating; // Mengonversi rating ke integer
        });
    
        $totalRatings = $ratings->sum();
        $averageRating = $ratings->count() > 0 ? $totalRatings / $ratings->count() : 0;
    
        //Hitung Ulasan
        $totalUlasan = ulasans::count();
    
        return view('main.setelahLogin.ulasan', compact('data1', 'averageRating', 'totalUlasan'));
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

        $ulasan->save();

        return redirect('ulasan');
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
        return view('main.setelahLogin.profile');
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
          if ($request->hasFile('fotoProfil')) {
              $image = $request->file('fotoProfil');
      
              // Membuat Nama File Foto
              $filename = 'fotoProfil.' . $user->name . ' ' . $user->username . '.' . $image->getClientOriginalExtension();
      
              // Menyimpan Foto Sesuai Direktori
              $image->move(public_path('fotoProfil'), $filename);
      
              // Update Nama File Foto
              $user->fotoProfil = $filename;
              $user->save();
          }
      
          return redirect('/profileUser');
      }
    }

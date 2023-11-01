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

    //[User-Home] Halaman Home
    function HomeSetelahLogin(Request $request){
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
    
            // Mengambil trending artikel secara random
            $trending = artikels::inRandomOrder()->take(3)->get();

            // Mengambil artikel terbaru
            $latest = artikels::orderBy('created_at', 'desc')->take(8)->get();

            // Mengambil what's new artikel secara random
            $whatsnew = artikels::inRandomOrder()->take(5)->get();

            // Mengambil boxLong artikel secara random
            $boxLong = artikels::inRandomOrder()->take(1)->get();

            // Mengambil box3 artikel secara random
            $box3 = artikels::inRandomOrder()->take(5)->get();
          
            // Mengambil box2 artikel secara random
            $box2 = artikels::inRandomOrder()->take(2)->get();

            // Mengambil box artikel secara random
            $box = artikels::inRandomOrder()->take(8)->get();

            // Mengambil semua artikel
            $semua = artikels::all();

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
    
        return view('main.setelahLogin.detailArt', compact('article', 'box', 'tags', 'kategori', 'komentarArtikels'));
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

                    // Mengambil video trending secara random
                    $trendingVideo = video::orderBy('created_at', 'desc')->paginate(3);
        
                      // Mengambil video terbaru
                    $latestVideo = video::orderBy('created_at', 'desc')->take(8)->get();
        
                      // Mengambil video what's new secara random
                    $whatsNewVideo = video::inRandomOrder()->take(5)->get();
        
                    // Mengambil video boxLong secara random
                    $boxVideoLong = video::inRandomOrder()->take(1)->get();
    
                    // Mengambil video boxVideo3 secara random
                    $boxVideo3 = video::inRandomOrder()->take(5)->get();
    
                    // Mengambil video boxVideo2 secara random
                    $boxVideo2 = video::inRandomOrder()->take(2)->get();
    
                    // Mengambil video boxVideo secara random
                    $boxVideo = video::inRandomOrder()->take(8)->get();
        
                    // Mengambil semua video
                    $semuaVideo = video::all();

                    // Mengambil tanggal hari ini
                    $todayDate = date('l, d M Y');
    
            return view('main.setelahLogin.video', compact('trendingVideo', 'latestVideo','whatsNewVideo','semuaVideo', 'boxVideo', 'boxVideo2', 'boxVideo3', 'boxVideoLong', 'todayDate'));
        }
    
    //[User-Detail Video] Halaman Detail Video Ketika Di Klik
    public function showDetailVideo($id)
    {
        $video = Video::findOrFail($id);

        $boxVideo = Video::inRandomOrder()->take(10)->get();
        $tagsV = Video::inRandomOrder()->take(10)->get();
        $kategoriV = Video::inRandomOrder()->take(10)->get();

        $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);
        
        return view('main.setelahLogin.detailVid', compact('video', 'boxVideo', 'tagsV', 'kategoriV', 'komentarVideos'));
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

        function kategoriVTuberLog(){
            $kategori = 'VTuber';
        
            $kategoriVTuber = artikels::where('kategori', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriVTuberLog', compact('kategoriVTuber'));
        }

        function kategoriGameLog(){
            $kategori = 'Game';
        
            $kategoriGame = artikels::where('kategori', $kategori)
                                    ->inRandomOrder()
                                    ->take(10)
                                    ->get();
        
            return view('main.setelahLogin.Kategori.kategoriGameLog', compact('kategoriGame'));
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
    function ulasan(){
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

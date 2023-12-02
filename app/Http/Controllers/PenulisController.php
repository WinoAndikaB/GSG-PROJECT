<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\Dislikes;
use App\Models\Event;
use App\Models\Likes;
use App\Models\syaratdanketentuans;
use App\Models\ulasans;
use App\Models\user;
use App\Models\video;
use App\Models\komentar_artikel;
use App\Models\LikeKomentarArtikel;
use App\Models\komentar_event;
use App\Models\komentar_video;
use App\Models\LaporanArtikelUser;
use App\Models\LaporanUlasanUser;
use App\Models\LaporanKomentarArtikel;
use App\Models\SimpanArtikel;
use App\Models\SimpanVideo;
use Illuminate\Support\Facades\Log;
use App\Models\LaporanVideoUser;
use Illuminate\Http\Request;
use App\Models\kategori;
use Illuminate\Support\Facades\Auth;

class PenulisController extends Controller
{
      //[User]  Search Artikel
      public function searchP(Request $request) {
        $searchTerm = $request->input('search');
        
        $artikels = artikels::where('judulArtikel', 'like', '%' . $searchTerm . '%')
            ->get();
    
        return view('Penulis.searchP', compact('artikels'));
    }

    //[User] Search Video
    public function searchVP(Request $request) {
        $searchTerm = $request->input('searchV');
        
        $videos = video::where('judulVideo', 'like', '%' . $searchTerm . '%')
            ->get();
    
        return view('Penulis.searchVP', compact('videos'));
    }

    //[User] Search Event
    public function searchEP(Request $request) {
        $searchTerm = $request->input('searchE');
        
        $searchE = Event::where('namaEvent', 'like', '%' . $searchTerm . '%')
            ->get();
    
        return view('Penulis.searchEP', compact('searchE'));
    }


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

 //[User]  Event Artikel
 public function eventP(Request $request) {

    $event = Event::whereNotIn('status', ['Pending', 'Rejected'])->get();

    return view('Penulis.eventP', compact('event'));
}

//[User] Detail Event
public function detailEventP(Request $request, $id) {

    $event = Event::findOrFail($id);

    $box = Event::inRandomOrder()->take(8)->get();
    $tags = Event::inRandomOrder()->take(10)->get();
    $kategori = Event::inRandomOrder()->take(10)->get();

    // Hitung jumlah komentar untuk artikel dengan ID tertentu
    $totalKomentarEvent = komentar_event::where('event_id', $id)->count();

    $komentarEvent = komentar_event::where('event_id', $id)->latest()->paginate(6);

    return view('Penulis.detailEventP', compact('event', 'box', 'tags', 'kategori', 'komentarEvent', 'totalKomentarEvent'));
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//[User-Home] Halaman Home
function HomePenulis(Request $request){

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

    return view('Penulis.homeP', compact('trending', 'latest','whatsnew','semua', 'box', 'box2', 'box3', 'boxLong', 'todayDate'));
}

//[User-Home] Menampilkan Detail Artikel Ketika Di Klik
public function showDetailArtikelP($id)
{
    $article = artikels::findOrFail($id);
    $kategoriLogA = kategori::all();

    $box = artikels::inRandomOrder()->take(8)->get();

    $tags = artikels::inRandomOrder()->take(10)->get();

    $kategori = artikels::inRandomOrder()->take(10)->get();

    $komentarArtikels = komentar_artikel::where('artikel_id', $id)->latest()->paginate(6);

    $totalKomentarArtikels = komentar_artikel::where('artikel_id', $id)->count();

    // Retrieve the latest comment (if any) associated with the article
    $komentar = komentar_artikel::where('artikel_id', $id)->latest()->first();

    return view('Penulis.detailArtP', compact('kategoriLogA', 'article', 'box', 'tags', 'kategori', 'komentarArtikels', 'totalKomentarArtikels', 'komentar'));
}

    //[User-Home] Simpan Artikel
    public function simpanArtikelViewP()
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Retrieve the saved articles for the user
        $savedArtikels = $user->simpanArtikels;
    
        return view('Penulis.simpanArtikelP', compact('savedArtikels'));
    }
    
    public function simpanArtikelDataP(Request $request, $id)
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

    public function deleteSimpanArtP($id)
    {
        $data = SimpanArtikel::find($id);
    
        if ($data) {
            $data->delete();
            return redirect()->route('simpan.artikelViewP')->with('success', 'Article Berhasil Dihapus');
        } else {
            return redirect()->route('simpan.artikelViewP')->with('error', 'Article Tidak Ditemukan');
        }
    }
    
    
//[User-Detail Artikel] Menampilkan Komentar Pada Detail Artikel Ketika Di Klik
public function storeKomentarArtikelP(Request $request)
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
    return redirect()->back();
}

public function storeLaporanKomentarArtikelP(Request $request)
{
    // Validate the request
    $request->validate([
        'user_id_pelapor' => 'required',
        'artikel_id' => 'required',
        'comment_id' => 'required',
        'laporan' => 'required',
        'alasan' => 'required',
    ]);

    // Create a new instance of LaporanKomentarArtikel
    $laporan = new LaporanKomentarArtikel([
        'user_id_pelapor' => $request->user_id_pelapor,
        'artikel_id' => $request->artikel_id,
        'comment_id' => $request->comment_id,
        'laporan' => $request->laporan,
        'alasan' => $request->alasan,
    ]);

    // Save the data to the database
    $laporan->save();

    // Return a success response
    return response()->json(['success' => 'Laporan berhasil dikirim'], 200);
}

public function likeKomentarArtikelP($komentar_id)
{
    $user = auth()->user();
    $komentar = komentar_artikel::find($komentar_id);

    // Check if the user has already liked the comment
    if (!$komentar->likes()->where('user_id', $user->id)->exists()) {
        $like = new LikeKomentarArtikel(['user_id' => $user->id]);
        $komentar->likes()->save($like);
    }

    return redirect()->back();
}    

    //[User-Artikel] Delete Komentar Artikel
    public function deleteKomentarArtikelP($id)
    {
        $comment = komentar_artikel::find($id);
    
        // Ensure comment is found
        if (!$comment) {
            return redirect()->route('detail.artikelP', $id)->with('error', 'Comment not found');
        }
    
        // Ensure the user trying to delete the comment is the owner
        if (Auth::check() && $comment->user_id === Auth::user()->id) {
            $comment->delete();
            return redirect()->route('detail.artikelP', $comment->artikel_id);
        } else {
            $errorMessage = 'You are not allowed to delete this comment. <a href="' . route('detail.artikelP', ['id' => $comment->artikel_id]) . '">Go back</a>';
            return redirect()->route('detail.artikelP', $comment->artikel_id)->with('error', $errorMessage);
        }
    }


//----------------------------------------------------------------------------------------------------------- Video Area ---------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------Video Area ---------------------------------------------------------------------------------------------------------------------------------------

//[User-Video] Halaman Video
function VideoP(Request $request){
                         
    $semuaVideo = video::whereNotIn('statusVideo', ['Pending', 'Rejected'])
        ->inRandomOrder()
        ->get();

                // Mengambil tanggal hari ini
                $todayDate = date('l, d M Y');

        return view('Penulis.videoP', compact('semuaVideo', 'todayDate'));
    }

//[User-Detail Video] Halaman Detail Video Ketika Di Klik
public function showDetailVideoP($id)
{
    $video = Video::findOrFail($id);

    $kategoriLogV = Kategori::all();

    $boxVideo = Video::inRandomOrder()->take(10)->get();
    $tagsV = Video::inRandomOrder()->take(10)->get();
    $kategoriV = Video::inRandomOrder()->take(10)->get();

    $komentarVideos = komentar_video::where('video_id', $id)->latest()->paginate(6);
    
    $totalKomentarVideo = komentar_video::where('video_id', $id)->count();
    
    return view('Penulis.detailVidP', compact('kategoriLogV', 'video', 'boxVideo', 'tagsV', 'kategoriV', 'komentarVideos', 'totalKomentarVideo'));
}

   //[User-Home] Simpan Artikel
   public function simpanVideoViewP()
   {
       $user = auth()->user();
       $savedVideos = $user->simpanVideos;
   
       return view('Penulis.simpanVideoP', compact('savedVideos'));
   }
   
   
   public function simpanVideoDataP(Request $request, $videoId)
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
    
    
    public function deleteSimpanVidP($id)
    {
        $data = SimpanVideo::find($id);
    
        if ($data) {
            $data->delete();
            return redirect()->route('simpan.videoViewP')->with('success', 'Video Berhasil Dihapus');
        } else {
            return redirect()->route('simpan.videoViewP')->with('error', 'Video Tidak Ditemukan');
        }
    }

//[User-Detail Video] Komentar Video User
public function storeKomentarVideoP(Request $request)
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
public function deleteKomentarVP($id)
{
    $video = komentar_video::find($id);
    if (!$video) {
        return redirect('/detailVideoP/' . $id)->with('error', 'Komentar tidak ditemukan');
    }

    $video->delete();
    return redirect('/detailVideoP/' . $id)->with('success', 'Komentar berhasil dihapus');
}

public function storeLaporanVideoP(Request $request)
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

    //[User-Video] Delete Komentar Video
    public function deleteKomentarVideoP($id)
    {
        $comment = komentar_video::find($id);
    
        // Ensure comment is found
        if (!$comment) {
            return redirect()->route('showDetailVideoP', $id)->with('error', 'Comment not found');
        }
    
        // Ensure the user trying to delete the comment is the owner
        if (Auth::check() && $comment->user_id === Auth::user()->id) {
            $comment->delete();
            return redirect()->route('showDetailVideoP', $comment->video_id)->with('success', 'Comment successfully deleted');
        } else {
            $errorMessage = 'You are not allowed to delete this comment. <a href="' . route('showDetailVideoP', ['id' => $comment->video_id]) . '">Go back</a>';
            return redirect()->route('showDetailVideoP', $comment->video_id)->with('error', $errorMessage);
        }
    }
    
    

//------------------------------------------------------------------------------------------------------------------------ Kategori Area -----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------ Kategori Area -----------------------------------------------------------------------------------------------------------------------------------------------

//[User] Halaman Kategori 

function kategoriP(){

    $kategoriLogA = kategori::all();

    return view('Penulis.kategoriP', compact('kategoriLogA'));
}

function KategoriAP($kategori){

    $KategoriLogA = artikels::where('kategori', $kategori)
        ->whereNotIn('status', ['Pending', 'Rejected'])
        ->inRandomOrder()
        ->take(10)
        ->get();

    return view('Penulis.KategoriAP', compact('KategoriLogA'));
}

function kategoriVP($kategori){

    $kategoriLogV = video::where('kategoriVideo', $kategori)
        ->whereNotIn('status', ['Pending', 'Rejected'])
        ->inRandomOrder()
        ->take(10)
        ->get();

    return view('Penulis.KategoriVP', compact('kategoriLogV'));
}
    
//------------------------------------------------------------------------------------------------------------------ About Area ------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------ About Area ------------------------------------------------------------------------------------------------------------------------------------

//[User-About] Halaman About
function aboutP(){
    return view('Penulis.aboutP');
}

//----------------------------------------------------------------------------------------------------------------- Syarat & Ketentuan Area -------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------- Syarat & Ketentuan Area -------------------------------------------------------------------------------------------------------------------------------------

//[User-Syarat & Ketentuan] Halaman Syarat & Ketentuan
function syaratKetentuanAP(){
    $syarat = syaratdanketentuans::all();
    return view('Penulis.syaratKetentuanAP', compact('syarat'));
} 

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//[User-Ulasan] Halaman Ulasan
function ulasanP(Request $request){
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
     

return view('Penulis.ulasanP', compact('data1', 'averageRating', 'totalUlasan'));
}


//[User-Ulasan] Tambah Ulasan
public function storeUlasanP(Request $request)
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

    return redirect('ulasanP');
}

//[User-Ulasan] Edit Ulasan
public function simpanEditUlasanP(Request $request, $id) {

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
public function likeUlasanP($id){
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

    return redirect('ulasanP');
}

//[User-Ulasan] Dislike Ulasan
public function dislikeUlasanP($id){
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

    return redirect('ulasanP');
}

//[User-Ulasan] Delete Ulasan
public function deleteUlasanP($id)
{
    $ulasan = ulasans::find($id);

    // Pastikan ulasan ditemukan
    if (!$ulasan) {
        return redirect('/ulasanP')->with('error', 'Ulasan tidak ditemukan');
    }

    // Pastikan pengguna yang mencoba menghapus ulasan adalah pemiliknya
    if (Auth::check() && $ulasan->user_id === Auth::user()->id) {
        $ulasan->delete();
        return redirect('/ulasanP')->with('success', 'Ulasan berhasil dihapus');
    } else {
        return redirect('/ulasanP')->with('error', 'Anda tidak diizinkan menghapus ulasan ini');
    }
}


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//[User-Profil] Halaman Profil
public function profileP()
{
    return view('Penulis.profileP');
}  

    //[User-Profil] Halaman Profil
public function profilPenulisP()
{
  return view('Penulis.profilePenulisP');
}  


  //[User-Profil] Edit Profil
  public function updateUserP(Request $request, $id)
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
  
      return redirect('/profileP');
  }
}

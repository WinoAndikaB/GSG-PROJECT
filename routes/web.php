<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// [Halaman Non-User]

        //[Non-User] Tab Home landing Page
        Route::get('/', [LandingPageController::class, 'landingPage'])->name('landingPage');
        Route::get('/detailArtikelLP/{id}', [LandingPageController::class, 'showDetailLPArtikel'])->name('showDetailLPArtikel');

         //[Non-User] Tab Home landing Page Video
        Route::get('/landingPageVideo',[LandingPageController::class,'landingPageVideo'])->name('landingPageVideo');
        Route::get('/detailVideoLP/{id}', [LandingPageController::class, 'showDetailLPVideo'])->name('showDetailLPVideo');

        //[Non-User] Tab Kategori Landing Page
        Route::get('/kategoriLandingPage', [LandingPageController::class, 'kategoriLandingPage'])->name('kategoriLandingPage');
        Route::get('/kategoriAnime', [LandingPageController::class, 'kategoriAnime'])->name('kategoriAnime');
        Route::get('/kategoriAnimeV', [LandingPageController::class, 'kategoriAnimeV'])->name('kategoriAnimeV');

        Route::get('/kategoriVTuber', [LandingPageController::class, 'kategoriVTuber'])->name('kategoriVTuber');
        Route::get('/kategoriVTuberV', [LandingPageController::class, 'kategoriVTuberV'])->name('kategoriVTuberV');

        Route::get('/kategoriGame', [LandingPageController::class, 'kategoriGame'])->name('kategoriGame');
        Route::get('/kategoriGameV', [LandingPageController::class, 'kategoriGameV'])->name('kategoriGameV');

        Route::get('/kategoriAnimeVideo', [LandingPageController::class, 'kategoriAnimeVideo'])->name('kategoriAnimeVideo');
        Route::get('/kategoriVTuberVideo', [LandingPageController::class, 'kategoriVTuberVideo'])->name('kategoriVTuberVideo');
        Route::get('/kategoriGameVideo', [LandingPageController::class, 'kategoriGameVideo'])->name('kategoriGameVideo');

        //[Non-User] Tab About Landing Page
        Route::get('/abouts', [LandingPageController::class, 'aboutLandingPage'])->name('aboutLandingPage');

        //[Non-User] Tab Ulasan Landing Page
        Route::get('/ulasanLandingPage', [LandingPageController::class, 'ulasanLandingPage'])->name('ulasanLandingPage');
        
        //[Non-User] Halaaman Syarat Ketentuan Landing Page
        Route::get('/syaratKetentuanLP', [LandingPageController::class, 'syaratKetentuanLP'])->name('syaratKetentuanLP');

         //[Non-User] Halaman Login
        Route::get('/login',[LoginController::class,'log']);
        Route::post('/login',[LoginController::class,'login'])->name('login');

        //[Non-User] Tab Register User
        Route::get('/register',[LoginController::class,'register']);
        Route::post('/registerUser',[LoginController::class,'registerUser']);

        //[Non-User] Tab Lupa Password User
        Route::get('/lupaPassword',[LoginController::class,'lupaPassword']);
        Route::get('/resetPassword',[LoginController::class,'resetPassword']);

        //[Non-User] Tab Register Logout
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// [Halaman User]

    //[Admin] Membatasi Hak Akases Admin
    Route::middleware(['user'])->group(function () {

        //[User] Tab Home
        Route::get('/home',[PenggunaController::class,'HomeSetelahLogin'])->name('HomeSetelahLogin');
        Route::get('/detailArtikel/{id}', [PenggunaController::class, 'showDetailArtikel'])->name('detail.artikel');
        Route::post('/komentarArtikel', [PenggunaController::class, 'storeKomentarArtikel'])->name('storeKomentarArtikel');
        Route::post('/submit/report', [PenggunaController::class, 'storeLaporanArtikel'])->name('storeLaporanArtikel');
        Route::get('/deleteKomentarA/{id}',[PenggunaController::class,'deleteKomentarA'])->name('deleteKomentarA');

        //[User] Tab Video
        Route::get('/Video',[PenggunaController::class,'Video'])->name('Video');
        Route::get('/detailVideo/{id}', [PenggunaController::class, 'showDetailVideo'])->name('showDetailVideo');
        Route::post('/komentarVideo', [PenggunaController::class, 'storeKomentarVideo'])->name('storeKomentarVideo');
        Route::post('/submitV/reportV', [PenggunaController::class, 'storeLaporanVideo'])->name('storeLaporanVideo');
        Route::get('/deleteKomentarV/{id}', [PenggunaController::class, 'deleteKomentarV'])->name('deleteKomentarV');

        //[User] Tab Kategori
        Route::get('/kategori', [PenggunaController::class, 'kategori'])->name('kategori');
        Route::get('/kategoriAnimeLog', [PenggunaController::class, 'kategoriAnimeLog'])->name('kategoriAnimeLog');
        Route::get('/kategoriVTuberLog', [PenggunaController::class, 'kategoriVTuberLog'])->name('kategoriVTuberLog');
        Route::get('/kategoriGameLog', [PenggunaController::class, 'kategoriGameLog'])->name('kategoriGameLog');

        //[User] Tab Profil
        Route::get('/profileUser', [PenggunaController::class, 'profileUser'])->name('profileUser');
        Route::put('/profileUser/updateUser/{id}',[PenggunaController::class,'updateUser'])->name('updateUser');

        //[User] Tab About
        Route::get('/about', [PenggunaController::class, 'about'])->name('about');

        //[User] Tab Syarat & Ketentuan
        Route::get('/syaratKetentuanA', [PenggunaController::class, 'syaratKetentuanA'])->name('syaratKetentuanA');

        //[User] Tab Ulasan

        //[User] Tab Halaman Ulasan
        Route::get('/ulasan', [PenggunaController::class, 'ulasan'])->name('ulasan');

        //[User] Tab Tambah Ulasan
        Route::post('/storeUlasan',[PenggunaController::class,'storeUlasan']);

        //[User] Tab Delete Ulasan
        Route::get('/deleteUlasan/{id}', [PenggunaController::class, 'deleteUlasan'])->name('deleteUlasan');

        //[User] Tab Like & Dislike Ulasan
        Route::get('/likeUlasan/{id}', [PenggunaController::class, 'likeUlasan'])->name('likeUlasan');
        Route::get('/dislikeUlasan/{id}', [PenggunaController::class, 'dislikeUlasan'])->name('dislikeUlasan');

         //[User] Tab Edit Ulasan
        Route::post('/simpanEditUlasan/{id}', [PenggunaController::class, 'simpanEditUlasan'])->name('simpanEditUlasan');
    });

// [Halaman Admin]

    //[Admin] Membatasi Hak Akases Admin
    Route::middleware(['admin'])->group(function () {

    //[Admin] Tab Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //[Admin] Tab Profil
        Route::get('/profileAdmin', [AdminController::class, 'profileAdmin'])->name('profileAdmin');
        Route::put('/profileAdmin/updateAdmin/{id}',[AdminController::class,'updateAdmin'])->name('updateAdmin');

    //[Admin] Tab Artikel

        //[Admin] Tabel Artikel
        Route::get('/artikelAdmin', [AdminController::class, 'artikel'])->name('artikel');
        Route::get('/komentarArtikel', [AdminController::class, 'komentarArtikel'])->name('komentarArtikel');

        //[Admin] Tambah Artikel
        Route::get('/artikel/create',  [AdminController::class, 'create'])->name('artikel.create');
        Route::post('/artikel/store',  [AdminController::class, 'store'])->name('artikel.store');

        //[Admin] Delete Artikel
        Route::get('/deleteA/{id}',[AdminController::class,'deleteArtikel'])->name('deleteArtikel');
        Route::get('/deleteKomentarAA/{id}',[AdminController::class,'deleteKomentarAA'])->name('deleteKomentarAA');

        //[Admin] Edit Artikel
        Route::get('/tampilDataEditArtikel/{id}',[AdminController::class,'tampilDataEditArtikel']);
        // Route::post('/updateDataIdArtikel/{id}',[AdminController::class,'updateDataIdArtikel']);
        Route::post('/formEditArtikel/updateArtikel/{id}',[AdminController::class,'updateArtikel'])->name('updateArtikel');

    //[Admin] Tab Video

        //[Admin] Tabel Video
        Route::get('/videoAdmin', [AdminController::class, 'videoAdmin'])->name('videoAdmin');
        Route::get('/komentarVideo', [AdminController::class, 'komentarVideo'])->name('komentarVideo');

        //[Admin] Tambah Video Admin
        Route::get('/formTambahVideo', [AdminController::class, 'formTambahVideo'])->name('formTambahVideo');
        Route::post('/formTambahVideo/storeVideo',  [AdminController::class, 'storeVideo'])->name('storeVideo');

        //[Admin] Edit Video
        Route::get('/formEditVideo/{id}',[AdminController::class,'formEditVideo'])->name('formEditVideo');
        Route::post('/formEditVideo/updateVideo/{id}',[AdminController::class,'updateVideo'])->name('updateVideo');

        //[Admin] Delete Pengguna
        Route::get('/deleteV/{id}',[AdminController::class,'deleteVideo'])->name('deleteVideo');
        Route::get('/deleteKomentarVA/{id}',[AdminController::class,'deleteKomentarVA'])->name('deleteKomentarVA');

    //[Admin] Tab Pengguna

        //[Admin] Tabel Pengguna
        Route::get('/pengguna', [AdminController::class, 'listUserTerdaftar'])->name('listUserTerdaftar');

        //[Admin] Tabel Pengguna Like Dislike
        Route::get('/PenggunaLikeDislike', [AdminController::class, 'PenggunaLikeDislike'])->name('PenggunaLikeDislike');

        //[Admin] Tambah User Admin
        Route::get('/formTambahUserAdm', [AdminController::class, 'formTambahUserAdm'])->name('formTambahUserAdm');
        Route::post('/registerAdmin',[AdminController::class,'registerAdmin']);

        //[Admin] Delete Pengguna
        Route::get('/deleteP/{id}',[AdminController::class,'deleteUserTerdaftar']);

    //[Admin] Tab Ulasan

        //[Admin] Tabel Ulasan
        Route::get('/ulasans', [AdminController::class, 'ulasanAdmin'])->name('ulasanAdmin');

        //[Admin] Delete Ulasan
        Route::get('/deleteU/{id}',[AdminController::class,'deleteUlasanA']);
        });
    
     //[Admin] Tab Laporan User

        //[Admin] Tabel Laporan
        Route::get('/laporanUser', [AdminController::class, 'laporanUser'])->name('laporanUser');
        Route::get('/laporanVideoUser', [AdminController::class, 'laporanVideoUser'])->name('laporanVideoUser');
        Route::get('/laporanUlasanUser', [AdminController::class, 'laporanUlasanUser'])->name('laporanUlasanUser');

        Route::get('/deleteLaporanUA/{id}',[AdminController::class,'deleteLaporanUA'])->name('deleteLaporanUA');
        Route::get('/deleteLaporanVA/{id}',[AdminController::class,'deleteLaporanVA'])->name('deleteLaporanVA');

    //[Admin] Tab Syarat & Ketentuan

        //[Admin] Tabel Syarat & Ketentuan
        Route::get('/syaratdanketentuan',[AdminController::class,'syaratdanketentuan'])->name('syaratdanketentuan');

        //[Admin] Tambah Syarat & Ketentuan
        Route::get('/formTambahTdanC',  [AdminController::class, 'formTambahTdanC'])->name('formTambahTdanC');
        Route::post('/formTambahTdanC/storeTdanC',  [AdminController::class, 'storeTdanC'])->name('storeTdanC');

        //[Admin] Delete Syarat & Ketentuan
        Route::get('/deleteTdanC/{id}',[AdminController::class,'deleteTdanC']);

        //[Admin] Edit Syarat & Ketentuan
        Route::get('/formEditTdanC/{id}',[AdminController::class,'formEditTdanC'])->name('formEditTdanC');
        Route::post('/formEditTdanC/updateTdanC/{id}',[AdminController::class,'updateTdanC'])->name('updateTdanC');


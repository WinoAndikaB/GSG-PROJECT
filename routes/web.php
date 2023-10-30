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

         //[Non-User] Tab Home landing Page Video
        Route::get('/landingPageVideo',[LandingPageController::class,'landingPageVideo'])->name('landingPageVideo');

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

        //[Non-User] Tab Register Logout
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// [Halaman User]

    //[Admin] Membatasi Hak Akases Admin
    Route::middleware(['user'])->group(function () {

        //[User] Tab Home
        Route::get('/home',[PenggunaController::class,'HomeSetelahLogin'])->name('HomeSetelahLogin');
        Route::get('/detailArtikel/{id}', [PenggunaController::class, 'showDetailArtikel'])->name('detail.artikel');

        //[User] Tab Video
        Route::get('/Video',[PenggunaController::class,'Video'])->name('Video');
        Route::get('/detailVideo/{id}', [PenggunaController::class, 'showDetailVideo'])->name('showDetailVideo');

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
        Route::get('/artikelAdmin', [AdminController::class, 'dataArtikel'])->name('dataArtikel');

        //[Admin] Tambah Artikel
        Route::get('/artikel/create',  [AdminController::class, 'create'])->name('artikel.create');
        Route::post('/artikel/store',  [AdminController::class, 'store'])->name('artikel.store');

        //[Admin] Delete Artikel
        Route::get('/deleteA/{id}',[AdminController::class,'deleteArtikel'])->name('deleteArtikel');

        //[Admin] Edit Artikel
        Route::get('/tampilDataEditArtikel/{id}',[AdminController::class,'tampilDataEditArtikel']);
        Route::post('/updateDataIdArtikel/{id}',[AdminController::class,'updateDataIdArtikel']);

    //[Admin] Tab Video

        //[Admin] Tabel Video
        Route::get('/videoAdmin', [AdminController::class, 'videoAdmin'])->name('videoAdmin');

        //[Admin] Tambah Video Admin
        Route::get('/formTambahVideo', [AdminController::class, 'formTambahVideo'])->name('formTambahVideo');
        Route::post('/formTambahVideo/storeVideo',  [AdminController::class, 'storeVideo'])->name('storeVideo');

        //[Admin] Edit Video
        Route::get('/formEditVideo/{id}',[AdminController::class,'formEditVideo'])->name('formEditVideo');
        Route::post('/formEditVideo/updateVideo/{id}',[AdminController::class,'updateVideo'])->name('updateVideo');

        //[Admin] Delete Pengguna
        Route::get('/deleteV/{id}',[AdminController::class,'deleteVideo'])->name('deleteVideo');

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
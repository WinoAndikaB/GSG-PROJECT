<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;



//------------------------------------------------------------- [Halaman Non-User] ---------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Halaman Non-User] ---------------------------------------------------------------------------------------------------------------

        //[Non-User] Tab Home landing Page
        Route::get('/', [LandingPageController::class, 'landingPage'])->name('landingPage');
        Route::get('/detailArtikelLP/{id}', [LandingPageController::class, 'showDetailLPArtikel'])->name('showDetailLPArtikel');

//------------------------------------------------------------- [Non-User] Tab Search ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Search ---------------------------------------------------------------------------------------------------------

        //Pencarian Video
        Route::get('/searchLP', [LandingPageController::class, 'searchLP'])->name('searchLP');

        //Pencarian Video
        Route::get('/searchLPV', [LandingPageController::class, 'searchLPV'])->name('searchLPV');

        //Pencarian Event
        Route::get('/searchEvent', [LandingPageController::class, 'searchEvent'])->name('searchEvent');

//------------------------------------------------------------- [Non-User] Tab Search ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Search ---------------------------------------------------------------------------------------------------------

        //[Non-User] Tab Event landing Page
        Route::get('/eventLandingPage', [LandingPageController::class, 'eventLandingPage'])->name('eventLandingPage');
        Route::get('/detailEventLP/{id}', [LandingPageController::class, 'detailEventLP'])->name('detailEventLP');

//------------------------------------------------------------- [Non-User] Tab Video ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Video ---------------------------------------------------------------------------------------------------------

        //[Non-User] Tab Home landing Page Video
        Route::get('/landingPageVideo',[LandingPageController::class,'landingPageVideo'])->name('landingPageVideo');
        Route::get('/detailVideoLP/{id}', [LandingPageController::class, 'showDetailLPVideo'])->name('showDetailLPVideo');

//------------------------------------------------------------- [Non-User] Tab Kategori ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Kategori ---------------------------------------------------------------------------------------------------------

        //[Non-User] Tab Kategori Landing Page
        Route::get('/kategoriLandingPage', [LandingPageController::class, 'kategoriLandingPage'])->name('kategoriLandingPage');
        Route::get('/kategoriLandingPageA/{kategori}', [LandingPageController::class, 'kategoriLandingPageA'])->name('kategoriLandingPageA');
        Route::get('/kategoriLandingPageV/{kategori}', [LandingPageController::class, 'kategoriLandingPageV'])->name('kategoriLandingPageV');

//------------------------------------------------------------- [Non-User] Tab About ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab About ---------------------------------------------------------------------------------------------------------

        Route::get('/abouts', [LandingPageController::class, 'aboutLandingPage'])->name('aboutLandingPage');

//------------------------------------------------------------- [Non-User] Tab Ulasan ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Ulasan ---------------------------------------------------------------------------------------------------------

        Route::get('/ulasanLandingPage', [LandingPageController::class, 'ulasanLandingPage'])->name('ulasanLandingPage');
        
//------------------------------------------------------------- [Non-User] Tab Syarat & Ketentuan ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Syarat & Ketentuan ---------------------------------------------------------------------------------------------------------

        Route::get('/syaratKetentuanLP', [LandingPageController::class, 'syaratKetentuanLP'])->name('syaratKetentuanLP');

//------------------------------------------------------------- [Non-User] Tab Login ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Non-User] Tab Login ---------------------------------------------------------------------------------------------------------

        Route::get('/login',[LoginController::class,'log']);
        Route::post('/login',[LoginController::class,'login'])->name('login');

        //[Non-User] Tab Register User
        Route::get('/register',[LoginController::class,'register']);
        Route::post('/registerUser',[LoginController::class,'registerUser']);

        //[Non-User] Tab Lupa Password User
        Route::get('/lupaPassword',[LoginController::class,'lupaPassword']);
        Route::post('/lupaPasswordpost',[LoginController::class,'kirimEmail']);
        Route::get('/password/reset/{token}', [LoginController::class, 'resetPassword']);
        Route::post('/updatePassword', [LoginController::class, 'updatePassword']);


        //[Non-User] Tab Register Logout
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//------------------------------------------------------------- [Halaman User] ---------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Halaman User] ---------------------------------------------------------------------------------------------------------------

    //[Admin] Membatasi Hak Akases Admin
    Route::middleware(['user'])->group(function () {

//------------------------------------------------------------- [User] Tab Search ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Search ---------------------------------------------------------------------------------------------------------

        //Pencarian Artikel
        Route::get('/search', [PenggunaController::class, 'search'])->name('search');

        //Pencarian Video
        Route::get('/searchV', [PenggunaController::class, 'searchV'])->name('searchV');

        //Pencarian Event
        Route::get('/searchE', [PenggunaController::class, 'searchE'])->name('searchE');

//------------------------------------------------------------- [User] Tab Event ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Event ---------------------------------------------------------------------------------------------------------

        Route::get('/event', [PenggunaController::class, 'event'])->name('event');
        Route::get('/detailEvent/{id}', [PenggunaController::class, 'detailEvent'])->name('detailEvent');
        
//------------------------------------------------------------- [User] Tab Home ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Home ---------------------------------------------------------------------------------------------------------

        Route::get('/home',[PenggunaController::class,'HomeSetelahLogin'])->name('HomeSetelahLogin');
        Route::get('/detailArtikel/{id}', [PenggunaController::class, 'showDetailArtikel'])->name('detail.artikel');

        Route::post('/komentarArtikel', [PenggunaController::class, 'storeKomentarArtikel'])->name('storeKomentarArtikel');
        Route::get('/likeKomentarArtikel/{id}', [PenggunaController::class, 'likeKomentarArtikel'])->name('likeKomentarArtikel');
        Route::get('/dislikeKomentarArtikel/{id}', [PenggunaController::class, 'dislikeKomentarArtikel'])->name('dislikeKomentarArtikel');
        Route::get('/deleteKomentarArtikel/{id}', [PenggunaController::class, 'deleteKomentarArtikel'])->name('deleteKomentarArtikel');     

        Route::post('/submit/report', [PenggunaController::class, 'storeLaporanArtikel'])->name('storeLaporanArtikel');
        Route::post('/submit/reportKomentar', [PenggunaController::class, 'storeLaporanKomentarArtikel'])->name('storeLaporanKomentarArtikel');
        Route::get('/deleteKomentarA/{id}',[PenggunaController::class,'deleteKomentarA'])->name('deleteKomentarA');

//------------------------------------------------------------- [User] Tab Video ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Video ---------------------------------------------------------------------------------------------------------

        Route::get('/Video',[PenggunaController::class,'Video'])->name('Video');
        Route::get('/detailVideo/{id}', [PenggunaController::class, 'showDetailVideo'])->name('showDetailVideo');

        Route::post('/komentarVideo', [PenggunaController::class, 'storeKomentarVideo'])->name('storeKomentarVideo');
        Route::get('/likeKomentarVideo/{id}', [PenggunaController::class, 'likeKomentarVideo'])->name('likeKomentarVideo');
        Route::get('/dislikeKomentarVideo/{id}', [PenggunaController::class, 'dislikeKomentarVideo'])->name('dislikeKomentarVideo');
        Route::get('/deleteKomentarVideo/{id}', [PenggunaController::class, 'deleteKomentarVideo'])->name('deleteKomentarVideo');        

        Route::post('/submitV/reportV', [PenggunaController::class, 'storeLaporanVideo'])->name('storeLaporanVideo');
        Route::get('/deleteKomentarV/{id}', [PenggunaController::class, 'deleteKomentarV'])->name('deleteKomentarV');

//------------------------------------------------------------- [User] Tab Kategori ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Kategori ---------------------------------------------------------------------------------------------------------

        Route::get('/kategori', [PenggunaController::class, 'kategori'])->name('kategori');
        Route::get('/kategoriA/{kategori}', [PenggunaController::class, 'kategoriA'])->name('kategoriA');
        Route::get('/kategoriV/{kategori}', [PenggunaController::class, 'kategoriV'])->name('kategoriV');

//------------------------------------------------------------- [User] Tab Profil ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Profil ---------------------------------------------------------------------------------------------------------

        Route::get('/profileUser', [PenggunaController::class, 'profileUser'])->name('profileUser');
        Route::put('/profileUser/updateUser/{id}',[PenggunaController::class,'updateUser'])->name('updateUser');

//------------------------------------------------------------- [User] Tab About ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab About ---------------------------------------------------------------------------------------------------------

        Route::get('/about', [PenggunaController::class, 'about'])->name('about');

//------------------------------------------------------------- [User] Tab Syarat & Ketentuan ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Syarat & Ketentuan ---------------------------------------------------------------------------------------------------------

        Route::get('/syaratKetentuanA', [PenggunaController::class, 'syaratKetentuanA'])->name('syaratKetentuanA');

//------------------------------------------------------------- [User] Tab Ulasan ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [User] Tab Ulasan ---------------------------------------------------------------------------------------------------------

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

//------------------------------------------------------------- [Halaman Admin] ---------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Halaman Admin] ---------------------------------------------------------------------------------------------------------------


    //[Admin] Membatasi Hak Akases Admin
    Route::middleware(['admin'])->group(function () {

//------------------------------------------------------------- [Admin] Tab Dashboard ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Dashboard ---------------------------------------------------------------------------------------------------------

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//------------------------------------------------------------- [Admin] Tab Profil ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Profil ---------------------------------------------------------------------------------------------------------

        Route::get('/profileAdmin', [AdminController::class, 'profileAdmin'])->name('profileAdmin');
        Route::put('/profileAdmin/updateAdmin/{id}',[AdminController::class,'updateAdmin'])->name('updateAdmin');

//------------------------------------------------------------- [Admin] Tab Artikel ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Artikel ---------------------------------------------------------------------------------------------------------

        //[Admin] Tabel Artikel
        Route::get('/artikelAdmin', [AdminController::class, 'artikel'])->name('artikel');
        Route::get('/komentarArtikel', [AdminController::class, 'komentarArtikel'])->name('komentarArtikel');

        //[Admin] Tambah Artikel
        Route::get('/formTambahArtikelA',  [AdminController::class, 'formTambahArtikelA'])->name('formTambahArtikelA');
        Route::post('/formTambahArtikelA/storeArtikelA',  [AdminController::class, 'storeArtikelA'])->name('storeArtikelA');

        //[Admin] Delete Artikel
        Route::get('/deleteA/{id}',[AdminController::class,'deleteArtikel'])->name('deleteArtikel');
        Route::get('/deleteKomentarAA/{id}',[AdminController::class,'deleteKomentarAA'])->name('deleteKomentarAA');

        //[Admin] Edit Artikel
        Route::get('/formEditArtikelA/{id}',[AdminController::class,'formEditArtikelA'])->name('formEditArtikelA');     
        Route::post('/formEditArtikelA/updateArtikelA/{id}',[AdminController::class,'updateArtikelA'])->name('updateArtikelA');

//------------------------------------------------------------- [Admin] Tab Video ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Video ---------------------------------------------------------------------------------------------------------

        //[Admin] Tabel Video
        Route::get('/videoAdmin', [AdminController::class, 'videoAdmin'])->name('videoAdmin');
        Route::get('/komentarVideo', [AdminController::class, 'komentarVideo'])->name('komentarVideo');

        //[Admin] Tambah Video Admin
        Route::get('/formTambahVideo', [AdminController::class, 'formTambahVideo'])->name('formTambahVideo');
        Route::post('/formTambahVideo/storeVideo',  [AdminController::class, 'storeVideo'])->name('storeVideo');

        //[Admin] Edit Video
        Route::get('/formEditVideo/{id}',[AdminController::class,'formEditVideo'])->name('formEditVideo');
        Route::post('/formEditVideoA/updateVideoA/{id}',[AdminController::class,'updateVideo'])->name('updateVideo');

        //[Admin] Delete Pengguna
        Route::get('/deleteV/{id}',[AdminController::class,'deleteVideo'])->name('deleteVideo');
        Route::get('/deleteKomentarVA/{id}',[AdminController::class,'deleteKomentarVA'])->name('deleteKomentarVA');
        

//------------------------------------------------------------- [Admin] Tab Pengguna ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Pengguna ---------------------------------------------------------------------------------------------------------

        //[Admin] Tabel Pengguna
        Route::get('/pengguna', [AdminController::class, 'listUserTerdaftar'])->name('listUserTerdaftar');

        //[Admin] Tabel Pengguna Like Dislike
        Route::get('/PenggunaLikeDislike', [AdminController::class, 'PenggunaLikeDislike'])->name('PenggunaLikeDislike');

        //[Admin] Delete Pengguna
        Route::get('/deletePenggunaA/{id}',[AdminController::class,'deletePenggunaA'])->name('deletePenggunaA');

//------------------------------------------------------------- [Admin] Tab Ulasan ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Ulasan ---------------------------------------------------------------------------------------------------------

        //[Admin] Tabel Ulasan
        Route::get('/ulasans', [AdminController::class, 'ulasanAdmin'])->name('ulasanAdmin');

        //[Admin] Delete Ulasan
        Route::get('/deleteU/{id}',[AdminController::class,'deleteUlasanA'])->name('deleteUlasanA');
        });

//------------------------------------------------------------- [Admin] Tab Event ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Event ---------------------------------------------------------------------------------------------------------

        //[Admin] Tabel Event
        Route::get('/eventKomAd', [AdminController::class, 'eventKomAd'])->name('eventKomAd');
        Route::get('/deleteEvent/{id}',[AdminController::class,'deleteEvent'])->name('deleteEvent');

         //[Admin] Form Tambah Event
         Route::get('/formTambahEvent', [AdminController::class, 'formTambahEvent'])->name('formTambahEvent');
         Route::post('/formTambahEvent/storeEvent',  [AdminController::class, 'storeEvent'])->name('storeEvent');

        //[Admin] Form Edit Event
        Route::get('/formEditEvent/{id}',[AdminController::class,'formEditEvent'])->name('formEditEvent');
        Route::post('/formEditEvent/updateEvent/{id}',[AdminController::class,'updateEvent'])->name('updateEvent');

        //[Admin] Tabel Komentar Event
        Route::get('/komentarEvent', [AdminController::class, 'komentarEvent'])->name('komentarEvent');
        Route::get('/deleteKomentarEvent/{id}',[AdminController::class,'deleteKomentarEvent'])->name('deleteKomentarEvent');
        
//------------------------------------------------------------- [Admin] Tab Laporan User ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Admin] Tab Laporan User ---------------------------------------------------------------------------------------------------------

        //[Admin] Tabel Laporan
        Route::get('/laporanUser', [AdminController::class, 'laporanUser'])->name('laporanUser');
        Route::get('/laporanVideoUser', [AdminController::class, 'laporanVideoUser'])->name('laporanVideoUser');
        Route::get('/laporanUlasanUser', [AdminController::class, 'laporanUlasanUser'])->name('laporanUlasanUser');

        Route::get('/deleteLaporanUA/{id}',[AdminController::class,'deleteLaporanUA'])->name('deleteLaporanUA');
        Route::get('/deleteLaporanVA/{id}',[AdminController::class,'deleteLaporanVA'])->name('deleteLaporanVA');


//------------------------------------------------------------- [Halaman SuperAdmin] ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Halaman SuperAdmin] ---------------------------------------------------------------------------------------------------------

    //[SuperAdmin] Membatasi Hak Akases SuperAdmin
    Route::middleware(['superadmin'])->group(function () {

//------------------------------------------------------------- [SuperAdmin] Tab Dashboard ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Dashboard ---------------------------------------------------------------------------------------------------------

            Route::get('/dashboardSA', [SuperAdminController::class, 'dashboardSA'])->name('dashboardSA');
    
//------------------------------------------------------------- [SuperAdmin] Tab Profil ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Profil ---------------------------------------------------------------------------------------------------------

            Route::get('/profileSA', [SuperAdminController::class, 'profileSA'])->name('profileSA');
            Route::put('/profileSA/updateSA/{id}',[SuperAdminController::class,'updateSA'])->name('updateSA');
    
//------------------------------------------------------------- [SuperAdmin] Tab Artikel ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Artikel ---------------------------------------------------------------------------------------------------------
    
            //[SuperAdmin] Tabel Artikel
            Route::get('/artikelSuperAdmin', [SuperAdminController::class, 'artikelSA'])->name('artikelSA');
            Route::get('/komentarArtikelSA', [SuperAdminController::class, 'komentarArtikelSA'])->name('komentarArtikelSA');
    
            //[SuperAdmin] Tambah Artikel
            Route::get('/artikelSA/createSA', [SuperAdminController::class, 'createSA'])->name('createSA');
            Route::post('/artikelSA/storeSA', [SuperAdminController::class, 'storeSA'])->name('storeSA');
            
            //[SuperAdmin] Status Artikel
            Route::get('/approve-article/{id}',  [SuperAdminController::class, 'approveArticle'])->name('approveArticle');
            Route::get('/reject-article/{id}',  [SuperAdminController::class, 'rejectArticle'])->name('rejectArticle');
    
            //[SuperAdmin] Delete Artikel
            Route::get('/deleteArtikelSA/{id}',[SuperAdminController::class,'deleteArtikelSA'])->name('deleteArtikelSA');
            Route::get('/deleteKomentarSA/{id}',[SuperAdminController::class,'deleteKomentarSA'])->name('deleteKomentarSA');
    
            //[Admin] Edit Artikel
            Route::get('/formEditArtikelSA/{id}',[SuperAdminController::class,'formEditArtikelSA'])->name('formEditArtikelSA');
            Route::post('/formEditArtikelSA/updateArtikelSA/{id}', [SuperAdminController::class, 'updateArtikelSA'])->name('updateArtikelSA');
    
//------------------------------------------------------------- [SuperAdmin] Tab Video ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Video ---------------------------------------------------------------------------------------------------------
    
            //[SuperAdmin] Tabel Video
            Route::get('/videoSuperAdmin', [SuperAdminController::class, 'videoSuperAdmin'])->name('videoSuperAdmin');
            Route::get('/komentarVideoSA', [SuperAdminController::class, 'komentarVideoSA'])->name('komentarVideoSA');

            //[SuperAdmin] Status Video
            Route::get('/approveVideo/{id}',  [SuperAdminController::class, 'approveVideo'])->name('approveVideo');
            Route::get('/rejectVideo/{id}',  [SuperAdminController::class, 'rejectVideo'])->name('rejectVideo');
    
            //[SuperAdmin] Tambah Video Admin
            Route::get('/formTambahVideoSA', [SuperAdminController::class, 'formTambahVideoSA'])->name('formTambahVideoSA');
            Route::post('/formTambahVideoSA/storeVideoSA',  [SuperAdminController::class, 'storeVideoSA'])->name('storeVideoSA');
    
            //[SuperAdmin] Edit Video
            Route::get('/formEditVideoSA/{id}',[SuperAdminController::class,'formEditVideoSA'])->name('formEditVideoSA');
            Route::post('/formEditVideoSA/updateVideoSA/{id}',[SuperAdminController::class,'updateVideoSA'])->name('updateVideoSA');
    
            //[SuperAdmin] Delete Pengguna
            Route::get('/deleteVideoSA/{id}',[SuperAdminController::class,'deleteVideoSA'])->name('deleteVideoSA');
            Route::get('/deleteKomentarVideoSA/{id}',[SuperAdminController::class,'deleteKomentarVideoSA'])->name('deleteKomentarVideoSA');

//------------------------------------------------------------- [SuperAdmin] Tab Kategori ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Kategori ---------------------------------------------------------------------------------------------------------

            Route::get('/kategoriTblSA', [SuperAdminController::class, 'kategoriTblSA'])->name('kategoriTblSA');
    
            //[SuperAdmin] Tambah Kategori
            Route::get('/formTambahKategoriSA', [SuperAdminController::class, 'formTambahKategoriSA'])->name('formTambahKategoriSA');
            Route::post('/formTambahKategoriSA/storeKategorioSA',  [SuperAdminController::class, 'storeKategorioSA'])->name('storeKategorioSA');
    
            //[SuperAdmin] Edit Kategori
            Route::get('/formEditKategoriSA/{id}',[SuperAdminController::class,'formEditKategoriSA'])->name('formEditKategoriSA');
            Route::post('/formEditKategoriSA/updateKategoriSA/{id}',[SuperAdminController::class,'updateKategoriSA'])->name('updateKategoriSA');
    
            //[SuperAdmin] Delete Kategori
            Route::get('/deleteKategoriSA/{id}',[SuperAdminController::class,'deleteKategoriSA'])->name('deleteKategoriSA');

//------------------------------------------------------------- [SuperAdmin] Tab Event ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Event ---------------------------------------------------------------------------------------------------------

            //[Admin] Tabel Event
            Route::get('/eventKomAdSA', [SuperAdminController::class, 'eventKomAdSA'])->name('eventKomAdSA');
            Route::get('/deleteEventSA/{id}',[SuperAdminController::class,'deleteEventSA'])->name('deleteEventSA');

            //[SuperAdmin] Status Event
            Route::get('/approveEvent/{id}',  [SuperAdminController::class, 'approveEvent'])->name('approveEvent');
            Route::get('/rejectEvent/{id}',  [SuperAdminController::class, 'rejectEvent'])->name('rejectEvent');

            //[Admin] Form Tambah Event
            Route::get('/formTambahEventSA', [SuperAdminController::class, 'formTambahEventSA'])->name('formTambahEventSA');
            Route::post('/formTambahEventSA/storeEventSA',  [SuperAdminController::class, 'storeEventSA'])->name('storeEventSA');

            //[Admin] Form Edit Event
            Route::get('/formEditEventSA/{id}',[SuperAdminController::class,'formEditEventSA'])->name('formEditEventSA');
            Route::post('/formEditEventSA/updateEventSA/{id}',[SuperAdminController::class,'updateEventSA'])->name('updateEventSA');

            //[Admin] Tabel Komentar Event
            Route::get('/komentarEventSA', [SuperAdminController::class, 'komentarEventSA'])->name('komentarEventSA');
            Route::get('/deleteKomentarEventSA/{id}',[SuperAdminController::class,'deleteKomentarEventSA'])->name('deleteKomentarEventSA');
    
//------------------------------------------------------------- [SuperAdmin] Tab Pengguna ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Pengguna ---------------------------------------------------------------------------------------------------------
    
            //[SuperAdmin] Tabel Pengguna
            Route::get('/penggunaSA', [SuperAdminController::class, 'penggunaSA'])->name('penggunaSA');

            //[SuperAdmin] Promote-Demote Pengguna
            Route::get('/promote-user/{id}', [SuperAdminController::class, 'promoteUser'])->name('promoteUser');
            Route::get('/demote-user/{id}', [SuperAdminController::class, 'demoteUser'])->name('demoteUser');
    
            //[SuperAdmin] Tambah User Admin
            Route::get('/formTambahUserAdmSA', [SuperAdminController::class, 'formTambahUserAdmSA'])->name('formTambahUserAdmSA');
            Route::post('/registerSuperAdminSA',[SuperAdminController::class,'registerSuperAdminSA']);
    
            //[SuperAdmin] Delete Pengguna
            Route::get('/deletePenggunaSA/{id}',[SuperAdminController::class,'deletePenggunaSA'])->name('deletePenggunaSA');
    
        //[SuperAdmin] Tab Ulasan
    
            //[SuperAdmin] Tabel Ulasan
            Route::get('/ulasansSA', [SuperAdminController::class, 'ulasansSA'])->name('ulasansSA');
    
            //[SuperAdmin] Delete Ulasan
            Route::get('/deleteUlasanSA/{id}',[SuperAdminController::class,'deleteUlasanSA'])->name('deleteUlasanSA');
            });
        
//------------------------------------------------------------- [SuperAdmin] Tab Laporan User ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Laporan User ---------------------------------------------------------------------------------------------------------

            //[SuperAdmin] Tabel Laporan
            Route::get('/laporanUserSA', [SuperAdminController::class, 'laporanUserSA'])->name('laporanUserSA');
            Route::get('/laporanKomentarArtikelUserSA', [SuperAdminController::class, 'laporanKomentarArtikelUserSA'])->name('laporanKomentarArtikelUserSA');
            Route::get('/admin/freeze/{id}', [SuperAdminController::class, 'showFreezeForm'])->name('admin.freeze.form');
            Route::post('/admin/freeze/{id}', [SuperAdminController::class, 'freezeAccount'])->name('admin.freeze.account');


            Route::get('/laporanVideoUserSA', [SuperAdminController::class, 'laporanVideoUserSA'])->name('laporanVideoUserSA');
            Route::get('/laporanKomentarVideoUserSA', [SuperAdminController::class, 'laporanKomentarVideoUserSA'])->name('laporanKomentarVideoUserSA');
    
            Route::get('/deleteLaporanArtikelSA/{id}',[SuperAdminController::class,'deleteLaporanArtikelSA'])->name('deleteLaporanArtikelSA');
            Route::get('/deleteLaporanVideoSA/{id}',[SuperAdminController::class,'deleteLaporanVideoSA'])->name('deleteLaporanVideoSA');

//------------------------------------------------------------- [SuperAdmin] Tab Syarat & Ketentuan ---------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [SuperAdmin] Tab Syarat & Ketentuan ---------------------------------------------------------------------------------------------------------

            //[SuperAdmin] Tabel Syarat & Ketentuan
            Route::get('/syaratdanketentuanSA',[SuperAdminController::class,'syaratdanketentuanSA'])->name('syaratdanketentuanSA');

            //[SuperAdmin] Tambah Syarat & Ketentuan
            Route::get('/formTambahTdanCSA',  [SuperAdminController::class, 'formTambahTdanCSA'])->name('formTambahTdanCSA');
            Route::post('/formTambahTdanCSA/storeTdanCSA',  [SuperAdminController::class, 'storeTdanCSA'])->name('storeTdanCSA');

            //[SuperAdmin] Delete Syarat & Ketentuan
            Route::get('/deleteTdanCSA/{id}',[SuperAdminController::class,'deleteTdanCSA'])->name('deleteTdanCSA');

            //[SuperAdmin] Edit Syarat & Ketentuan
            Route::get('/formEditTdanCSA/{id}',[SuperAdminController::class,'formEditTdanCSA'])->name('formEditTdanCSA');
            Route::post('/formEditTdanCSA/updateTdanCSA/{id}',[SuperAdminController::class,'updateTdanCSA'])->name('updateTdanCSA');

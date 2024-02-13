<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;


        
//------------------------------------------------------------- [Halaman Login] ---------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Halaman Login] ---------------------------------------------------------------------------------------------------------------

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

//------------------------------------------------------------- [Halaman Non-User] ---------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------- [Halaman Non-User] ---------------------------------------------------------------------------------------------------------------

                //[Non-User] Tab Home landing Page
                Route::get('/', [LandingPageController::class, 'landingPage'])->name('landingPage');
                Route::get('/detailArtikelLP/{id}', [LandingPageController::class, 'showDetailLPArtikel'])->name('showDetailLPArtikel');
                Route::get('/detailProfilPenulisArtikelLP/{id}', [LandingPageController::class, 'detailProfilPenulisArtikelLP'])->name('detailProfilPenulisArtikelLP');

                //[Non-User] Pencarian Video
                Route::get('/searchLP', [LandingPageController::class, 'searchLP'])->name('searchLP');

                //[Non-User] Pencarian Video
                Route::get('/searchLPV', [LandingPageController::class, 'searchLPV'])->name('searchLPV');

                //[Non-User] Tab Home landing Page Video
                Route::get('/landingPageVideo',[LandingPageController::class,'landingPageVideo'])->name('landingPageVideo');
                Route::get('/detailVideoLP/{id}', [LandingPageController::class, 'showDetailLPVideo'])->name('showDetailLPVideo');
                Route::get('/detailProfilVideoLP/{id}', [LandingPageController::class, 'detailProfilVideoLP'])->name('detailProfilVideoLP');

                //[Non-User] Tab Kategori Landing Page
                Route::get('/kategoriLandingPage', [LandingPageController::class, 'kategoriLandingPage'])->name('kategoriLandingPage');
                Route::get('/kategoriLandingPageA/{kategori}', [LandingPageController::class, 'kategoriLandingPageA'])->name('kategoriLandingPageA');
                Route::get('/kategoriLandingPageV/{kategori}', [LandingPageController::class, 'kategoriLandingPageV'])->name('kategoriLandingPageV');

                //[Non-User] Tab About Landing Page
                Route::get('/abouts', [LandingPageController::class, 'aboutLandingPage'])->name('aboutLandingPage');
             
                //[Non-User] Tab Ulasan Landing Page
                Route::get('/ulasanLandingPage', [LandingPageController::class, 'ulasanLandingPage'])->name('ulasanLandingPage');              
                
                //[Non-User] Tab Syarat & Ketentuan Landing Page
                Route::get('/syaratKetentuanLP', [LandingPageController::class, 'syaratKetentuanLP'])->name('syaratKetentuanLP');

//----------------------------------------------------------------------------------- [Halaman Non-User] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [Halaman Non-User] ---------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------- [Halaman Pengguna] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [Halaman Pengguna] ---------------------------------------------------------------------------------------------------------------

    //[Pengguna] Membatasi Hak Akases Admin
    Route::middleware(['user'])->group(function () {

                //[Pengguna] Pencarian Artikel
                Route::get('/search', [PenggunaController::class, 'search'])->name('search');

                //[Pengguna] Pencarian Video
                Route::get('/searchV', [PenggunaController::class, 'searchV'])->name('searchV');

                 //[Pengguna] Home
                Route::get('/home',[PenggunaController::class,'HomeSetelahLogin'])->name('HomeSetelahLogin');
                Route::get('/detailArtikel/{id}', [PenggunaController::class, 'showDetailArtikel'])->name('detail.artikel');

                //[Pengguna] Artikel
                Route::post('/komentarArtikel', [PenggunaController::class, 'storeKomentarArtikel'])->name('storeKomentarArtikel');
                Route::post('/likeKomentarArtikel/{commentId}', [PenggunaController::class, 'likeKomentarArtikel'])->name('likeKomentarArtikel');
                Route::get('/deleteKomentarArtikel/{id}', [PenggunaController::class, 'deleteKomentarArtikel'])->name('deleteKomentarArtikel'); 
                Route::post('/simpanEditKomentarArtikel/{id}/{user_id}', [PenggunaController::class, 'simpanEditKomentarArtikel'])->name('simpanEditKomentarArtikel'); 

                Route::post('/submit/report', [PenggunaController::class, 'storeLaporanArtikel'])->name('storeLaporanArtikel');
                Route::post('/submit/reportKomentar', [PenggunaController::class, 'storeLaporanKomentarArtikel'])->name('storeLaporanKomentarArtikel');

                Route::get('/simpanArtikelView', [PenggunaController::class, 'simpanArtikelView'])->name('simpan.artikelView');
                Route::post('/simpanArtikelData/{id}', [PenggunaController::class, 'simpanArtikelData'])->name('simpan.artikelData');
                Route::get('/deleteSimpanArt/{id}', [PenggunaController::class, 'deleteSimpanArt'])->name('simpan.deleteArtikel');

                Route::middleware(['auth'])->group(function () {
                    Route::post('/follow/{user}', [PenggunaController::class, 'follow'])->name('follow');
                    Route::delete('/unfollow/{user}', [PenggunaController::class, 'unfollow'])->name('unfollow');
                });

                Route::get('/detailProfilPenulisArtikel/{id}', [PenggunaController::class, 'detailProfilPenulisArtikel'])->name('detailProfilPenulisArtikel');

                Route::get('/search/tags', [PenggunaController::class, 'searchTags'])->name('search.tags');
                Route::get('/TagsArtikel/{tag}', [PenggunaController::class, 'TagsArtikel'])->name('TagsArtikel');          

                //[Pengguna] Video
                Route::get('/Video',[PenggunaController::class,'Video'])->name('Video');
                Route::get('/detailVideo/{id}', [PenggunaController::class, 'showDetailVideo'])->name('showDetailVideo');

                Route::post('/komentarVideo', [PenggunaController::class, 'storeKomentarVideo'])->name('storeKomentarVideo');
                Route::post('/likeKomentarVideo/{commentId}', [PenggunaController::class, 'likeKomentarVideo'])->name('likeKomentarVideo');
                Route::post('/submitV/reportV', [PenggunaController::class, 'storeLaporanVideo'])->name('storeLaporanVideo');
                Route::post('/submit/reportKomentarV', [PenggunaController::class, 'storeLaporanKomentarVideo'])->name('storeLaporanKomentarVideo');
                Route::get('/deleteKomentarVideo/{id}', [PenggunaController::class, 'deleteKomentarVideo'])->name('deleteKomentarVideo');
                Route::post('/simpanEditKomentarVideo/{id}/{user_id}', [PenggunaController::class, 'simpanEditKomentarVideo'])->name('simpanEditKomentarVideo');

                Route::get('/simpanVideoView', [PenggunaController::class, 'simpanVideoView'])->name('simpan.videoView');
                Route::post('/simpanVideoData/{videoId}', [PenggunaController::class, 'simpanVideoData'])->name('simpan.videoData')->middleware('auth'); 
                Route::get('/deleteSimpanVid/{id}', [PenggunaController::class, 'deleteSimpanVid'])->name('simpan.deleteVideo');

                 //[Pengguna] kategori
                Route::get('/kategori', [PenggunaController::class, 'kategori'])->name('kategori');
                Route::get('/kategoriA/{kategori}', [PenggunaController::class, 'kategoriA'])->name('kategoriA');
                Route::get('/kategoriV/{kategori}', [PenggunaController::class, 'kategoriV'])->name('kategoriV');

                //[Pengguna] Tab Halaman Ulasan
                Route::get('/ulasan', [PenggunaController::class, 'ulasan'])->name('ulasan');
                Route::post('/storeUlasan',[PenggunaController::class,'storeUlasan']);
                Route::get('/deleteUlasan/{id}', [PenggunaController::class, 'deleteUlasan'])->name('deleteUlasan');
                Route::get('/likeUlasan/{id}', [PenggunaController::class, 'likeUlasan'])->name('likeUlasan');
                Route::get('/dislikeUlasan/{id}', [PenggunaController::class, 'dislikeUlasan'])->name('dislikeUlasan');
                Route::post('/simpanEditUlasan/{id}', [PenggunaController::class, 'simpanEditUlasan'])->name('simpanEditUlasan');

                Route::get('/detailProfilVideo/{id}', [PenggunaController::class, 'detailProfilVideo'])->name('detailProfilVideo');

                Route::get('/search/videos', [PenggunaController::class, 'searchVideos'])->name('search.videos');
                Route::get('/TagsVideos/{tag}', [PenggunaController::class, 'TagsVideos'])->name('TagsVideos');                        
                });
                
                
                //[Pengguna] About
                Route::get('/about', [PenggunaController::class, 'about'])->name('about');


                 //[Pengguna] Profil
                Route::get('/profileUser', [PenggunaController::class, 'profileUser'])->name('profileUser');
                Route::put('/profileUser/updateUser/{id}',[PenggunaController::class,'updateUser'])->name('updateUser');
                Route::get('/profilPenulis', [PenggunaController::class, 'profilPenulis'])->name('profilPenulis');
        

                //[Pengguna] Syarat & Ketentuan
                Route::get('/syaratKetentuanA', [PenggunaController::class, 'syaratKetentuanA'])->name('syaratKetentuanA');

        
//----------------------------------------------------------------------------------- [End Halaman Pengguna] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [End Halaman Pengguna] ---------------------------------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------- [Halaman Admin] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [Halaman Admin] ---------------------------------------------------------------------------------------------------------------


    //[Admin] Membatasi Hak Akases Admin
    Route::middleware(['admin'])->group(function () {

                //[Admin] Tabel Dashboard
                Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

                //[Admin] Tabel Profil
                Route::get('/profileAdmin', [AdminController::class, 'profileAdmin'])->name('profileAdmin');
                Route::put('/profileAdmin/updateAdmin/{id}',[AdminController::class,'updateAdmin'])->name('updateAdmin');

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

                //[Admin] Tabel Laporan
                Route::get('/laporanUser', [AdminController::class, 'laporanUser'])->name('laporanUser');
                Route::get('/laporanVideoUser', [AdminController::class, 'laporanVideoUser'])->name('laporanVideoUser');
                Route::get('/laporanUlasanUser', [AdminController::class, 'laporanUlasanUser'])->name('laporanUlasanUser');

                Route::get('/deleteLaporanUA/{id}',[AdminController::class,'deleteLaporanUA'])->name('deleteLaporanUA');
                Route::get('/deleteLaporanVA/{id}',[AdminController::class,'deleteLaporanVA'])->name('deleteLaporanVA');

            });

//----------------------------------------------------------------------------------- [End Halaman Admin] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [End Halaman Admin] ---------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------- [Halaman SuperAdmin] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [Halaman SuperAdmin] ---------------------------------------------------------------------------------------------------------------

    //[SuperAdmin] Membatasi Hak Akases SuperAdmin
    Route::middleware(['superadmin'])->group(function () {

    
            //[SuperAdmin] Dashboard
            Route::get('/dashboardSA', [SuperAdminController::class, 'dashboardSA'])->name('dashboardSA');
    
          
            //[SuperAdmin] Profil
            Route::get('/profileSA', [SuperAdminController::class, 'profileSA'])->name('profileSA');
            Route::put('/profileSA/updateSA/{id}',[SuperAdminController::class,'updateSA'])->name('updateSA');
    

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


            //[SuperAdmin] Halaman Kategori
            Route::get('/kategoriTblSA', [SuperAdminController::class, 'kategoriTblSA'])->name('kategoriTblSA');
    
            //[SuperAdmin] Tambah Kategori
            Route::get('/formTambahKategoriSA', [SuperAdminController::class, 'formTambahKategoriSA'])->name('formTambahKategoriSA');
            Route::post('/formTambahKategoriSA/storeKategorioSA',  [SuperAdminController::class, 'storeKategorioSA'])->name('storeKategorioSA');
    
            //[SuperAdmin] Edit Kategori
            Route::get('/formEditKategoriSA/{id}',[SuperAdminController::class,'formEditKategoriSA'])->name('formEditKategoriSA');
            Route::post('/formEditKategoriSA/updateKategoriSA/{id}',[SuperAdminController::class,'updateKategoriSA'])->name('updateKategoriSA');
    
            //[SuperAdmin] Delete Kategori
            Route::get('/deleteKategoriSA/{id}',[SuperAdminController::class,'deleteKategoriSA'])->name('deleteKategoriSA');
            
            //[SuperAdmin] Tabel Pengguna
            Route::get('/penggunaSA', [SuperAdminController::class, 'penggunaSA'])->name('penggunaSA');

            //[SuperAdmin] Freeze-Unfreeze Pengguna
            Route::post('/freeze-pengguna', [SuperAdminController::class, 'freezePengguna'])->name('freeze.pengguna');
            Route::post('/unfreeze-pengguna', [SuperAdminController::class, 'unfreezePengguna'])->name('unfreeze.pengguna');

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

            //[SuperAdmin] Tabel Laporan
            Route::get('/laporanUserSA', [SuperAdminController::class, 'laporanUserSA'])->name('laporanUserSA');
            Route::get('/laporanKomentarArtikelUserSA', [SuperAdminController::class, 'laporanKomentarArtikelUserSA'])->name('laporanKomentarArtikelUserSA');
            Route::post('/freeze-user', [SuperAdminController::class, 'freezeUser'])->name('freeze.user');
   
            //[SuperAdmin] Tabel Laporan 
            Route::get('/laporanVideoUserSA', [SuperAdminController::class, 'laporanVideoUserSA'])->name('laporanVideoUserSA');
            Route::get('/laporanKomentarVideoUserSA', [SuperAdminController::class, 'laporanKomentarVideoUserSA'])->name('laporanKomentarVideoUserSA');
    
            //[SuperAdmin] Hapus Laporan
            Route::get('/deleteLaporanArtikelSA/{id}',[SuperAdminController::class,'deleteLaporanArtikelSA'])->name('deleteLaporanArtikelSA');
            Route::get('/deleteLaporanVideoSA/{id}',[SuperAdminController::class,'deleteLaporanVideoSA'])->name('deleteLaporanVideoSA');



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


//----------------------------------------------------------------------------------- [End Halaman SuperAdmin] ---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------- [End Halaman SuperAdmin] ---------------------------------------------------------------------------------------------------------------
           
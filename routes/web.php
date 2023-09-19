<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use Database\Seeders\PenggunaSeeder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[LoginController::class,'landingPage']);
Route::get('/login',[LoginController::class,'log']);
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/register',[LoginController::class,'register']);
Route::post('/registerUser',[LoginController::class,'registerUser']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [PenggunaController::class, 'dataArtikelHome1'])->name('dataArtikelHome1');
Route::get('/about1', [PenggunaController::class, 'about1'])->name('about1');

//---- HOME ----
//Memberikan Hak Akses User
Route::middleware(['user'])->group(function () {
//Menampilkan Halaman Data Artikel Pada Halamn Home Setelah Login
Route::get('/home',[PenggunaController::class,'allog']);
//Menampilkan Halaman Data Artikel Pada Halamn Home Sebelum Login
Route::get('/artikel', [PenggunaController::class, 'dataArtikelHome'])->name('dataArtikelHome');
//Menampilkan Halaman Data Artikel Pada Halamn Home Setelah Login
Route::get('artikel/{id}', [PenggunaController::class, 'showArtikel'])->name('dtArtikel.showArtikel');
Route::get('/detaiArtikel', [PenggunaController::class, 'detailArtikel']);

Route::get('/ulasan', [PenggunaController::class, 'ulasan'])->name('ulasan');
Route::post('/storeUlasan',[PenggunaController::class,'storeUlasan']);
Route::get('/about', [PenggunaController::class, 'about'])->name('about');
});

//---- ADMIN ----
//Memberikan Hak Akses Admin
Route::middleware(['admin'])->group(function () {
//Route Tab Dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//Route Tab Artikel
Route::get('/artikelAdmin', [AdminController::class, 'dataArtikel'])->name('dataArtikel');
Route::get('/formTambahArtikel', [AdminController::class, 'formTambahArtikel'])->name('formTambahArtikel');
Route::post('/formTambahArtikel/storeArtikel',[AdminController::class,'storeTbhArtikel']);
Route::get('/deleteA/{id}',[AdminController::class,'deleteArtikel']);

Route::get('/tampilDataEditArtikel/{id}',[AdminController::class,'tampilDataEditArtikel']);
Route::post('/updateDataIdArtikel/{id}',[AdminController::class,'updateDataIdArtikel']);

//Route Tab Pengguna
Route::get('/pengguna', [AdminController::class, 'listUserTerdaftar'])->name('listUserTerdaftar');
Route::get('/formTambahUserAdm', [AdminController::class, 'formTambahUserAdm'])->name('formTambahUserAdm');
Route::post('/registerAdmin',[AdminController::class,'registerAdmin']);
Route::get('/deleteP/{id}',[AdminController::class,'deleteUserTerdaftar']);

//Route Tab Ulasan
Route::get('/ulasans', [AdminController::class, 'ulasanAdmin'])->name('ulasanAdmin');
Route::get('/deleteU/{id}',[AdminController::class,'deleteUlasan']);
});
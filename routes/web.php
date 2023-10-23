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
Route::get('/', [LoginController::class, 'landingPage'])->name('landingPage');
Route::get('/abouts', [LoginController::class, 'aboutLandingPage'])->name('aboutLandingPage');

//---- HOME ----
//Memberikan Hak Akses User
Route::middleware(['user'])->group(function () {
Route::get('/home',[PenggunaController::class,'HomeSetelahLogin'])->name('HomeSetelahLogin');
Route::get('/artikel', [PenggunaController::class, 'dataArtikelHome'])->name('dataArtikelHome');
Route::get('/detailArtikel/{id}', [PenggunaController::class, 'showDetailArtikel'])->name('detail.artikel');
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
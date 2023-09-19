<?php

namespace Database\Seeders;

use App\Models\artikels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TambahArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'gambar'=>'ar2.jpg',
                'judulArtikel'=>'Carlo Ancelotti Yakin Paolo Maldini Dalang Di Balik Kebangkitan AC Milan',
                'penulis'=>'Anugerah Pamuji',
                'deskripsi'=>'Pelatih Everton Carlo Ancelotti berpendapat, rekrutmen yang dilakukan Paolo Maldini buat AC Milan telah mengubah takdir klub tersebut.',
            ],
            [
                'gambar'=>'ar3.jpg',
                'judulArtikel'=>'Review Anime: Demon Slayer: Kimetsu no Yaiba Movie - Mugen Train',
                'penulis'=>'Tiyar Mangulo',
                'deskripsi'=>'Anime Demon Slayer: Kimetsu no Yaiba telah menjadi salah satu anime paling populer dalam beberapa tahun terakhir. Kesuksesannya tidak hanya berhenti di seri TV-nya saja, tetapi juga meluas ke film layar lebar, Demon Slayer: Kimetsu no Yaiba Movie - Mugen Train. Film ini mengambil langkah berani dengan mengambil alur cerita utama dan mengeksplorasinya lebih lanjut, menghadirkan pengalaman yang tak terlupakan bagi para penggemar.',
            ],
            [
                'gambar'=>'ar4.jpg',
                'judulArtikel'=>'Sinopsis Serial Anime SPY x FAMILY, Perjalanan Twilight Membuat Keluarga Untuk Misinya',
                'penulis'=>'Daki Dakian',
                'deskripsi'=>'SPY x FAMILY adalah anime yang pertama kali dirilis pada April 2022. Musim pertamanya terdiri dari 25 episode, dengan 12 episode pertama dirilis pada April 2022 dan 13 episode sisanya dirilis pada bulan Oktober 2022, sehingga total ada 25 episode. Anime ini diproduksi oleh WIT STUDIO dan CloverWorks.',
            ],
        ];
        foreach($userData as $key=> $val){
            artikels::create($val);
        }
    }
}

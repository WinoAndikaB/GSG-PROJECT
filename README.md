
## DKT-PROJECT

Langkah-Langkah Menjalankan Aplikasinya:

- Cari Folder tempat simpan projek, lalu, *Git Bash*.
- Setelah itu, jalankan *GIT CLONE https://github.com/WinoAndikaB/GSG-PROJECT.git*.
- Terus buka VSCode, kemudian buka *Terminal*.
- Ketik *Composer Update*.
- Setelah itu, buat file baru *.env* dan pindahkan isi dari *.env.example* ke *.env*.
- Di *Terminal*, ketikkan *php artisan key:generate*.
- Lalu, buka *XAMPP* dan jalankan *Apache & MySQL*.
- Buka lagi Teriminal, *php artisan migrate --seed*.
- Kemudian, jalankan *php artisan serve*.

Jika data pada database tidak masuk setelah di migrate, input manual saja dengan import file dari GDrive
https://drive.google.com/drive/u/3/folders/1iuafUJMoKbrXr-JBOOYPNB85bBdmWuzu

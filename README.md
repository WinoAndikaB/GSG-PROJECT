
## KataKey Project
Sebelum memulai langkah-langkahnya, siapkan kebutuhan software yaitu:
- XAMPP Control Panel : https://www.apachefriends.org/download.html
- Visual Studio Code : https://code.visualstudio.com/download
- Git : https://git-scm.com/downloads
- Composer : https://getcomposer.org/download/

Setelah menginstall semua, ikutin langkah berikut
- Buka XAMPP
- Pada bagian *"Apache"* terdapat tombol *"Config"*, pilih *Config* lalu pilih _"PHP(php.ini)"_
- Setelah di klik, akan muncul *"Notepad"*, kemudian cari *zip* dengan tulisan *;extension=zip*
- Jika sudah cari, hilangkan tanda ; sehingga hanya *"extension=zip"*
- Save notepad dan silakan masuk tahap menjalankan aplikasinya.

Langkah-Langkah Menjalankan Aplikasinya:

- Cari Folder tempat simpan projek, lalu, *Git Bash*.
- Setelah itu, jalankan *GIT CLONE https://github.com/WinoAndikaB/KataKey-Project.git*.
- Terus buka VSCode, kemudian buka *Terminal*.
- Ketik *Composer Update*.
- Setelah itu, buat file baru *.env* dan pindahkan isi dari *.env.example* ke *.env*.
- Di *Terminal*, ketikkan *php artisan key:generate*.
- Lalu, buka *XAMPP* dan jalankan *Apache & MySQL*.
- Buka lagi Teriminal, *php artisan migrate --seed*.
- Kemudian, jalankan *php artisan serve*.

*Catatan:*
- Untuk akun buat login, bisa lihat di bagian seeder

Jika data pada database tidak masuk setelah di migrate, input manual saja dengan import file dari GDrive
https://drive.google.com/drive/u/3/folders/1iuafUJMoKbrXr-JBOOYPNB85bBdmWuzu

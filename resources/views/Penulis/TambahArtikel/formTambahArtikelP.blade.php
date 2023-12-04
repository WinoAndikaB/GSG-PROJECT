@extends('Main.layout.homeStyle')

<link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/lg1.png">
<link rel="icon" type="image/png" href="../assets2/img/lg1.png">

<style>
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: hidden; /* Tidak dapat di-scroll */
  }

  .modal-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    border: 1px solid #888;
    width: 20%;
    height: 30%; /* Mengatur tinggi modal menjadi 60% */
    text-align: center;
  }

  .close {
    color: #888;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
  }

  #confirm-button, #cancel-button {
    padding: 10px 20px;
    margin: 25px;
    cursor: pointer;
  }
</style>
<style>
  body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
  }

  .card {
      margin: 5px auto;
      max-width: 1950px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      overflow: hidden;
  }

  .card-header {
      background-color: #00bcd4;
      color: #fff;
      border-radius: 15px 15px 0 0;
      padding: 15px;
      text-align: center;
  }

  .btn-container {
            margin: 20px;
        }

        .btn-container a.btn {
            margin: 0 10px;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-container a.btn:hover {
            background-color: #0069d9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 0;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            color: #495057;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        tbody tr:nth-child(even) {
            background-color: #f1f3f5;
        }

        tbody tr:last-child {
            border-bottom: 2px solid #343a40;
        }

        .btn-container-bottom {
            margin-top: 20px;
        }
</style>
<!-- Alert Standar Ketentuan -->
<style>
  #error-message {
    display: none;
    background-color: #dc3545; /* Warna latar belakang merah */
    color: #fff; /* Warna teks putih */
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
    animation: fadeIn 0.5s ease-in-out; /* Animasi fade-in selama 0.5 detik */
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
</style>

<title>Form Tambah Artikel - Katakey</title>

<header class="header-area header-sticky" style="text-align: center;">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-12">
            <nav class="main-nav">
              <ul class="nav">
                  <li class="scroll-to-section"><a href="/homeP">Home</a></li>
                  <li class="scroll-to-section"><a href="/homeP">Trending</a></li>
                  <li class="scroll-to-section"><a href="/homeP">Artikel</a></li>
                  <li class="scroll-to-section"><a href="/VideoP">Video</a></li>
                  <li class="scroll-to-section"><a href="/kategoriP">Kategori</a></li>
                  <li class="scroll-to-section"><a href="/eventP">Event</a></li>
                  <li class="scroll-to-section"><a href="/ulasanP">Ulasan</a></li>
                  <li class="scroll-to-section"><a href="/aboutP">Tentang</a></li>
                  <li>
                    <div class="dropdown">
                        <a href="#" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center dropdown-toggle" role="button" id="savedArticlesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="profile-picture" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                                <?php
                                $fotoProfil = Auth::user()->fotoProfil;
                                if ($fotoProfil && file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                                ?>
                                <img src="{{ asset('fotoProfil/' . $fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php
                                } else {
                                ?>
                                <img src="{{ asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php
                                }
                                ?>
                            </div>
                
                            <span class="d-sm-inline d-none">
                                <?php
                                $fullName = Auth::user()->name;
                                $words = explode(' ', $fullName);
                
                                // Ambil dua kata pertama dan dua kata terakhir dari nama pengguna
                                $firstTwoWords = implode(' ', array_slice($words, 0, 1));
                                $lastTwoWords = implode(' ', array_slice($words, -1, 2));
                
                                echo $firstTwoWords . ' ' . $lastTwoWords;
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="savedArticlesDropdown">
                          <center>
                            <a class="dropdown-item" href="#" style="background-color: lightblue; display: block; text-align: center;">
                                {{ Auth::user()->role }}
                            </a>
                            <a class="dropdown-item" href="/profileP">Profil Anda</a>
                            <a class="dropdown-item" href="/simpanArtikelViewP">Artikel Tersimpan</a>
                            <a class="dropdown-item" href="/simpanVideoViewP">Video Tersimpan</a>
                          </center>
                      </div>
                    </div>
                </li>           
                  <li class="scroll-to-section">
                    <a href="#" class="d-sm-inline d-none text-white text-bold" id="logout-link" onclick="openModal()"> Logout</a>
                  </li>
          </nav>
          </div>
      </div>
  </div>
</header>

      <!-- Modal Logout -->
      <div id="logout-modal" class="modal">
        <div class="modal-content">
          <span class="close" id="close-button" onclick="closeModal()">&times;</span>
          <h2>Konfirmasi Logout</h2>
          <p>Apakah anda mau logout?</p>
          <div style="text-align: center;">
            <button style="width: 120px;" class="btn btn-primary" id="confirm-logout-button" onclick="confirmLogout(true)">Ya</button>
            <button style="width: 120px;" class="btn btn-danger" id="cancel-logout-button" onclick="confirmLogout(false)">Tidak</button>
          </div>
        </div>
      </div>

<div class="page-heading">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="header-text">
          <h2>Tambah Artikel</h2>
          <div class="div-dec"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<body class="landing-page sidebar-collapse">
  <div class="wrapper">
    <br>

    <div class="card">
      <div class="card-header" style="background: linear-gradient(45deg, #0f4c75, #3282b8); color: #fff; text-align: center; border-radius: 10px 10px 0 0; padding: 15px;">
          <h5 style="margin-bottom: 0; font-size: 1.5em; color: #fff;">Tulis Artikel</h5>
      </div>
      <div class="btn-container">
          <div class="text-center">
            <a href="/formTambahArtikelP" class="btn btn-info">Tambah Artikel</a>
            <a href="/komentarArtikelP" class="btn btn-primary">Komentar Artikel</a>
            <a href="/laporanArtikelP" class="btn btn-danger">Laporan Artikel</a>
          </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('storeSA') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mx-3">
                        <div class="form-group">
                            <label>Gambar Artikel</label><br>
                            <span for="gambarArtikel">Format Gambar: .jpg, .jpeg, .png</span>
                            <input type="file" class="form-control" id="gambarArtikel" name="gambarArtikel">
                        </div>
    
                        <div class="form-group">
                            <label>Judul Artikel</label>
                            <input type="text" class="form-control" id="judulArtikel" name="judulArtikel" required>
                        </div>
    
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>
    
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ Auth::user()->name }}" readonly>
                        </div>
    
                        <div class="form-group">
                            <label for="kategori">Kategori</label><br>
                            <select class="form-control" id="kategori" name="kategori" required>
                                @foreach($kategoris as $item)
                                <option value="{{ $item->kategori }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                          <label for="tags">Tags</label>
                          <select class="form-control" id="tags" name="tags[]" multiple="multiple" required>
                              <!-- Existing tags (if any) can be shown here -->
                          </select>
                      </div>
    
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="editor"></textarea>
                        </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

      <div class="btn-container-bottom text-center">
          <a href="/daftarArtikelP" class="btn btn-warning">Kembali</a>
      </div>

      <br>
  </div>
</div>

  <!-- Dynamic Tags -->
  <script>
    $(document).ready(function () {
        $('#tags').select2({
            tags: true,
            tokenSeparators: [',', ' '], // Allow comma or space to separate tags
            placeholder: 'Choose tags',
        });
    });
</script>

<!-- Standar Penulisan -->
<script>
  function validateForm() {
    const errorMessageDiv = document.getElementById('error-message');
    errorMessageDiv.innerHTML = ''; // Reset pesan kesalahan sebelum validasi

    // Validasi kualitas foto
    const gambarArtikelInput = document.getElementById('gambarArtikel');
    if (gambarArtikelInput.files.length > 0) {
      const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
      const fileName = gambarArtikelInput.value;
      if (!allowedExtensions.exec(fileName)) {
        errorMessageDiv.innerHTML += '<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Format foto harus <strong>.jpg, .jpeg, atau .png.</strong></p>';
      }
    }

// Validasi penggunaan kata tidak pantas pada deskripsi
const deskripsiInput = document.getElementById('editor');
const forbiddenWordsDesc = ['kata1', 'kata2', 'kata3']; // Gantilah dengan kata-kata yang dianggap tidak pantas pada deskripsi
const deskripsiValue = deskripsiInput.value.toLowerCase();
for (const word of forbiddenWordsDesc) {
  if (deskripsiValue.includes(word)) {
    errorMessageDiv.innerHTML += `<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Penggunaan kata <strong>"${word}"</strong> pada deskripsi tidak sesuai karena mengandung unsur negatif.</p>`;
  }
}

// Validasi penggunaan kata tidak pantas pada judul
const judulInput = document.getElementById('judulArtikel');
const forbiddenWordsJudul = ['judul1','judul2','judul3','judul4','judul5','judul6','judul7','judul8','judul9','judul10',]; // Gantilah dengan kata-kata yang dianggap tidak pantas pada judul
const judulValue = judulInput.value.toLowerCase();
for (const word of forbiddenWordsJudul) {
  if (judulValue.includes(word)) {
    errorMessageDiv.innerHTML += `<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Penggunaan kata <strong>"${word}"</strong> pada judul tidak sesuai karena mengandung unsur negatif.</p>`;
  }
}

// Validasi penggunaan kata tidak pantas pada tags
const tagsInput = document.getElementById('tags');
const forbiddenWordsTags = ['tags1','tags2','tags3','tags4','tags5','tags6','tags7','tags8','tags9','tags10']; // Gantilah dengan kata-kata yang dianggap tidak pantas pada tags
const tagsValue = tagsInput.value.toLowerCase();
for (const word of forbiddenWordsTags) {
  if (tagsValue.includes(word)) {
    errorMessageDiv.innerHTML += `<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Penggunaan kata <strong>"${word}"</strong> pada tags tidak sesuai karena mengandung unsur negatif.</p>`;
  }
}


    // Jika ada pesan kesalahan, tampilkan di bawah judul "Tambah Artikel"
    if (errorMessageDiv.innerHTML !== '') {
      errorMessageDiv.style.display = 'block';
    } else {
      // Jika semua validasi berhasil, formulir akan dikirimkan
      document.querySelector('form').submit();
    }
  }
</script>
   
            <!-- MODAL LOGOUT -->
     <script>
      // JavaScript untuk modal logout
      function openModal() {
        const modal = document.getElementById('logout-modal');
        modal.style.display = 'block';
      }
    
      function closeModal() {
        const modal = document.getElementById('logout-modal');
        modal.style.display = 'none';
      }
    
      function confirmLogout(confirmed) {
        if (confirmed) {
          // Redirect ke URL logout yang sesuai (ganti URL ini dengan URL logout sebenarnya)
          window.location.href = '/logout';
        } else {
          // Tutup modal jika pengguna memilih "No"
          closeModal();
        }
      }
    
      // Tutup modal jika pengguna mengklik di luar modal
      window.addEventListener('click', (event) => {
        const modal = document.getElementById('logout-modal');
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      });
    </script>

    <!--  CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');

  async function fetchBadWords(input) {
    const apiKey = "O3A8ZvNyKn89WPtIBt4Kf0XccNCytF0T";
    const apiUrl = "https://api.apilayer.com/bad_words?censor_character=";

    const myHeaders = new Headers();
    myHeaders.append("apikey", apiKey);

    const requestOptions = {
      method: 'POST',
      redirect: 'follow',
      headers: myHeaders,
      body: input
    };

    try {
      const response = await fetch(apiUrl + input, requestOptions);
      if (!response.ok) {
        throw new Error('Failed to fetch bad words');
      }

      const result = await response.text();
      return result;
    } catch (error) {
      console.error('Error fetching bad words:', error);
      return null;
    }
  }

  async function validateForm() {
    const errorMessageDiv = document.getElementById('error-message');
    errorMessageDiv.innerHTML = ''; // Reset pesan kesalahan sebelum validasi

    // Validasi penggunaan kata tidak pantas pada deskripsi
    const deskripsiInput = CKEDITOR.instances.editor.getData();
    const deskripsiValue = deskripsiInput.toLowerCase();

    try {
      console.log('Deskripsi sebelum validasi:', deskripsiValue);

      const result = await fetchBadWords(deskripsiValue);
      console.log('Respon dari API:', result);

      if (result) {
        errorMessageDiv.innerHTML += `<p class="text-white">${result}</p>`;
      }
    } catch (error) {
      console.error('Error validating description:', error);
    }

    // Jika ada pesan kesalahan, tampilkan di bawah judul "Tambah Artikel"
    if (errorMessageDiv.innerHTML !== '') {
      errorMessageDiv.style.display = 'block';
    } else {
      // Jika semua validasi berhasil, formulir akan dikirimkan
      document.querySelector('form').submit();
    }
  }
</script>
            </body>

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
      font-family: 'Poppins', sans-serif;
      text-align: center;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
  }

  .profile-container {
      max-width: 800px; /* Adjust the max-width to your desired size */
      margin: auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
  }

  .profile-name {
      font-size: 2em;
      font-weight: bold;
      margin-bottom: 10px;
      color: #3498db;
  }

  .header-name {
      font-size: 2em;
      font-weight: bold;
      margin-bottom: 10px;
      color: #000000;
  }

  .about-section {
      margin-bottom: 20px;
      color: #555;
  }

  .social-media-links {
      margin-bottom: 20px;
      color: #555;
  }

  .social-media-links a {
      margin: 0 15px;
      text-decoration: none;
      color: #3498db;
      transition: color 0.3s ease;
  }

  .followers-likes {
      font-size: 1.2em;
      color: #555;
      margin-bottom: 20px;
  }

  .articles-section {
      text-align: left;
  }

  .article-card {
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      transition: transform 0.3s ease;
  }

  .article-card:hover {
      transform: scale(1.02);
  }

  .fab {
      font-size: 1.5em;
      margin-right: 5px;
  }
</style>

<title>Profil - Katakey</title>

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
          <h2>Profile</h2>
          <div class="div-dec"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<body class="landing-page sidebar-collapse">
  <div class="wrapper">
    <div class="section">
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-user" style="border: 2px solid #00bcd4; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <div class="card-header" style="background: linear-gradient(45deg, #0f4c75, #3282b8); color: #fff; text-align: center; border-radius: 10px 10px 0 0; padding: 15px;">
                <h5 style="margin-bottom: 0; font-size: 1.5em; color: #fff;"> Edit Profil User </h5>
              </div>
              <div class="card-body">
                    <form method="POST" action="{{ route('updateUser', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')

                      <div class="text-center">
                        <a href="/daftarArtikelP" class="btn btn-info">Artikel Anda</a>
                        <a href="/daftarVideoP" class="btn btn-primary">Video Anda</a>
                        <a href="/berhentiPenulis" class="btn btn-danger">Berhenti Menjadi Penulis?</a>
                      </div>

                      <hr>

                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" disabled="" name="role" value="{{ Auth::user()->role }}">
                            </div>
        
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" disabled="" name="username" value="{{ Auth::user()->username }}">
                            </div>
        
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" disabled="" name="email" value="{{ Auth::user()->email }}">
                            </div>

                            <div class="form-group">
                              <label>Foto Profil</label>
                              <input type="file" class="form-control" name="fotoProfil">
                          </div>
        
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
        
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ Auth::user()->alamat }}">
                            </div>
        
                            <div class="form-group">
                              <label>Instagram</label><br>
                              <label>Format Penulisan : https://www.instagram.com/goodgamestoreid/</label>
                              <input type="text" class="form-control" name="instagram" value="{{ Auth::user()->instagram }}" pattern="https?://(www\.)?instagram\.com/.+">
                          </div>
                          
                          <div class="form-group">
                              <label>Facebook</label><br>
                              <label>Format Penulisan : https://www.facebook.com/goodgamestoreid/</label>
                              <input type="text" class="form-control" name="facebook" value="{{ Auth::user()->facebook }}" pattern="https?://(www\.)?facebook\.com/.+">
                          </div>                  
        
                            <div class="form-group">
                                <label>About Me</label>
                                <textarea rows="4" class="form-control" name="aboutme">{{ Auth::user()->aboutme}}</textarea>
                            </div>
        
                              <button type="submit" class="btn btn-primary">Simpan</button>
                              <a href="/homeP" class="btn btn-info">Kembali</a>
                              </form>
                          </div>
                      </div>
                  </div>
        
                  <div class="col-md-4">
                    <div class="card">
                    <br>
                          <div>
                            <div style="width: 120px; height: 120px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="
                                <?php
                                $fotoProfil = Auth::user()->fotoProfil;
                                if ($fotoProfil && file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                                    echo asset('fotoProfil/' . $fotoProfil);
                                } else {
                                    echo asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999');
                                }
                            ?>" alt="Foto Profil">
                            </div>
                          
                            <div class="profile-name text-center">
                                {{ Auth::user()->name }}
                            </div>
                          
                            <div class="text-center">
                                <span style="margin-right: 10px;"><b>20</b> Artikel</span>
                                <span style="margin-right: 10px;"><b>2</b> Video</span>
                                <span style="margin-right: 10px;"><b>100</b> Followers</span>
                                <span><b>500</b> Likes</span>
                            </div>
                          
                            <br>
                          
                            <div class="social-media-links text-center">
                                <a href="#" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                                <a href="#" target="_blank" title="Facebook"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" target="_blank" title="Facebook"><i class="fab fa-youtube"></i></a>
                                <a href="#" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                            <hr>
                              <div class="social-media-links text-center"><b>Bergabung Sejak:</b>
                                <p>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('F j, Y') }}</p>
                              </div> 

                            <hr>
                          
                            <div class="about-section text-center">
                                <p>{{ Auth::user()->aboutme }}</p>
                            </div>
                        
                          </div>
                        </div>
                      </div>
                      
                </div>
              </div>
            </div>

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
            </body>

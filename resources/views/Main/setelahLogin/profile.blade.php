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

<title>Profil - GSG Project</title>

<header class="header-area header-sticky" style="text-align: center;">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-12">
            <nav class="main-nav">
              <ul class="nav">
                  <li class="scroll-to-section"><a href="/">Home</a></li>
                  <li class="scroll-to-section"><a href="#trends">Trending</a></li>
                  <li class="scroll-to-section"><a href="#about">Artikel</a></li>
                  <li class="scroll-to-section"><a href="/Video" class="">Video</a></li>
                  <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                  <li class="scroll-to-section"><a href="/event">Event</a></li>
                  <li class="scroll-to-section"><a href="/ulasan" class="text-center">Ulasan</a></li>
                  <li class="scroll-to-section"><a href="/about" class="">Tentang</a></li>
                  <li class="scroll-to-section">
                    <a href="/profileUser" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center">
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
                      <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                  </a>                        
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
              <div class="card">
                  <div class="card-header">
                      <h5 class="title">Edit Profile</h5>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('updateUser', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
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
                              <a href="/home" class="btn btn-info">Kembali</a>
                              </form>
                          </div>
                      </div>
                  </div>
        
                  <div class="col-md-4">
                    <div class="card card-user">
                      <div class="card-body text-center">
                        <div class="author">
                          <a href="/profileUser">
                            <img src="
                            <?php
                                $fotoProfil = Auth::user()->fotoProfil;
                                if ($fotoProfil && file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                                    echo asset('fotoProfil/' . $fotoProfil);
                                } else {
                                    echo asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999');
                                }
                            ?>" alt="User's Profile Picture">

                            <br>
                            <br>
                            <br>
                            <h5 class="title">{{Auth::user()->name}}</h5>
                            <span>{{Auth::user()->username}}</span>
                          </a>
                          <p class="description">
                            {{Auth::user()->email}}
                          </p>
                        </div>
                        <p class="description">
                          {{Auth::user()->aboutme}}
                        </p>
                      </div>
                      <hr>
                      <div class="button-container text-center">
                        <a href="{{Auth::user()->facebook}}" class="btn btn-neutral btn-icon btn-round btn-lg">
                          <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="{{Auth::user()->instagram}}" class="btn btn-neutral btn-icon btn-round btn-lg">
                          <i class="fab fa-instagram"></i> Instagram
                        </a>
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

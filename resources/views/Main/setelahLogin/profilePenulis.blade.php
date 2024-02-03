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

<title>Profil Penulis - Katakey</title>

<header class="header-area header-sticky" style="text-align: center;">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-12">
            <nav class="main-nav">
              <ul class="nav">
                  <li class="scroll-to-section"><a href="/home">Home</a></li>
                  <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                  <li class="scroll-to-section"><a href="/Video">Video</a></li>
                  <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                  <li class="scroll-to-section"><a href="/ulasan">Ulasan</a></li>
                  <li class="scroll-to-section"><a href="/about">Tentang</a></li>
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
                          <a class="dropdown-item" href="/profileUser">Profil Anda</a>
                          <a class="dropdown-item" href="/simpanArtikelView">Artikel Tersimpan</a>
                          <a class="dropdown-item" href="/simpanVideoView">Video Tersimpan</a>
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

<div class="page-heading">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="header-text">
          <h2>Profile Penulis</h2>
          <div class="div-dec"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<br>

<div class="section">
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
          <div class="card">
          <br>
                <div>
                  <div style="width: 120px; height: 120px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
                      <img style="width: 100%; height: 100%; object-fit: cover;" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fHByb2ZpbGV8ZW58MHx8MHx8fDA%3D" alt="Foto Profil">
                  </div>
                
                  <div class="profile-name text-center">
                      {{ Auth::user()->name }}
                  </div>
                
                  <div class="text-center">
                      <span style="margin-right: 10px;"><b>20</b> Artikel</span>
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
                
                  <div class="about-section text-center">
                      <p>{{ Auth::user()->aboutme }}</p>
                  </div>
              
                </div>
              </div>
            </div>
    
            <div class="col-md-4">
              <div class="card card-user" style="border: 2px solid #00bcd4; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(45deg, #0f4c75, #3282b8); color: #fff; text-align: center; border-radius: 10px 10px 0 0; padding: 15px;">
                  <h5 style="margin-bottom: 0; font-size: 1.5em; color: #fff;"> Daftar Artikel </h5>
                </div>
                <div class="card-body">
                  <div class="row" style="text-align: justify">
                    <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                      <div class="d-flex justify-content-center">
                        <img src="https://i0.wp.com/picjumbo.com/wp-content/uploads/beautiful-nature-scenery-free-photo.jpg?w=2210&quality=70" style="max-width: 100%; height: auto; border-radius: 14px;">
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                      <a href="#" style="color: #d47500;">
                        <h4 class="header-name" style="text-align: left; font-size: 1.2em;">📖 Judul Artikel 1</h4>
                        <span class="d-flex"><b>01 November 2023</b></span>
                      </a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row" style="text-align: justify">
                    <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                      <div class="d-flex justify-content-center">
                        <img src="https://i0.wp.com/picjumbo.com/wp-content/uploads/beautiful-nature-scenery-free-photo.jpg?w=2210&quality=70" style="max-width: 100%; height: auto; border-radius: 14px;">
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                      <a href="#" style="color: #d47500;">
                        <h4 class="header-name" style="text-align: left; font-size: 1.2em;">📖 Judul Artikel 1</h4>
                        <span class="d-flex"><b>01 November 2023</b></span>
                      </a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            
            

    
            <div class="col-md-4">
              <div class="card card-user" style="border: 2px solid #00bcd4; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(45deg, #0f4c75, #3282b8); color: #fff; text-align: center; border-radius: 10px 10px 0 0; padding: 15px;">
                  <h5 style="margin-bottom: 0; font-size: 1.5em; color: #fff;"> Daftar Video </h5>
                </div>
                <div class="card-body">
                  <div class="row" style="text-align: justify">
                    <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                      <div class="d-flex justify-content-center">
                        <img src="https://i0.wp.com/picjumbo.com/wp-content/uploads/beautiful-nature-scenery-free-photo.jpg?w=2210&quality=70" style="max-width: 100%; height: auto; border-radius: 14px;">
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                      <a href="#" style="color: #d47500;">
                        <h4 class="header-name" style="text-align: left; font-size: 1.2em;">📖 Judul Video 1</h4>
                        <span class="d-flex"><b>05 November 2023</b></span>
                      </a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row" style="text-align: justify">
                    <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                      <div class="d-flex justify-content-center">
                        <img src="https://i0.wp.com/picjumbo.com/wp-content/uploads/beautiful-nature-scenery-free-photo.jpg?w=2210&quality=70" style="max-width: 100%; height: auto; border-radius: 14px;">
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                      <a href="#" style="color: #d47500;">
                        <h4 class="header-name" style="text-align: left; font-size: 1.2em;">📖 Judul Video 1</h4>
                        <span class="d-flex"><b>05 November 2023</b></span>
                      </a>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
              
          </div>
        </div>
      </div>


<!----------------------------------------------------------------------------------- Modal Area -------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------- Modal Area -------------------------------------------------------------------------------------------->

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


<!----------------------------------------------------------------------------------- Javascript Area -------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------- Javascript Area -------------------------------------------------------------------------------------------->

<!-- Slider Video Artikel -->
  <script>
    function showContent(contentType) {
      const articlesSection = document.querySelector('.articles-section');
      const articleContainer = document.querySelector('.article-container');

      // Toggle display based on content type
      if (contentType === 'articles') {
        articleContainer.style.transform = 'translateX(0%)';
      } else if (contentType === 'videos') {
        articleContainer.style.transform = 'translateX(-100%)';
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
            </body>

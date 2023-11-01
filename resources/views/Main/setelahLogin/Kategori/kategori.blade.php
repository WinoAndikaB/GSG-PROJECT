@extends('Main.layout.homeStyle')

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/lg1.png">
    <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Kategori - GSG Project</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

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
  </head>

<body>


  <!-- ***** Header Area Start ***** -->
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
                    <li class="scroll-to-section"><a href="/kategori" class="active">Kategori</a></li>
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
  <!-- ***** Header Area End ***** -->

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
            <h2>Kategori</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Main Banner Area End ***** -->

  <div class="pd-top-80 pd-bottom-50" id="grid">
    <div class="container">

      <div class="section-title">
        <h6 class="title">List Kategori</h6>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="trending-post">
                <div class="single-post-wrap style-overlay">
                  <div class="thumb">
                    <img src="https://images3.alphacoders.com/133/1331008.png" alt="img" width="100%" height="200">
                  </div>
                  <div class="details">
                    <h6 class="title"><a href="/kategoriAnimeLog">Anime</a></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="trending-post">
                <div class="single-post-wrap style-overlay">
                  <div class="thumb">
                    <img src="https://t3.ftcdn.net/jpg/04/66/29/50/360_F_466295095_7pE9mbUqZEjzHDHA2Jgt7EGnzNYibd8S.jpg" alt="img" width="100%" height="200">
                  </div>
                  <div class="details">
                    <h6 class="title"><a href="/kategoriVTuberLog">Virtual YouTuber</a></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>    
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="trending-post">
                <div class="single-post-wrap style-overlay">
                  <div class="thumb">
                    <img src="https://c4.wallpaperflare.com/wallpaper/943/336/946/point-blank-online-game-wallpaper-preview.jpg" alt="img">
                  </div>
                  <div class="details">
                    <h6 class="title"><a href="/kategoriGameLog">Game</a></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="trending-post">
                <div class="single-post-wrap style-overlay">
                  <div class="thumb">
                    <img src="https://s3.amazonaws.com/static.organiclead.com/Site-188d77f5-71db-4d99-84a6-4daef9a27c27/Blog_images/0ec1f71c_3137_46ff_b881_4b5982d72c74.jpg" alt="img">
                  </div>
                  <div class="details">
                    <h6 class="title"><a href="#">Budaya</a></h6>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="trending-post">
                <div class="single-post-wrap style-overlay">
                  <div class="thumb">
                    <img src="https://i.pinimg.com/originals/19/a1/b2/19a1b216f31a5d18a054aef242ccacab.jpg" alt="img">
                  </div>
                  <div class="details">
                    <h6 class="title"><a href="#">Seni</a></h6>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
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
</html>
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

    <title>About - Katakey</title>

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

                /* DROP DOWN AREA */
  .dropdown:hover .dropdown-menu,
  .dropdown:focus-within .dropdown-menu {
      display: block;
  }

  .dropdown-menu {
      display: none;
}

.dropdown-menu {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease; /* menambahkan transisi */
}

.dropdown-menu.show {
    display: block;
    opacity: 1;
}
  </style>

<style>
  /* Notificaton */
  .scrollable-menu {
  max-height: 600px; /* Set the max height you want */
  overflow-y: auto; /* Enable vertical scrolling */
}
</style>

</head>
<body>


  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
              <nav class="main-nav">
                <ul class="nav">
                    <li class="scroll-to-section"><a href="/home">Home</a></li>
                    <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/Video" class="">Video</a></li>
                    <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                    <li class="scroll-to-section"><a href="/ulasan" class="text-center">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/about" class="active">Tentang</a></li>
                    <li>
                      <div class="dropdown">
                        <a href="#" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center dropdown-toggle" role="button" id="savedArticlesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div class="profile-picture" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                              <?php
                              $fotoProfil = Auth::user()->fotoProfil;
                              if ($fotoProfil) {
                                  if (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                                      // Jika fotoProfil adalah URL, gunakan langsung URL tersebut
                                      echo '<img src="' . $fotoProfil . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                                  } else {
                                      // Jika fotoProfil adalah nama file, cek apakah file tersebut ada
                                      $pathToFile = public_path('fotoProfil/' . $fotoProfil);
                                      if (file_exists($pathToFile)) {
                                          echo '<img src="' . asset('fotoProfil/' . $fotoProfil) . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                                      } else {
                                          // Jika file tidak ada, tampilkan foto default
                                          echo '<img src="' . asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                                      }
                                  }
                              } else {
                                  // Jika fotoProfil kosong, tampilkan foto default
                                  echo '<img src="' . asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
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
                            <a class="dropdown-item" href="/profileUser"><i class="fas fa-user"></i> Profil Anda</a>
                            <a class="dropdown-item" href="/simpanArtikelView"><i class="fas fa-bookmark"></i> Artikel Tersimpan</a>
                            <a class="dropdown-item" href="/simpanVideoView"><i class="fas fa-video"></i> Video Tersimpan</a>
                        </div>
                    </div>
                  </li>
                  <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell" style="color: white;"></i> <span class="badge badge-pill badge-primary">{{ $jumlahData }}</span>
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-wide scrollable-menu" aria-labelledby="dropdownMenuButton">
                        <h6 class="container-title" style="margin: 10px 0; text-align: center;"><i class="fas fa-bell"></i> Notifikasi</h6>
                        <hr>
                        
                        @if($isFollowingAuthor && $jumlahData > 0)
                            @foreach($notifArtikel as $item)
                                <a class="dropdown-item" href="{{ route('detail.artikel', ['id' => $item->id]) }}">
                                    <div class="notification-item">
                                        <div class="notification-info">
                                            <div class="profile-info">
                                                <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left">
                                                <div class="profile-details">
                                                    <h6 class="notification-title" title="{{ $item->judulArtikel }}">{{ $item->penulis }} mengupload: {{ Str::limit($item->judulArtikel, 20) }}</h6>
                                                    <p class="notification-time">{{ $item->created_at->format('d F Y') }} | {{ $item->created_at->diffForHumans() }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="dropdown-item">Tidak ada notifikasi saat ini.</p>
                        @endif
                        
                    </div>
                </div>         
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
            <h2>About Us</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Main Banner Area End ***** -->

  <section class="top-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="left-image">
            <img src="assets/images/about-left-image.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 align-self-center">
          <div class="accordions is-first-expanded">
            <article class="accordion">
              <div class="accordion-head">
                  <span>Selamat Datang</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Selamat datang di Katakey, ruang digital yang kami bentuk untuk menjadi sumber utama bagi mereka yang haus akan pengetahuan, inspirasi, dan hiburan berkualitas. Sebagai tim yang berkomitmen, kami percaya bahwa pembelajaran adalah proses sepanjang hayat, dan melalui Katakey, kami ingin mempermudah perjalanan Anda dalam mengeksplorasi dunia informasi yang kaya dan beragam.</p>
                  </div>
              </div>
          </article>
          <article class="accordion">
            <div class="accordion-head">
                <span>Tujuan?</span>
                <span class="icon">
                    <i class="icon fa fa-chevron-right"></i>
                </span>
            </div>
            <div class="accordion-body">
                <div class="content">
                    <p>
                      <strong>1. Memberikan Platform Berkualitas: </strong><br>
                      
                      Kami bertekad memberikan platform yang tidak hanya memfasilitasi upload artikel informatif tetapi juga menyajikan video pendukung berkualitas tinggi. Kami percaya bahwa kombinasi artikel dan video dapat menciptakan pengalaman pembelajaran yang lebih menyeluruh dan menarik.<br>
                      <br>
                      <strong>2. Menyediakan Beragam Kategori: </strong><br>
                      
                      Katakey mencakup berbagai kategori agar setiap pengunjung dapat menemukan konten yang sesuai dengan minat dan kebutuhan mereka. Dari sains hingga seni, kami berusaha untuk merangkul keragaman pengetahuan.<br>
                      <br>
                      <strong>3. Menjadi Sumber Informasi Terpercaya:</strong><br>
                      
                      Kami berkomitmen untuk menjadi sumber informasi yang terpercaya dan akurat. Setiap artikel yang diunggah melalui platform kami melalui proses kurasi yang ketat, memastikan bahwa pengguna mendapatkan informasi yang berkualitas.<br>
                    </p>
                </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>  

  <section class="what-we-do">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="left-content">
            <h4>Kami Butuh Dukungan Anda</h4>
            <p>Katakey adalah perwujudan semangat kami untuk membangun komunitas pembelajar yang dinamis dan berbagi. Kami berharap bahwa setiap langkah yang Anda ambil di dalam platform ini membawa Anda lebih dekat pada pemahaman yang lebih dalam, 
              inspirasi yang tak terbatas, dan konektivitas dengan komunitas yang berpikiran serupa. Selamat mengeksplorasi dan bergabunglah dengan kami dalam perjalanan pengetahuan yang tak ada habisnya!</p>
            <div class="green-button">
                <a href="contact-us.html">Temukan Lebih Lanjut</a>
            </div>
        </div>        
        </div>
        <div class="col-lg-6">
          <div class="right-items">
            <div class="row">
              <div class="col-lg-6">
                <div class="item">
                  <em>01</em>
                  <h4>Jelajahi Konten Kami</h4>
                  <p>Temukan beragam artikel menarik, video pendukung, dan informasi yang kami sediakan. Cari topik yang Anda minati dan mulailah menjelajah.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item">
                  <em>02</em>
                  <h4>Interaksi dan Berbagi</h4>
                  <p>Setelah menemukan konten yang Anda nikmati, interaksilah dengan komunitas kami. Anda dapat memberikan komentar, berbagi artikel, dan terlibat dalam diskusi yang menarik.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item">
                  <em>03</em>
                  <h4>Manfaatkan Video Pendukung</h4>
                  <p>Saksikan video pendukung yang tersedia untuk meningkatkan pemahaman Anda. Video dapat menjadi pelengkap yang sangat berharga untuk artikel dan memperkaya cara Anda menyerap informasi.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item">
                  <em>04</em>
                  <h4> Beri Masukan</h4>
                  <p>Kami selalu menghargai masukan dari pengguna kami. Jika Anda memiliki saran atau tanggapan, jangan ragu untuk menghubungi kami. Kami ingin memastikan Katakey terus berkembang sesuai dengan kebutuhan dan minat Anda.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="simple-cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <h4>Upload <em>Articles</em> with <strong>Valid</strong> Information</h4>
        </div>
        <div class="col-lg-7">
          <div class="buttons">
            <div class="green-button">
              <a href="/home">Kembali</a>
            </div>
            <div class="orange-button">
              <a href="/ulasan">Ulasan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="map">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div id="map">
            <iframe src="https://www.google.com/maps/d/embed?mid=1ipscTh3Sci7oB74qAg6hPkEjACg&hl=en&ehbc=2E312F" width="100%" height="450px" frameborder="0" style="border:0; border-radius: 5px; position: relative; z-index: 2;" allowfullscreen=""></iframe>
          </div>
        </div>
        <div class="col-lg-10 offset-lg-1">
          <div class="row">
            <div class="col-lg-4">
              <div class="info-item">
                <i class="fa fa-envelope"></i>
                <h4>Email Address</h4>
                <a href="#">Katakey@gmail.com</a>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="info-item">
                <i class="fa fa-phone"></i>
                <h4>Phone Number</h4>
                <a href="#">010-020-0340</a>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="info-item">
                <i class="fa fa-map-marked-alt"></i>
                <h4>Address</h4>
                <a href="#">Yogyakarta, Indonesia</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials" id="testimonials">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Person</h6>
            <h4>Person Involved</h4>
          </div>
        </div>
        <div class="col-lg-10 offset-lg-1">
          <div class="owl-testimonials owl-carousel" style="position: relative; z-index: 5;">
            <div class="item">
              <i class="fa fa-quote-left"></i>
              <p>“Chill and enjoy the process.”</p>
              <h4>Wino Andika Batara</h4>
              <span>Frontend & Backend Developer</span>
              <div class="right-image">
                <img src="fotoProfil/fotoProfil.Random Person Random.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--------------------------------------------------------------------------------------- Javascript Dropdown ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Dropdown ------------------------------------------------------------------------------->

<script>
  document.addEventListener("DOMContentLoaded", function() {
      var dropdownMenu = document.querySelector('.dropdown-menu');

      // Saat mouse memasuki dropdown, tambahkan kelas 'show'
      dropdownMenu.addEventListener('mouseenter', function() {
          dropdownMenu.classList.add('show');
      });

      // Saat mouse meninggalkan dropdown, hapus kelas 'show'
      dropdownMenu.addEventListener('mouseleave', function() {
          dropdownMenu.classList.remove('show');
      });
  });
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
</html>
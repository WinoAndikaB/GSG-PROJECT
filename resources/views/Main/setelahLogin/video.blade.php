@extends('Main.layout.homeStyle')


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/lg1.png">
    <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Video -  Katakey</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

    <link href="{{ asset('aset1/css/media_query.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/owl.theme.default.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('aset1/css/style_1.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Modernizr JS -->
    <script src="{{ asset('aset1/js/modernizr-3.5.0.min.js')}}"></script>

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
  /* CSS styles */
  .article-title {
      color: black;
      text-decoration: none; /* Menghilangkan garis bawah */
      font-weight: bold; /* Bold text */
      position: relative; /* Memberikan posisi relatif */
  }
  .article-title::selection {
      color: white; /* Warna teks saat dipilih */
      background-color: #007bff; /* Warna latar belakang saat teks dipilih */
  }
  .article-title:hover {
      color: #ff6347; /* Warna teks saat kursor berada di atas judul artikel */
      cursor: pointer; /* Kursor pointer saat di atas judul artikel */
  }
  .article-title:hover::after {
      content: ""; /* Membuat elemen pseudo */
      position: absolute; /* Memberikan posisi absolut */
      bottom: -2px; /* Jarak dari bawah */
      left: 0; /* Posisi dari kiri */
      width: 100%; /* Lebar sesuai dengan judul artikel */
      background-color: #ff6347; /* Warna garis saat kursor berada di atas judul artikel */
  }
  .article-title span {
      text-decoration: none; /* Menghilangkan garis bawah */
  }
</style>

<style>
  /* Notificaton */
  .scrollable-menu {
  max-height: 600px; /* Set the max height you want */
  overflow-y: auto; /* Enable vertical scrolling */
}

</style>

<title>Video - Katakey</title>

<body>
<div class="page-heading">
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <ul class="nav">
                        <li style="margin-right: auto;">
                            <img src="{{ asset('assets2/img/katakey1.png') }}" alt="logo" style="width: 50px; height: auto;">
                          </li>
                          <li class="scroll-to-section"><a href="/home">Home</a></li>
                          <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                          <li class="scroll-to-section"><a href="/Video" class="active">Video</a></li>
                          <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                          <li class="scroll-to-section"><a href="/ulasan" class="text-center">Ulasan</a></li>
                          <li class="scroll-to-section"><a href="/about">Tentang</a></li>
                          <li>
                            <form action="{{ route('searchV') }}" method="GET" class="input-group">
                              <input type="text" name="searchV" class="form-control" placeholder="Cari Video..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('searchV') }}">
                              <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                          </form>
                          </li>
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
                              @foreach($notifVideo as $item)
                              <a class="dropdown-item" href="{{ route('showDetailVideo', ['id' => $item->id]) }}">
                                  <div class="notification-item">
                                      <div class="notification-info">
                                          <div class="profile-info">
                                              <?php
                                
                                              // Check if the function is already defined before declaring it
                                              if (!function_exists('getYoutubeVideoId')) {
                                                  // Define the function only if it's not already defined
                                                  function getYoutubeVideoId($url) {
                                                      $videoId = '';
                                                      $parts = parse_url($url);
                                                      if(isset($parts['query'])){
                                                          parse_str($parts['query'], $query);
                                                          if(isset($query['v'])){
                                                              $videoId = $query['v'];
                                                          }
                                                      } elseif (preg_match('/embed\/([^\&\?\/]+)/', $url, $matches)) {
                                                          $videoId = $matches[1];
                                                      }
                                                      return $videoId;
                                                  }
                                              }

                                              $videoId = getYoutubeVideoId($item->linkVideo);
                                              $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg"; // Mengambil thumbnail maksimum resolusi
                                              ?>
                                              <div class="col-4 align-self-center mb-3">
                                                  <img src="<?php echo $thumbnail; ?>" width="800%" alt="Thumbnail" style="border-radius: 3%;">
                                              </div>
                                              <div class="profile-details">
                                                  <h6 class="notification-title" title="{{ $item->judulVideo }}">{{ $item->uploader }} mengupload: {{ Str::limit($item->judulVideo, 20) }}</h6>
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
</div>

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

  <div class="banner-area banner-inner-1 bg-black" id="banner">
    <div class="banner-inner pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="thumb after-left-top">
                        <img src="assets/img/banner/1.png" alt="img">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="banner-details mt-4 mt-lg-0">
                        <div class="post-meta-single">
                            <ul>
                                <li><a class="tag-base tag-blue" href="#">Katakey</a></li>
                                <li class="date"><i class="fa fa-clock-o"></i>{{$todayDate}}</li>
                            </ul>
                        </div>
                        <h2>Provide you a qualified articles and informative articles from a lot sources.</h2>
                        <p></p>
                        <a class="btn btn-blue" href="/abouts">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <section class="about-us" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Video</h6>
            <h4>Daftar Video</h4>
          </div>
        </div>
        <div>

          <div style="display: flex; justify-content: center; margin: 10px;">
            @php
            $uniqueCategories = [];
            @endphp
            
            @foreach($kategoriLogV as $item)
                    @if (!in_array($item->kategori, $uniqueCategories))
                    <span class="fh5co_tags_all">
                        <a href="{{ route('kategoriV', ['kategori' => $item->kategori]) }}" class="fh5co_tagg">{{ $item->kategori }}</a>
                    </span>
                    @php
                    $uniqueCategories[] = $item->kategori;
                    @endphp
                @endif
            @endforeach
        </div>
        

        <?php

        // Check if the function is already defined before declaring it
        if (!function_exists('getYoutubeVideoId')) {
            // Define the function only if it's not already defined
            function getYoutubeVideoId($url) {
                $videoId = '';
                $parts = parse_url($url);
                if(isset($parts['query'])){
                    parse_str($parts['query'], $query);
                    if(isset($query['v'])){
                        $videoId = $query['v'];
                    }
                } elseif (preg_match('/embed\/([^\&\?\/]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                }
                return $videoId;
            }
        }
        
        foreach ($semuaVideo as $item) {
            $videoId = getYoutubeVideoId($item->linkVideo);
            $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg"; // Mengambil thumbnail maksimum resolusi
            ?>
            
            <div class="row" style="text-align: justify">
                <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                    <img src="<?php echo $thumbnail; ?>" alt="Thumbnail">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                <a href="{{ route('showDetailVideo', ['id' => $item->id]) }}" style="text-decoration: none;">
                  <h4 class="article-title" onclick="selectText(this)" style="text-align: left;">{{ $item->judulVideo}}</h4>
              </a>                   
                    <span class="d-flex"><b>{{ $item->uploader }} • 
                        @php
                        $ulasanCreatedAt = \Carbon\Carbon::parse($item->created_at);
                        $sekarang = \Carbon\Carbon::now();
                        $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
        
                        if ($selisihWaktu < 60) {
                            echo $selisihWaktu . ' Menit Lalu';
                        } elseif ($selisihWaktu < 1440) {
                            echo floor($selisihWaktu / 60) . ' Jam Lalu';
                        } elseif ($selisihWaktu < 10080) {
                            echo floor($selisihWaktu / 1440) . ' Hari Lalu';
                        } elseif ($selisihWaktu < 43200) {
                            echo floor($selisihWaktu / 10080) . ' Minggu Lalu';
                        } elseif ($selisihWaktu < 525600) {
                            echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                        } else {
                            echo floor($selisihWaktu / 525600) . ' Tahun Lalu';
                        }
                        @endphp
                        <br>
                    </b></span>
                    <p>{!! substr(strip_tags($item->deskripsiVideo), 0, 400) . (strlen(strip_tags($item->deskripsiVideo)) > 400 ? '...' : '') !!}</p>
                </div>
            </div>
            <hr>
            
            <?php
        }
        ?>
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
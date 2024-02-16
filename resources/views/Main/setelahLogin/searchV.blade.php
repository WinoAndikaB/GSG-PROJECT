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

    <title>Pencarian - Katakey</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

<!--------------------------------------------------------------------------- CSS Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- CSS Area --------------------------------------------------------------------------------------------------------------->

    <style>
      .animated-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        cursor: pointer;
        margin: 5px;
        font-size: 16px;
      }

      .animated-button:hover {
        background-color: #0056b3;
      }

      /* Additional styling for the second button */
      .animated-button:nth-of-type(2) {
        background-color: #ff6600;
      }

      .animated-button:nth-of-type(2):hover {
        background-color: #ff4500;
      }

      .search-container {
          text-align: center;
      }

      #search-input {
          padding: 10px;
          font-size: 20px;
          border: 2px solid #3498db;
          border-radius: 5px;
          outline: none;
      }

      #search-button {
          padding: 10px 20px;
          font-size: 18px;
          background-color: #3498db;
          color: #fff;
          border: none;
          border-radius: 5px;
          margin-left: 10px;
          cursor: pointer;
      }

      #search-button:hover {
          background-color: #2186c6;
      }

    </style>
     <style>
      .modalLogout {
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
  
      .modal-contentLogout {
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
        width: 40%;
        height: 30%; /* Mengatur tinggi modal menjadi 60% */
        text-align: center;
      }
  
      .closeLogout {
        color: #888;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
      }
  
      #confirm-buttonLogout, #cancel-buttonLogout {
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

  </head>

<!--------------------------------------------------------------------------- Body Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- Body Area --------------------------------------------------------------------------------------------------------------->

<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
              <nav class="main-nav">
                <ul class="nav">
                    <li class="scroll-to-section"><a href="/home">Home</a></li>
                    <li class="scroll-to-section"><a href="/home">Trending</a></li>
                    <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/Video" class="active">Video</a></li>
                    <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                    <li class="scroll-to-section"><a href="/ulasan">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/about">Tentang</a></li>
                    <li>
                      <form action="{{ route('searchV') }}" method="GET" class="input-group">
                        <input type="text" name="searchV" class="form-control" placeholder="Cari Artikel..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('searchV') }}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </form>
                    </li>
                    <li>
                      <div class="dropdown">
                        <a href="#" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center dropdown-toggle" role="button" id="savedArticlesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                            <a class="dropdown-item" href="/profileUser"><i class="fas fa-user"></i> Profil Anda</a>
                            <a class="dropdown-item" href="/simpanArtikelView"><i class="fas fa-bookmark"></i> Artikel Tersimpan</a>
                            <a class="dropdown-item" href="/simpanVideoView"><i class="fas fa-video"></i> Video Tersimpan</a>
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
  <!-- ***** Header Area End ***** -->
  

  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-text">
            <h2>Pencarian Video</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="pd-top-80 pd-bottom-50" id="grid">
  <div class="container">

    <section class="about-us" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <div class="section-heading">

            </div>
          </div>
          <div>

            <div class="search-container">
              <form action="{{ route('searchV') }}" method="GET" class="input-group">
                <input type="text" name="searchV" class="form-control" placeholder="Cari..." value="{{ request('searchV') }}">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
              </form>            
          </div>          
          </div>

          <br>
          <br>

          <h5>Hasil pencarian <b>"{{ request('searchV') }}"</b>, {{ $videos->count() }} hasil ditemukan</h5>

            <br>
            <br>

            <?php
            // Fungsi untuk mendapatkan ID video YouTube dari URL
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
            ?>
            
            @foreach ($videos as $item)
                <div class="row" style="text-align: justify">
                    <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                        <?php
                        $videoId = getYoutubeVideoId($item->linkVideo);
                        $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg"; // Mengambil thumbnail maksimum resolusi
                        ?>
            
                        <img src="<?php echo $thumbnail; ?>" alt="Thumbnail">
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                        <h4 style="text-align: left">{{ $item->judulVideo }}</h4>
                        <span class="d-flex"><b>{{ $item->uploader }}</b></span>
                        <p>{!! substr(strip_tags($item->deskripsiVideo), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
                    </div>
                    <span style="text-align: right; color: rgba(165, 165, 165, 1);">
                        <p>
                            @php
                            $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
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
                            | 
                            <a href="{{ route('showDetailVideo', ['id' => $item->id]) }}" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a>
                        </p>
                    </span>
                </div>
                <hr>
            @endforeach
            
            </div>
        </div>
      </div>
    </section>

<!--------------------------------------------------------------------------- Modal Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- Modal Area --------------------------------------------------------------------------------------------------------------->   

     <!-- Modal Logout -->
     <div id="logout-modal" class="modalLogout">
      <div class="modal-contentLogout">
        <span class="closeLogout" id="close-buttonLogout" onclick="closeModal()">&times;</span>
        <h2>Konfirmasi Logout</h2>
        <p>Apakah anda mau logout?</p>
        <div style="text-align: center;">
          <button style="width: 120px;" class="btn btn-primary" id="confirm-logout-button" onclick="confirmLogout(true)">Ya</button>
          <button style="width: 120px;" class="btn btn-danger" id="cancel-logout-button" onclick="confirmLogout(false)">Tidak</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!--------------------------------------------------------------------------- JavaScript Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- JavaScript Area --------------------------------------------------------------------------------------------------------------->
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


 <!-- Modal Logout -->
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
@extends('Main.layout.homeStyle')

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/lg1.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/lg1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title> 
        @if($kategoriLandingPageV->isNotEmpty())
            Kategori {{ $kategoriLandingPageV->first()->kategoriVideo }} - Katakey
        @else
           Tidak Ada Artikel Ditemukan Pada Ketegori Ini - Katakey
        @endif
    </title>
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
    </style>
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

</head>
<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12" style="display: flex; justify-content: space-between; align-items: center;">
                <nav class="main-nav" style="flex-grow: 1; display: flex; align-items: center;">
                    <ul class="nav" style="display: flex; justify-content: center; align-items: center; list-style: none; padding: 0; margin: 0; width: 100%;">
                      <li style="margin-right: auto;">
                        <img src="{{ asset('assets2/img/katakey1.png') }}" alt="logo" style="width: 50px; height: auto;">
                      </li>
                      <li class="scroll-to-section"><a href="/" >Home</a></li>
                      <li class="scroll-to-section"><a href="/">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo" class="text-center">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage" class="active">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage">Ulasan</a></li>
                      <li class="scroll-to-section"><a href="/abouts">Tentang</a></li>
                      <li class="scroll-to-section"><a href="/login">Login</a></li>
                    </ul>
                    <a class='menu-trigger' style="display: none;">
                        <span>Menu</span>
                    </a>
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
                    @if($kategoriLandingPageV->isNotEmpty())
                        <h2>Kategori {{ $kategoriLandingPageV->first()->kategoriVideo }}</h2>
                        <div class="div-dec"></div>
                    @else
                        <h2>Tidak Ada Artikel Ditemukan Pada Ketegori Ini</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


  <!-- ***** Main Banner Area End ***** -->

  <div class="pd-top-80 pd-bottom-50" id="grid">
    <div class="container">

      <section class="about-us" id="about">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
            </div>
            <div>
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
              
              @foreach ($kategoriLandingPageV as $item)
              <div class="row" style="text-align: justify">
                <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                    <?php
                    $videoId = getYoutubeVideoId($item->linkVideo);
                    $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg"; // Mengambil thumbnail maksimum resolusi
                    ?>
        
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
                    <p>{!! substr(strip_tags($item->deskripsiVideo), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>

                      
                  <p>Tags:
                    @php
                    $tags = explode(",", $item->tagsVideo);
                    foreach ($tags as $tag) {
                        $trimmedTag = trim($tag);
                        // Menggunakan route 'TagsVideo' untuk membuat tautan ke halaman yang sesuai dengan tag
                        echo '<a href="' . route("TagsVideosLP", $trimmedTag) . '" class="fh5co_tagg">' . $trimmedTag . '</a>';
                        echo ' ';
                    }
                    @endphp
                </p>
                </div>
            </div>
            <hr>
              @endforeach
              
              </div>
          </div>
        </div>
      </section>
    </div>
</div>

  </body>
</html>
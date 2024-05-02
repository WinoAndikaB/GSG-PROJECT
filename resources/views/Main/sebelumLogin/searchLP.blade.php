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

    </style>  <style>
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
            <div class="col-12">
                <nav class="main-nav">
                    <a href="/" class="logo">
                        <img src="" alt="">
                    </a>
                    <span>Katakey</span>
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="/">Home</a></li>
                      <li class="scroll-to-section"><a href="/" class="active">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage">Ulasan</a></li>
                      <li class="scroll-to-section"><a href="/abouts">Tentang</a></li>
                      <li>
                        <form action="{{ route('search') }}" method="GET" class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Cari Artikel..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('search') }}">
                          <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                      </form>
                      </li>
                      <li class="scroll-to-section"><a href="/login">Login</a></li>
                    </ul>       
                    <a class='menu-trigger'>
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
            <h2>Pencarian Artikel</h2>
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
              <form action="{{ route('searchLP') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
              </form>            
          </div>          
          </div>

          <br>
          <br>

            <h5>Hasil pencarian <b>"{{ request('search') }}"</b>, {{ $artikels->count() }} hasil ditemukan</h5>

            <br>
            <br>

            @foreach ($artikels as $item)
            <div class="row" style="text-align: justify">
              <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200" style="margin-bottom: 20px;">
                  <div class="d-flex justify-content-center">

                      @if($item->gambarArtikel)
                          @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                              <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                  <img src="{{$item->gambarArtikel}}" style="max-width: 100%; height: auto; border-radius: 14px;">
                              </a>
                          @else
                              <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                  <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}"  style="max-width: 100%; height: auto; border-radius: 14px;">
                              </a>
                          @endif
                      @endif

                  </div>
              </div>
              <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                  <a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}" style="text-decoration: none;">
                      <h4 class="article-title" onclick="selectText(this)" style="text-align: left;">{{ $item->judulArtikel }}</h4>
                  </a>
                  <span class="d-flex">
                      <b>{{ $item->penulis }} • 
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
                          <br>
                      </b>
                  </span>
                  <p>{!! substr(strip_tags($item->deskripsi), 0, 400) . (strlen(strip_tags($item->deskripsi)) > 400 ? '...' : '') !!}</p> 
              </div>
          </div>
          <hr style="margin-top: 20px; margin-bottom: 20px;">
                @endforeach
            </div>
        </div>
      </div>
    </section>
  
      
  </div>
</div>

  </body>
</html>
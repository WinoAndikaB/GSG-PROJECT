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

    <title>Kategori Game - GSG Project</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
<!--

TemplateMo 574 Mexant

https://templatemo.com/tm-574-mexant

-->

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
                    GSG<span>PROJECT</span>
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="/" >Home</a></li>
                      <li class="scroll-to-section"><a href="/">Trending</a></li>
                      <li class="scroll-to-section"><a href="/">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage" class="active">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage">Ulasan</a></li>
                      <li class="scroll-to-section"><a href="/abouts">Tentang</a></li>
                      <li class="scroll-to-section"><a href="/login">Login</a></li>
                    </ul>       
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
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
            <h2>Kategori Game</h2>
            <div class="div-dec"></div>
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
              <div class="section-heading">
                <h6>Game</h6>
                <h4>List Kategori Game</h4>
              </div>
            </div>
            <div>
              @foreach ($kategoriGame as $item)
                  <div class="row" style="text-align: justify">
                      <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                          <div class="d-flex justify-content-center">
                              <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" style="max-width: 100%; height: auto; border-radius: 14px">
                          </div>
                      </div>
                      <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                          <h4 style="text-align: left" >{{ $item->judulArtikel }} </h4>
                          <span class="d-flex"><b>{{ $item->penulis }}</b></span>
                          <p>{!! substr(strip_tags($item->deskripsi), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
                      </div>
                      <span style="text-align: right; color: rgba(165, 165, 165, 1);"><p>
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
                          <a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a></p></span>
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
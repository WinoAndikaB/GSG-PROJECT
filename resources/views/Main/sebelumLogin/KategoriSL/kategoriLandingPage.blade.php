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

    <title>Kategori - Katakey</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
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
                    <span>Katakey</span>
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="/" >Home</a></li>
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
          @foreach ($kategoriA as $item)  
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="trending-post">
                <div class="single-post-wrap style-overlay">
                  <div class="thumb">

                    @if($item->fotoKategori)
                        @if(filter_var($item->fotoKategori, FILTER_VALIDATE_URL))
                            <a href="{{$item->fotoKategori}}" data-lightbox="fotoKategori" data-title="Deskripsi Gambar">
                                <img src="{{$item->fotoKategori}}"  alt="img" width="100%" height="200">
                            </a>
                        @else
                            <a href="{{asset('fotoKategori/'.$item->fotoKategori)}}" data-lightbox="fotoKategori" data-title="Deskripsi Gambar">
                                <img src="{{asset('fotoKategori/'.$item->fotoKategori)}}" alt="img" width="100%" height="200">
                            </a>
                        @endif
                    @endif
                    
                  </div>
                  
                  <div class="details">
                    <h6 class="title">  
                      <a href="{{ route('kategoriLandingPageA', ['kategori' => $item->kategori]) }}">{{ $item->kategori }}</a>                    
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      
    </div>
</div>


  
  </body>
</html>
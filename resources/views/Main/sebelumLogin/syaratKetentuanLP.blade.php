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

    <title>Syarat & Ketentuan - GSG Project</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">


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
                      <li class="scroll-to-section"><a href="/kategoriLandingPage">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/eventLandingPage">Event</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage">Ulasan</a></li>
                      <li class="scroll-to-section"><a href="/abouts" class="">Tentang</a></li>
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
            <h2>Syarat & Ketentuan</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br>
  <br>

  <div class="container">
        <div class="col-lg-20">
          @foreach ($syarat as $item)
          <div style="font-size: 18px; text-align: justify; margin-top: 20px;">
            <div style="font-size: 18px; line-height: 2;">
              {!! str_replace('<img', '<img style="max-width: 1152px; width: 100%; height: auto; display: block; margin: 0 auto;"', $item->deskripsisyarat) !!}
            </div>
          </div>
          @endforeach

      </div>
    </div>
  </body>
</html>
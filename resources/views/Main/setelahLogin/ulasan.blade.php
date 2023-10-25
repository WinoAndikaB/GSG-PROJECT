@extends('Main.layout.homeStyle')

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Ulasan - GSG Project</title>

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



  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <nav class="main-nav d-flex align-items-center justify-content-between">
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="/home" class="text-center">Home</a></li>
                        <li class="scroll-to-section"><a href="/home" class="text-center">Trending</a></li>
                        <li class="scroll-to-section"><a href="/home" class="text-center">Artikel</a></li>
                        <li class="scroll-to-section"><a href="/about" class="text-center">Tentang</a></li>
                    </ul>
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="/profileUser" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center">
                                <div class="profile-picture">
                                    <img src="{{ asset('fotoProfil/' . Auth::user()->fotoProfil) }}" alt="Gambar Profil" />
                                </div>
                                <span class="d-sm-inline d-none">{{Auth::user()->name}}</span>
                            </a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="/logout" class="text-right">Logout</a>
                        </li>
                    </ul>
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
            <h2>Ulasan</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Main Banner Area End ***** -->

  <section class="contact-us-form">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Berikan Ulasan Anda Tentang Website Ini</h6>
            <h4>Ulasan</h4>
          </div>
        </div>
        <div class="col-lg-10 offset-lg-1">
          <form id="contact" action="storeUlasan" method="post">
            @csrf

            <hr>

            <p> Salin <b>Bintang</b> Untuk Memberikan <b> Rating </b> : ★★★★★</p>
            <br>

            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                </label>Rating</label>
                  <input type="text" name="rating" id="rating" required>
                </fieldset>
              </div>
              <br>
              <div class="col-lg-6">
                <fieldset>
                </label>Nama</label>
                  <input type="name" name="nama" id="nama" placeholder="Name..." autocomplete="on" value="{{Auth::user()->name}}" readonly required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                </label>Email</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-mail..."  value="{{Auth::user()->email}}" readonly required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="pesan" id="pesan" placeholder="Pesan..."></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <br>
  <hr>
  <section class="testimonials" id="testimonials">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Ulasan</h6>
            <h4>Daftar Ulasan</h4>
          </div>
        </div>
        
        @foreach ($data1 as $item)
        <div class="col-lg-10 offset-lg-1">
          <div class="owl-testimonials owl-carousel" style="position: relative; z-index: 5;">
            <div class="item">
              <i class="fa fa-quote-left"></i>
              <p class="font-size: 100px;">“{{ $item->rating }}”</p>
              <p>“{{ $item->pesan }}”</p>
              <h4>{{ $item->nama }}</h4>
              <span>{{ \Carbon\Carbon::parse($item['created_at'])->format('l, d M Y H.i') }}</span>
              <div class="right-image">
                <img src="gambarArtikel/per1.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="simple-cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <h4>Upload <em>Articles</em> and <strong>Valid</strong> Information</h4>
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

  </body>
</html>
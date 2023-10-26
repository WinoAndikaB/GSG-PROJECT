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

    <title>About - GSG Project</title>

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


  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <nav class="main-nav d-flex align-items-center justify-content-between">
                  <ul class="nav">
                    <li class="scroll-to-section"><a href="/home" class="text-center">Home</a></li>
                    <li class="scroll-to-section"><a href="/home" class="text-center">Trending</a></li>
                    <li class="scroll-to-section"><a href="/home" class="text-center">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/ulasan" class="text-center">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/about" class="text-center">Tentang</a></li>
                </ul>
                    <ul class="nav">
                      <li class="nav-item">
                          <a href="/profileUser" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center">
                              <div class="profile-picture" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                                  <img src="{{ asset('fotoProfil/' . Auth::user()->fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                              </div>
                              <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                          </a>
                      </li>
                      <li class="nav-item">
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
                  <span>Tujuan</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Tujuan terbentuknya website ini adalah memberikan artikel yang dapat dibaca oleh banyak orang.</p>
                  </div>
              </div>
          </article>
          <article class="accordion">
            <div class="accordion-head">
                <span>Kenapa Namanya GSG Project?</span>
                <span class="icon">
                    <i class="icon fa fa-chevron-right"></i>
                </span>
            </div>
            <div class="accordion-body">
                <div class="content">
                    <p>Emang cuma kepikiran aja nama itu, gaada alasan tersendiri.</p>
                </div>
            </div>
          </article>
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
                <a href="#">gsgproject@gmail.com</a>
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

  <section class="what-we-do">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="left-content">
            <h4>Please tell us about your idea and how you want it to be</h4>
            <p>If you need more HTML templates, you can try visiting TooCSS blog and Tooplate websites. You can get many good templates on those websites.<br><br>Nulla non placerat neque, a gravida elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Morbi sed dolor condimentum tellus commodo volutpat non malesuada turpis.</p>
            <div class="green-button">
              <a href="contact-us.html">Discover More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-items">
            <div class="row">
              <div class="col-lg-6">
                <div class="item">
                  <em>01</em>
                  <h4>First Step</h4>
                  <p>Pellentesque ipsum elit, congue a sapien laoreet, pellentesque ultricies risus.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item">
                  <em>02</em>
                  <h4>Second Step</h4>
                  <p>Pellentesque ipsum elit, congue a sapien laoreet, pellentesque ultricies risus.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item">
                  <em>03</em>
                  <h4>Third Step</h4>
                  <p>Pellentesque ipsum elit, congue a sapien laoreet, pellentesque ultricies risus.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item">
                  <em>04</em>
                  <h4>Fourth Step</h4>
                  <p>Pellentesque ipsum elit, congue a sapien laoreet, pellentesque ultricies risus.</p>
                </div>
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
            <h6>Web Dev</h6>
            <h4>What They Say</h4>
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
  
  </body>
</html>
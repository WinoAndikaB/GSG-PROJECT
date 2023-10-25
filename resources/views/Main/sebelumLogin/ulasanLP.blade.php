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
    <style>
      .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    }

    .card {
      flex: 0 0 100%; /* Set card width to 100% to stack vertically */
      margin: 10px 0;
      padding: 20px;
      border: 1px solid #e6e6e6;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      position: relative; /* Added this line to make inner elements absolute positioned */
    }

      .profile-pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        margin: 0 auto 10px;
      }

      .star-rating i {
        color: #FFD700;
      }

      .review-actions {
      display: flex;
      justify-content: flex-end; /* Align right */
      align-items: center;
    }

    .actions i {
      margin: 0 5px;
      cursor: pointer;
    }

      .card-header {
        background-color: #f8f9fa; /* Header background color */
        border-bottom: 1px solid #e6e6e6;
        padding: 10px 20px;
      }

      .fade-in {
        animation: fadeIn 1s ease-in-out;
      }

      @keyframes fadeIn {
        0% {
          opacity: 0;
          transform: translateY(20px);
        }
        100% {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>

<body>



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
                      <li class="scroll-to-section"><a href="/home" >Home</a></li>
                      <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/home">Orang</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage" class="text-center">Ulasan</a></li>
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
                                   <div class="profile-picture-container">
                                       <a href="/profileUser" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center">
                                           <div class="profile-picture" style="width: 50px; height: 50px; overflow: hidden; margin-right: 10px;">
                                               <img src="{{ asset('fotoProfil/' . $item->fotoProfil) }}" alt="User's Profile Picture" style="width: 25%; height: 70%; object-fit: cover; border-radius: 50%;">
                                           </div>
                                       </a>
                                   </div>
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


  <div class="text-center">
    <div class="buttons" style="display: flex; justify-content: center; gap: 10px;">
        <div class="green-button">
            <a href="/">Kembali</a>
        </div>
        <div class="orange-button">
            <a href="/ulasanLandingPage">Ulasan</a>
        </div>
    </div>
</div>

<script>
  // Optional: Menambahkan animasi scroll horizontal
  const container = document.querySelector('.container');
  container.addEventListener('wheel', (e) => {
      if (e.deltaY !== 0) {
          e.preventDefault();
          container.scrollLeft += e.deltaY;
      }
  });
</script>
  </body>
</html>
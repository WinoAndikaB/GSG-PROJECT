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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <style>
      /* CSS for the curved card */
      .curved-card {
          background: #fff; /* Background color for the card */
          border-radius: 20px; /* Adjust the border radius as needed for the desired curve */
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a box shadow for depth */
          padding: 20px; /* Add padding inside the card */
          margin: 10px; /* Add margin to create spacing between cards */
          border: 2px solid #000; /* Add a border with the desired color and width */
      }

      .interaction-icons i {
          font-size: 20px;
          margin: 5px;
          cursor: pointer;
          transition: color 0.3s, transform 0.3s;
        }

        .interaction-icons i:hover {
          color: #007bff; /* Warna ikon berubah saat dihover */
          transform: scale(1.2); /* Ikona diperbesar saat dihover */
        }
        .interaction-icons {
          text-align: right;
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
          </div>
        </div>
    </section>


    <div class="container">
      @foreach ($data1 as $item)
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="item curved-card">
              <div class="row">
                <div class="col-lg-9 col-md-6">
                  <div class="profile-picture">
                    <img src="{{ asset('fotoProfil/' . $item->fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                  </div>
                </div>
                <div class="col-lg-9 col-md-6 offset-lg-1">
                  <span>{{ $item->nama }}</span><br>
                  <span>
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
                      } else {
                        echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                      }
                    @endphp
                  </span><br>
                  <span>{{ $item->rating }}</span>
                  <p>“{{ $item->pesan }}”</p>
    
                  <div class="interaction-icons text-right">
                    <a href="/like" class="like-icon">
                      <i class="fas fa-thumbs-up"></i>
                    </a>
                  
                    <a href="/dislike" class="dislike-icon">
                      <i class="fas fa-thumbs-down"></i>
                    </a>
                  
                    <a href="/reply" class="reply-icon">
                      <i class="fas fa-reply"></i>
                    </a>
                  </div>
                                                    
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    
    
    
    
  
          

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
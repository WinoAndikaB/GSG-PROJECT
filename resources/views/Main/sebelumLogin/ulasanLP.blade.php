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

        .rating {
          font-size: 24px;
        }

        .star {
          color: gray; /* Mengatur warna bintang awalnya menjadi gray */
          cursor: pointer;
        }

        .star.selected {
          color: gold; /* Mengatur warna bintang yang dipilih menjadi gold */
        }

        .rating-container {
            font-size: 36px; /* Atur ukuran teks rata-rata rating */
            margin: 20px; /* Atur margin untuk jarak dari teks sekitarnya */
          }

          .filled-star {
            color: gold; /* Warna bintang yang diisi */
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
                      <li class="scroll-to-section"><a href="/" >Home</a></li>
                      <li class="scroll-to-section"><a href="/">Trending</a></li>
                      <li class="scroll-to-section"><a href="/">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo" class="text-center">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage" class="active">Ulasan</a></li>
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

    <div class="text-center">
      <div class="rating-container">
        <p class="average-rating" style="font-size: 150px;">{{ number_format($averageRating, 1) }}</p>
        <br>
          <div class="stars">
              @php
                  $averageRating = round($averageRating); // Pembulatan rating
              @endphp
              @for ($i = 1; $i <= 5; $i++)
                  @if ($i <= $averageRating)
                      <i class="fas fa-star filled-star"></i>
                  @else
                      <i class="fas fa-star"></i>
                  @endif
              @endfor
          </div>
          <p>{{$totalUlasan}} Ulasan</p>
      </div>
    </div>

  <br>
  <br>
  <br>

  <div class="container text-center">
    <div class="filter-options d-inline-block">
        <select name="filter" id="filter" onchange="filterComments(this.value)" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
            <option value="" selected>Urutkan</option>
            <option value="newest">Terbaru</option>
            <option value="oldest">Terlama</option>
            <option value="mine">Komen Saya</option>
        </select>
    </div>
</div>

    <div class="container">
      @foreach ($data1 as $item)
        <div class="row curved-card">
          <div class="col-lg-5">
            <!-- Kolom 1: Gambar Profil -->
            <div class="profile-picture">
              <img src="{{ asset('fotoProfil/' . $item->fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
            </div>
          </div>
          <div class="col-lg-9 col-md-6">
            <span>{{ $item->nama }}</span>
            <br>
            <span class="rating">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $item->rating)
                  <span class="star selected">&#9733;</span>
                @else
                  <span class="star">&#9733;</span>
                @endif
              @endfor
            </span>
            <span>
              @php
                $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
                $sekarang = \Carbon\Carbon::now();
                $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
                
                if ($selisihWaktu < 60) {
                  echo $selisihWaktu . ' Menit yang lalu';
                } elseif ($selisihWaktu < 1440) {
                  echo floor($selisihWaktu / 60) . ' Jam yang lalu';
                } elseif ($selisihWaktu < 10080) {
                  echo floor($selisihWaktu / 1440) . ' Hari yang lalu';
                } elseif ($selisihWaktu < 43200) {
                  echo floor($selisihWaktu / 10080) . ' Minggu yang lalu';
                } else {
                  $yearsAgo = floor($selisihWaktu / 525600); // 525600 menit dalam setahun
                  echo $yearsAgo . ' Tahun yang lalu';
                }
              @endphp
            </span>
            
            <!-- ID "pesan-{{ $item->id }}" digunakan untuk menggantikan pesan di tempat -->
            <p id="pesan-{{ $item->id }}">“{{ $item->pesan }}”</p>
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- Kolom 3: Ikon Edit dan Ikon Lainnya -->
            <div class="d-flex flex-column">
              <div class="interaction-icons text-center">
                      <a href="/login" class="icon-button"><i class="fas fa-thumbs-up"></i></a>
                      <a href="/login"><i class="fas fa-thumbs-down"></i></a>
                      <a href="/login"><i class="fas fa-reply"></i></a>
                      <a href="/login"><i class="fas fa-trash"></i></a>
              </div>
          </div>
          
          </div>
          <div class="col-lg-4 col-md-10">
            <!-- Kolom 4: Textarea untuk Edit Pesan -->
            <span class="likes-count">{{ $item->likes->count() }} Likes</span>
            <span class="dislikes-count">{{ $item->dislikes->count() }} Dislikes</span>

            <div id="edit-pesan-{{ $item->id }}" style="display: none; width: 150%; text-align: right;">
                <textarea id="edit-pesan-text-{{ $item->id }}" style="width: 155%;">{{ $item->pesan }}</textarea>
                <button id="simpan-edit-{{ $item->id }}" style="background: none; border: none; cursor: pointer;">
                    <i class="fas fa-save"></i>
                </button>
                <button id="tutup-edit-{{ $item->id }}" style="background: none; border: none; cursor: pointer;">
                    <i class="fas fa-times"></i> <!-- Ikon close (X) -->
                </button>
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

  <!-- Filter Komen Ulansan -->
  <script>
    function filterComments(filter) {
        window.location.href = '{{ route('ulasan') }}?filter=' + filter;
    }
    </script>

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
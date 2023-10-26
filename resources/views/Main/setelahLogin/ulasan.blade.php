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
        
            <div class="row">             
              <div class="user-profile-info">
                <a href="/profileUser" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center">
                    <div class="profile-picture" style="width: 220px; height: 200px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                        <img src="{{ asset('fotoProfil/' . Auth::user()->fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                </a>
            </div>

            <div class="col-lg-6 align-left">
              <fieldset>
                <p> Pilih <b>Bintang</b> Untuk Memberikan <b> Rating </b> :</p>
                <label for="rating">Rating</label>
                <div class="rating">
                  <span class="star" data-rating="1">&#9733;</span>
                  <span class="star" data-rating="2">&#9733;</span>
                  <span class="star" data-rating="3">&#9733;</span>
                  <span class="star" data-rating="4">&#9733;</span>
                  <span class="star" data-rating="5">&#9733;</span>
                </div>
                <input type="hidden" name="rating" id="rating" value="0" required>
              </fieldset>
            </div> 
            <div class="col-lg-6 align-left">
              <fieldset>
                <label for="nama">Username</label>
                <input type="name" name="nama" id="nama" placeholder="Name..." autocomplete="on" value="{{Auth::user()->username}}" readonly required>
              </fieldset>
            </div>
              <div class="col-lg-6 align-left">
                <fieldset>
                  <label for="nama">Nama</label>
                  <input type="name" name="nama" id="nama" placeholder="Name..." autocomplete="on" value="{{Auth::user()->name}}" readonly required>
                </fieldset>
              </div>
        
              <div class="col-lg-6 align-right">
                <fieldset>
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-mail..." value="{{Auth::user()->email}}" readonly required>
                </fieldset>
              </div>
        
              <div class="col-lg-12 align-left">
                <fieldset>
                  <label for="pesan">Pesan</label>
                  <textarea name="pesan" id="pesan" placeholder="Pesan..." required></textarea>
                </fieldset>
              </div>
        
              <div class="col-lg-12 align-left">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Kirim Ulasan</button>
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
                <br>
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
              <a href="#" id="edit-{{ $item->id }}"><i class="fas fa-edit"></i></a>
              <div class="interaction-icons text-center">
                <a href="/ulasan"><i class="fas fa-thumbs-up"></i></a>
                <a href="/ulasan"><i class="fas fa-thumbs-down"></i></a>
                <a href="/ulasan"><i class="fas fa-reply"></i></a>
                <a href="{{ route('deleteUlasan', ['id' => $item->id]) }}"><i class="fas fa-trash"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-10">
            <!-- Kolom 4: Textarea untuk Edit Pesan -->
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
    
    
  </div>
    
  <!-- Edit Ulansan -->
  <script>
    @foreach ($data1 as $item)
      document.getElementById('edit-{{ $item->id }}').addEventListener('click', function (e) {
        e.preventDefault();
        // Tampilkan textarea untuk mengedit pesan
        document.getElementById('edit-pesan-{{ $item->id }}').style.display = 'block';
      });
    
      document.getElementById('simpan-edit-{{ $item->id }}').addEventListener('click', function (e) {
        e.preventDefault();
        const editedText = document.getElementById('edit-pesan-text-{{ $item->id }}').value;
        
        // Kirim data yang telah diedit ke server menggunakan AJAX
        fetch("{{ route('simpanEditUlasan', ['id' => $item->id]) }}", {
          method: "POST",
          body: JSON.stringify({ pesan: editedText }),
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
          }
        })
        .then(response => response.json())
        .then(data => {
          // Gantilah pesan lama dengan pesan yang telah diperbarui
          const pesanElement = document.getElementById('pesan-{{ $item->id }}');
          pesanElement.innerText = '“' + editedText + '”';
  
          // Sembunyikan textarea dan tombol Simpan setelah berhasil
          document.getElementById('edit-pesan-{{ $item->id }}').style.display = 'none';
        })
        .catch(error => {
          // Tangani kesalahan jika ada
          console.error(error);
        });
      });

      // Event listener untuk tombol tutup
      document.getElementById('tutup-edit-{{ $item->id }}').addEventListener('click', function (e) {
        e.preventDefault();
        // Sembunyikan textarea dan tombol Simpan
        document.getElementById('edit-pesan-{{ $item->id }}').style.display = 'none';
      });
    @endforeach
</script>

<!-- Rating -->
<script>
  const stars = document.querySelectorAll('.star');
  const ratingInput = document.getElementById('rating');

  stars.forEach((star) => {
    star.addEventListener('click', () => {
      const ratingValue = parseInt(star.getAttribute('data-rating'));
      ratingInput.value = ratingValue;
      stars.forEach((s) => s.classList.remove('selected')); // Hapus kelas 'selected' dari semua bintang
      for (let i = 0; i < ratingValue; i++) {
        stars[i].classList.add('selected'); // Tambahkan kelas 'selected' pada bintang yang dipilih
      }
    });
  });
</script>
    
</body>
</html>
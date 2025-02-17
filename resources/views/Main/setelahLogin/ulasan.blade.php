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

    <title>Ulasan - Katakey</title>

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

          .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: hidden; /* Tidak dapat di-scroll */
          }
      
          .modal-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border: 1px solid #888;
            width: 20%;
            height: 30%; /* Mengatur tinggi modal menjadi 60% */
            text-align: center;
          }
      
          .close {
            color: #888;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
          }
      
          #confirm-button, #cancel-button {
            padding: 10px 20px;
            margin: 25px;
            cursor: pointer;
          }

          
                /* DROP DOWN AREA */
  .dropdown:hover .dropdown-menu,
  .dropdown:focus-within .dropdown-menu {
      display: block;
  }

  .dropdown-menu {
      display: none;
}

.dropdown-menu {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease; /* menambahkan transisi */
}

.dropdown-menu.show {
    display: block;
    opacity: 1;
}

  </style>

<style>
  /* Notificaton */
  .scrollable-menu {
  max-height: 600px; /* Set the max height you want */
  overflow-y: auto; /* Enable vertical scrolling */
}
</style>

</head>
<body>

  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
              <nav class="main-nav">
                <ul class="nav">
                  <li style="margin-right: auto;">
                    <img src="{{ asset('assets2/img/katakey1.png') }}" alt="logo" style="width: 50px; height: auto;">
                  </li>
                    <li class="scroll-to-section"><a href="/home">Home</a></li>
                    <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/Video">Video</a></li>
                    <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                    <li class="scroll-to-section"><a href="/ulasan" class="active">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/about">Tentang</a></li>
                    <li>
                      <div class="dropdown">
                        <a href="#" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center dropdown-toggle" role="button" id="savedArticlesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div class="profile-picture" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                              <?php
                              $fotoProfil = Auth::user()->fotoProfil;
                              if ($fotoProfil) {
                                  if (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                                      // Jika fotoProfil adalah URL, gunakan langsung URL tersebut
                                      echo '<img src="' . $fotoProfil . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                                  } else {
                                      // Jika fotoProfil adalah nama file, cek apakah file tersebut ada
                                      $pathToFile = public_path('fotoProfil/' . $fotoProfil);
                                      if (file_exists($pathToFile)) {
                                          echo '<img src="' . asset('fotoProfil/' . $fotoProfil) . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                                      } else {
                                          // Jika file tidak ada, tampilkan foto default
                                          echo '<img src="' . asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                                      }
                                  }
                              } else {
                                  // Jika fotoProfil kosong, tampilkan foto default
                                  echo '<img src="' . asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                              }
                          ?>
                            </div>
                    
                            <span class="d-sm-inline d-none">
                                <?php
                                $fullName = Auth::user()->name;
                                $words = explode(' ', $fullName);
                    
                                // Ambil dua kata pertama dan dua kata terakhir dari nama pengguna
                                $firstTwoWords = implode(' ', array_slice($words, 0, 1));
                                $lastTwoWords = implode(' ', array_slice($words, -1, 2));
                    
                                echo $firstTwoWords . ' ' . $lastTwoWords;
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="savedArticlesDropdown">
                            <a class="dropdown-item" href="/profileUser"><i class="fas fa-user"></i> Profil Anda</a>
                            <a class="dropdown-item" href="/simpanArtikelView"><i class="fas fa-bookmark"></i> Artikel Tersimpan</a>
                            <a class="dropdown-item" href="/simpanVideoView"><i class="fas fa-video"></i> Video Tersimpan</a>
                        </div>
                    </div>
                  </li>
                  <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell" style="color: white;"></i> <span class="badge badge-pill badge-primary">{{ $jumlahData }}</span>
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-wide scrollable-menu" aria-labelledby="dropdownMenuButton" style="min-width: 550px;">
                      <h6 class="container-title" style="margin: 10px 0; text-align: center;"><i class="fas fa-bell"></i> Notifikasi</h6>
                      <hr>
                      
                      <div class="row" style="display: flex; flex-direction: column; align-items: stretch;">
                          @if($isFollowingAuthor && $jumlahData > 0)
                              @foreach($notifArtikel as $item)
                                  <div class="col-md-12 mb-3" style="display: flex;">
                                      <a class="dropdown-item d-flex" href="{{ route('detail.artikel', ['id' => $item->id]) }}" style="display: flex;">
                                          <img src="{{ !empty($item->gambarArtikel) && filter_var($item->gambarArtikel, FILTER_VALIDATE_URL) ? $item->gambarArtikel : asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left" style="max-width: 120px; height: 80px;">
                                          <div class="media-body ml-3" style="align-self: center;">
                                              <h6 class="notification-title mb-1" title="{{ $item->judulArtikel }}"> {{ $item->penulis }} mengupload: <br>
                                                  <?php
                                                  $judul = $item->judulArtikel;
                                                  $length = 35; // Panjang maksimum sebelum perlu di-break
                                              
                                                  // Jika judul lebih panjang dari panjang maksimum
                                                  if (strlen($judul) > $length) {
                                                      $chunks = explode(" ", $judul);
                                                      $output = '';
                                                      $lineLength = 0;
                                              
                                                      foreach ($chunks as $chunk) {
                                                          // Jika panjang baris lebih besar dari panjang maksimum, tambahkan line break
                                                          if ($lineLength + strlen($chunk) > $length) {
                                                              $output .= "<br>";
                                                              $lineLength = 0;
                                                          }
                                                          $output .= $chunk . " ";
                                                          $lineLength += strlen($chunk) + 1; // Ditambah satu untuk spasi
                                                      }
                                              
                                                      echo rtrim($output); // Menghilangkan spasi ekstra di akhir
                                                  } else {
                                                      echo $judul;
                                                  }
                                                  ?>
                                              </h6>
                                              
                                              <p class="notification-time mb-0">{{ $item->created_at->format('d F Y') }} | {{ $item->created_at->diffForHumans() }}</p>
                                          </div>
                                      </a>
                                  </div>
                              @endforeach
                          @else
                              <div class="col-md-12" style="align-self: center;">
                                  <p class="dropdown-item">Tidak ada notifikasi saat ini.</p>
                              </div>
                          @endif
                      </div>
                  </div> 
                </div>
                          
                    <li class="scroll-to-section">
                      <a href="#" class="d-sm-inline d-none text-white text-bold" id="logout-link" onclick="openModal()"> Logout</a>
                    </li>
            </nav>
            </div>
        </div>
    </div>
</header>
      <!-- Modal Logout -->
      <div id="logout-modal" class="modal">
        <div class="modal-content">
          <span class="close" id="close-button" onclick="closeModal()">&times;</span>
          <h2>Konfirmasi Logout</h2>
          <p>Apakah anda mau logout?</p>
          <div style="text-align: center;">
            <button style="width: 120px;" class="btn btn-primary" id="confirm-logout-button" onclick="confirmLogout(true)">Ya</button>
            <button style="width: 120px;" class="btn btn-danger" id="cancel-logout-button" onclick="confirmLogout(false)">Tidak</button>
          </div>
        </div>
      </div>

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
                    <?php
                    $fotoProfil = Auth::user()->fotoProfil;
                    if ($fotoProfil) {
                        if (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                            // Jika fotoProfil adalah URL, gunakan langsung URL tersebut
                            echo '<img src="' . $fotoProfil . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                        } else {
                            // Jika fotoProfil adalah nama file, cek apakah file tersebut ada
                            $pathToFile = public_path('fotoProfil/' . $fotoProfil);
                            if (file_exists($pathToFile)) {
                                echo '<img src="' . asset('fotoProfil/' . $fotoProfil) . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                            } else {
                                // Jika file tidak ada, tampilkan foto default
                                echo '<img src="' . asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                            }
                        }
                    } else {
                        // Jika fotoProfil kosong, tampilkan foto default
                        echo '<img src="' . asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') . '" alt="User\'s Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">';
                    }
                ?>
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

<br>

    <div class="container">
      @foreach ($data1 as $item)
        <div class="row curved-card">
          <div class="col-lg-5">
            <!-- Kolom 1: Gambar Profil -->
            <div class="profile-picture">

                @if(!empty($item->fotoProfil))
                    @if(filter_var($item->fotoProfil, FILTER_VALIDATE_URL))
                        <img src="{{ $item->fotoProfil }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        <img src="{{ asset('fotoProfil/' . $item->fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @endif
                @endif


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
                  {{$item->created_at->diffForHumans()}}

                  @if($item->updated_at)
                  <span style="color: gray;">(Edited)</span>
              @endif
            </span>
            
            <!-- ID "pesan-{{ $item->id }}" digunakan untuk menggantikan pesan di tempat -->
            <p id="pesan-{{ $item->id }}">{{ $item->pesan }}</p>

            <div style="text-align: right;">
              @if(Auth::check() && Auth::user()->id == $item->user_id)    
                  <a href="#" class="edit-button" data-id="{{ $item->id }}" data-user-id="{{ $item->user_id }}" style="margin-left: 10px; color: #f44336; text-decoration: none; transition: color 0.3s;">
                      <i class="fas fa-edit" style="font-size: 20px;"></i> Edit
                  </a>
              @endif 
            </div>
          
          </div>
        

          <br>
        
        <div id="edit-pesan-{{ $item->id }}" style="display: none; width: 100%; text-align: right;">
            <textarea id="edit-pesan-text-{{ $item->id }}" style="width: 100%;">{{ $item->pesan }}</textarea>
            <button class="simpan-edit-button" data-id="{{ $item->id }}" data-user-id="{{ $item->user_id }}" style="background: none; border: none; cursor: pointer;">
                <i class="fas fa-save"></i> Simpan
            </button>                               
            
            <button class="tutup-edit-button" data-id="{{ $item->id }}" style="background: none; border: none; cursor: pointer;">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>

        <div class="" style="max-width: 730px; margin-bottom: 10px;">
        <div style="flex: 1;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 10px;">
              <div style="display: flex; align-items: center;">

                <button id="likeButton{{ $item->id }}" class="likeButton" data-id="{{ $item->id }}" style="text-decoration: none; color: #333; display: inline-block; padding: 8px 15px; border: 2px solid #4CAF50; border-radius: 20px; background-color: #fff; transition: all 0.3s ease; margin-right: 10px;">
                  @if (Auth::check() && $item->userHasLiked(Auth::user()))
                      <i class="fa fa-thumbs-up" style="color: #4CAF50; margin-right: 5px;"></i>
                  @else
                      <i class="fa-regular fa-thumbs-up" style="color: #4CAF50; margin-right: 5px;"></i>
                  @endif
                  <span id="likeCount" style="font-size: medium; margin-left: 5px;">{{ $item->likes->count() }} likes</span>
              </button>
              
              <button id="dislikeButton{{ $item->id }}" class="dislikeButton" data-id="{{ $item->id }}" style="text-decoration: none; color: #333; display: inline-block; padding: 8px 15px; border: 2px solid #FF0000; border-radius: 20px; background-color: #fff; transition: all 0.3s ease; margin-right: 10px;">
                  @if (Auth::check() && $item->userHasDisliked(Auth::user()))
                      <i class="fa fa-thumbs-down" style="color: #FF0000; margin-right: 5px;"></i>
                  @else
                      <i class="fa-regular fa-thumbs-down" style="color: #FF0000; margin-right: 5px;"></i>
                  @endif
                  <span id="dislikeCount" style="font-size: medium; margin-left: 5px;">{{ $item->dislikes->count() }} Dislike</span>
              </button>
              
              
              
              
              

                  @if (auth()->check() && $item->user_id === auth()->user()->id)
                  <a href="{{ route('deleteUlasan', ['id' => $item->id]) }}" style="margin-left: 10px; color: #f44336; text-decoration: none; transition: color 0.3s;">
                      <i class="fas fa-trash" style="font-size: large;"></i> Hapus
                  </a>
                  @endif
              </div>
          </div>
      </div>

    </div>
      
      
        </div>
      @endforeach
    </div>
    
      
<!--------------------------------------------------------------------------------------- Javascript Area ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Area ------------------------------------------------------------------------------->

  <!-- Filter Komen Ulansan -->
    <script>
      function filterComments(filter) {
          window.location.href = '{{ route('ulasan') }}?filter=' + filter;
      }
      </script>
    <!--------------------------------------------------------------------------------------- Javascript Dropdown ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Dropdown ------------------------------------------------------------------------------->

<script>
  document.addEventListener("DOMContentLoaded", function() {
      var dropdownMenu = document.querySelector('.dropdown-menu');

      // Saat mouse memasuki dropdown, tambahkan kelas 'show'
      dropdownMenu.addEventListener('mouseenter', function() {
          dropdownMenu.classList.add('show');
      });

      // Saat mouse meninggalkan dropdown, hapus kelas 'show'
      dropdownMenu.addEventListener('mouseleave', function() {
          dropdownMenu.classList.remove('show');
      });
  });
</script>

<!--------------------------------------------------------------------------------------- Javascript Edit ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Edit ------------------------------------------------------------------------------->

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const editButtons = document.querySelectorAll('.edit-button');
      
      editButtons.forEach(button => {
          button.addEventListener('click', function (e) {
              e.preventDefault();
              const komentarId = this.getAttribute('data-id');
              const userId = this.getAttribute('data-user-id');
              const editPesanDiv = document.getElementById('edit-pesan-' + komentarId);
              editPesanDiv.style.display = 'block';
          });
      });
      
      // Tambahkan event listener untuk tombol simpan edit
      const simpanEditButtons = document.querySelectorAll('.simpan-edit-button');
      
      simpanEditButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const komentarId = this.getAttribute('data-id');
            const editedText = document.getElementById('edit-pesan-text-' + komentarId).value;

            // Menggunakan fetch untuk mengirim permintaan POST ke server
            fetch("{{ url('/simpanEditUlasan') }}/" + komentarId, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ pesan: editedText })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menyimpan perubahan');
                }
                return response.json();
            })
            .then(data => {
                const pesanElement = document.getElementById('pesan-' + komentarId);
                pesanElement.innerText = editedText;

                // Tampilkan keterangan edited
                const keteranganEdited = document.createElement('span');
                keteranganEdited.style.color = 'gray';
                keteranganEdited.textContent = ' (Edited)';
                pesanElement.appendChild(keteranganEdited);

                // Sembunyikan area edit setelah disimpan
                document.getElementById('edit-pesan-' + komentarId).style.display = 'none';
            })
              .catch(error => {
                  console.error(error);
              });
          });
      });
      
      // Tambahkan event listener untuk tombol tutup edit
      const tutupEditButtons = document.querySelectorAll('.tutup-edit-button');
      
      tutupEditButtons.forEach(button => {
          button.addEventListener('click', function (e) {
              e.preventDefault();
              const komentarId = this.getAttribute('data-id');
              document.getElementById('edit-pesan-' + komentarId).style.display = 'none';
          });
      });
  });
  
    </script>
    

<!--------------------------------------------------------------------------------------- Javascript Rating ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Rating ------------------------------------------------------------------------------->

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

<!--------------------------------------------------------------------------------------- Javascript Modal Logout ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Modal Logout ------------------------------------------------------------------------------->

     <script>
      // JavaScript untuk modal logout
      function openModal() {
        const modal = document.getElementById('logout-modal');
        modal.style.display = 'block';
      }
    
      function closeModal() {
        const modal = document.getElementById('logout-modal');
        modal.style.display = 'none';
      }
    
      function confirmLogout(confirmed) {
        if (confirmed) {
          // Redirect ke URL logout yang sesuai (ganti URL ini dengan URL logout sebenarnya)
          window.location.href = '/logout';
        } else {
          // Tutup modal jika pengguna memilih "No"
          closeModal();
        }
      }
    
      // Tutup modal jika pengguna mengklik di luar modal
      window.addEventListener('click', (event) => {
        const modal = document.getElementById('logout-modal');
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      });
    </script>

<!--------------------------------------------------------------------------------------- Javascript Like & Dislike ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Like & Dislike  ------------------------------------------------------------------------------->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
      // Handle like button click
      $('.likeButton').click(function() {
          var itemId = $(this).data('id');
          var button = $(this);
          var likeCountElement = button.closest('.ulasan').find('.likeCount');
          var dislikeCountElement = button.closest('.ulasan').find('.dislikeCount');
          
          var likeCount = parseInt(likeCountElement.text().split(' ')[0]);
          var dislikeCount = parseInt(dislikeCountElement.text().split(' ')[0]);

          // Jika jumlah like awalnya 1, maka tambahkan 1 lagi
          if (likeCount === 1) {
              likeCount += 1;
          } else {
              likeCount += 1;
              dislikeCount = 0;
          }

          likeCountElement.text(likeCount + ' Likes');
          dislikeCountElement.text(dislikeCount + ' Dislikes');

          button.find('i').removeClass('fa-regular fa-thumbs-down').addClass('fa fa-thumbs-up');
          button.closest('.ulasan').find('.dislikeButton').find('i').removeClass('fa fa-thumbs-down').addClass('fa-regular');

          $.ajax({
              type: 'GET',
              url: '/likeUlasan/' + itemId,
              success: function(response) {
                  if (response.status !== 'success') {
                      console.error('Failed to like ulasan');
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Failed to like ulasan:', error);
              }
          });
      });

      // Handle dislike button click
      $('.dislikeButton').click(function() {
          var itemId = $(this).data('id');
          var button = $(this);
          var likeCountElement = button.closest('.ulasan').find('.likeCount');
          var dislikeCountElement = button.closest('.ulasan').find('.dislikeCount');

          var likeCount = parseInt(likeCountElement.text().split(' ')[0]);
          var dislikeCount = parseInt(dislikeCountElement.text().split(' ')[0]);

          dislikeCount += 1;
          likeCount = 0;

          dislikeCountElement.text(dislikeCount + ' Dislikes');
          likeCountElement.text(likeCount + ' Likes');

          button.find('i').removeClass('fa-regular fa-thumbs-up').addClass('fa fa-thumbs-down');
          button.closest('.ulasan').find('.likeButton').find('i').removeClass('fa fa-thumbs-up').addClass('fa-regular');

          $.ajax({
              type: 'GET',
              url: '/dislikeUlasan/' + itemId,
              success: function(response) {
                  if (response.status !== 'success') {
                      console.error('Failed to dislike ulasan');
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Failed to dislike ulasan:', error);
              }
          });
      });
  });
</script>






    
</body>
</html>
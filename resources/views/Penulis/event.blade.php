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

    <title>Event - Katakey</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    

<!--------------------------------------------------------------------------- CSS Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- CSS Area --------------------------------------------------------------------------------------------------------------->
    
    <style>
      /* Style for the buttons */
      .animated-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        cursor: pointer;
        margin: 5px;
        font-size: 16px;
      }

      .animated-button:hover {
        background-color: #0056b3;
      }

      /* Additional styling for the second button */
      .animated-button:nth-of-type(2) {
        background-color: #ff6600;
      }

      .animated-button:nth-of-type(2):hover {
        background-color: #ff4500;
      }

  </style>
  <style>
    /* Style untuk modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.7);
    }
  
    .modal-content {
      background-color: #fff;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }
  
    .close {
      position: absolute;
      right: 10px;
      top: 5px;
      font-size: 25px;
      cursor: pointer;
    }
  
    /* Style untuk judul dan informasi event */
    h2 {
      color: rgba(242, 100, 25, 1);
    }
  </style>
  <style>
    .modalLogout {
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

    .modal-contentLogout {
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
      width: 40%;
      height: 30%; /* Mengatur tinggi modal menjadi 60% */
      text-align: center;
    }

    .closeLogout {
      color: #888;
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }

    #confirm-buttonLogout, #cancel-buttonLogout {
      padding: 10px 20px;
      margin: 25px;
      cursor: pointer;
    }
</style>
</head>

<!--------------------------------------------------------------------------- Body Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- Body Area --------------------------------------------------------------------------------------------------------------->
    
<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
              <nav class="main-nav">
                <ul class="nav">
                    <li class="scroll-to-section"><a href="/home">Home</a></li>
                    <li class="scroll-to-section"><a href="/home">Trending</a></li>
                    <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/Video">Video</a></li>
                    <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                    <li class="scroll-to-section"><a href="/event" class="active">Event</a></li>
                    <li class="scroll-to-section"><a href="/ulasan">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/about">Tentang</a></li>
                    <li>
                      <form action="{{ route('searchE') }}" method="GET" class="input-group">
                        <input type="text" name="searchE" class="form-control" placeholder="Cari Event..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('searchE') }}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </form>
                    </li>
                    <li>
                      <div class="dropdown">
                          <a href="#" class="nav-link text-white font-weight-bold px-0 d-flex align-items-center dropdown-toggle" role="button" id="savedArticlesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <div class="profile-picture" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                                  <?php
                                  $fotoProfil = Auth::user()->fotoProfil;
                                  if ($fotoProfil && file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                                  ?>
                                  <img src="{{ asset('fotoProfil/' . $fotoProfil) }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                  <?php
                                  } else {
                                  ?>
                                  <img src="{{ asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') }}" alt="User's Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                  <?php
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
                            <a class="dropdown-item" href="/profileUser">Profil Anda</a>
                            <a class="dropdown-item" href="/simpanArtikelView">Artikel Tersimpan</a>
                            <a class="dropdown-item" href="/simpanVideoView">Video Tersimpan</a>
                        </div>
                      </div>
                  </li>           
                    <li class="scroll-to-section">
                      <a href="#" class="d-sm-inline d-none text-white text-bold" id="logout-link" onclick="openModal()"> Logout</a>
                    </li>
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
            <h2>Event</h2>
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
            <div>
              @foreach ($event as $item)
                  <div class="row" style="text-align: justify">
                      <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                          <div class="d-flex justify-content-center">
                              <img src="{{ asset('fotoEvent/'.$item->fotoEvent) }}" style="max-width: 100%; height: auto; border-radius: 14px">
                          </div>
                      </div>
                      <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                          <h4 style="text-align: left" >{{ $item->namaEvent }} </h4>
                          <span class="d-flex"><b>{{ $item->pembuatEvent }}</b></span>
                          <p>{!! str_replace('<img', '<img style="max-width: 1152px; width: 100%; height: auto; display: block; margin: 0 auto;"', $item->deskripsiEvent) !!}</p>
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
                      <a href="#" class="showModalButton" data-toggle="modal" data-target="#exampleModalEvent{{$item->id}}" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a>

                  </div>
                  <hr>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalEvent{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width: 100%; max-width: 900px;">

                          <div class="modal-header">
                              <img src="{{ asset('assets2/img/lg1.png') }}" alt="Detail Event Icon" style="max-width: 30px; max-height: 30px; margin-right: 15px;">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Event</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          
                          

                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6 text-left">
                                <p>Nama Event</p>
                                <p>Nama Pembuat Event</p>
                                <p>Tanggal Event</p>
                                <p>Jam Event</p>
                                <p>Lokasi Event</p>
                                <p>Informasi Event Lebih Lanjut</p>
                                <p>Tanggal Buat Event</p>
                                <p>Tanggal Update Event</p>
                              </div>
                              <div class="col-md-6 text-right">
                                <p>{{ $item->namaEvent}}</p>
                                <p>{{ $item->pembuatEvent}}</p>
                                <p>{{ date('d F Y', strtotime($item->tanggalEvent)) }}</p>
                                <p>{{ date('H:i', strtotime($item->jamEvent)) }}</p>
                                <p>{{ $item->lokasiEvent}}</p>
                                <a href="{{$item->informasiLebihLanjut}}" target="_blank">{{$item->informasiLebihLanjut}}</a>
                                <p>{{ strftime('%A, %d %B, %H.%M', strtotime($item->created_at)) }}</p>
                                <p>{{ strftime('%A, %d %B, %H.%M', strtotime($item->updated_at)) }}</p>
                              </div>
                            </div>
                          </div>

                          <div style="text-align: center; font-size: 10px; font-weight: normal;">
                            Copyright &copy; <a href="#" style="font-size: 10px; font-weight: normal;">Katakey@gmail.com</a>
                          </div>

                        </div>
                      </div>
                    </div>
                    @endforeach
              </div>
          </div>
        </div>
      </section>
    </div>
</div>
<!--------------------------------------------------------------------------- Modal Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- Modal Area --------------------------------------------------------------------------------------------------------------->
   
     <!-- Modal Logout -->
     <div id="logout-modal" class="modalLogout">
      <div class="modal-contentLogout">
        <span class="closeLogout" id="close-buttonLogout" onclick="closeModal()">&times;</span>
        <h2>Konfirmasi Logout</h2>
        <p>Apakah anda mau logout?</p>
        <div style="text-align: center;">
          <button style="width: 120px;" class="btn btn-primary" id="confirm-logout-button" onclick="confirmLogout(true)">Ya</button>
          <button style="width: 120px;" class="btn btn-danger" id="cancel-logout-button" onclick="confirmLogout(false)">Tidak</button>
        </div>
      </div>
    </div>

<!--------------------------------------------------------------------------- JavaScript Area --------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------- JavaScript Area --------------------------------------------------------------------------------------------------------------->
    
<!-- MODAL LOGOUT -->
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

<!-- Modal Detail Event -->
<script>
    // Fungsi untuk menampilkan modal saat tombol diklik
    document.getElementById('showModalButton{{$item->id}}').addEventListener('click', function() {
    $('#exampleModalEvent{{$item->id}}').modal('show');
  });

  // Fungsi untuk menutup modal saat tombol "X" diklik
  $('#exampleModalEvent{{$item->id}} button.btn-close').on('click', function () {
    $('#exampleModalEvent{{$item->id}}').modal('hide');
  });
</script>

 <!-- Modal Logout -->
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

  </body>
</html>
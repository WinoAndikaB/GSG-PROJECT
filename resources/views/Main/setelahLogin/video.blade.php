@extends('Main.layout.homeStyle')

<link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/lg1.png">
<link rel="icon" type="image/png" href="../assets2/img/lg1.png">

<style>
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
</style>

<title>Video - Katakey</title>

<body>
<div class="page-heading">
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="/home">Home</a></li>
                          <li class="scroll-to-section"><a href="/home">Trending</a></li>
                          <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                          <li class="scroll-to-section"><a href="/Video" class="active">Video</a></li>
                          <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                          <li class="scroll-to-section"><a href="/event">Event</a></li>
                          <li class="scroll-to-section"><a href="/ulasan" class="text-center">Ulasan</a></li>
                          <li class="scroll-to-section"><a href="/about">Tentang</a></li>
                          <li>
                            <form action="{{ route('searchV') }}" method="GET" class="input-group">
                              <input type="text" name="searchV" class="form-control" placeholder="Cari Video..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('searchV') }}">
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
</div>

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

  <div class="banner-area banner-inner-1 bg-black" id="banner">
    <div class="banner-inner pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="thumb after-left-top">
                        <img src="assets/img/banner/1.png" alt="img">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="banner-details mt-4 mt-lg-0">
                        <div class="post-meta-single">
                            <ul>
                                <li><a class="tag-base tag-blue" href="#">Katakey</a></li>
                                <li class="date"><i class="fa fa-clock-o"></i>{{$todayDate}}</li>
                            </ul>
                        </div>
                        <h2>Provide you a qualified articles and informative articles from a lot sources.</h2>
                        <p></p>
                        <a class="btn btn-blue" href="/abouts">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <section class="about-us" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Video</h6>
            <h4>Daftar Video</h4>
          </div>
        </div>
        <div>
          @foreach ($semuaVideo as $item)
              <div class="row" style="text-align: justify">
                  <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                    <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                      <h4 style="text-align: left" >{{ $item->judulVideo }} </h4>
                      <span class="d-flex"><b>{{ $item->uploader }}</b></span>
                      <p>{!! substr(strip_tags($item->deskripsiVideo), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
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
                      <a href="{{ route('showDetailVideo', ['id' => $item->id]) }}" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a></p></span>
              </div>
              <hr>
              @endforeach
          </div>
      </div>
    </div>
  </section>

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
</body>
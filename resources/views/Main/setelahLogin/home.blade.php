@extends('Main.layout.homeStyle')

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/lg1.png">
    <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Home -  Katakey</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    
    <link href="{{ asset('aset1/css/media_query.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/owl.theme.default.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('aset1/css/style_1.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Modernizr JS -->
    <script src="{{ asset('aset1/js/modernizr-3.5.0.min.js') }}"></script>


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
  /* CSS styles */
  .article-title {
      color: black;
      text-decoration: none; /* Menghilangkan garis bawah */
      font-weight: bold; /* Bold text */
      position: relative; /* Memberikan posisi relatif */
  }
  .article-title::selection {
      color: white; /* Warna teks saat dipilih */
      background-color: #007bff; /* Warna latar belakang saat teks dipilih */
  }
  .article-title:hover {
      color: #ff6347; /* Warna teks saat kursor berada di atas judul artikel */
      cursor: pointer; /* Kursor pointer saat di atas judul artikel */
  }
  .article-title:hover::after {
      content: ""; /* Membuat elemen pseudo */
      position: absolute; /* Memberikan posisi absolut */
      bottom: -2px; /* Jarak dari bawah */
      left: 0; /* Posisi dari kiri */
      width: 100%; /* Lebar sesuai dengan judul artikel */
      background-color: #ff6347; /* Warna garis saat kursor berada di atas judul artikel */
  }
  .article-title span {
      text-decoration: none; /* Menghilangkan garis bawah */
  }
</style>

<!---------------------------------------------------------------------  Banner Carousel Style ------------------------------------------------------------------------------>
<!---------------------------------------------------------------------  Banner Carousel Style ------------------------------------------------------------------------------>

<style>
  /* banner */
  .banner-container {
    max-width: 1550px; /* Mengatur lebar maksimum */
    width: 100%;
    overflow: hidden;
    margin: 0 auto; /* Membuat container terpusat */
  }
  
  .banner-carousel {
    display: flex;
    transition: transform 0.5s ease;
  }
  
  .banner-slide {
    min-width: 100%;
    flex: 0 0 auto;
    border-radius: 50px; /* Add border radius here */
  }

</style>

<style>
    /* Notificaton */
    .scrollable-menu {
    max-height: 600px; /* Set the max height you want */
    overflow-y: auto; /* Enable vertical scrolling */
}

</style>


<!---------------------------------------------------------------------  Body Area ------------------------------------------------------------------------------>
<!---------------------------------------------------------------------  Body Area ------------------------------------------------------------------------------>

<body>
<div class="page-heading">
<header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
              <nav class="main-nav">
                <ul class="nav">
                    <li class="scroll-to-section"><a href="/home" class="active">Home</a></li>
                    <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/Video" class="">Video</a></li>
                    <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                    <li class="scroll-to-section"><a href="/ulasan" class="text-center">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/about">Tentang</a></li>
                    <li>
                      <form action="{{ route('search') }}" method="GET" class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Artikel..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </form>
                    </li>
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
                    
                    <div class="dropdown-menu dropdown-menu-wide scrollable-menu" aria-labelledby="dropdownMenuButton">
                        <h6 class="container-title" style="margin: 10px 0; text-align: center;"><i class="fas fa-bell"></i> Notifikasi</h6>
                        <hr>
                        
                        @if($isFollowingAuthor && $jumlahData > 0)
                            @foreach($notifArtikel as $item)
                                <a class="dropdown-item" href="{{ route('detail.artikel', ['id' => $item->id]) }}">
                                    <div class="notification-item">
                                        <div class="notification-info">
                                            <div class="profile-info">
                                                <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left">
                                                <div class="profile-details">
                                                    <h6 class="notification-title" title="{{ $item->judulArtikel }}">{{ $item->penulis }} mengupload: {{ Str::limit($item->judulArtikel, 20) }}</h6>
                                                    <p class="notification-time">{{ $item->created_at->format('d F Y') }} | {{ $item->created_at->diffForHumans() }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="dropdown-item">Tidak ada notifikasi saat ini.</p>
                        @endif
                        
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
</div>

  <div class="banner-area banner-inner-1 bg-black" id="banner">
    <div class="banner-inner pt-5">
        <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($banner0 as $key => $banner)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($banner0 as $key => $banner)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ asset($banner->image_url) }}" alt="{{ $banner->keterangan }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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
                        <a class="btn btn-blue" href="/about">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<!---------------------------------------------------------------------  Banner Carousel ------------------------------------------------------------------------------>

<div class="post-area pd-top-75 pd-bottom-50" id="trending">

  <div class="banner-container">
    <div class="banner-carousel">
        @foreach($banner1 as $banner)
            <div class="banner-slide">
                <img src="{{ asset($banner->image_url) }}" alt="{{ $banner->keterangan }}" style="border-radius: 50px;">
            </div>
        @endforeach
    </div>
  </div>
  


<!---------------------------------------------------------------------  Banner Carousel ------------------------------------------------------------------------------> 

    
  <div style="display: flex; justify-content: center; margin: 10px;">
    @php
    $uniqueCategories = [];
    @endphp
    
    @foreach($kategoriLogA as $item)
        @if (!in_array($item->kategori, $uniqueCategories))
            <span class="fh5co_tags_all">
                <a href="{{ route('kategoriA', ['kategori' => $item->kategori]) }}" class="fh5co_tagg">{{ $item->kategori }}</a>
            </span>
            @php
            $uniqueCategories[] = $item->kategori;
            @endphp
        @endif
    @endforeach
</div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="section-title">
                    <h6 class="title">Trending</h6>
                </div>
                @foreach ($trending->take(5) as $item)
                <div class="post-slider owl-carousel">
                      <div class="item">
                          <div class="trending-post">
                              <div class="single-post-wrap style-overlay">
                                  <div class="thumb">
                                      <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" alt="img">
                                  </div>
                                  <div class="details">
                                      <div class="post-meta-single">
                                          <p><i class="fa fa-clock-o"></i>
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
                                        </p>
                                      </div>
                                      <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{$item->judulArtikel}}</a></h6>
                                  </div>
                              </div>
                          </div>
                      </div>
              </div>
              @endforeach
                           
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="section-title">
                  <h6 class="title">Latest</h6>
              </div>
              @foreach ($latest as $item)
              <div class="post-slider owl-carousel">
                      <div class="item">
                          <div class="single-post-list-wrap">
                              <div class="media">
                                <div class="media">
                                  <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left" style="width: 70px; height: 50px;">
                                  </div>
                                  <div class="media-body">
                                      <div class="details">
                                          <div class="post-meta-single">
                                              <ul>
                                                  <li><i class="fa fa-clock-o"></i>
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
                                                </li>
                                              </ul>
                                          </div>
                                          <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 50) }}</a></h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
              </div>
              @endforeach
          </div>
          
          <div class="col-lg-3 col-md-6">
            <div class="section-title">
                <h6 class="title">What’s new</h6>
            </div>
            <div class="post-slider owl-carousel">
                @foreach ($whatsnew as $item)
                    <div class="item">
                        <div class="single-post-wrap">
                            <div class="thumb">
                                <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single mb-4 pt-1">
                                    <ul>
                                        <li><a class="tag-base tag-blue" href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{$item->penulis}}</a></li>
                                        <li><i class="fa fa-clock-o"></i>
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
                                        </li>
                                    </ul>
                                </div>
                                <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{$item->judulArtikel}}</a></h6>
                                <p>{{ \Illuminate\Support\Str::limit($item->deskripsi, 350) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
            <div class="col-lg-3 col-md-6">

                @foreach($banner2 as $banner)
                <div class="add-area" style="margin-top: 20px;">
                    @if(!empty($banner->image_url))
                        <a href="#"><img class="w-100" src="{{ asset($banner->image_url) }}"></a>
                    @else
                        <a href="#"><img class="w-100" src="{{ asset('assets/img/add/6.png') }}"></a>
                    @endif
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>

<div class="bg-sky pd-top-80 pd-bottom-50" id="latest">
  <div class="container">
      <div class="row">

          @foreach($banner3 as $banner)
              <div class="col-lg-3 col-sm-6">
                  <div class="single-post-wrap style-overlay-bg">
                      <div class="thumb">
                          <img src="{{ asset($banner->image_url) }}" alt="img">
                      </div>
                      <div class="details">
                          <div class="post-meta-single mb-3">
                              <ul>
                                  <li><p><i class="fa fa-clock-o"></i>{{ $banner->created_at }}</p></li>
                              </ul>
                          </div>
                          <h6 class="title"><a href="#">{{ $banner->keterangan }}</a></h6>
                      </div>
                  </div>
              </div>
          @endforeach

          @foreach ($box2 as $item)
          <div class="col-lg-3 col-sm-6">
              <div class="single-post-wrap">
                  <div class="thumb">
                    <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left" style="width: 400; height: 250;">
                      <p class="btn-date"><i class="fa fa-clock-o"></i>{{$item->created_at}}</p>
                  </div>
                  <div class="details">
                      <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{$item->judulArtikel}}</a></h6>
                  </div>
              </div>
              <div class="single-post-wrap">
                  <div class="thumb">
                    <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left" style="width: 400; height: 250;">
                      <p class="btn-date"><i class="fa fa-clock-o"></i>{{$item->created_at}}</p>
                  </div>
                  <div class="details">
                      <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 50) }}</a></h6>
                  </div>
              </div>
          </div>
          @endforeach

          <div class="col-lg-3 col-sm-6">
              <div class="trending-post style-box">
                  <div class="section-title">
                      <h6 class="title">Most Read</h6>
                  </div>
                  @foreach ($box3 as $item)
                  <div class="post-slider owl-carousel">
                      <div class="item">
                          <div class="single-post-list-wrap">
                              <div class="media">
                                  <div class="media-left">
                                    <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" class="media-left" style="width: 100px; height: 60px;">
                                  </div>
                                  <div class="media-body">
                                      <div class="details">
                                          <div class="post-meta-single">
                                              <ul>
                                                  <li><i class="fa fa-clock-o"></i>{{$item->created_at}}</li>
                                              </ul>
                                          </div>
                                          <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 50) }}</a></h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    @endforeach
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
            <h6>Artikel</h6>
            <h4>Daftar Artikel</h4>
          </div>
        </div>
        <div>
          @foreach ($semua as $item)
              <div class="row" style="text-align: justify">
                  <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                      <div class="d-flex justify-content-center">
                          <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" style="max-width: 100%; height: auto; border-radius: 14px">
                      </div>
                  </div>
                  <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                    <a href="{{ route('detail.artikel', ['id' => $item->id]) }}" style="text-decoration: none;">
                        <h4 class="article-title" onclick="selectText(this)" style="text-align: left;">{{ $item->judulArtikel }}</h4>
                    </a>
                    <span class="d-flex">
                        <b>{{ $item->penulis }} • 
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
                            <br>
                        </b>
                    </span>
                    <p>{!! substr(strip_tags($item->deskripsi), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
        
                    <p>Tags:
                        @php
                        $tags = explode(",", $item->tags);
                        foreach ($tags as $tag) {
                            $trimmedTag = trim($tag);
                            echo '<a href="' . route("TagsArtikel", $trimmedTag) . '" class="fh5co_tagg">' . $trimmedTag . '</a>';
                            echo ' ';
                        }
                        @endphp
                    </p> 
                </div>
              </div>
              <hr>
              @endforeach
          </div>
      </div>
    </div>
  </section>

  <div class="pd-top-80 pd-bottom-50" id="grid">
    <div class="container">
      <div class="col-lg-6 offset-lg-3">
        <div class="section-heading">
          <h6>Selengkapnya</h6>
          <h4>Selengkapnya</h4>
        </div>
      </div>
        <div class="row">
            @foreach ($box as $item)
            <div class="col-lg-3 col-sm-6">
                <div class="single-post-wrap style-overlay">
                    <div class="thumb">
                        <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" alt="img" width="500" height="250">
                        <a class="tag-base tag-purple" href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{ $item->kategori }}</a>
                    </div>
                    <div class="details">
                        <div class="post-meta-single">
                            <p><i class="fa fa-clock-o"></i>
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
                            </p>
                        </div>
                        <h6 class="title"><a href="{{ route('detail.artikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 50) }}</a></h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------- Modal Area ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Modal Area ------------------------------------------------------------------------------->

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

<!--------------------------------------------------------------------------------------- Javascript Area ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Area ------------------------------------------------------------------------------->

<!--------------------------------------------------------------------- Javascript Banner Carousel ------------------------------------------------------------------------------>
<!--------------------------------------------------------------------- Javascript Banner Carousel ------------------------------------------------------------------------------>
<script>
  const carousel = document.querySelector('.banner-carousel');
  const slides = document.querySelectorAll('.banner-slide');
  const totalSlides = slides.length;
  const autoPlayInterval = 3000; // milliseconds
  let currentIndex = 0;

  function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateCarousel();
  }

  function updateCarousel() {
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  setInterval(nextSlide, autoPlayInterval);
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
</body>
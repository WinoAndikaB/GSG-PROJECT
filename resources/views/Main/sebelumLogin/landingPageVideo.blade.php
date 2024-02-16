@extends('Main.layout.homeStyle')

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/lg1.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/lg1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title>Detail Artikel - Katakey</title>
    
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

<title>Landing Page -  Katakey</title>

<body>
<div class="page-heading">
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="/">Home</a></li>
                          <li class="scroll-to-section"><a href="#about">Artikel</a></li>
                          <li class="scroll-to-section"><a href="/landingPageVideo" class="active">Video</a></li>
                          <li class="scroll-to-section"><a href="/kategoriLandingPage">Kategori</a></li>
                          <li class="scroll-to-section"><a href="/ulasanLandingPage" class="text-center">Ulasan</a></li>
                          <li class="scroll-to-section"><a href="/abouts">Tentang</a></li>
                          <li>
                            <form action="{{ route('searchLPV') }}" method="GET" class="input-group">
                              <input type="text" name="searchLPV" class="form-control" placeholder="Cari Video..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('searchLPV') }}">
                              <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                          </form>
                          </li>
                          <li><a href="/login">Login</a></li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
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

          <div style="display: flex; justify-content: center; margin: 10px;">
            @php
            $uniqueCategories = [];
            @endphp
            
            @foreach($kategoriV as $item)
                    @if (!in_array($item->kategori, $uniqueCategories))
                    <span class="fh5co_tags_all">
                        <a href="{{ route('kategoriLandingPageV', ['kategori' => $item->kategori]) }}" class="fh5co_tagg">{{ $item->kategori }}</a>
                    </span>
                    @php
                    $uniqueCategories[] = $item->kategori;
                    @endphp
                @endif
            @endforeach
        </div>

        </div>
        <div>

          <?php
          // Fungsi untuk mendapatkan ID video YouTube dari URL
          function getYoutubeVideoId($url) {
              $videoId = '';
              $parts = parse_url($url);
              if(isset($parts['query'])){
                  parse_str($parts['query'], $query);
                  if(isset($query['v'])){
                      $videoId = $query['v'];
                  }
              } elseif (preg_match('/embed\/([^\&\?\/]+)/', $url, $matches)) {
                  $videoId = $matches[1];
              }
              return $videoId;
          }
          
          foreach ($semuaVideo as $item) {
              $videoId = getYoutubeVideoId($item->linkVideo);
              $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg"; // Mengambil thumbnail maksimum resolusi
          ?>
          
          <div class="row" style="text-align: justify">
              <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                  <img src="<?php echo $thumbnail; ?>" alt="Thumbnail">
              </div>
              <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                  <h4 style="text-align: left">{{ $item->judulVideo }}</h4>
                  <span class="d-flex"><b>{{ $item->uploader }}</b></span>
                  <p>{!! substr(strip_tags($item->deskripsiVideo), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
              </div>
              <span style="text-align: right; color: rgba(165, 165, 165, 1);">
                  <p>
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
                      <a href="{{ route('showDetailLPVideo', ['id' => $item->id]) }}" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a>
                  </p>
              </span>
          </div>
          <hr>
          
          <?php
          }
          ?>
          
          </div>
      </div>
    </div>
  </section>
</body>
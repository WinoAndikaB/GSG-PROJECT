@extends('Main.layout.homeStyle')

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/lg1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title>Landing Page - Katakey</title>
    
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

<!---------------------------------------------------------------------  Article Title Active Style  ------------------------------------------------------------------------------>
<!---------------------------------------------------------------------  Article Title Active Style  ------------------------------------------------------------------------------>
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


<!---------------------------------------------------------------------  Body Area ------------------------------------------------------------------------------>
<!---------------------------------------------------------------------  Body Area ------------------------------------------------------------------------------>

<body>
<div class="page-heading">
    <header class="header-area">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav class="main-nav" style="display: flex; justify-content: space-between; align-items: center;">
                <ul class="nav" style="display: flex; align-items: center; justify-content: center; width: 100%; list-style: none; padding: 0; margin: 0;">
                    <li style="margin-right: auto;">
                        <img src="{{ asset('assets2/img/katakey1.png') }}" alt="logo" style="width: 50px; height: auto;">
                      </li>
                      <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                      <li class="scroll-to-section"><a href="#about">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo" class="text-center">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage" class="text-center">Ulasan</a></li>
                      <li class="scroll-to-section"><a href="/abouts">Tentang</a></li>
                      <li>
                        <form action="{{ route('searchLP') }}" method="GET" class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Cari Artikel..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('search') }}">
                          <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </form>
                      </li>
                      <li><a href="/login">Login</a></li> 
                </ul>
                <a class='menu-trigger' style="display: none;">
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
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($banner0 as $key => $banner)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">

                        @foreach($banner0 as $key => $banner)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">                    

                              @if(!empty($banner->image_url) && filter_var($banner->image_url, FILTER_VALIDATE_URL))
                                    <a href="{{$banner->image_url}}" data-lightbox="gallery" data-title="Deskripsi Gambar">
                                        <img src="{{$banner->image_url}}" class="avatar avatar-sm me-3" alt="Gambar" style="max-width: 100%; height: auto; border-radius: 14px">
                                    </a>
                                @endif
                                
                                @if(!empty($banner->file_path))
                                    <a href="{{asset('banners/'. $banner->file_path)}}" data-lightbox="gallery" data-title="Deskripsi Gambar">
                                        <img src="{{asset('banners/'. $banner->file_path)}}" class="avatar avatar-sm me-3" alt="Gambar" style="max-width: 100%; height: auto; border-radius: 14px">
                                    </a>
                                @endif
                          
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
                        <a class="btn btn-blue" href="/abouts">About Us</a>
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
               
                  @if(!empty($banner->image_url) && filter_var($banner->image_url, FILTER_VALIDATE_URL))
                        <a href="{{$banner->image_url}}" data-lightbox="gallery" data-title="Deskripsi Gambar">
                            <img src="{{$banner->image_url}}" class="avatar avatar-sm me-3" alt="Gambar" style="max-width: 100%; height: auto; border-radius: 14px">
                        </a>
                    @endif
                    
                    @if(!empty($banner->file_path))
                        <a href="{{asset('banners/'. $banner->file_path)}}" data-lightbox="gallery" data-title="Deskripsi Gambar">
                            <img src="{{asset('banners/'. $banner->file_path)}}" class="avatar avatar-sm me-3" alt="Gambar" style="max-width: 100%; height: auto; border-radius: 14px">
                        </a>
                    @endif

              </div>
          @endforeach
      </div>
    </div>
    
  

<!---------------------------------------------------------------------  Banner Carousel ------------------------------------------------------------------------------> 

    <div style="display: flex; justify-content: center; margin: 50px;">
      @php
      $uniqueCategories = [];
      @endphp
      
      @foreach($kategoriA as $item)
          @if (!in_array($item->kategori, $uniqueCategories))
              <span class="fh5co_tags_all">
                  <a href="{{ route('kategoriLandingPageA', ['kategori' => $item->kategori]) }}" class="fh5co_tagg">{{ $item->kategori }}</a>
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
                    <h6 class="title">Most Read</h6>
                </div>
                @foreach ($trending->take(5) as $item)
                <div class="post-slider owl-carousel">
                      <div class="item">
                          <div class="trending-post">
                              <div class="single-post-wrap style-overlay">
                                  <div class="thumb">

                                    @if($item->gambarArtikel)
                                        @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                                            <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                                <img src="{{$item->gambarArtikel}}">
                                            </a>
                                        @else
                                            <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                                <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}">
                                            </a>
                                        @endif
                                    @endif
                                    
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
                                      <h6 class="title"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 70) }}</a></h6>
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
                              @if($item->gambarArtikel)
                              @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                                  <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                      <img src="{{$item->gambarArtikel}}" class="media-left" style="width: 70px; height: 50px;">
                                  </a>
                              @else
                                  <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                      <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" class="media-left" style="width: 70px; height: 50px;">
                                  </a>
                              @endif
                          @endif
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
                                      <h6 class="title"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 70) }}</a></h6>
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
                <h6 class="title">See More</h6>
            </div>
            <div class="post-slider owl-carousel">
                @foreach ($whatsnew as $item)
                    <div class="item">
                        <div class="single-post-wrap">
                            <div class="thumb">
                              @if($item->gambarArtikel)
                              @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                                  <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                      <img src="{{$item->gambarArtikel}}">
                                  </a>
                              @else
                                  <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                      <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}">
                                  </a>
                              @endif
                          @endif
                            </div>
                            <div class="details">
                                <div class="post-meta-single mb-4 pt-1">
                                    <ul>
                                        <li><a class="tag-base tag-blue" href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{$item->penulis}}</a></li>
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
                                <h6 class="title"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 70) }}</a></h6>
                                <p>{{ \Illuminate\Support\Str::limit($item->deskripsi, 350) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
            <div class="col-lg-3 col-md-6">

                <div style="width: 365px; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">  
                    <div style="text-align: center;">
                        <h6 class="title">Best Rate Author</h6>
                    </div>
                    @foreach ($ratingPenulis->groupBy('user_id_penulis')->sortByDesc(function ($userRatings) {
                        $filteredRatings = $userRatings->filter(function ($rating) {
                            return $rating->created_at->gt(now()->subMonth());
                        });
                        return $filteredRatings->avg('rating');
                    }) as $userRatings)
                        @php 
                            $filteredUserRatings = $userRatings->filter(function ($rating) {
                                return $rating->created_at->gt(now()->subMonth());
                            });
                
                            if ($filteredUserRatings->isEmpty()) {
                                continue; // Skip if no ratings in the last month
                            }
                
                            $sortedUserRatings = $filteredUserRatings->sortByDesc('rating'); // Mengurutkan rating dari yang tertinggi
                            $firstRating = $sortedUserRatings->first();
                            $averageRating = min(round($sortedUserRatings->avg('rating'), 1), 5.0); // Memastikan rating tidak melebihi 5.0
                            $totalRating = $filteredUserRatings->count(); // Total rating berdasarkan user
                        @endphp
                        <a href="{{ route('profilPenulisUser', ['id' => $firstRating->user->id]) }}">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                                @if ($firstRating->user->fotoProfil)
                                    <?php
                                        $fotoProfil = $firstRating->user->fotoProfil;
                                        $gambarPath = null;
                                        
                                        if (file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                                            // Jika file fotoProfil ada di direktori fotoProfil
                                            $gambarPath = asset('fotoProfil/' . $fotoProfil);
                                        } elseif (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                                            // Jika fotoProfil adalah URL yang valid
                                            $gambarPath = $fotoProfil;
                                        }
                                    ?>
                                    @if ($gambarPath)
                                        <img src="{{ $gambarPath }}" alt="Profil Foto" style="width: 65px; height: 65px; border-radius: 50%; flex-shrink: 0; object-fit: cover;">
                                    @else
                                        <div style="width: 50px; height: 50px; border-radius: 50%; flex-shrink: 0; background-color: lightgrey;"></div>
                                    @endif
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 50%; flex-shrink: 0; background-color: lightgrey;"></div>
                                @endif
                                
                                <div style="flex-grow: 1; margin-left: 10px;">
                                    <p style="margin: 0; font-weight: bold;">{{ $firstRating->user->name }}</p>
                                    <p style="margin: 0;">{{ number_format($averageRating, 1) }} / 5.0 ({{ $totalRating }} rating)</p>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $averageRating)
                                            <span style="color: gold;">★</span>
                                        @else
                                            <span style="color: lightgrey;">★</span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </a>
                    @endforeach                                           
                </div>
                

            
     
            </div>
        </div>
    </div>
</div>

<div class="bg-sky pd-top-80 pd-bottom-50" id="latest">
  <div class="container">
      <div class="row">


    <div class="col-lg-3 col-sm-6">
        @foreach($banner2 as $banner)
        <div class="add-area" style="margin-top: 20px;">
            @if(!empty($banner->image_url) && filter_var($banner->image_url, FILTER_VALIDATE_URL))
                <a href="#"><img class="w-100" src="{{ $banner->image_url }}"></a>
            @elseif(!empty($banner->file_path))
                <a href="#"><img class="w-100" src="{{ asset('banners/'. $banner->file_path) }}"></a>
            @else
                <a href="#"><img class="w-100" src="{{ asset('assets/img/add/6.png') }}"></a>
            @endif
        </div>
    @endforeach
    </div> 

          @foreach ($box2 as $item)
          <div class="col-lg-3 col-sm-6">
              <div class="single-post-wrap">
                  <div class="thumb">

                    <br>

                    @if($item->gambarArtikel)
                        @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                            <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                <img src="{{$item->gambarArtikel}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                            </a>
                        @else
                            <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                            </a>
                        @endif
                    @endif

                      <p class="btn-date"><i class="fa fa-clock-o"></i>{{$item->created_at->format('d F Y H:i:s')}}</p>
                  </div>
                  <div class="details">
                      <h6 class="title" title="{{ $item->judulArtikel }}"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 40) }}</a></h6>
                  </div>
              </div>
              <div class="single-post-wrap">
                  <div class="thumb">
                    @if($item->gambarArtikel)
                    @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                        <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                            <img src="{{$item->gambarArtikel}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                        </a>
                    @else
                        <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                            <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                        </a>
                    @endif
                @endif
                      <p class="btn-date"><i class="fa fa-clock-o"></i>{{$item->created_at->format('d F Y H:i:s')}}</p>
                  </div>
                  <div class="details">
                      <h6 class="title" title="{{ $item->judulArtikel }}"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 40) }}</a></h6>
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

                                    @if($item->gambarArtikel)
                                      @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                                          <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                              <img src="{{$item->gambarArtikel}}"  class="media-left" style="width: 100px; height: 60px;">
                                          </a>
                                      @else
                                          <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                              <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}"  class="media-left" style="width: 100px; height: 60px;">
                                          </a>
                                      @endif
                                  @endif

                                  </div>
                                  <div class="media-body">
                                      <div class="details">
                                          <div class="post-meta-single">
                                              <ul>
                                                  <li><i class="fa fa-clock-o"></i>{{$item->created_at}}</li>
                                              </ul>
                                          </div>
                                          <h6 class="title"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 50) }}</a></h6>
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
        </div>
        <div>

          @foreach ($semua as $item)
          <div class="row" style="text-align: justify">
            <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                <div class="d-flex justify-content-center">

                  @if($item->gambarArtikel)
                      @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                          <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                              <img src="{{$item->gambarArtikel}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                          </a>
                      @else
                          <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                              <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                          </a>
                      @endif
                  @endif
                  
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
              <a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}" style="text-decoration: none;">
                  <h4 class="article-title" onclick="selectText(this)" style="text-align: left;">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 80) }}</h4>
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
                      echo '<a href="' . route("TagsArtikelLP", $trimmedTag) . '" class="fh5co_tagg">' . $trimmedTag . '</a>';
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

                        @if($item->gambarArtikel)
                        @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                            <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                <img src="{{$item->gambarArtikel}}"  alt="img" width="500" height="250">
                            </a>
                        @else
                            <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" alt="img" width="500" height="250">
                            </a>
                        @endif
                    @endif

                        <a class="tag-base tag-purple" href="#">{{ $item->kategori }}</a>
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
                        <h6 class="title"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ \Illuminate\Support\Str::limit($item->judulArtikel, 50) }}</a></h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</body>


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
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

    <title> 
      @if($kategoriLandingPageA->isNotEmpty())
          Kategori {{ $kategoriLandingPageA->first()->kategori }} - Katakey
      @else
         Data Tidak Ditemukan - Katakey
      @endif
  </title>
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

    <link href="{{ asset('aset1/css/media_query.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('aset1/css/owl.theme.default.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('aset1/css/style_1.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Modernizr JS -->
    <script src="{{ asset('aset1/js/modernizr-3.5.0.min.js')}}"></script>
    
    
    
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
    

</head>
<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="/" class="logo">
                        <img src="" alt="">
                    </a>
                    <span>Katakey</span>
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="/" >Home</a></li>
                      <li class="scroll-to-section"><a href="/">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage" class="active">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage">Ulasan</a></li>
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
  <!-- ***** Header Area End ***** -->

  <div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-text">
                    @if($kategoriLandingPageA->isNotEmpty())
                        <h2>Kategori {{ $kategoriLandingPageA->first()->kategori }}</h2>
                        <div class="div-dec"></div>
                    @else
                        <h2>Tidak Ada Artikel Ditemukan Pada Ketegori Ini</h2>
                    @endif
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
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <div class="section-heading">
                <h6>{{ $kategoriLandingPageA->isNotEmpty() ? $kategoriLandingPageA->first()->kategori : 'Tidak Ditemukan' }}</h6>
                <h4>List Kategori {{ $kategoriLandingPageA->isNotEmpty() ? $kategoriLandingPageA->first()->kategori : 'Tidak Ditemukan' }}</h4>
                <br>
              </div>
            </div>
            <div>
              @foreach ($kategoriLandingPageA as $item)
              <div class="row" style="text-align: justify">
                <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                    <div class="d-flex justify-content-center">

                          @if($item->gambarArtikel)
                              @if(filter_var($item->gambarArtikel, FILTER_VALIDATE_URL))
                                  <a href="{{$item->gambarArtikel}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                      <img src="{{$item->gambarArtikel}}" style="max-width: 100%; height: auto; border-radius: 14px">
                                  </a>
                              @else
                                  <a href="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" data-lightbox="gambarArtikel" data-title="Deskripsi Gambar">
                                      <img src="{{asset('gambarArtikel/'.$item->gambarArtikel)}}" style="max-width: 100%; height: auto; border-radius: 14px">
                                  </a>
                              @endif
                          @endif

                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                    <a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}" style="text-decoration: none;">
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
                    <p>{!! substr(strip_tags($item->deskripsi), 0, 400) . (strlen(strip_tags($item->deskripsi)) > 400 ? '...' : '') !!}</p>
        
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
    
        
    </div>
</div>


  
  </body>
</html>
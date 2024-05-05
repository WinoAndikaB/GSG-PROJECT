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

    <title>Detail Video - Katakey</title>

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
<style>
  .rating {
       font-size: 24px;
     }
.gold-star {
   color: gold;
   font-size: 15px; /* Adjust the size as needed */
}
</style>
  <style>
    /* CSS styles */
    .video-title {
        color: black;
        text-decoration: none; /* Menghilangkan garis bawah */
        font-weight: bold; /* Bold text */
        position: relative; /* Memberikan posisi relatif */
    }
    .video-title::selection {
        color: white; /* Warna teks saat dipilih */
        background-color: #007bff; /* Warna latar belakang saat teks dipilih */
    }
    .video-title:hover {
        color: #ff6347; /* Warna teks saat kursor berada di atas judul video */
        cursor: pointer; /* Kursor pointer saat di atas judul video */
    }
    .video-title:hover::after {
        content: ""; /* Membuat elemen pseudo */
        position: absolute; /* Memberikan posisi absolut */
        bottom: -2px; /* Jarak dari bawah */
        left: 0; /* Posisi dari kiri */
        width: 100%; /* Lebar sesuai dengan judul video */
        background-color: #ff6347; /* Warna garis saat kursor berada di atas judul video */
    }
    .video-title span {
        text-decoration: none; /* Menghilangkan garis bawah */
    }
  </style>
  <style>
    .rating-penulis {
       font-size:55px;
       cursor: pointer;
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
                    <span>Katakey</span>
                    <ul class="nav">
                      <li class="scroll-to-section"><a href="/" >Home</a></li>
                      <li class="scroll-to-section"><a href="/" class="">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo" class="active">Video</a></li>
                      <li class="scroll-to-section"><a href="/kategoriLandingPage">Kategori</a></li>
                      <li class="scroll-to-section"><a href="/ulasanLandingPage">Ulasan</a></li>
                      <li class="scroll-to-section"><a href="/abouts" class="">Tentang</a></li>
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
            <h2>Detail Artikel</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="what-we-do">
    <div class="container">
      <div class="row">
      
        <div class="col-md-8 animate-box" data-animate-effect="fadeInRight">
          <section>
            <h1 style="color: rgba(47, 72, 88, 1); font-weight: bold;">{{ $video->judulVideo }}</h1><br>

              <div class="simple-profile-container" style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                <a href="{{ route('detailProfilVideoLP', ['id' => $video->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="simple-profile-picture" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 2px solid #3498db;">


                      @if($fotoProfil)
                          @if(filter_var($fotoProfil, FILTER_VALIDATE_URL))
                              <a href="{{$fotoProfil}}" data-lightbox="gambarProfil" data-title="Deskripsi Gambar">
                                  <img src="{{$fotoProfil}}" alt="Profil Picture" style="width: 100%; height: 100%;">
                              </a>
                          @else
                              <a href="{{asset('fotoProfil/'.$fotoProfil)}}" data-lightbox="gambarProfil" data-title="Deskripsi Gambar">
                                  <img src="{{asset('fotoProfil/'.$fotoProfil)}}" alt="Profil Picture" style="width: 100%; height: 100%;">
                              </a>
                          @endif
                      @endif

                    </div>
                </a>
            
                <div class="simple-profile-details" style="flex: 1;">
                    <a href="{{ route('detailProfilVideoLP', ['id' => $video->id]) }}" style="text-decoration: none; color: inherit;">
                        <span class="simple-profile-name" style="color: #2c3e50; font-weight: bold; font-size: 1.2em; display: block; margin-bottom: 4px;">
                            {{ $video->uploader }}
                        </span>
                    </a>
            
                    <span style="color: #7f8c8d; font-weight: normal; font-size: 1em; display: block;">Uploader | {{$totalFollowers}} Followers</span>
                    <span style="color: #7f8c8d; font-weight: normal; font-size: 1em; display: block;">
                      <span style="color: gray;">{{ number_format($averageRating, 1) }}</span>
                      <span class="gold-star" data-rating="1">&#9733;</span></span>
                </div>
            
                  <a href="/login" style="text-decoration: none; color: inherit;">
                      <div class="simple-follow-button" style="background-color: #3498db; padding: 8px 16px; border-radius: 20px; cursor: pointer;">
                          <span style="color: #fff; font-weight: bold; font-size: 1em; display: block;">Follow</span>
                      </div>
                  </a>
              </div>
    
             <hr>
            
             
             <div class="float-right" style="margin-top: 10px;">
              <ul>
                  <li>
                      Dibuat: <span style="color: rgba(165, 165, 165, 1);">{{ \Carbon\Carbon::parse($video['created_at'])->format('l, d M Y H.i') }}</span><br>
                  </li>
                  <li>
                      Diperbarui: <span style="color: rgba(165, 165, 165, 1);">{{ \Carbon\Carbon::parse($video['updated_at'])->format('l, d M Y H.i') }}</span>
                  </li>
              </ul>
          </div>

          <span class="fh5co_tags_all">
            <a href="#" class="fh5co_tagg">{{ $video->kategoriVideo }}</a>
          </span>

        <ul class="list-inline">
          <li class="list-inline-item">
            <form action="/login" method="POST">
              @csrf
                <input type="hidden" name="video_id" value="{{ $video->id }}">
                <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    <i class="fa fa-plus" style="color: white;"></i> Simpan
                </button>
            </form>
        </li>          
          <li class="list-inline-item">
            <a href="/login" id="showModal" class="laporan-button" style="margin-left: 10px; color: #f44336; text-decoration: none; transition: color 0.3s;">
              <i class="fa fa-flag"></i> Laporkan
          </a>
        </li>        

        <span class="gold-star" data-rating="1">&#9733;</span><span style="color: gray;">{{ number_format($AvgVid, 1) }} ({{$totalRatingVid}} Rating)</span>

          </section>
          <span style="text-align: right">
              <p class="icon-bagikan" style="color: rgba(165, 165, 165, 1); display: flex; align-items: center; justify-content: end; gap: 0.5em;">
                  Share &nbsp;&nbsp;&nbsp;
                  <a href="https://www.facebook.com/sharer.php?u=https://www.example.com/post-url{{ $video->judulVideo }}">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Facebook_logo_%28square%29.png/640px-Facebook_logo_%28square%29.png" alt="Facebook" style="width: 32px; height: 32px;">
                  </a>
                  <a href="https://twitter.com/intent/tweet?url=https://www.example.com/post-url&text={{ $video->judulVideo }}">
                      <img src="https://seeklogo.com/images/T/twitter-x-logo-101C7D2420-seeklogo.com.png?v=638258862800000000" alt="Twitter" style="width: 32px; height: 32px;">
                  </a>
                  <a href="whatsapp://send?text={{ $video->judulVideo }}%20-%20https://www.example.com/post-url">
                      <img src="https://cdn4.iconfinder.com/data/icons/miu-square-flat-social/60/whatsapp-square-social-media-512.png" alt="WhatsApp" style="width: 32px; height: 32px;">
                  </a>
                  <a href="https://telegram.me/share/url?url=https://www.example.com/post-url&text={{ $video->judulVideo }}">
                      <img src="https://cdn3.iconfinder.com/data/icons/social-media-chamfered-corner/154/telegram-512.png" alt="Telegram" style="width: 32px; height: 32px;">
                  </a>
              </p>
          </span>
        </ul>

          <br>
          
          <iframe width="730" height="450" src="{{$video->linkVideo}}" frameborder="0" allowfullscreen style="border-radius: 3%;"></iframe>

          <div style="font-size: 18px; text-align: justify; margin-top: 20px;">
            <div style="font-size: 18px; line-height: 2;">
              {!! str_replace('<img', '<img style="max-width: 1152px; width: 100%; height: auto; display: block; margin: 0 auto;"', $video->deskripsiVideo) !!}
            </div>
          </div>

          <span class="fh5co_tags_all"> Tags : 
            @foreach(explode(',', $video->tagsVideo) as $tag)
                <a href="{{ route('TagsVideosLP', ['tag' => $tag]) }}" class="fh5co_tagg">{{ $tag }}</a>
            @endforeach
          </span>   

          <br>
          <br>
          <form id="ratingForm" action="/login" method="get">
          <div class="row">
            <div class="col-lg-6 offset-lg-0"> <!-- Tambahkan kelas offset-lg-1 untuk membuat margin kiri sebanyak 5 kolom -->
              <div class="card" style="width: 210%;"> <!-- Ubah margin-left menjadi padding -->
                <div class="card-body text-center">
                  <label for="rating">Berikan rating uploader dari video ini</label>
                  <div class="rating-penulis">
                    <span class="star" data-rating="1" title="Sangat Buruk">&#9733;</span>
                    <span class="star" data-rating="2" title="Buruk">&#9733;</span>
                    <span class="star" data-rating="3" title="Sedang">&#9733;</span>
                    <span class="star" data-rating="4" title="Baik">&#9733;</span>
                    <span class="star" data-rating="5" title="Sangat Baik">&#9733;</span>
                  </div>
                  <input type="hidden" name="rating" id="rating" value="0" required>
                  <div id="keterangan"></div>
                  <!-- Tombol submit awalnya disembunyikan -->
                  <div id="buttonContainer" style="text-align: center; display: none;">
                    <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      
          <br>
          <br>

          
        </div>


        <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
          <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Kategori</div>
        </div>
        <div class="clearfix"></div>
     
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

        <div>
          <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tags</div>
      </div>
      <div class="clearfix"></div>

      @php
          $uniqueTags = [];
      @endphp
      
      @foreach($tagsV as $item)
      @if (!in_array($item->tagsVideo, $uniqueTags))
          <?php
          $words = explode(",", $item->tagsVideo);
          foreach ($words as $word) {
              $trimmedWord = trim($word);
              if (!in_array($trimmedWord, $uniqueTags)) {
                  $uniqueTags[] = $trimmedWord;
                  echo '<span class="fh5co_tags_all"><a href="' . route("TagsVideosLP", $trimmedWord) . '" class="fh5co_tagg">' . $trimmedWord . '</a></span>';
              }
          }
          ?>
      @endif
  @endforeach


              
            <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">See More</div>
            <div class="row pb-3">
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
              ?>
              
              @foreach($boxVideo as $item)
              <?php
              $videoId = getYoutubeVideoId($item->linkVideo);
              $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg"; // Mengambil thumbnail maksimum resolusi
              ?>
              <div class="col-4 align-self-center mb-3">
                  <img src="<?php echo $thumbnail; ?>" width="120" height="59" alt="Thumbnail" style="border-radius: 5%;">
              </div>
              <div class="col-8 padding">
                  <div class="most_fh5co_trending_font"><a class="video-title" href="{{ route('showDetailLPVideo', ['id' => $item->id]) }}" >{{ \Illuminate\Support\Str::limit($item->judulVideo, 50) }}</a></div>
                  <div class="most_fh5co_trending_font_123">{{ \Carbon\Carbon::parse($item['created_at'])->format('l, d M Y H.i') }}</div>
              </div>
              @endforeach
              
            </div>            
        </div>
    </div>

      <input type="hidden" name="video_id" value="{{ $video->id }}"> 
      <label for="" style="font-size: 24px;"><strong>{{$totalKomentarV}} Komentar</strong></label><br>
      <label for="pesan" style="font-size: 24px;">Beri Komentar:</label><br>
      <textarea name="pesan" id="pesan" placeholder="Berikan Tanggapan Anda..." required style="width: 730px; height: 200px; border-radius: 10px;"></textarea><br>
      <div class="green-button">
          <a href="{{ route('showDetailLPVideo', ['id' => $item->id]) }}" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Kirim</a>
      </div>

  <br>


  @foreach ($komentarVideos as $komentar)
  <div class="card" style="max-width: 730px; margin-bottom: 10px;">
      <div class="card-body" style="display: flex;">
          <div class="profil-foto" style="margin-right: 10px;">
              <img src="{{ asset('fotoProfil/' . $komentar->user->fotoProfil) }}" alt="Foto Profil" style="border-radius: 50%; width: 50px; height: 50px;">

              @if($komentar->fotoProfil)
                @if(filter_var($komentar->user->fotoProfil, FILTER_VALIDATE_URL))
                    <a href="{{$komentar->user->fotoProfil}}" data-lightbox="fotoProfil" data-title="Deskripsi Gambar">
                        <img src="{{$komentar->user->fotoProfil}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                    </a>
                @else
                    <a href="{{asset('fotoProfil/'.$komentar->user->fotoProfil)}}" data-lightbox="fotoProfil" data-title="Deskripsi Gambar">
                        <img src="{{asset('fotoProfil/'.$komentar->user->fotoProfil)}}"  style="max-width: 100%; height: auto; border-radius: 14px">
                    </a>
                @endif
            @endif

          </div>
          <div style="flex: 1;">
            <h5 class="card-title" style="display: inline-block;">
              {{ $komentar->user->name }}
          </h5>
          @if($komentar->created_at->diffInDays(now()) <= 5)
          <div style="display: inline-block; background-color: #097BED; color: white; padding: 5px; border-radius: 5px; font-size: smaller;">
            <strong>Komentar Baru</strong>
        </div>                
      @endif
              <p>{{ $komentar->created_at->format('d F Y') }} | {{ $komentar->created_at->diffForHumans() }}</p>
              <p class="card-text" style="text-align: justify;">
                  {{ $komentar->pesan }}
              </p>
              <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 10px;">
                <div style="display: flex; align-items: center;">
                    <a href="/login" style="text-decoration: none; color: #333; display: inline-block; padding: 8px 15px; border: 2px solid #4CAF50; border-radius: 20px; background-color: #fff; transition: all 0.3s ease;" >
                        <i class="fa-regular fa-thumbs-up" style="color: #4CAF50; font-size: 15px;"></i>  
                        <span style="font-size: 16px; margin-left: 5px;">Like</span>
                    </a>
        
                  </div>
                  <div>
        
                        <a href="/login" class="showLaporanKomen" data-comment-id="" data-nama-dilaporkan="" data-user-id-dilaporkan="" style="margin-left: 10px; color: #f44336; text-decoration: none; transition: color 0.3s;">
                            <i class="fas fa-flag" style="font-size: 15px;"></i> Laporkan
                        </a>
        
                </div>
            </div>
          </div>
      </div>
  </div>
  @endforeach

  <div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($komentarVideos->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $komentarVideos->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                    </a>
                </li>
            @endif

            <!-- Display current page and total pages -->
            <li class="page-item disabled">
                <span class="page-link">
                    {{ $komentarVideos->currentPage() }} dari {{ $komentarVideos->lastPage() }}
                </span>
            </li>

            @if ($komentarVideos->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $komentarVideos->nextPageUrl() }}" rel="next" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>
      
</div>

      <br>
      <br>

          <div class="text-center">
            <div class="buttons" style="display: flex; justify-content: center; gap: 10px;">
                <div class="green-button">
                    <a href="/home">Kembali</a>
                </div>
                <div class="orange-button">
                    <a href="/ulasan">Ulasan</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

    <script src="{{ asset('assets/js/tabs.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <div class="gototop js-top">
      <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
          integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
          crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
          integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
          crossorigin="anonymous"></script>

    <!-- Parallax -->
    <script src="{{ asset('aset1/js/jquery.stellar.min.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('aset1/js/main.js') }}"></script>

<!-- Javascript Rating -->
<script>
  // Ambil elemen-elemen yang diperlukan
  const ratingPenulis = document.querySelectorAll('.star');
  const ratingInput = document.getElementById('rating');
  const keterangan = document.getElementById('keterangan');
  const submitBtn = document.getElementById('submitBtn'); // Tombol submit

  // Tambahkan event listener ke setiap bintang
  ratingPenulis.forEach(star => {
    star.addEventListener('click', function() {
      const ratingValue = parseInt(this.getAttribute('data-rating'));
      ratingInput.value = ratingValue; // Set nilai input rating
      
      // Tampilkan keterangan sesuai rating
      switch(ratingValue) {
        case 1:
          keterangan.innerText = "Sangat Buruk";
          break;
        case 2:
          keterangan.innerText = "Buruk";
          break;
        case 3:
          keterangan.innerText = "Sedang";
          break;
        case 4:
          keterangan.innerText = "Baik";
          break;
        case 5:
          keterangan.innerText = "Sangat Baik";
          break;
        default:
          keterangan.innerText = "";
      }
      
      // Tambahkan kelas checked ke bintang yang dipilih
      ratingPenulis.forEach(s => s.classList.remove('checked'));
      this.classList.add('checked');
      
      // Hapus kelas selected dari semua bintang
      ratingPenulis.forEach(s => s.classList.remove('selected'));
      
      // Tambahkan kelas selected ke bintang-bintang sebelumnya
      for (let i = 0; i < ratingValue; i++) {
        ratingPenulis[i].classList.add('selected');
      }

// Tampilkan tombol submit jika rating telah dipilih
submitBtn.style.display = 'block';

// Tampilkan tombol submit jika rating telah dipilih
document.getElementById('buttonContainer').style.display = 'block';


    });
  });
</script>
  

  </body>
</html>
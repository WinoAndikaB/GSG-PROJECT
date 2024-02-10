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
                      <li class="scroll-to-section"><a href="/" class="active">Artikel</a></li>
                      <li class="scroll-to-section"><a href="/landingPageVideo">Video</a></li>
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
              <h1 style="color: rgba(47, 72, 88, 1);">{{ $article->judulArtikel }}</h1><br>
            <div class="simple-profile-container" style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
              <a href="/login" style="text-decoration: none; color: inherit;">
                <div class="simple-profile-picture" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 2px solid #3498db;">
                    <img src="{{ asset('fotoProfil/' . $fotoProfil) }}" alt="Profil Picture" style="width: 100%; height: 100%;">
                </div>
            </a>
            

            <div class="simple-profile-details" style="flex: 1;">
                <a href="/login" style="text-decoration: none; color: inherit;">
                    <span class="simple-profile-name" style="color: #2c3e50; font-weight: bold; font-size: 1.2em; display: block; margin-bottom: 4px;">
                        {{ $article->penulis }}
                    </span>
                </a>

                <span style="color: #7f8c8d; font-weight: normal; font-size: 1em; display: block;">Penulis</span>
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
                        Dibuat: <span style="color: rgba(165, 165, 165, 1);">{{ \Carbon\Carbon::parse($article['created_at'])->format('l, d M Y H.i') }}</span><br>
                    </li>
                    <li>
                        Diperbarui: <span style="color: rgba(165, 165, 165, 1);">{{ \Carbon\Carbon::parse($article['updated_at'])->format('l, d M Y H.i') }}</span>
                    </li>
                </ul>
            </div>

          
          <span class="fh5co_tags_all">
            <a href="#" class="fh5co_tagg">{{ $article->kategori }}</a>
          </span>
          
            <ul class="list-inline">
              <li class="list-inline-item">
                <form action="/login" method="POST">
                    @csrf
                    <input type="hidden" name="artikel_id" value="{{ $article->id }}">
                    <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                        <i class="fa fa-plus" style="color: white;"></i> Simpan
                    </button>
                </form>
            </li>
            
              <li class="list-inline-item">
                <a href="/login" id="showModal" class="laporan-button">
                  <i class="fa fa-flag"></i> Laporkan
              </a>
            </li>        
          </ul>
          
          </section>
          <span style="text-align: right">
              <p class="icon-bagikan" style="color: rgba(165, 165, 165, 1); display: flex; align-items: center; justify-content: end; gap: 0.5em;">
                  Share &nbsp;&nbsp;&nbsp;
                  <a href="https://www.facebook.com/sharer.php?u=https://www.example.com/post-url{{ $article->judulArtikel }}">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Facebook_logo_%28square%29.png/640px-Facebook_logo_%28square%29.png" alt="Facebook" style="width: 32px; height: 32px;">
                  </a>
                  <a href="https://twitter.com/intent/tweet?url=https://www.example.com/post-url&text={{ $article->judulArtikel }}">
                      <img src="https://seeklogo.com/images/T/twitter-x-logo-101C7D2420-seeklogo.com.png?v=638258862800000000" alt="Twitter" style="width: 32px; height: 32px;">
                  </a>
                  <a href="whatsapp://send?text={{ $article->judulArtikel }}%20-%20https://www.example.com/post-url">
                      <img src="https://cdn4.iconfinder.com/data/icons/miu-square-flat-social/60/whatsapp-square-social-media-512.png" alt="WhatsApp" style="width: 32px; height: 32px;">
                  </a>
                  <a href="https://telegram.me/share/url?url=https://www.example.com/post-url&text={{ $article->judulArtikel }}">
                      <img src="https://cdn3.iconfinder.com/data/icons/social-media-chamfered-corner/154/telegram-512.png" alt="Telegram" style="width: 32px; height: 32px;">
                  </a>
              </p>
          </span>
          
          <img src="{{ asset('gambarArtikel/' . $article->gambarArtikel) }}" class="main-image" style="max-width: 100%; height: auto; margin-bottom: 20px;">

          <div style="font-size: 18px; text-align: justify; margin-top: 20px;">
            <div style="font-size: 18px; line-height: 2;">
              {!! str_replace('<img', '<img style="max-width: 1152px; width: 100%; height: auto; display: block; margin: 0 auto;"', $article->deskripsi) !!}
            </div>
          </div>
        </div>


          <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
            <div>
              <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Kategori</div>
          </div>
          <div class="clearfix"></div>

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

          <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tags</div>
        </div>
        <div class="clearfix"></div>

        @php
          $uniqueArtikel = [];
          @endphp

          @foreach($tags as $item)
              @if (!in_array($item->tags, $uniqueArtikel))
                  <span class="fh5co_tags_all">
                      <a href="#" class="fh5co_tagg">{{ $item->tags }}</a>
                  </span>
                  @php
                  $uniqueArtikel[] = $item->tags;
                  @endphp
              @endif
          @endforeach
                    
            <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
            <div class="row pb-3">
                @foreach($box as $item)
                <div class="col-5 align-self-center mb-3">
                    <img src="{{ asset('gambarArtikel/' . $item->gambarArtikel) }}" alt="img" class="fh5co_most_trading"/>
                </div>
                <div class="col-7 padding">
                    <div class="most_fh5co_trending_font"><a href="{{ route('showDetailLPArtikel', ['id' => $item->id]) }}">{{ $item->judulArtikel }}</a></div>
                    <div class="most_fh5co_trending_font_123">{{ \Carbon\Carbon::parse($item['created_at'])->format('l, d M Y H.i') }}</div>
                </div>
                @endforeach
            </div>            
        </div>
    </div>

    <span class="fh5co_tags_all"> Tags : 
      @foreach(explode(',', $article->tags) as $tag)
          <a href="#" class="fh5co_tagg">{{ $tag }}</a>
      @endforeach
    </span>

    <br>
    <br>
    <br>
    
      <input type="hidden" name="artikel_id" value="{{ $article->id }}"> 
      <label for="" style="font-size: 24px;"><strong>{{$totalKomentar}} Komentar</strong></label><br>
      <label for="pesan" style="font-size: 24px;">Beri Komentar:</label><br>
      <textarea name="pesan" id="pesan" placeholder="Berikan Tanggapan Anda..." style="width: 730px; height: 200px; border-radius: 10px;"></textarea><br>
      <div class="green-button">
        <a href="/login" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Kirim</a>
      </div>
  
      <br>
      @foreach ($detailArtikelLP as $komentar)
      <div class="card" style="max-width: 730px; margin-bottom: 10px;">
          <div class="card-body" style="display: flex;">
              <div class="profil-foto" style="margin-right: 10px;">
                  <img src="{{ asset('fotoProfil/' . $user->fotoProfil) }}" alt="Foto Profil" style="border-radius: 50%; width: 50px; height: 50px;">
              </div>
              <div style="flex: 1;">
                  <h5 class="card-title">{{ $komentar->user->name }}</h5>
                  <p>{{ $komentar->created_at->format('d F Y') }} | {{ $komentar->created_at->diffForHumans() }}</p>
                  <p class="card-text" style="text-align: justify;">
                      {{ $komentar->pesan }}
                  </p>
                  <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 10px;">
                    <div style="display: flex; align-items: center;">
                        <a href="/login" style="text-decoration: none; color: #333; display: inline-block; padding: 8px 15px; border: 2px solid #4CAF50; border-radius: 20px; background-color: #fff; transition: all 0.3s ease;" >
                            <i class="fas fa-thumbs-up" style="color: #4CAF50; font-size: 15px;"></i>  
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
                @if ($detailArtikelLP->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&lsaquo;</span>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $detailArtikelLP->previousPageUrl() }}" rel="prev" aria-label="Previous">
                            <span aria-hidden="true">&lsaquo;</span>
                        </a>
                    </li>
                @endif
    
                <!-- Display current page and total pages -->
                <li class="page-item disabled">
                    <span class="page-link">
                        {{ $detailArtikelLP->currentPage() }} dari {{ $detailArtikelLP->lastPage() }}
                    </span>
                </li>
    
                @if ($detailArtikelLP->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $detailArtikelLP->nextPageUrl() }}" rel="next" aria-label="Next">
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
                    <a href="/">Kembali</a>
                </div>
                <div class="orange-button">
                    <a href="/ulasanLandingPage">Ulasan</a>
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
  

  </body>
</html>
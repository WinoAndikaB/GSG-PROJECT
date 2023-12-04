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
  
  </head>
<body>

  <header class="header-area header-sticky" style="text-align: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
              <nav class="main-nav">
                <ul class="nav">
                    <li class="scroll-to-section"><a href="/homeP">Home</a></li>
                    <li class="scroll-to-section"><a href="/homeP">Artikel</a></li>
                    <li class="scroll-to-section"><a href="/VideoP" class="active">Video</a></li>
                    <li class="scroll-to-section"><a href="/kategoriP">Kategori</a></li>
                    <li class="scroll-to-section"><a href="/eventP">Event</a></li>
                    <li class="scroll-to-section"><a href="/ulasanP">Ulasan</a></li>
                    <li class="scroll-to-section"><a href="/aboutP">Tentang</a></li>
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
                            <center>
                              <a class="dropdown-item" href="#" style="background-color: lightblue; display: block; text-align: center;">
                                  {{ Auth::user()->role }}
                              </a>
                              <a class="dropdown-item" href="/profileP">Profil Anda</a>
                              <a class="dropdown-item" href="/simpanArtikelViewP">Artikel Tersimpan</a>
                              <a class="dropdown-item" href="/simpanVideoViewP">Video Tersimpan</a>
                            </center>
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
            <h2>Detail Video</h2>
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
              <h1 style="color: rgba(47, 72, 88, 1);">{{ $video->judulVideo }}</h1><br>
              
          <div class="simple-profile-container" style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
            <a href="/profilPenulis" style="text-decoration: none; color: inherit;">
                <div class="simple-profile-picture" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 2px solid #3498db;">
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
            </a>
        
            <div class="simple-profile-details" style="flex: 1;">
                <a href="/profilPenulis" style="text-decoration: none; color: inherit;">
                    <span class="simple-profile-name" style="color: #2c3e50; font-weight: bold; font-size: 1.2em; display: block; margin-bottom: 4px;">
                        {{ $video->uploader }}
                    </span>
                </a>
        
                <span style="color: #7f8c8d; font-weight: normal; font-size: 1em; display: block;">Uploader</span>
            </div>
        
              <a href="/profilPenulis" style="text-decoration: none; color: inherit;">
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
          
            <br>
            <br>

          <ul class="list-inline">
            <li class="list-inline-item">
              <form action="{{ route('simpan.videoData', ['videoId' => $video->id]) }}" method="POST">
                @csrf
                  <input type="hidden" name="video_id" value="{{ $video->id }}">
                  <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                      <i class="fa fa-plus" style="color: white;"></i> Simpan
                  </button>
              </form>
          </li>          
            <li class="list-inline-item">
              <a href="#" id="showModal" class="laporan-button">
                <i class="fa fa-flag"></i> Laporkan
            </a>
          </li>        
        </ul>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @elseif(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
      @endif
  
    <br>

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

          <br>
          
          <iframe width="730" height="450" src="{{$video->linkVideo}}" frameborder="0" allowfullscreen></iframe>

          <div style="font-size: 18px; text-align: justify; margin-top: 20px;">
            <div style="font-size: 18px; line-height: 2;">
              {!! str_replace('<img', '<img style="max-width: 1152px; width: 100%; height: auto; display: block; margin: 0 auto;"', $video->deskripsiVideo) !!}
            </div>
          </div>
          
          @foreach(explode(',', $video->tagsVideo) as $tag)
          <span class="fh5co_tags_all"> Tags :
              <a href="#" class="fh5co_tagg">{{ $tag }}</a>
          </span>
      @endforeach
        </div>


        <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
          <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Kategori</div>
        </div>
        <div class="clearfix"></div>
        
        @php
        $uniqueCategories = [];
        @endphp
        
        @foreach($kategoriLogV as $item)
            @if (!in_array($item->kategori, $uniqueCategories))
                <span class="fh5co_tags_all">
                    <a href="" class="fh5co_tagg">{{ $item->kategori }}</a>
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
      $uniqueVideo = [];
      @endphp

      @foreach($tagsV as $item)
          @if (!in_array($item->tagsVideo, $uniqueVideo))
          <span class="fh5co_tags_all">
              <a href="#" class="fh5co_tagg">{{ $item->tagsVideo }}</a>
          </span>
          @php
          $uniqueVideo[] = $item->tagsVideo;
          @endphp
      @endif
      @endforeach

              
            <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
            <div class="row pb-3">
                @foreach($boxVideo as $item)
                <div class="col-4 align-self-center mb-3">
                  <iframe width="120" height="100" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-8 padding">
                    <div class="most_fh5co_trending_font"><a href="{{ route('showDetailVideo', ['id' => $item->id]) }}">{{ $item->judulVideo }}</a></div>
                    <div class="most_fh5co_trending_font_123">{{ \Carbon\Carbon::parse($item['created_at'])->format('l, d M Y H.i') }}</div>
                </div>
                @endforeach
            </div>            
        </div>
    </div>

    <form action="/komentarVideo" method="post">
      @csrf
      <input type="hidden" name="video_id" value="{{ $video->id }}"> 
      <label for="" style="font-size: 24px;"><strong>{{$totalKomentarVideo}} Komentar</strong></label><br>
      <label for="pesan" style="font-size: 24px;">Beri Komentar:</label><br>
      <textarea name="pesan" id="pesan" placeholder="Berikan Tanggapan Anda..." required style="width: 730px; height: 200px; border-radius: 10px;"></textarea><br>
      <div class="green-button">
          <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Kirim</button>
      </div>
  </form>

  <br>


  @foreach ($komentarVideos as $komentar)
  <div class="card" style="max-width: 730px; margin-bottom: 10px;"> 
      <div class="card-body" style="display: flex;">
          <div class="profil-foto" style="margin-right: 10px;">
              <img src="{{ asset('fotoProfil/' . $komentar->user->fotoProfil) }}" alt="Foto Profil" style="border-radius: 50%; width: 50px; height: 50px;">
          </div>
          <div style="flex: 1;">
              <h5 class="card-title">{{ $komentar->user->name }}</h5>
              <p>{{ $komentar->created_at->format('d F Y') }} | {{ $komentar->created_at->diffForHumans() }}</p>
              <p class="card-text" style="text-align: justify;">
                  {{ $komentar->pesan }}
              </p>
              <div style="align-items: right; margin-top: 2px; margin-bottom: 10px;">
                  <a href="like_action.html">
                      <i class="fa fa-thumbs-up"></i> Like
                  </a>

                 @if(Auth::check() && Auth::user()->id == $komentar->user_id)
                    <a href="{{ route('deleteKomentarVideo', ['id' => $komentar->id]) }}">
                        <i class="fas fa-trash"></i>Hapus
                    </a>
                  @endif
      
                  @if(Auth::check() && Auth::user()->id != $komentar->user_id)
                  <a href="#" class="showLaporanKomen" data-comment-id="{{ $komentar->id }}" data-nama-dilaporkan="{{ $komentar->user->name }}" data-user-id-dilaporkan="{{ $komentar->user->id }}">
                    <i class="fa fa-flag"></i> Laporkan
                </a>
                @endif
      
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

  <div id="modalLaporan" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 1;">
    <div style="background-color: #ffffff; border-radius: 10px; text-align: center; padding: 20px; width: 600px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
      <span style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 20px;" id="closeLaporan">&times;</span>
      <h2 style="color: #007bff; font-size: 24px;">Laporkan Video</h2>
      <form id="reportForm">
        <div style="text-align: left;">
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Konten Seksual"> Konten Seksual</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Konten kekerasan atau menjijikkan"> Konten kekerasan atau menjijikkan</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Konten kebencian atau pelecehan"> Konten kebencian atau pelecehan</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Pelecehan atau penindasan"> Pelecehan atau penindasan</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Tindakan merugikan atau berbahaya"> Tindakan merugikan atau berbahaya</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Misinformasi"> Misinformasi</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Pelecehan terhadap anak"> Pelecehan terhadap anak</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Mendukung terorisme"> Mendukung terorisme</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Spam atau menyesatkan"> Spam atau menyesatkan</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Masalah hukum"> Masalah hukum</label><br>
          <label style="font-size: 16px;"><input type="radio" name="reason" value="Teks bermasalah"> Teks bermasalah</label><br>
        </div><br>
        <textarea id="reportTextLaporan" style="width: 100%; padding: 10px; font-size: 16px;" placeholder="Kenapa Anda melaporkan artikel ini?"></textarea><br>
        <button type="submit" class="submit-buttonLaporan" style="background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; padding: 10px 20px; font-size: 18px;">Kirim Laporan</button>
      </form>
      <div style="text-align: left; padding: 10px;">
        <p style="font-size: 14px;">Video dan pengguna yang dilaporkan akan ditinjau oleh staf kami untuk menentukan apakah video dan pengguna tersebut melanggar Pedoman kami atau tidak. Akun akan dikenai sanksi jika melanggar Pedoman Komunitas, dan pelanggaran serius atau berulang dapat berakibat pada penghentian akun.</p>
      </div>
    </div>
  </div>

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

       <!-- Laporkan Modal -->
       <script>
        // Get the modal and close button elements
        var modal = document.getElementById("modalLaporan");
        var showModalButton = document.getElementById("showModal");
        var closeButton = document.getElementById("closeLaporan");
    
        // Show the modal when the laporan-button is clicked
        showModalButton.addEventListener("click", function(event) {
          event.preventDefault();
          modal.style.display = "block";
        });
    
        // Close the modal when the close button is clicked
        closeButton.addEventListener("click", function() {
          modal.style.display = "none";
        });
    
        // Close the modal when the user clicks outside of it
        window.addEventListener("click", function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        });
    
        // Submit the form
    document.getElementById("reportForm").addEventListener("submit", function(event) {
      event.preventDefault();
      
      // Mengambil nilai yang dipilih dari radio button
      var selectedReason = document.querySelector('input[name="reason"]:checked');
      if (!selectedReason) {
        alert("Pilih alasan laporan terlebih dahulu.");
        return;
      }
      
      // Mengambil alasan laporan dan artikel_id dari elemen form
      var alasan = document.getElementById("reportTextLaporan").value;
      var videoId = {{ $video->id }};

  
      // Kirim data laporan ke server melalui AJAX
      $.ajax({
        type: "POST",
        url: "/submitV/reportV", // Ganti dengan URL yang sesuai
        data: {
          _token: "{{ csrf_token() }}",
          user_id: {{ Auth::user()->id }}, // Ganti dengan user_id yang sesuai
          video_id: videoId,
          laporan: selectedReason.value,
          alasan: alasan,
        },
        success: function(response) {
          // Tindakan setelah pengiriman berhasil
          alert("Laporan telah dikirim!");
          modal.style.display = "none"; // Tutup modal
        },
        error: function(error) {
          // Tindakan jika ada kesalahan
          alert("Terjadi kesalahan saat mengirim laporan.");
        }
      });
    });
      </script>
     
  </body>
</html>
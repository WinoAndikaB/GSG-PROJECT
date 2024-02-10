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

    <title>Profil Penulis -  Katakey</title>

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
  body {
      font-family: 'Poppins', sans-serif;
      text-align: center;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
  }

  .profile-container {
      max-width: 800px; /* Adjust the max-width to your desired size */
      margin: auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
  }

  .profile-name {
      font-size: 2em;
      font-weight: bold;
      margin-bottom: 10px;
      color: #3498db;
  }

  .about-section {
      margin-bottom: 20px;
      color: #555;
  }

  .social-media-links {
      margin-bottom: 20px;
      color: #555;
  }

  .social-media-links a {
      margin: 0 15px;
      text-decoration: none;
      color: #3498db;
      transition: color 0.3s ease;
  }

  .followers-likes {
      font-size: 1.2em;
      color: #555;
      margin-bottom: 20px;
  }

  .articles-section {
      text-align: left;
  }

  .article-card {
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      transition: transform 0.3s ease;
  }

  .article-card:hover {
      transform: scale(1.02);
  }

  .fab {
      font-size: 1.5em;
      margin-right: 5px;
  }
</style>

<title>Profil Penulis - Katakey</title>

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
          <h2>Profile Penulis</h2>
          <div class="div-dec"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<br>

<div class="section">
  <br>
  <div class="container">
      <div class="row">
          <div class="col-md-4 w-100"> <!-- Tambahkan kelas w-100 di sini -->
              <div class="card">
                  <br>
                  <div>
                      <div style="width: 120px; height: 120px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
                          <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('fotoProfil/' . $fotoProfil) }}" alt="Foto Profil">
                      </div>

                      <div class="profile-name text-center">
                          {{ $profilPenulis->uploader }}
                      </div>

                      <div class="text-center">
                          <span style="margin-right: 10px;"><b>{{ $TotalArtikelId }}</b> Artikel</span>
                          <span style="margin-right: 10px;"><b>{{ $TotalVideoId }}</b> Video</span>
                          <span style="margin-right: 10px;"><b>{{ $totalFollowers }}</b> Followers</span>
                      </div>

                      <br>

                      <div class="social-media-links text-center">
                          <a href="{{ $user->facebook }}" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                          <a href="{{ $user->instagram }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                      </div>

                      @auth
                      @if(auth()->user()->isNot($user))
                      <div class="social-media-links text-center">
                          <a href="#" id="followButton" class="btn btn-info" style="color: white; font-weight: bold; background-color: #3498db; padding: 8px 16px; border-radius: 20px; cursor: pointer;">
                              <span id="followText" style="font-size: 1em;">{{ auth()->user()->isFollowing($user) ? 'Following' : 'Follow' }}</span>
                          </a>
                      </div>
                      @endif
                      @endauth


                      <hr>

                      <div class="about-section text-center">
                          <p>{{$user->aboutme }}</p>
                      </div>

                  </div>
              </div>
          </div>

          <div class="col-md-4 w-100">
            <div class="card card-user" style="border: 2px solid #00bcd4; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(45deg, #0f4c75, #3282b8); color: #fff; text-align: center; border-radius: 10px 10px 0 0; padding: 15px;">
                    <h5 style="margin-bottom: 0; font-size: 1.5em; color: #fff;"> Daftar Artikel </h5>
                </div>
                <div class="card-body" style="max-height: 700px; overflow-y: auto;">
                    @foreach ($semuaArtikel as $artikel)
                    <div class="row" style="text-align: justify">
                        <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('gambarArtikel/'.$artikel->gambarArtikel) }}" style="max-width: 100%; height:  150%; border-radius: 14px;">
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                            <a href="{{ route('showDetailLPArtikel', ['id' => $artikel->id]) }}" style="color: #d47500;">
                                <h4 class="header-name" style="text-align: left; font-size: 1.2em;">📖 {{ $artikel->judulArtikel }}</h4>
                                <span class="d-flex"><b>{{ $artikel->created_at->format('l, d M Y') }}</b></span>
                            </a>
                            <p>{!! substr(strip_tags($artikel->deskripsi), 0, 100) . (strlen(strip_tags($artikel->deskripsi)) > 400 ? '...' : '') !!}</p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        

          <div class="col-md-4 w-100"> <!-- Tambahkan kelas w-100 di sini -->
              <div class="card card-user" style="border: 2px solid #00bcd4; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <div class="card-header" style="background: linear-gradient(45deg, #0f4c75, #3282b8); color: #fff; text-align: center; border-radius: 10px 10px 0 0; padding: 15px;">
                      <h5 style="margin-bottom: 0; font-size: 1.5em; color: #fff;"> Daftar Video </h5>
                  </div>
                  <div class="card-body">
                      @foreach ($semuaVideo as $video)
                      <div class="row" style="text-align: justify">
                          <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                              <div class="d-flex justify-content-center ml-5"> <!-- Tambahkan kelas ml-5 di sini -->
                                  <iframe width="50" height="50" src="{{ $video->linkVideo }}" frameborder="0" allowfullscreen></iframe>
                              </div>

                          </div>
                          <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                              <a href="{{ route('showDetailLPVideo', ['id' => $video->id]) }}" style="color: #d47500;">
                                  <h4 class="header-name" style="text-align: left; font-size: 1.2em;">▶️ {{ $video->judulVideo }}</h4>
                                  <span class="d-flex"><b>{{ $video->created_at->format('l, d M Y') }}</b></span>
                              </a>
                              <p>{!! substr(strip_tags($artikel->deskripsi), 0, 100) . (strlen(strip_tags($video->deskripsi)) > 400 ? '...' : '') !!}</p>
                          </div>
                      </div>
                      <hr>
                      @endforeach
                  </div>
              </div>
          </div>

      </div>
  </div>
</div>


<!----------------------------------------------------------------------------------- Modal Area -------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------- Modal Area -------------------------------------------------------------------------------------------->

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

      <!-- Modal Unfollow -->
<div class="modal fade" tabindex="-1" role="dialog" id="unfollowModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Unfollow Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Are you sure you want to unfollow?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id="confirmUnfollow">Unfollow</button>
          </div>
      </div>
  </div>
</div>


<!----------------------------------------------------------------------------------- Javascript Area -------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------- Javascript Area -------------------------------------------------------------------------------------------->

<!-- Slider Video Artikel -->
  <script>
    function showContent(contentType) {
      const articlesSection = document.querySelector('.articles-section');
      const articleContainer = document.querySelector('.article-container');

      // Toggle display based on content type
      if (contentType === 'articles') {
        articleContainer.style.transform = 'translateX(0%)';
      } else if (contentType === 'videos') {
        articleContainer.style.transform = 'translateX(-100%)';
      }
    }
  </script>

<!--------------------------------------------------------------------------------------- Javascript Followers ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Followers ------------------------------------------------------------------------------->

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shC65g+0n3E0yfFilaFIBw5TO7wGvzD0F1Dz0" crossorigin="anonymous"></script>

<script>
    var followButton = document.getElementById('followButton');
    if (followButton) {
        followButton.addEventListener('click', function () {
            var followText = document.getElementById('followText');
            var isFollowing = followText.textContent.trim() === 'Following';
            
            if (isFollowing) {
                $('#unfollowModal').modal('show');
            } else {
                toggleFollow({{ $user->id }});
            }
        });
    }

    document.getElementById('confirmUnfollow').addEventListener('click', function () {
        $('#unfollowModal').modal('hide');
        toggleFollow({{ $user->id }});
    });

    function toggleFollow(userId) {
        var followText = document.getElementById('followText');
        var isFollowing = followText.textContent.trim() === 'Following';

        var method = isFollowing ? 'DELETE' : 'POST';
        var url = isFollowing ? '/unfollow/' + userId : '/follow/' + userId;

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                if (isFollowing) {
                    followText.textContent = 'Follow';
                } else {
                    followText.textContent = 'Following';
                }
            } else {
                console.error('Error:', data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>


<!--------------------------------------------------------------------------------------- Javascript Modal Logout ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Modal Logout ------------------------------------------------------------------------------->

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

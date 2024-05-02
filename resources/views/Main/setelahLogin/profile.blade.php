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
  /* Notificaton */
  .scrollable-menu {
  max-height: 600px; /* Set the max height you want */
  overflow-y: auto; /* Enable vertical scrolling */
}
</style>

<title>Profil - Katakey</title>

<header class="header-area header-sticky" style="text-align: center;">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-12">
            <nav class="main-nav">
              <ul class="nav">
                  <li class="scroll-to-section"><a href="/home">Home</a></li>
                  <li class="scroll-to-section"><a href="/home">Artikel</a></li>
                  <li class="scroll-to-section"><a href="/Video">Video</a></li>
                  <li class="scroll-to-section"><a href="/kategori">Kategori</a></li>
                  <li class="scroll-to-section"><a href="/ulasan">Ulasan</a></li>
                  <li class="scroll-to-section"><a href="/about">Tentang</a></li>
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
          <h2>Profile</h2>
          <div class="div-dec"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<body class="landing-page sidebar-collapse">
  <div class="wrapper">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-7">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                      <h3 class="text-center font-weight-light my-4">Edit Profile Anda</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('updateUser', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')

                      <div class="form-group">
                          <label class="small mb-1" for="inputRole">Role</label>
                          <input class="form-control py-4" id="inputRole" type="text" placeholder="Role" disabled value="{{ Auth::user()->role }}">
                      </div>

                      <div class="form-group">
                          <label class="small mb-1" for="inputUsername">Username</label>
                          <input class="form-control py-4" id="inputUsername" type="text" placeholder="Username" disabled value="{{ Auth::user()->username }}">
                      </div>

                      <div class="form-group">
                          <label class="small mb-1" for="inputEmail">Email</label>
                          <input class="form-control py-4" id="inputEmail" type="email" placeholder="Email" disabled value="{{ Auth::user()->email }}">
                      </div>

                      <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="small mb-1" for="inputFotoFile">Upload Foto (File)</label>
                                <input class="form-control-file py-4" id="inputFoto" type="file" name="fotoProfil" onchange="toggleInput('file')">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="small mb-1" for="inputFotoURL">Upload Foto (URL)</label>
                                <input class="form-control" id="inputFoto" type="text" name="fotoProfil" onchange="toggleInput('url')">
                            </div>
                        </div>
                    </div>
                    

                      <div class="form-group">
                          <label class="small mb-1" for="inputName">Nama</label>
                          <input class="form-control py-4" id="inputName" type="text" placeholder="Nama" name="name" value="{{ Auth::user()->name }}">
                      </div>

                      <div class="form-group">
                          <label class="small mb-1" for="inputAlamat">Alamat</label>
                          <input class="form-control py-4" id="inputAlamat" type="text" placeholder="Alamat" name="alamat" value="{{ Auth::user()->alamat }}">
                      </div>

                      <div class="form-group">
                          <label class="small mb-1" for="inputInstagram">Instagram</label>
                          <input class="form-control py-4" id="inputInstagram" type="text" placeholder="Instagram" name="instagram" value="{{ Auth::user()->instagram }}" pattern="https?://(www\.)?instagram\.com/.+">
                          <small>Format Penulisan: https://www.instagram.com/goodgamestoreid/</small>
                      </div>

                      <div class="form-group">
                          <label class="small mb-1" for="inputFacebook">Facebook</label>
                          <input class="form-control py-4" id="inputFacebook" type="text" placeholder="Facebook" name="facebook" value="{{ Auth::user()->facebook }}" pattern="https?://(www\.)?facebook\.com/.+">
                          <small>Format Penulisan: https://www.facebook.com/goodgamestoreid/</small>
                      </div>

                      <div class="form-group">
                          <label class="small mb-1" for="inputAboutMe">About Me</label>
                          <textarea class="form-control py-4" id="inputAboutMe" rows="4" placeholder="Tentang Saya" name="aboutme">{{ Auth::user()->aboutme}}</textarea>
                      </div>

                      <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-secondary" href="/home">Kembali</a>
                      </div>
                  </form>
                  </div>
              </div>
          </div>
  
          <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                      <h3 class="text-center font-weight-light my-4">Profil Anda</h3>
                  </div>
                  <div class="card-body">
                      <div class="text-center">
                        <img src="<?php
                              $fotoProfil = Auth::user()->fotoProfil;
                              if ($fotoProfil) {
                                  if (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                                      // Jika fotoProfil adalah URL, gunakan langsung URL tersebut
                                      echo $fotoProfil;
                                  } else {
                                      // Jika fotoProfil adalah nama file, cek apakah file tersebut ada
                                      $pathToFile = public_path('fotoProfil/' . $fotoProfil);
                                      if (file_exists($pathToFile)) {
                                          echo asset('fotoProfil/' . $fotoProfil);
                                      } else {
                                          // Jika file tidak ada, tampilkan foto default
                                          echo asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999');
                                      }
                                  }
                              } else {
                                  // Jika fotoProfil kosong, tampilkan foto default
                                  echo asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999');
                              }
                          ?>" alt="User's Profile Picture" class="rounded-circle" style="width: 150px; height: 150px;">

                    
                          <h5 class="mt-3">{{Auth::user()->name}}</h5>
                          <span class="text-muted">{{Auth::user()->username}}</span>
                          <p class="text-muted">{{Auth::user()->email}}</p>
                          <hr>
                          <p>
                            <i class="fas fa-calendar"></i> Bergabung pada {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d F, Y') }}
                        </p>
                        <p>
                            <a href="{{ route('profileFollowing', ['follower_id' => auth()->id()]) }}">
                                <i class="fas fa-user-friends"></i> <b>{{ $followerCount }}</b> Following
                            </a>
                        </p>

                          <hr>
                      </div>

               
  
                      <p class="text-muted" title="{{ Auth::user()->aboutme }}">
                        {{ \Illuminate\Support\Str::limit(Auth::user()->aboutme, 600) }}
                    </p>
                    
  
                      <div class="button-container text-center">
                          <a href="{{Auth::user()->facebook}}" class="btn btn-info btn-lg btn-block" target="_blank">
                              <i class="fab fa-facebook-f"></i> Facebook
                          </a>
                          <a href="{{Auth::user()->instagram}}" class="btn btn-danger btn-lg btn-block" target="_blank">
                              <i class="fab fa-instagram"></i> Instagram
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  

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

<!--------------------------------------------------------------------------------------- Javascript Upload Foto ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Upload Foto ------------------------------------------------------------------------------->


<script>
  function toggleInput(type) {
      var inputs = document.querySelectorAll('#inputFoto');
      
      if (type === 'file') {
          inputs.forEach(function(input) {
              if (input.type === 'file') {
                  input.disabled = false;
              } else {
                  input.disabled = true;
                  input.value = ''; // Clear the URL input
              }
          });
      } else if (type === 'url') {
          inputs.forEach(function(input) {
              if (input.type === 'file') {
                  input.disabled = true;
                  input.value = ''; // Clear the file input
              } else {
                  input.disabled = false;
              }
          });
      }
  }
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

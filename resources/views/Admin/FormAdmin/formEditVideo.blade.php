<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
  <title>
    Form Edit Video | KataKey
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets2/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets2/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

  <!-- Dynamic Tags -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Dynamic Tags CSS and JS files -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <div class="d-flex px-2 py-1">
          <div>
            <img src="{{ asset('assets/img/lg1.png') }}" class="avatar avatar-sm me-3" alt="user1" width="2" height="2">
          </div>
          <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm">KataKey</h6>
            <p class="text-xs text-secondary mb-0">Halaman Admin</p>
          </div>
        </div>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/profileAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-badge text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/dashboard">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/artikelAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Artikel
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruArtikel + $dataBaruKomentarArtikel}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/videoAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Video
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruVideo + $dataBaruKomentarVideo}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/laporanUser">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-sound-wave text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan User 
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruLaporanArtikel + $dataBaruLaporanVideo}}</span> 
            </span>
          </a>
        </li>
      </ul>
    </div>

  <div class="sidenav-footer mx-3 ">     
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Video</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Form Edit Video </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="/profileSA" class="nav-link text-white font-weight-bold px-0">
                  <i>
                      <?php
                      $fotoProfil = Auth::user()->fotoProfil;
                      if ($fotoProfil && file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                      ?>
                      <img src="{{ asset('fotoProfil/' . $fotoProfil) }}" alt="User's Profile Picture" width="50" height="50" style="border-radius: 50%; overflow: hidden;">
                      <?php
                      } else {
                      ?>
                      <img src="{{ asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') }}" alt="User's Profile Picture" width="50" height="50" style="border-radius: 50%; overflow: hidden;">
                      <?php
                      }
                      ?>
                  </i>
                  <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span> |
                  <a href="#" class="d-sm-inline d-none text-white text-bold" id="logout-link" onclick="openModal()"> Logout</a>
              </a>
          </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

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
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Form Edit Video</h6>

              <form action="/formEditVideoA/updateVideoA/{{$data->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="" class="form-control-label">Link Video</label>
                  <input class="form-control" type="text" id="uploadGambar" name="linkVideo" value="{{ $data->linkVideo }}" required>
                  <br>
                  <iframe width="340" height="190" src="{{$data->linkVideo}}" frameborder="0" allowfullscreen></iframe>
              </div>    
                  <div class="form-group">
                      <label for="judulArtikel">Judul Video</label>
                      <input type="text" class="form-control" type="textarea" name="judulVideo"" value="{{ $data->judulVideo }}" required>
                    </div>
                      <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                </div>
                  <div class="form-group">
                      <label for="penulis">Penulis</label>
                      <input type="text" class="form-control" id="penulis" name="penulis" value="{{ Auth::user()->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        @foreach($kategoris as $item)
                            <option value="{{ $item->kategori }}" @if($item->kategori == $data->kategori) selected @endif>{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                  <div class="form-group">
                    <label for="tagsVideo">Tags</label>
                    <select class="form-control" id="tagsVideo" name="tagsVideo[]" multiple="multiple">
                        @if($data->tagsVideo)
                            @foreach(explode(',', $data->tagsVideo) as $tag)
                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                  <div class="form-group">
                    <label for="" class="form-control-label">Deskirpsi</label>
                    <textarea class="form-control" type="text" name="deskripsiVideo" id="editor">{{ $data->deskripsiVideo }}</textarea>
                  </div>
                  <button type="button" onclick="validateForm()" class="btn btn-primary mt-3">Edit</button>
                  <a href="/videoAdmin" class="btn btn-info mt-3">Kembali</i></a>
              </form>

            <div class="card-body px-0 pt-12 pb-2">
              <div class="table-responsive p-0">
                <div class="panel-header panel-header-sm">
                </div>
                <div class="content">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="card-body ">
                          <div id="map" class="map"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets2/js/core/popper.min.js"></script>
  <script src="../assets2/js/core/bootstrap.min.js"></script>
  <script src="../assets2/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets2/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets2/js/plugins/chartjs.min.js"></script>

<!--  Dynamic Tags Video -->
  <script>
    $(document).ready(function () {
        $('#tagsVideo').select2({
            tags: true,
            tokenSeparators: [',', ' '], // Allow comma or space to separate tags
            placeholder: 'Choose tags',
        });
    });
</script>


<!--  CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');

  async function fetchBadWords(input) {
    const apiKey = "O3A8ZvNyKn89WPtIBt4Kf0XccNCytF0T";
    const apiUrl = "https://api.apilayer.com/bad_words?censor_character=";

    const myHeaders = new Headers();
    myHeaders.append("apikey", apiKey);

    const requestOptions = {
      method: 'POST',
      redirect: 'follow',
      headers: myHeaders,
      body: input
    };

    try {
      const response = await fetch(apiUrl + input, requestOptions);
      if (!response.ok) {
        throw new Error('Failed to fetch bad words');
      }

      const result = await response.text();
      return result;
    } catch (error) {
      console.error('Error fetching bad words:', error);
      return null;
    }
  }

  async function validateForm() {
    const errorMessageDiv = document.getElementById('error-message');
    errorMessageDiv.innerHTML = ''; // Reset pesan kesalahan sebelum validasi

    // Validasi penggunaan kata tidak pantas pada deskripsi
    const deskripsiInput = CKEDITOR.instances.editor.getData();
    const deskripsiValue = deskripsiInput.toLowerCase();

    try {
      console.log('Deskripsi sebelum validasi:', deskripsiValue);

      const result = await fetchBadWords(deskripsiValue);
      console.log('Respon dari API:', result);

      if (result) {
        errorMessageDiv.innerHTML += `<p class="text-white">${result}</p>`;
      }
    } catch (error) {
      console.error('Error validating description:', error);
    }

    // Jika ada pesan kesalahan, tampilkan di bawah judul "Tambah Artikel"
    if (errorMessageDiv.innerHTML !== '') {
      errorMessageDiv.style.display = 'block';
    } else {
      // Jika semua validasi berhasil, formulir akan dikirimkan
      document.querySelector('form').submit();
    }
  }
</script>

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
</html>
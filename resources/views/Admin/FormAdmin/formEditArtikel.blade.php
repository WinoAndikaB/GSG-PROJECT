<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
  <title>
    Form Edit Artikel | KataKey
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


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
      width: 40%;
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
<!-- Alert Standar Ketentuan -->
<style>
  #error-message {
    display: none;
    background-color: #dc3545; /* Warna latar belakang merah */
    color: #fff; /* Warna teks putih */
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
    animation: fadeIn 0.5s ease-in-out; /* Animasi fade-in selama 0.5 detik */
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
</style>

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
          <a class="nav-link active" href="/artikelAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Artikel
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruArtikel + $dataBaruKomentarArtikel}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/videoAdmin">
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Artikel</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Form Edit Artikel </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <div class="dropdown">
                <a href="#" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                  <i>
                    <?php
                    $fotoProfil = Auth::user()->fotoProfil;
                    $gambarPath = null;
                    
                    if ($fotoProfil && file_exists(public_path('fotoProfil/' . $fotoProfil))) {
                        // Jika file fotoProfil ada di direktori fotoProfil
                        $gambarPath = asset('fotoProfil/' . $fotoProfil);
                    } elseif (filter_var($fotoProfil, FILTER_VALIDATE_URL)) {
                        // Jika fotoProfil adalah URL yang valid
                        $gambarPath = $fotoProfil;
                    }
                
                    if ($gambarPath) {
                ?>
                    <img src="{{ $gambarPath }}" alt="User's Profile Picture" width="50" height="50" style="border-radius: 50%; object-fit: cover;">
                <?php
                    } else {
                ?>
                    <img src="{{ asset('https://powerusers.microsoft.com/t5/image/serverpage/image-id/98171iCC9A58CAF1C9B5B9/image-size/large/is-moderation-mode/true?v=v2&px=999') }}" alt="User's Profile Picture" width="50" height="50" style="border-radius: 50%; object-fit: cover;">
                <?php
                    }
                ?>
                </i>
                <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span> 
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                    <li>
                        <a class="dropdown-item" href="/profileAdmin">
                          <i class="ni ni-badge text-primary text-sm opacity-10"></i> Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" id="logout-link" onclick="openModal()">
                          <i class="ni ni-button-power text-primary text-sm opacity-10"></i> Logout
                        </a>
                    </li>
                </ul>
              </div>
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
              <h6>Form Edit Artikel</h6>

              <div id="error-message" style="color: red; margin-bottom: 10px;"></div>


              <form action="/formEditArtikelA/updateArtikelA/{{$data->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="gambarArtikelFile">Upload Gambar (File)</label>
                      <span for="gambarArtikelFile">Format Gambar: .jpg, .jpeg, .png</span>
                      <input type="file" class="form-control" id="gambarArtikel" name="gambarArtikel" onchange="toggleInput('file'); previewFile()">
                      <img id="previewImageFile" src="#" alt="Preview" style="display:none; max-width:50%; height:auto; margin: 20px;">
                  </div>
                  
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <label for="gambarArtikelURL">Upload Gambar (URL)</label>
                          <input type="text" class="form-control" id="gambarArtikel" name="gambarArtikel" onchange="toggleInput('url'); previewURL(this.value)" value="{{ $data->gambarArtikel }}" required>
                          <img id="previewImageURL" src="#" alt="Preview" style="display:none; max-width:50%; height:auto; margin: 20px;">
                      </div>
                  </div>
              </div>
              
              <div class="form-group" id="existingImage">
                  <img src="{{ asset('gambarArtikel/'.$data->gambarArtikel) }}" height="50%" width="30%" alt="">
              </div>
            
                <div class="form-group">
                    <label for="judulArtikel">Judul Artikel</label>
                    <input type="text" class="form-control" id="judulArtikel" name="judulArtikel" value="{{ $data->judulArtikel }}" required>
                </div>
                <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <label for="penulis">Penulis</label>
                          <input type="text" class="form-control" id="penulis" name="penulis" value="{{ Auth::user()->name }}" readonly>
                      </div>
                  </div>
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
                    <label for="tags">Tags</label>
                    <select class="form-control" id="tags" name="tags[]" multiple="multiple" required>
                        @if($data->tags)
                            @foreach(explode(',', $data->tags) as $tag)
                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Deskripsi</label>
                    <textarea class="form-control" type="text" name="deskripsi" id="editor">{{ $data->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Edit</button>
                <a href="/artikelAdmin" class="btn btn-info mt-3">Kembali</a>
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

<!--------------------------------------------------------------------------------------- Javascript Upload Foto ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Upload Foto ------------------------------------------------------------------------------->


<script>
  function toggleInput(type) {
      var inputs = document.querySelectorAll('#gambarArtikel');
      
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

<script>
  function previewFile() {
      var preview = document.getElementById('previewImageFile');
      var file = document.querySelector('input[type=file]').files[0];
      var reader = new FileReader();

      reader.onloadend = function () {
          preview.src = reader.result;
          preview.style.display = "block";
          document.getElementById('existingImage').style.display = "none"; // Hide existing image
      }

      if (file) {
          reader.readAsDataURL(file);
      } else {
          preview.src = "";
      }
  }

  function previewURL(url) {
      var preview = document.getElementById('previewImageURL');
      preview.src = url;
      preview.style.display = "block";
      document.getElementById('existingImage').style.display = "none"; // Hide existing image
  }
</script>

<!--------------------------------------------------------------------------------------- Javascript Dynamic Tags ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Dynamic Tags ------------------------------------------------------------------------------->

  <script>
    $(document).ready(function () {
        $('#tags').select2({
            tags: true,
            tokenSeparators: [',', ' '], // Allow comma or space to separate tags
            placeholder: 'Choose tags',
        });
    });
</script>


<!--------------------------------------------------------------------------------------- Javascript CKEditor ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript CKEditor ------------------------------------------------------------------------------->

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

<!--------------------------------------------------------------------------------------- Javascript Standar Penulisan ------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------- Javascript Standar Penulisan ------------------------------------------------------------------------------->


<script>
  function validateForm() {
    const errorMessageDiv = document.getElementById('error-message');
    errorMessageDiv.innerHTML = ''; // Reset pesan kesalahan sebelum validasi

    // Validasi kualitas foto
    const gambarArtikelInput = document.getElementById('gambarArtikel');
    if (gambarArtikelInput.files.length > 0) {
      const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
      const fileName = gambarArtikelInput.value;
      if (!allowedExtensions.exec(fileName)) {
        errorMessageDiv.innerHTML += '<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Format foto harus <strong>.jpg, .jpeg, atau .png.</strong></p>';
      }
    }

// Validasi penggunaan kata tidak pantas pada deskripsi
const deskripsiInput = document.getElementById('editor');
const forbiddenWordsDesc = ['kata1', 'kata2', 'kata3']; // Gantilah dengan kata-kata yang dianggap tidak pantas pada deskripsi
const deskripsiValue = deskripsiInput.value.toLowerCase();
for (const word of forbiddenWordsDesc) {
  if (deskripsiValue.includes(word)) {
    errorMessageDiv.innerHTML += `<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Penggunaan kata <strong>"${word}"</strong> pada deskripsi tidak sesuai karena mengandung unsur negatif.</p>`;
  }
}

// Validasi penggunaan kata tidak pantas pada judul
const judulInput = document.getElementById('judulArtikel');
const forbiddenWordsJudul = ['judul1','judul2','judul3','judul4','judul5','judul6','judul7','judul8','judul9','judul10']; // Gantilah dengan kata-kata yang dianggap tidak pantas pada judul
const judulValue = judulInput.value.toLowerCase();
for (const word of forbiddenWordsJudul) {
  if (judulValue.includes(word)) {
    errorMessageDiv.innerHTML += `<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Penggunaan kata <strong>"${word}"</strong> pada judul tidak sesuai karena mengandung unsur negatif.</p>`;
  }
}

// Validasi penggunaan kata tidak pantas pada tags
const tagsInput = document.getElementById('tags');
const forbiddenWordsTags = ['tags1','tags2','tags3','tags4','tags5','tags6','tags7','tags8','tags9','tags10']; // Gantilah dengan kata-kata yang dianggap tidak pantas pada tags
const tagsValue = tagsInput.value.toLowerCase();
for (const word of forbiddenWordsTags) {
  if (tagsValue.includes(word)) {
    errorMessageDiv.innerHTML += `<p class="text-white"><i class="fas fa-exclamation-triangle text-white"></i> Penggunaan kata <strong>"${word}"</strong> pada tags tidak sesuai karena mengandung unsur negatif.</p>`;
  }
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
</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
  <title>
    Kategori Artikel | Katakey
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets2/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets2/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

  <!-- Detail Foto -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">


<!------------------------------------------------------------------------------------- CSS Area -------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------- CSS Area -------------------------------------------------------------------------------------------->

<!-- Rating CSS-->
<style>
  .rating {
    font-size: 20px;
  }

  .star {
    color: gray; /* Mengatur warna bintang awalnya menjadi gray */
    cursor: pointer;
  }

  .star.selected {
    color: gold; /* Mengatur warna bintang yang dipilih menjadi gold */
  }

  .rating-container {
      font-size: 20px; /* Atur ukuran teks rata-rata rating */
      margin: 15px; /* Atur margin untuk jarak dari teks sekitarnya */
    }

    .filled-star {
      color: gold; /* Warna bintang yang diisi */
    }
  </style>

  
<!-- Modal CSS-->
  <style>
    .modalLogout {
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

    .modal-contentLogout {
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

    .closeLogout {
      color: #888;
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }

    #confirm-buttonLogout, #cancel-buttonLogout {
      padding: 10px 20px;
      margin: 25px;
      cursor: pointer;
    }
</style>
<style>
    /* CSS untuk dropdown */
    .dropdown {
      position: relative;
      display: inline-block;
      margin: 10px;
      text-align: center; /* Membuat dropdown menjadi pusat */
    }

    .dropbtn {
      background-color: #5E72E4;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      border-radius: 10px;
      transition: background-color 0.3s;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #ffffff;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(255, 255, 255, 0.2);
      z-index: 1;
      border-radius: 10px;
      text-align: left; /* Membuat teks dalam dropdown menjadi kiri */
      border: 1px solid #ccc; /* Menambahkan garis pembatas ke seluruh dropdown */
    }

    .dropdown-content a {
      color: #5E72E4;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      transition: color 0.3s;
    }

    .dropdown-content a:hover {
      background-color: #5E72E4;
      color: #ffffff;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover .dropbtn {
      background-color: #5E72E4;
    }
</style>
<style>
  .popup-modal {
    display: none;
    position: absolute;
    z-index: 1;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 80%;
    max-height: 80%;
    overflow: auto;
    padding: 20px;
    text-align: justify;
    border-radius: 8px;
  }

  .popup-modal p {
    margin: 0;
  }

  .popup-trigger {
    position: relative;
    cursor: pointer;
    display: inline-block;
    text-align: justify;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px; /* Adjust the max-width as needed */
  }

  .popup-trigger:hover {
    text-decoration: underline;
  }
</style>
</head>

<!------------------------------------------------------------------------------------- Body Area -------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------- Body Area -------------------------------------------------------------------------------------------->

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
          <a class="nav-link" href="/artikelAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Artikel
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruArtikel + $dataBaruKomentarArtikel}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/videoAdmin">
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kategori Artikel</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Kategori Artikel</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="{{ route('searchTagsA') }}" method="GET" class="d-flex">
              @csrf
              <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                  <input type="text" name="search" class="form-control" placeholder="Cari Artikel..." value="{{ request()->input('search') }}" autocomplete="off" list="tagList">
                  <datalist id="tagList">

                </datalist>
              </div>
              <button type="submit" class="btn btn-warning ms-2 btn-block">Cari</button>
          </form>          
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
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              </a>
              <h6>
                @if($KategoriA->isNotEmpty())
                    <h2>Kategori {{ $KategoriA->first()->kategori }}</h2>
                    <div class="div-dec"></div>
                @else
                    <h2>Tidak Ada Artikel Ditemukan Pada Ketegori Ini</h2>
                @endif
              </h6>

            <div class="pd-top-80 pd-bottom-50" id="grid">
              <div class="container">
          
                <section class="about-us" id="about">
                  <div class="container">
                    <div class="row">
                      <div>
                        @foreach ($KategoriA as $item)
                            <div class="row" style="text-align: justify">
                                <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('gambarArtikel/'.$item->gambarArtikel) }}" style="max-width: 100%; height: auto; border-radius: 14px">
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                                    <h4 style="text-align: left" >{{ $item->judulArtikel }} </h4>
                                    <span class="d-flex"><b>{{ $item->penulis }}</b></span>
                                    <p>{!! substr(strip_tags($item->deskripsi), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
                                    <p>Tags:
                                      @php
                                      $tags = explode(",", $item->tags);
                                      foreach ($tags as $tag) {
                                          $trimmedTag = trim($tag);
                                          echo '<a href="' . route("TagsArtikelA", $trimmedTag) . '" class="fh5co_tagg">#' . $trimmedTag . '</a>';
                                          echo ' ';
                                      }
                                      @endphp
                                  </p>
                                  
                                </div>
                                <span style="text-align: right; color: rgba(165, 165, 165, 1);"><p>
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
                                    <a href="{{ route('showDetailArtikelA', ['id' => $item->id]) }}" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a></p></span>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                  </div>
                </section>  
              </div>
          </div>

            </div>

        
  
<!------------------------------------------------------------------------------------- Modal Area -------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------- Modal Area -------------------------------------------------------------------------------------------------------------------->


          <!--Modal Hapus Data -->
          <div id="confirmation-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a id="delete-link" href="#" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
          </div>

          <div id="success-notification" class="alert alert-success" style="display: none;">
            Data berhasil dihapus.
          </div>

          <!-- Modal Logout -->
          <div id="logout-modal" class="modalLogout">
            <div class="modal-contentLogout">
              <span class="closeLogout" id="close-buttonLogout" onclick="closeModal()">&times;</span>
              <h2>Konfirmasi Logout</h2>
              <p>Apakah anda mau logout?</p>
              <div style="text-align: center;">
                <button style="width: 120px;" class="btn btn-primary" id="confirm-logout-button" onclick="confirmLogout(true)">Ya</button>
                <button style="width: 120px;" class="btn btn-danger" id="cancel-logout-button" onclick="confirmLogout(false)">Tidak</button>
              </div>
            </div>
          </div>

              <footer class="footer pt-3  ">
                <div class="container-fluid">
                  <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                      <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                          document.write(new Date().getFullYear())
                        </script>,
                        Template by <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>,
                        <a title="CSS Templates" rel="sponsored" href="https://themewagon.com/themes/free-bootstrap-4-html-5-blog-website-template-nextpage/" target="_blank">NextPage </a> and
                        <a title="CSS Templates" rel="sponsored" href="https://www.creative-tim.com" target="_blank">Crative Tim </a> 
                        Edited By <a title="CSS Templates" rel="sponsored" href="#" target="_blank">KataKey Team</a></p>
                      </div>
                      </div>
                    </div>
                  </div>
                </footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-------------------------------------------------------------------------------------Argon Feature Area -------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------Argon Feature Area -------------------------------------------------------------------------------------------------------------------->

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

<!------------------------------------------------------------------------------------- JavaScript Area -------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------- JavaScript Area -------------------------------------------------------------------------------------------->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <!--   Core JS Files   -->
 <script src="../assets2/js/core/popper.min.js"></script>
 <script src="../assets2/js/core/bootstrap.min.js"></script>
 <script src="../assets2/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="../assets2/js/plugins/smooth-scrollbar.min.js"></script>
 <script src="../assets2/js/plugins/chartjs.min.js"></script>
 
   <!-- Detail Foto -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
  $(document).ready(function() {
      console.log("Document ready.");
  });
  </script>
  

  <!-- Modal Pop Up Detail Deskripsi Artikel -->
  <script>
    document.querySelectorAll('.popup-trigger').forEach(function (element) {
      element.addEventListener('mouseenter', function () {
        openPopup(element.dataset.id);
      });
  
      element.addEventListener('mouseleave', function () {
        closePopup(element.dataset.id);
      });
    });
  
    function openPopup(id) {
      const popup = document.getElementById('popup-' + id);
      if (!popup) {
        const tdElement = document.querySelector('.popup-trigger[data-id="' + id + '"]');
        const description = tdElement.querySelector('p').innerHTML;
  
        const popupContainer = document.createElement('div');
        popupContainer.id = 'popup-' + id;
        popupContainer.className = 'popup-modal';
  
        const popupContent = document.createElement('p');
        popupContent.innerHTML = description;
  
        popupContainer.appendChild(popupContent);
        document.body.appendChild(popupContainer);
  
        positionPopup(tdElement, popupContainer);
      }
  
      document.getElementById('popup-' + id).style.display = 'block';
    }
  
    function closePopup(id) {
      const popup = document.getElementById('popup-' + id);
      if (popup) {
        popup.style.display = 'none';
      }
    }
  
    function positionPopup(triggerElement, popupElement) {
      const rect = triggerElement.getBoundingClientRect();
  
      popupElement.style.top = rect.bottom + 'px';
      popupElement.style.left = rect.left + 'px';
    }
  </script>

  <!-- Modal Delete -->
  <script>
    function showConfirmationModal(deleteUrl) {
      $('#delete-link').attr('href', deleteUrl);
      $('#confirmation-modal').modal('show');
    }
  
    // Setelah data berhasil dihapus
    function onDeleteSuccess() {
      $('#confirmation-modal').modal('hide'); // Sembunyikan modal konfirmasi
      $('#success-notification').fadeIn().delay(2000).fadeOut(); // Tampilkan notifikasi berhasil
    }
  
    // Tambahkan event handler untuk tombol "Hapus"
    $(document).ready(function() {
      $('#delete-link').click(function() {
        // Setelah tombol "Hapus" diklik, Anda bisa memicu penghapusan dengan mengunjungi URL yang telah diatur sebelumnya
        window.location.href = $('#delete-link').attr('href');
      });
  
      // Event handler untuk tombol "Batal"
      $('#confirmation-modal .btn-default').click(function() {
        $('#confirmation-modal').modal('hide');
      });
  
      // Event handler untuk tombol close window (tanda "X")
      $('.modal .close').click(function() {
        $('#confirmation-modal').modal('hide');
      });
    });
  </script>

  <!-- Filter Role -->
  <script>
    // Menangani klik pada filter role
    document.querySelectorAll('.role-filter').forEach(function (element) {
        element.addEventListener('click', function () {
            var selectedRole = element.getAttribute('data-role');
            // Redirect ke halaman dengan filter role
            window.location.href = '{{ route("penggunaSA") }}?role=' + selectedRole;
        });
    });
  </script>

  <!-- Rating -->
<script>
  const stars = document.querySelectorAll('.star');
  const ratingInput = document.getElementById('rating');

  stars.forEach((star) => {
    star.addEventListener('click', () => {
      const ratingValue = parseInt(star.getAttribute('data-rating'));
      ratingInput.value = ratingValue;
      stars.forEach((s) => s.classList.remove('selected')); // Hapus kelas 'selected' dari semua bintang
      for (let i = 0; i < ratingValue; i++) {
        stars[i].classList.add('selected'); // Tambahkan kelas 'selected' pada bintang yang dipilih
      }
    });
  });
</script>

  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
    </script>

    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets2/js/argon-dashboard.min.js?v=2.0.4"></script>

    <!-- Modal Logout -->
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
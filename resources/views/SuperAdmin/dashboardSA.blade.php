
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/lg1.png">
  <link rel="icon" type="image/png" href="../assets2/img/lg1.png">
  <title>
    Dashboard | KataKey
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


  <style>
      .rating {
        font-size: 24px;
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
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main" data-color="primary">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <div class="d-flex px-2 py-1">
          <div>
            <img src="{{ asset('assets/img/lg1.png') }}" class="avatar avatar-sm me-3 h-100" alt="user1">
          </div>
          <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm">KataKey</h6>
            <p class="text-xs text-secondary mb-0">Halaman Super Admin</p>
          </div>
        </div>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/profileSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-badge text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/dashboardSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/artikelSuperAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Artikel
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruArtikel + $dataBaruKomentarArtikel}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/videoSuperAdmin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Video
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruVideo + $dataBaruKomentarVideo}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/kategoriTblSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori
              <span class="text-success text-sm font-weight-bolder"></span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/eventKomAdSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-user-run text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Event 
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruEventKomunitas}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/penggunaSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pengguna
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruUser}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/ulasansSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-paper-diploma text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Ulasan 
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruUlasan}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/laporanUserSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-sound-wave text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan User 
              <span class="text-success text-sm font-weight-bolder">+ {{ $dataBaruLaporanArtikel + $dataBaruLaporanVideo}}</span> 
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/syaratdanketentuanSA">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Term  & Conditions</span>
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
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Ulasan</p>
                      <h5 class="font-weight-bolder">{{$totalUlasan}}</h5>
                      <br>
                      <p class="mb-0">
                          <span class="text-success text-sm font-weight-bolder">+{{ $dataBaruUlasan }}</span>
                          Data Baru Ditambahkan
                      </p>
                  </div>
              </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengguna</p>
                    <h5 class="font-weight-bolder">
                      {{$totalUser}}
                    </h5>
                    <br>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+{{ $dataBaruUser }}</span>
                      Data Baru Ditambahkan
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Artikel</p>
                        <h5 class="font-weight-bolder">{{$totalArtikel}}</h5>
                        <br>
                        <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+{{ $dataBaruArtikel }}</span>
                            Data Baru Ditambahkan
                        </p>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>            
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Rating Website</p>
                      <h5 class="font-weight-bolder">
                          @php
                              $averageRating = round($averageRating, 1);
                          @endphp
                          @for ($i = 1; $i <= 5; $i++)
                              @if ($i <= $averageRating)
                                  <i class="fas fa-star filled-star"></i>
                              @else
                                  <i class="fas fa-star"></i>
                              @endif
                          @endfor
                          <p>{{ number_format($averageRating, 1) }} | {{$totalUlasan}} Ulasan</p>
                      </h5>
                  </div>
              </div>              
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-satisfied text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

     

          <div class="col-lg-5">
            <div class="card card-carousel overflow-hidden h-100 p-0">
              <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                <div class="carousel-inner border-radius-lg h-100">
                  <div class="carousel-item h-100 active" style="background-image: url('../assets2/img/carousel-1.jpg');background-size: cover;">
                    <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                      <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                      </div>
                      <h5 class="text-white mb-1">Get started with Argon</h5>
                      <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                    </div>
                  </div>
                  <div class="carousel-item h-100" style="background-image: url('../assets2/img/carousel-2.jpg');background-size: cover;">
                    <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                      <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                      </div>
                      <h5 class="text-white mb-1">Faster way to create web pages</h5>
                      <p>That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
                    </div>
                  </div>
                  <div class="carousel-item h-100" style="background-image: url('../assets2/img/carousel-3.jpg');background-size: cover;">
                    <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                      <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                        <i class="ni ni-trophy text-dark opacity-10"></i>
                      </div>
                      <h5 class="text-white mb-1">Share with us your design tips!</h5>
                      <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Kategori Video</h6>
              </div>
              <div class="card-body p-3">
                <!-- Kategori Artikel -->
                  <ul class="list-group">
                    @foreach($kategoriVideo as $item)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                <i class="ni ni-mobile-button text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">{{$item->kategoriVideo}}</h6>
                                <span class="text-xs">{{$item->total}} <b>Video</b></span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </li>
                    @endforeach
                  </ul>

              </div>
            </div>
          </div>

          
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Kategori Artikel</h6>
              </div>
              <div class="card-body p-3">
                <!-- Kategori Artikel -->
                  <ul class="list-group">
                    @foreach($kategoriArtikel as $item)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                <i class="ni ni-mobile-button text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">{{$item->kategori}}</h6>
                                <span class="text-xs">{{$item->total}} <b>Artikel</b></span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </li>
                    @endforeach
                  </ul>

              </div>
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
                  Edited By <a title="CSS Templates" rel="sponsored" href="#" target="_blank">GSG Team</a></p>
                </div>
              </div>
            </div>
          </div>
        </footer>

      </div>
      </div>
  </main>

   <!--   Core JS Files   -->
   <script src="../assets2/js/core/popper.min.js"></script>
   <script src="../assets2/js/core/bootstrap.min.js"></script>
   <script src="../assets2/js/plugins/perfect-scrollbar.min.js"></script>
   <script src="../assets2/js/plugins/smooth-scrollbar.min.js"></script>
   <script src="../assets2/js/plugins/chartjs.min.js"></script>
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
   <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>

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
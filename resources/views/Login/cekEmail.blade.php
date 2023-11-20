<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets2/img/lg1.png') }}">
  <title>
    Cek Email | Katakey
  </title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets2/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets2/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets2/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets2/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder text-center">Cek Email Anda</h4>
                  <p style="text-align: justify;">Email untuk reset kata sandi anda sudah kami kirimkan, silakan cek <strong>Email</strong> Anda.</p>

                  <br>
            
                  <div class="text-center">
                    <a href="https://www.facebook.com/" target="_blank">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Gmail_icon_%282020%29.svg/768px-Gmail_icon_%282020%29.svg.png" alt="Facebook Logo" style="width: 80px;">
                    </a>
                  </div>
                  <br>
                  <p style="text-align: justify;">Jika anda tidak menerima Email, silakan cek <strong>Spam</strong> Folder</p>
                  <br>
                  <p class="text-center">
                    <a href="/login" class="btn btn-lg btn-primary">Kembali ke Login</a>
                  </p>
                  <br>
                </div>
              </div>
            </div>
                      
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://img.freepik.com/premium-photo/interior-background-contemporary-shelves-wall-desktop-apartment-design-computer-living-generative-ai_163305-172176.jpg');
          background-size: cover;">
                <span></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Katakey"</h4>
                <p class="text-white position-relative">Website Focusing on Uploading Articles.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets2/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets2/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets2/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets2/js/plugins/smooth-scrollbar.min.js') }}"></script>
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
  <script src="{{ asset('assets2/js/argon-dashboard.min.js?v=2.0.4') }}"></script>  
</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran Berhasil</title>

  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      min-height: 100vh;
      margin: 0;
      background-color: #fff;
    }

    .center {
      text-align: center;
    }

    .header,
    .footer {
      background-color: #134BBA;
      color: #fff;
      padding: 10px 0;
       height: 2px; 
    }

    .header img {
      display: block;
      margin: 0 auto;
    }

    .content {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
    }

    .email-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

 .footer {
      background-color: #134BBA;
      color: #fff;
      padding: 10px 0;
      height: 2px; 
      text-align: center;
      height: 150px; /* Atur ketinggian footer sesuai kebutuhan */
    }

    .social-icons {
        margin-top: 10px;
    }

    .social-icons a {
        display: inline-block;
        margin-right: 10px;
    }

    .social-icons img {
        width: 30px; /* Sesuaikan ukuran ikon sesuai kebutuhan */
        height: 30px;
    }
  </style>

</head>
<body>
  <div class="center">
     <div class="header">
  </div>

  <br>

  <div>
    <img src="https://img.freepik.com/premium-vector/abstract-monogram-lk-kl-initial-letter-logo_649646-38.jpg" alt="livinbymandiri" style="max-width:156px" class="CToWUd" data-bit="iit">
  </div>

  <br>
  <br>
  
      <div class="content center">

        <h2>Reset Password Akun</h2>

        <p>Ini adalah email verifikasi dari KataKey. Jika Anda ingin mengatur ulang kata sandi Anda, klik tombol di bawah ini:</p>

        <br>

        <div class="text-center">
          <a class="email-button" href="{{ url('password/reset/' . $user->remember_token) }}">Verifikasi</a>
        </div>
        
        <br>

        <p>Jika Anda tidak meminta reset kata sandi, Anda bisa mengabaikan email ini. Terima kasih telah menggunakan website kami.</p>

  </div>
  
    <br>
    <br>


          <div class="footer center" style="color: white; background-color: #134BBA; padding: 20px;">
            <span>&copy; 2023 Katakey All rights reserved.</span>
        
            <div class="social-icons">
              <a href="#" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" alt="Facebook"></a>
              <a href="#" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" alt="Twitter"></a>
              <a href="#" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" alt="Instagram"></a>
          </div>
        </div>
        </div>
      </div>
    </div>
    
  </div>
</body>
</html>

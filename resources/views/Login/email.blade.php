<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Reset Password Email</title>
  <style>
    .email-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #134BBA;
      color: #ffffff;
      text-decoration: none;
    }

    .text-center {
      margin: 0 auto;
      max-width: 600px;
      text-align: center;
      border-bottom: 2px solid #ccc;
      padding: 20px 0;
    }

    .footer {
      padding: 20px 0;
    }

    .social-icons img {
      width: 30px; /* Adjust the size as needed */
      margin: 0 5px; /* Adjust spacing between icons */
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <!-- header with text-center class and border-bottom -->
  <div class="text-center">
    <img src="https://ci4.googleusercontent.com/proxy/6fEtvO8_XjTwD-Hdu0F6lI7wvSSFSNU4pOINu5tWMkMZwvtqnT3-KAxht3tZtx1DQfrI9nn37OC0cn9H2M-b7yCSEiJFpa6JquoLQsSK_KeRz83pENYdLM7EuFLUGMp9EaESXxwcH5mAEnj2gAr7lICKZcoVqB71kHNvpnMGExvD=s0-d-e1-ft#https://mobile.omni.bankmandiri.co.id/livin/customer/content/v1/image/5ebaf8c1-9696-417a-ab84-3c36c94af489.png" alt="livinbymandiri" style="max-width:156px; display: block; margin: 0 auto;">
  </div>

  <div class="text-center">
    <h2>Reset Password Akun</h2>
    <p>Ini adalah email verifikasi dari KataKey. Jika Anda ingin mengatur ulang kata sandi Anda, klik tombol di bawah ini:</p>
    <br>
    <div>
      <a class="email-button" href="{{ url('password/reset/' . $user->remember_token) }}">Verifikasi</a>
    </div>
    <br>
    <p>Jika Anda tidak meminta reset kata sandi, Anda bisa mengabaikan email ini. Terima kasih telah menggunakan website kami.</p>
  </div>

  <!-- footer with borders -->
  <div class="footer">
    <br>
    <p>&copy; 2023 Katakey All rights reserved.</p>
    <div> 
      <div class="social-icons">
        <a href="https://www.facebook.com/" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/1024px-2023_Facebook_icon.svg.png" alt="Facebook Logo" style="width: 25px;">
        </a>
        <a href="https://www.instagram.com/" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/600px-Instagram_logo_2022.svg.png" alt="Instagram Logo" style="width: 25px;">
        </a>
        <a href="https://twitter.com/" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/X_logo_2023.svg/1134px-X_logo_2023.svg.png" alt="Twitter Logo" style="width: 25px;">
        </a>
        <a href="https://gmail.com/" target="_blank">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Gmail_icon_%282020%29.svg/768px-Gmail_icon_%282020%29.svg.png" alt="Twitter Logo" style="width: 25px;">
      </a>
    </div>    
    </div>
</div>
 
</body>
</html>

<?php 
require_once 'config/config.php';

if (isset($_SESSION["user"])) {
  $id = $_SESSION["user"];
  $result = query("SELECT * FROM users WHERE id_user = $id")[0];
  if ($result['roles'] == 'ADMIN') {
    header("Location: admin");
  } elseif($result["roles"] == 'OWNER') {
    header("Location: owner");
  }
}

if (isset($_SESSION["driver"])) {
  header("Location: driver");
} 


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Dani Snak</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="assets/style/main.css" rel="stylesheet" />

    <style>      
    .store-adventeges {
        padding: 40px;
        background-color: #F7F7E8;
      }
    </style>
  </head>

  <body>
    <!-- navbar -->
    
    <!-- akhir navbar -->

    <!-- page content -->
    <div class="page-content page-home" data-aos="zoom-in">
      <section class="store-landing">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-md-5">
              <img src="assets/images/danisnack.png" class="w-100" alt="" />
            </div>
            <div class="col-md-6">
              <h1 style="font-weight: bold; margin-bottom: 15px;">SEGERA SELESEIKAN PEMBAYARAN</h1>
              <p class="store-subtitle-landing" style="line-height: 28px; color: rgb(146, 146, 146);">
                Website ini dimatikan sementara sampai dilakukan pembayaran
              </p>
              <!-- <a href="https://api.whatsapp.com/send?phone=6285641548727&text=Hallo+Min%2C+Saya+mau+memesan+snack" class="btn btn-success px-4 py-2 mt-4">Hubungi Kami</a> -->
              <a href="https://api.whatsapp.com/send?phone=6285641548727" class="btn btn-success px-4 py-2 mt-4">Hubungi Saya</a>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- akhir slider -->

    <!-- footer -->
    
    <!-- akhir footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.slim.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="assets/js/navbar-scroll.js"></script>
  </body>
</html>

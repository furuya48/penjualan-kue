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
  </head>

  <body>
    <!-- navbar -->
    <?php include 'template/navbar.php' ?>
    <!-- akhir navbar -->

    <!-- page content -->
    <div class="page-home" data-aos="zoom-in">
      <section class="store-landing" style="background-color: #F8F6F3; background-attachment: fixed; padding: 100px 0 100px 0;">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1 class="" style="font-size: 60px;">Dani Snack</h1>
              <h5 class="">Toko Kue Onine Pilihan</h5>
              <a
                  href="https://wa.me/6285641548727"
                  target="_blank"
                  class="btn btn-success mt-2 px-4 py-2 text-white"
                  ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 18 18">
  <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
</svg> Hubungi Kami</a>
            </div>
          </div>
        </div>
      </section>
      <section class="store-adventeges" id="adventeges">
        <div class="container">
          <div class="row text-center">
            <div class="col-12">
              <h2 class="font-weight-bold mb-2">Dani Snack</h2>   
              <hr style="border-top: 5px solid black; width: 80px;">
            </div>
          </div>
          <div class="row text-center">
            <div class="col-md-12">
              <p>Dani Snack merupakan toko penjualan berbagai macam kue seperti kue kering, kue basah, kue lebaran dan lain sebagainya. Dani snack melayani pengiriman hanya dibeberapa kecamatan di banyumas dan purbalingga</p>
            </div>
          </div>
        </div>
      </section>
      <section class="store-adventeges" style="background-color: #F8F6F3; background-attachment: fixed; padding: 100px 0 100px 0;">
        <div class="container">
          <div class="row text-center">
            <div class="col-12">
              <h2 class="font-weight-bold mb-2">Metode Pembayaran</h2>   
              <hr style="border-top: 5px solid black; width: 80px;">
            </div>
          </div>
          <div class="row text-center">
            <div class="col-md-12">
              <table class="table table-striped table-hover w-100" id="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Bank</th>
                    <th scope="col">No Rekening</th>
                    <th scope="col">Atas Nama</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $rekening_numbers = query("SELECT * FROM rekening_numbers");
                  ?>
                  <?php foreach ($rekening_numbers as $rekening) : ?>
                    <tr>
                      <th scope="row" style="width: 10%;"><?= $no; ?></th>
                      <td><?= $rekening["bank_name"]; ?></td>
                      <td><?= $rekening["number"]; ?></td>
                      <td><?= $rekening["rekening_name"]; ?></td>
                    </tr>
                    <?php $no++ ?>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
      <!-- <section class="counter text-white" style="background-color: #001524; padding: 40px; margin-top: 100px;" id="counter">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <h3>Numbers Speak For Themeselves</h3>
            </div>
            <div class="col-md-3">
              <h3 id="terjual"></h3>
            </div>
          </div>
        </div>
      </section> -->
    </div>

    <br>
    <br><br><br><br>
    <br>
    <br><br><br><br>
    <!-- akhir slider -->

    <!-- footer -->
    <?php include 'template/footer.php' ?>
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

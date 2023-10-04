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
    <?php include 'template/navbar.php' ?>
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
              <h1 style="font-weight: bold; margin-bottom: 15px;">Dani Snack</h1>
              <p class="store-subtitle-landing" style="line-height: 28px; color: rgb(146, 146, 146);">
                Dani Snack adalah toko yang menjual berbagai macam kue home Made sangat cocok disajikan pada saat santai bersama keluarga atau pun untuk kue lebaran nanti.
              </p>
              <a href="products.php" class="btn btn-success px-4 py-2 mt-4">Belanja Sekarang</a>
              <a href="https://api.whatsapp.com/send?phone=6285641548727&text=Hallo+Min%2C+Saya+mau+memesan+snack" class="btn btn-success px-4 py-2 mt-4">Hubungi Kami</a>
            </div>
          </div>
        </div>
      </section>
      <section class="store-adventeges" style="margin-top: 100px;" id="adventeges">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="title-adventeges" style="text-align: center; font-size: 24px; font-weight: 600; margin-bottom: 20px;">Kelebihan Belanja Disini</div>
            </div>
          </div>
          <div class="row">
            <div
              class="col-6 col-md-4"
              data-aos="fade-down"
              data-aos-delay="100"
            >
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row justify-content-center align-content-center">
                    <div class="col-10 col-md-4">
                      <div class="adventeges-thumbnail mb-lg-0 mb-2">
                        <img
                          src="assets/images/fast.svg"
                          class="w-100"
                          alt=""
                        />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div
                        class="adventege-description text-center text-lg-left"
                      >
                        <div class="title-text">Pengiriman Cepat</div>
                        <div class="subtitle-text">
                          Dikirim langsung oleh drive toko
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="col-6 col-md-4"
              data-aos="fade-down"
              data-aos-delay="200"
            >
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row justify-content-center align-content-center">
                    <div class="col-10 col-md-4">
                      <div class="adventeges-thumbnail mb-lg-0 mb-2">
                        <img
                          src="assets/images/money.svg"
                          class="w-100"
                          alt=""
                        />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div
                        class="adventege-description text-center text-lg-left"
                      >
                        <div class="title-text">Harga Terjangkau</div>
                        <div class="subtitle-text">
                          Dapatkan harga murah dan kualitas
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="col-6 col-md-4"
              data-aos="fade-down"
              data-aos-delay="300"
            >
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row justify-content-center align-content-center">
                    <div class="col-10 col-md-4">
                      <div class="adventeges-thumbnail mb-lg-0 mb-2">
                        <img src="assets/images/env.svg" class="w-100" alt="" />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div
                        class="adventege-description text-center text-lg-left"
                      >
                        <div class="title-text">Banyak Pilihan</div>
                        <div class="subtitle-text">
                          Tersedia berbagai macam pilihan
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="store-products-kilogram" style="margin-top: 100px;">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 style="font-weight: 600; margin-bottom: 15px;">New Products</h5>
            </div>
          </div>
          <div class="row">
            <?php 
            $products = query("SELECT * FROM products LIMIT 8");
            $iteration = 0;
            ?>

            <?php foreach ($products as $product) : ?>
            <?php 
            $idProduct = $product["id_product"];
            $galleries = query("SELECT * FROM products_galleries INNER JOIN products ON products_galleries.product_id = products.id_product WHERE products_galleries.product_id = $idProduct");    
            ?>
              <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="<?= $iteration += 100; ?>"
              >
                <?php if ($product["stock"] > 0) : ?>
                <a href="details.php?id=<?= $idProduct; ?>" class="component-products d-block">
                  <div class="products-thumbnail">
                    <div
                      class="products-image"
                      style="background-image: url('assets/images/<?= $galleries[0]["photos"] ?>')"
                    >
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <div class="products-text"><?= $product["product_name"]; ?></div>

                      <div class="products-price">Rp. <?= number_format($product["price"]); ?></div>
                    </div>
                    <div>
                      <div class="text-muted">Sisa <?= $product["stock"]; ?></div>
                    </div>
                  </div>
                </a>
                <?php else : ?>
                <div class="component-products d-block">
                  <div class="products-thumbnail position-relative">
                      <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center bg-dark" style="opacity: .7;">
                          <div class="text-decoration-none font-weight-bold text-white" style="font-weight: 500;">SOLD OUT</div>
                      </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <div class="products-text"><?= $product["product_name"]; ?></div>

                      <div class="products-price">Rp. <?= number_format($product["price"]); ?></div>
                    </div>
                    <div>
                      <div class="text-muted"><?= $product["unit"]; ?> Buah</div>
                    </div>
                  </div>
                </div>
                <?php endif;?>
              </div>
            <?php endforeach;?>
          </div>
        </div>
      </section>
    </div>
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

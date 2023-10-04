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
  header("Location: driver/index.php");
}
$idProduct = $_GET["id"];
$product = query("SELECT * FROM products WHERE id_product = $idProduct")[0];
$galleries = query("SELECT * FROM products_galleries INNER JOIN products ON products_galleries.product_id = products.id_product WHERE products_galleries.product_id = $idProduct"); 

if (isset($_POST["addToCart"])) {
    if (addToCart($_POST) > 0) {
      header("Location: cart.php");
    } else {
      echo mysqli_error($conn);
    }
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

    <title>Details | Dani Snak</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="assets/style/main.css" rel="stylesheet" />
  </head>

  <body>
    <!-- navbar -->
    <?php include 'template/navbar.php' ?>
    <!-- akhir navbar -->

    <!-- page-content -->
    <div class="page-content page-details">
      <section
        class="store-breadcrumb"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb bg-transparent">
                  <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="products.php">Produk</a>
                  </li>
                  <li class="breadcrumb-item active"><?= $product["product_name"]; ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="store-gallery" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :src="photos[activePhoto].url"
                  :key="photos[activePhoto].id"
                  alt=""
                  class="thumbnail-image w-100"
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="store-details-container" data-aos="fade-up">
      <form action="" method="POST">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 d-flex justify-content-between">
                <div>
                  <h1><?= $product["product_name"]; ?></h1>
                  <div class="owner"><?= $product["unit"] / 1000; ?> gram</div> 
                  <div class="form-group d-flex align-items-center justify-content-between" style="width: 150px;">
                    <input type="number" required name="banyak" id="banyak" class="form-control w-50" value="1" min="0"> Buah
                  </div>
                  <div class="price">Rp. <?= number_format($product["price"]); ?></div>                    
                </div>
                <div>
                  <p>
                    Tersedia : <strong><?= $product["stock"]; ?> Buah</strong>
                  </p>
                </div>
              </div>
              <?php if (!isset($_SESSION["login"]) && !isset($_SESSION["user"])) : ?>
              <div class="col-lg-2" data-aos="zoom-in">
                  <a
                    href="login.php"
                    class="btn btn-success px-4 text-white btn-block mb-3 py-2"
                  >
                    Sign in to cart
                  </a>
              </div>
              <?php else : ?>
              <div class="col-lg-2" data-aos="zoom-in">
                  <input type="hidden" name="user_id" value="<?= $id; ?>">
                  <input type="hidden" name="product_id" value="<?= $idProduct; ?>">
                  <button 
                    type="submit"
                    name="addToCart"
                    class="btn btn-success px-4 text-white btn-block mb-3 py-2"
                  >
                    Add to cart
                  </button>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
      </form>
        <section class="store-description">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8">
                <p>
                  <?= $product["descriptions"]; ?>
                </p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <!-- footer -->
    <?php include 'template/footer.php' ?>
    <!-- akhir footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="assets//vendor/jquery/jquery.slim.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="assets/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 1,
          photos: [
            <?php foreach ($galleries as $gallery) : ?>
            {
              id: <?= $gallery["id_gallery"] ?>,
              url: "assets/images/<?= $gallery["photos"] ?>",
            },
            <?php endforeach; ?>
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
    <script src="assets/js/navbar-scroll.js"></script>
  </body>
</html>

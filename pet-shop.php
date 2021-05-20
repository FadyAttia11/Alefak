<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    $all_store_query = "select * from store";
    $all_store = mysqli_query($con, $all_store_query);

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['all'])) {
          $all_store_query = "select * from store";
          $all_store = mysqli_query($con, $all_store_query);
  
        } else if(isset($_POST['nike'])) {
          $all_store_query = "select * from store where brand = 'Nike'";
          $all_store = mysqli_query($con, $all_store_query);
  
        } else if(isset($_POST['adidas'])) {
          $all_store_query = "select * from store where brand = 'Adidas'";
          $all_store = mysqli_query($con, $all_store_query);
  
        } else if(isset($_POST['zara'])) {
          $all_store_query = "select * from store where brand = 'Zara'";
          $all_store = mysqli_query($con, $all_store_query);
  
        } else if(isset($_POST['calvin'])) {
          $all_store_query = "select * from store where brand = 'Calvin Klein'";
          $all_store = mysqli_query($con, $all_store_query);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Alefak</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo mr-auto"><a href="index.php">Alefak</a></h1> -->
      <a href="index.php" class="logo mr-auto"><img src="assets/img/logo.jpg" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="pet-shop.php">Pet Shop</a></li>
          <li><a href="all-vets.php">All Vets</a></li>
          <li><a href="sell-pets.php">Sell Pets</a></li>
          <li><a href="buy-pets.php?category=All">Buy Pets</a></li>
          <li><a href="my-profile-owner.php">My Profile</a></li>
          <li><a href="#">Pet Owner: <?php echo $user_data['user_name'] ?></a></li>
          <li><a href="logout.php">Logout</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Pet Shop</li>
        </ol>
        <h2>Pet Shop</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
<div class="container">

    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Categories</h1>
            <div class="list-group">
                <form method="post">
                    <input type="hidden" name="all" value="all">
                    <input type="submit" class="list-group-item" value="All Store">
                </form>

                <form method="post">
                <input type="hidden" name="food" value="food">
                <input type="submit" class="list-group-item" value="Food">
                </form>

                <form method="post">
                <input type="hidden" name="accessories" value="accessories">
                <input type="submit" class="list-group-item" value="Accessories">
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <?php
                while($row = mysqli_fetch_array($all_store)) {
                ?>

                <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src=<?php echo './uploads/'. $row['image'] ?> alt=""></a>
                    <div class="card-body">
                    <h4 class="card-title">
                        <a href="#"><?php echo $row['item_name'] ?></a>
                    </h4>
                    <h5>$<?php echo $row['price'] ?></h5>
                    <p class="card-text"><?php echo $row['description'] ?></p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    <a href=<?php echo "checkout.php?id=". $row['id'] ?> class="btn btn-primary" style="background: #e03a3c;">
                        Buy Now
                    </a>
                    </div>

                </div>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>

</div>
</section>
</main>


  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
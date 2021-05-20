<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $buyer_name = $user_data['user_name'];
    $pet_id = $_GET["id"];

    $product_info_query = "select * from pets where id = '$pet_id'";
    $product_info = mysqli_query($con, $product_info_query);

    if($product_info) {
        $pet_data = mysqli_fetch_assoc($product_info);
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
          <li><a href="pet-shop.php">Pet Shop</a></li>
          <li><a href="all-vets.php">All Vets</a></li>
          <li><a href="sell-pets.php">Sell Pets</a></li>
          <li class="active"><a href="buy-pets.php?category=All">Buy Pets</a></li>
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
          <li>My Profile</li>
        </ol>
        <h2>My Profile</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="portfolio-details-container">

        <img src=<?php echo "uploads/".$pet_data['image'] ?> class="img-fluid" alt="">

          <div class="portfolio-info">
            <h3>Pet information</h3>
            <ul>
              <li><strong>Pet Name</strong>: <?php echo $pet_data['pet_name'] ?></li>
              <li><strong>Category</strong>: <?php echo $pet_data['category'] ?></li>
              <li><strong>Breed</strong>: <?php echo $pet_data['breed'] ?></li>
              <li><strong>Minimum Price</strong>: <?php echo $pet_data['min_price'] ?> L.E</li>
              <li><strong>Available Time</strong>: <?php echo $pet_data['time'] ?></li>
              <li><strong>Date Added</strong>: <?php echo $pet_data['date'] ?></li>
            </ul>
          </div>
        </div>

        <?php
            $existing_bid_query = "select * from auctions where pet_id = '$pet_id' and buyer_name = '$buyer_name'";
            $existing_bid = mysqli_query($con, $existing_bid_query);

            if($existing_bid && mysqli_num_rows($existing_bid) > 0) {
        ?>
        <h2>You Had Already Bid on This Pet!</h2>
        <?php } else { ?>

        <div class="portfolio-description">
            <h2>Bid on This Pet</h2>
            <form method="post">
                <input type="number" class="form-control mb-3" placeholder="Your Bid" name="bid" required>
                <input type="submit" value="Submit Bid" class="btn btn-primary">
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $bid = $_POST['bid'];
                        
                        $query = "insert into auctions (pet_id,buyer_name,bid) values ('$pet_id','$buyer_name','$bid')";
                        $result = mysqli_query($con, $query);

                        if($result) {
                            echo "successfully added your bid to the auction";
                        } else {
                            echo "error adding your bid to the auction";
                        }
                    }
                ?>
            </form>
        </div>

        <?php } ?>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->


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
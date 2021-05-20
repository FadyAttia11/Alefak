<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $category = $_GET["category"];

    if($category == 'All') {
        $all_pets_query = "select * from pets";
        $all_pets = mysqli_query($con, $all_pets_query);
    } else {
        $all_pets_query = "select * from pets where category = '$category'";
        $all_pets = mysqli_query($con, $all_pets_query);
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
          <li class="active"><a href="buy-pets.php">Buy Pets</a></li>
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
          <li><a href="index.php">Home</a></li>
          <li>Buy Pets</li>
        </ol>
        <h2>Choose Category: <a href="buy-pets.php?category=All">All</a> - <a href="buy-pets.php?category=Dogs">Dogs</a> - <a href="buy-pets.php?category=Cats">Cats</a> - <a href="buy-pets.php?category=Fish">Fish</a> - <a href="buy-pets.php?category=Birds">Birds</a> - <a href="buy-pets.php?category=Turtles">Turtles</a></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
    <div class="container">

    <h3>Buy Pets</h3>
    <div class="row">
            <?php
                while($row = mysqli_fetch_array($all_pets)) {
            ?>

            <div class="col-6">
                <a href=<?php echo "pet.php?id=". $row['id'] ?>><img src=<?php echo "./uploads/".$row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></a>
                <h5>Name: <?php echo $row['pet_name'] ?></h5>
                <p>Breed: <?php echo $row['breed'] ?></p>
            </div>  

            <?php } ?>
    </div>
        

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
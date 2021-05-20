<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];
    $vet_id = $_GET["id"];

    $product_info_query = "select * from users where id = '$vet_id'";
    $product_info = mysqli_query($con, $product_info_query);

    if($product_info) {
        $vet_data = mysqli_fetch_assoc($product_info);
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
          <li class="active"><a href="all-vets.php">All Vets</a></li>
          <li><a href="sell-pets.php">Sell Pets</a></li>
          <li><a href="buy-pets.php?category=All">Buy Pets</a></li>
          <li><a href="my-pets.php?category=All">My Pets</a></li>
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
          <li><?php echo $vet_data['user_name'] ?></li>
        </ol>
        <h2><?php echo $vet_data['user_name'] ?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="portfolio-details-container">

        <img src=<?php echo "uploads/". $vet_data['image'] ?> class="img-fluid" alt="">
            

          <div class="portfolio-info">
            <h3>Project information</h3>
            <ul>
              <li><strong>Name</strong>: <?php echo $vet_data['user_name'] ?></li>
              <li><strong>Phone</strong>: 0<?php echo $vet_data['phone'] ?></li>
              <li><strong>Email</strong>: <?php echo $vet_data['email'] ?></li>
              <li><strong>Date Created</strong>: <?php echo $vet_data['date'] ?></li>
            </ul>
          </div>

        </div>

        <div class="portfolio-description">
            <h2>Ask This Vet a Question</h2>
            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <textarea class="form-control my-3" rows="5" name="question" placeholder="write your question here.."></textarea>
                <button type="submit" class="btn btn-primary">Ask This Question</button>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        if(isset($_POST['question'])){
                            $question = $_POST['question'];
                            $vet_name = $vet_data['user_name'];
        
                            $ask_question_query = "insert into questions (owner_name,vet_name,question,answer) values ('$user_name','$vet_name','$question','')";
                            $ask_question = mysqli_query($con, $ask_question_query);
                        
                            if($ask_question) {
                                echo "Successfully added your question.";
                            } else {
                                echo "error adding your question, try again later!";
                            }
                        }
                    }
                ?>
            </form>
        </div>

        <div class="portfolio-description">
            <h2>Book Reservation</h2>
            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col">
                        <label>Reservation Day:</label>
                        <input type="date" class="form-control" placeholder="Reservation Day" name="reserv_day" required>
                    </div>
                    <div class="col">
                        <label>Reservation Time:</label>
                        <input type="text" class="form-control" placeholder="Reservation Time" name="reserv_time" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Book Now</button>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        if(isset($_POST['reserv_day'])){
                            $reserv_day = $_POST['reserv_day'];
                            $reserv_time = $_POST['reserv_time'];
                            $vet_name = $vet_data['user_name'];
        
                            $new_reserv_query = "insert into reservations (owner_name,vet_name,reserv_day,reserv_time) values ('$user_name','$vet_name','$reserv_day','$reserv_time')";
                            $new_reserv = mysqli_query($con, $new_reserv_query);
                        
                            if($new_reserv) {
                                echo "Successfully added your Reservation.";
                            } else {
                                echo "error adding your Reservation, try again later!";
                            }
                        }
                    }
                ?>
            </form>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Tempo</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

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
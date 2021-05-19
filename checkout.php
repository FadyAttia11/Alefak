<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];
    $product_id = $_GET["id"];

    $product_info_query = "select * from store where id = '$product_id'";
    $product_info = mysqli_query($con, $product_info_query);

    if($product_info) {
        $current_product = mysqli_fetch_assoc($product_info);
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
          <li><a href="buy-pets.php">Buy Pets</a></li>
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
<div class="container mb-5" style="max-width: 400px; margin-top: 100px;">
    <h1>Checkout</h1>
    <h3>for: <?php echo $current_product['item_name'] ?></h3>
    <h5>price: <?php echo $current_product['price'] ?></h5>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $get_money_query = "select * from users where user_role = 'admin'";
            $get_money = mysqli_query($con, $get_money_query);
    
            if($get_money && mysqli_num_rows($get_money) > 0) {
                
                $current_money = mysqli_fetch_assoc($get_money);
                $updated_money = $current_money['money'] + $current_product['price'];

                // echo "Successfully purchased your product";
    
                $add_money_query = "update users set money = '$updated_money' where user_role = 'admin'";
                $add_money = mysqli_query($con, $add_money_query);
    
                if($add_money) {
                    $item_id = $current_product['id'];
                    $price = $current_product['price'];
                    $location = $_POST['location'];
                    $day = $_POST['day'];

                    $add_purchased_query = "insert into purchased (item_id,owner_name,location,day) values ('$item_id','$user_name','$location','$day')";
                    $add_purchased = mysqli_query($con, $add_purchased_query);

                    if($add_purchased) {
                        echo "Successfully purchased your product";
                    } else {
                        echo "error inserting the purchased item";
                    }
                } else {
                    echo "error adding money to our account";
                }
            }
        }
    ?>

    <form method="post" class="m-auto">
        <div class="form-group mt-2">
            <label>Card holder's name</label>
        <input type="text" placeholder="Card holder's name" class="form-control">
        </div>
        <div class="form-group">
        <label>Card number</label>
        <input type="number" placeholder="Card number" class="form-control">
        </div>
        <div class="form-group">
            <label>Expire Date</label>
            <input type="date" placeholder="dd/mm/yy" class="form-control">
        </div>
        <div class="form-group">
            <label>CVV</label>
            <input type="text" placeholder="CVV" class="form-control">
        </div>
        <div class="form-group">
            <label>Drop-off Location</label>
            <input type="text" name="location" placeholder="Location" class="form-control">
        </div>
        <div class="form-group">
            <label>Drop-off Time (Day)</label>
            <input type="text" name="day" placeholder="Deliver Day" class="form-control">
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary m-auto" value="Buy Item">
        </div>
    </form>

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
<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

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
          <li class="active"><a href="new-shop.php">Add To Shop</a></li>
          <li><a href="pet-shop.php">Pet Shop</a></li>
          <li><a href="shop-reserv.php">Shop Reservations</a></li>
          <li><a href="vet-reserv.php">Vet Reservations</a></li>          
          <li><a href="#">Balance: <?php echo $user_data['balance'] ?> L.E</a></li>
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
          <li>Add To Shop</li>
        </ol>
        <h2>Add To Shop</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h3>Add To Shop</h3>
        
        <form method="post" enctype="multipart/form-data">
        <input type="text" class="form-control mb-3" placeholder="Item Name" name="item_name" required>

        <div class="row mb-3">
            <div class="col">
                <select class="form-control mb-3" name="category" required>
                    <option disabled selected value>Item Category</option>
                    <option>Food</option>
                    <option>Accessories</option>
                </select> 
            </div>
            <div class="col">
                <input type="number" class="form-control" placeholder="Price" name="price" required>
            </div>
        </div>
        
        <textarea class="form-control mb-3" rows="5" name="description" placeholder="Write description here.."></textarea>


        <label for="fileToUpload">Item Image: </label>
        <input type="file" name="fileToUpload" class="mb-3" id="fileToUpload" required> <br>


        <button type="submit" class="btn btn-primary">Add To Shop</button>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $image = '';
                $item_name = $_POST['item_name'];
                $category = $_POST['category'];
                $price = $_POST['price'];
                $description = $_POST['description'];

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $image = time() . basename($_FILES["fileToUpload"]["name"]);
                    $error_msg = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                    $error_msg = "Sorry, there was an error uploading your image.";
                }


                $query = "insert into store (item_name,category,price,image,description) values ('$item_name','$category','$price','$image','$description')";
                $result = mysqli_query($con, $query);

                if($result) {
                    echo "Successfully added your item!";
                } else {
                    echo "Error adding your item!";
                }
            }
        ?>
        </form>

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
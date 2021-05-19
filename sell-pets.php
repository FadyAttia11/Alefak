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
          <li><a href="pet-shop.php">Pet Shop</a></li>
          <li><a href="all-vets.php">All Vets</a></li>
          <li class="active"><a href="sell-pets.php">Sell Pets</a></li>
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
          <li><a href="index.php">Home</a></li>
          <li>Sell Pets</li>
        </ol>
        <h2>Sell Pets</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

      <h3>Sell Pets</h3>
        
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <label>Pet Name:</label>
            <input type="text" class="form-control mb-3" placeholder="Ex: Bella" name="pet_name" required>
            <div class="row mb-3">
                <div class="col">
                    <label>Category:</label>
                    <select class="form-control" name="category" required>
                        <option disabled selected value>Choose Category</option>
                        <option>Dogs</option>
                        <option>Cats</option>
                        <option>Birds</option>
                        <option>Fish</option>
                        <option>Turtles</option>
                    </select> 
                </div>
                <div class="col">
                    <label>Breed:</label>
                    <input type="text" class="form-control" placeholder="Ex: German Shepherd" name="breed" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Minimum Ask Price:</label>
                    <input type="number" class="form-control" placeholder="Ex: 1200 L.E" name="min_price" required>
                </div>
                <div class="col">
                    <label>Available Time:</label>
                    <input type="text" class="form-control" placeholder="Ex: 2weeks" name="time" required>
                </div>
            </div>

            <label for="fileToUpload">Pet Image: </label>
            <input type="file" name="fileToUpload" class="mb-3" id="fileToUpload" required> <br>

            <button type="submit" class="btn btn-primary">Sell This Pet</button>
            <?php
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    $image = '';
                    $owner_name = $user_data['user_name'];
                    $pet_name = $_POST['pet_name'];
                    $category = $_POST['category'];
                    $breed = $_POST['breed'];
                    $min_price = $_POST['min_price'];
                    $time = $_POST['time'];

                    $target_dir = "uploads/";
                    $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $image = time() . basename($_FILES["fileToUpload"]["name"]);
                        $error_msg = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    } else {
                        $error_msg = "Sorry, there was an error uploading your image.";
                    }

                    $query = "insert into pets (owner_name,pet_name,category,breed,min_price,time,image) values ('$owner_name','$pet_name','$category','$breed','$min_price','$time','$image')";
                    $result = mysqli_query($con, $query);

                    if($result) {
                        echo "Successfully added your pet to the shop!";
                    } else {
                        echo "Error adding the pet!";
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
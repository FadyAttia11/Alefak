<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];

    $my_jobs_query = "select purchased.id, purchased.owner_name, purchased.location, purchased.day, purchased.state, 
    store.item_name, users.phone
    from delivery
    join purchased on delivery.purchased_id = purchased.id
    join store on purchased.item_id = store.id 
    join users on purchased.owner_name = users.user_name
    where delivery_name = '$user_name'";
    $my_jobs = mysqli_query($con, $my_jobs_query);
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
          <li class="active"><a href="assigned-jobs.php">Assigned Jobs</a></li>
          <li><a href="#">Delivery: <?php echo $user_data['user_name'] ?></a></li>
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
          <li>My Jobs</li>
        </ol>
        <h2>My Jobs</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <h3>My Jobs</h3>
        
            <?php
                while($row = mysqli_fetch_array($my_jobs)) {
            ?>

            <div class="card col-5 ml-2">
                <div class="card-body">
                    <h5 class="card-title">Item Name: <?php echo $row['item_name'] ?></h5>
                    <p class="card-text">Owner Name: <?php echo $row['owner_name'] ?></p>
                    <p class="card-text">Owner Phone: 0<?php echo $row['phone'] ?></p>
                    <p class="card-text">Drop-off Location: <?php echo $row['location'] ?></p>
                    <p class="card-text">Drop-off Time: <?php echo $row['day'] ?></p>
                    <?php 
                        if($row['state'] == 'Pending Delivery Acceptance') {
                    ?>
                    <form method="post">
                    <input type="hidden" name="purchased_id" value=<?php echo $row['id'] ?>>   
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST") {
                            $purchased_id = $_POST['purchased_id'];

                            $query = "insert into delivery (delivery_name,purchased_id) values ('$delivery_name','$purchased_id')";
                            $result = mysqli_query($con, $query);

                            if($result) {
                                $update_state_query = "update purchased set state = 'Confirmed from Delivery' where id = '$purchased_id'";
                                $update_state = mysqli_query($con, $update_state_query);

                                if($update_state) {
                                    echo "Successfully assigned this to the delivery: ". $delivery_name;
                                }
                            } else {
                                echo "Error adding your item!";
                            }
                        }
                    ?>
                    </form>
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <p class="card-text">Delivery State: <?php echo $row['state'] ?></p>
                </div>
            </div>

            <?php } ?>
            

            </tbody>
        </table>
        
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
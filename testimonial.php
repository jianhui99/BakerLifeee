<?php
require_once 'database/db_connection.php';

$sql = "select * from testimonial where status = 1";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>BakerLifeee</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!--slick slider stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- slick slider -->

  <link rel="stylesheet" href="css/slick-theme.css" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link href="images\Favicon\store-logo.jpeg" rel="icon">

</head>

<body class="sub_page">

  <div class="main_body_content">

    <div class="hero_area">
      <!-- header section strats -->
      <?php require_once 'navbar.php'; ?>

      <!-- end header section -->
    </div>


    <!-- client section -->

    <section class="client_section layout_padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <div class="img-box sub_img-box">
              <img src="images/client-chocolate.png" alt="">
            </div>
          </div>
          <div class="col-lg-6 px-0">
            <div class="client_container">
              <div class="heading_container">
                <h2>
                  Testimonial
                </h2>
              </div>
              <div id="customCarousel2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php
                  while($row=mysqli_fetch_assoc($result)){
                    if($row['set_default'] == '1') { ?>
                  <div class="carousel-item active">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/Testimonial/<?= $row['image']?>" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                        <?= $row['title']?>
                        </h4>
                        <p>
                        <?= $row['description']?>
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                    <?php }else{ ?>
                      <div class="carousel-item">
                        <div class="box">
                          <div class="img-box">
                            <img src="images/Testimonial/<?= $row['image']?>" alt="">
                          </div>
                          <div class="detail-box">
                            <h4>
                            <?= $row['title']?>
                            </h4>
                            <p>
                            <?= $row['description']?>
                            </p>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                          </div>
                      </div>
                    </div>
                    <?php } ?>
                  <?php } ?>
                </div>
                
                <div class="carousel_btn-box">
                  <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end client section -->

    <!-- info section -->
    <?php require_once 'info.php'; ?>


    <!-- end info_section -->

  </div>

  <!-- footer section -->
  <?php require_once 'footer.php'; ?>

  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- slick slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->

</body>

</html>
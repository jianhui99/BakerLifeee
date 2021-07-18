<?php
require_once 'database/db_connection.php';

$sql = "select * from banner where status = 1";
$result = mysqli_query($con, $sql);

if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
    $ip = $_SERVER['HTTP_CLIENT_IP'];  
}  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
}  
else{  
    $ip = $_SERVER['REMOTE_ADDR'];  
}

if(!empty($ip)){
    $ip = $ip;
}else{
    $ip = "private visitor";
}

// check have add b4
$check = "select * from visitor where ip_address = '$ip'";
$check_result = $con->query($check);

if($check_result->num_rows == 0){
    $insert_sql = "insert into visitor(ip_address) values('$ip')";
    $insert_query = $con->query($insert_sql);
}

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
  <!-- favicon -->
  <link href="images\Favicon\store-logo.jpeg" rel="icon">


</head>

<body>

  <div class="main_body_content">

    <div class="hero_area">
      <!-- header section strats -->
        <?php require_once 'navbar.php'; ?>
      <!-- end header section -->
      <!-- slider section -->
      <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
          <?php
            while($row=mysqli_fetch_assoc($result)){
              if($row['set_default'] == '1') { ?>
                <div class="carousel-item active">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="detail_box">
                          <h1>
                            <?= $row['title'] ?>
                          </h1>
                          <h3>
                          <?= $row['description'] ?>
                          </h3>
                        </div>
                      </div>
                      <div class="col-md-4 ml-auto">
                        <!-- <div class="img-box"> -->
                        <div class="banner-img-box">
                          <img src="images/Banner/<?= $row['image'] ?>" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }else{ ?>
            <div class="carousel-item ">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="detail_box">
                      <h1>
                        <?= $row['title'] ?>
                      </h1>
                      <h3>
                      <?= $row['description'] ?>
                      </h3>
                    </div>
                  </div>
                  <div class="col-md-4 ml-auto">
                    <div class="banner-img-box">
                    <img src="images/Banner/<?= $row['image'] ?>" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
                  <?php } ?>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </section>
      <!-- end slider section -->
    </div>

    <!-- about section -->

    <!-- <section class="about_section layout_padding ">
      <div class="container  ">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  About Our Company
                </h2>
              </div>
              <p>
                Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web pagend web page editors now use Lorem Ipsum as their default model text, </p>
              <a href="#">
                <span>
                  Read More
                </span>
                <img src="images/color-arrow.png" alt="">
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/about-img.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- end about section -->

    <!-- chocolate section -->

    <!-- <section class="chocolate_section ">
      <div class="container">
        <div class="heading_container">
          <h2>
            Our chocolate products
          </h2>
          <p>
            Many desktop publishing packages and web pagend web page editors now use Lorem Ipsum as their
          </p>
        </div>
      </div>
      <div class="container">
        <div class="chocolate_container">
          <div class="box">
            <div class="img-box">
              <img src="images/chocolate1.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Yummy <span>chocolate</span>
              </h6>
              <h5>
                $5.0
              </h5>
              <a href="">
                BUY NOW
              </a>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/chocolate2.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Yummy <span>chocolate</span>
              </h6>
              <h5>
                $5.0
              </h5>
              <a href="">
                BUY NOW
              </a>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/chocolate3.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Yummy <span>chocolate</span>
              </h6>
              <h5>
                $5.0
              </h5>
              <a href="">
                BUY NOW
              </a>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/chocolate1.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Yummy <span>chocolate</span>
              </h6>
              <h5>
                $5.0
              </h5>
              <a href="">
                BUY NOW
              </a>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/chocolate2.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Yummy <span>chocolate</span>
              </h6>
              <h5>
                $5.0
              </h5>
              <a href="">
                BUY NOW
              </a>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/chocolate3.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Yummy <span>chocolate</span>
              </h6>
              <h5>
                $5.0
              </h5>
              <a href="">
                BUY NOW
              </a>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- end chocolate section -->

    <!-- offer section -->

    <!-- <section class="offer_section layout_padding">
      <div class="container">
        <div class="box">
          <div class="detail-box">
            <h2>
              Offers on Products
            </h2>
            <h3>
              Get 5% Offer <br>
              any Chocolate items
            </h3>
            <a href="">
              Buy Now
            </a>
          </div>
          <div class="img-box">
            <img src="images/offer-img.png" alt="">
          </div>
        </div>
        <div class="btn-box">
          <a href="">
            <span>
              See More
            </span>
            <img src="images/color-arrow.png" alt="">
          </a>
        </div>
      </div>
    </section> -->

    <!-- end offer section -->

    <!-- client section -->

    <!-- <section class="client_section">
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
                  <div class="carousel-item active">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/client-img.jpg" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                          Gero Miliya
                        </h4>
                        <p>
                          long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/client-img.jpg" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                          Gero Miliya
                        </h4>
                        <p>
                          long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/client-img.jpg" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                          Gero Miliya
                        </h4>
                        <p>
                          long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
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
    </section> -->

    <!-- end client section -->


    <!-- contact section -->

    <!-- <section class="contact_section layout_padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 col-lg-4 offset-md-1 offset-lg-2">
            <div class="form_container">
              <div class="heading_container">
                <h2>
                  Contact Us
                </h2>
              </div>
              <form action="">
                <div>
                  <input type="text" placeholder="Full Name " />
                </div>
                <div>
                  <input type="text" placeholder="Phone number" />
                </div>
                <div>
                  <input type="email" placeholder="Email" />
                </div>
                <div>
                  <input type="text" class="message-box" placeholder="Message" />
                </div>
                <div class="d-flex ">
                  <button>
                    SEND NOW
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6  px-0">
            <div class="map_container">
              <div class="map">
                <div id="googleMap"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- end contact section -->


    <!-- info section -->
    <?php require_once 'info.php'; ?>
    <!-- end info_section -->

  </div>

  <!-- footer section -->
  <?php require_once 'footer.php'; ?>
  <!-- footer section -->

  <!-- jQery -->
  <script  src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script  src="js/bootstrap.js"></script>
  <!-- slick slider -->
  <script  src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
  <!-- custom js -->
  <script  src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>
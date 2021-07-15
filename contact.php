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


    <!-- contact section -->

    <section class="contact_section layout_padding">
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
                  <input type="text" placeholder="Full Name " id="fullname" required/>
                </div>
                <div>
                  <input type="text" placeholder="Phone number" id="phone" required/>
                </div>
                <div>
                  <input type="text" placeholder="Subject" id="subject" required/>
                </div>
                <div>
                  <input type="text" class="message-box" placeholder="Message" id="message" required/>
                </div>
                <div class="d-flex ">
                  <button id="sendEmailBtn">
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
    </section>

    <!-- end contact section -->


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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

  <script>
    $('#sendEmailBtn').on('click', function (){
      var username = $('#fullname').val();
      var phonenumber = $('#phone').val();
      var message = $('#message').val();
      var subject = $('#subject').val();
      var content = "Username: " + username + ", Phone: " + phonenumber + " | Message: " + message;

      if(username == '' || phonenumber == '' || subject == '' || message == ''){
        alert('Please key in the required info');
      }else{
        window.open("mailto:ahheng1224@gmail.com?subject="+subject+"&body="+ content);
      }

    }); 
</script>

</body>

</html>
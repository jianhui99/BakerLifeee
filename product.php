<?php
require_once 'database/db_connection.php';

$sql = "select * from product where status = 1";
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

    <!-- product section -->
    <section class="chocolate_section layout_padding">
      <div class="container">
        <div class="heading_container">
          <h2>
            Our bakey products
          </h2>
          <p>
          Homemade baking is a very personal thing and we aim for perfection, safety, and delicious in all that we create.
          </p>
          <p>Click to view product details</p>
        </div>
      </div>
      <div class="container">
        <div class="chocolate_container">
          <?php
            while($row=mysqli_fetch_assoc($result)){ ?>
            <div class="box"  style="cursor:help" onclick="location.href='product_details.php?p=<?php echo(base64_encode($row['id'])); ?>'">
            <div class="img-box">
              <img src="images/Product/<?= $row['image']?>" alt="<?= $row['name']?>">
            </div>
            <div class="detail-box">
              <h6><?= $row['name']?></h6>
              <b><a href="contact.php">Order Now</a></b>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- end product section -->

    <?php
      $contact_flag = "
      <html>
          <style>
              .label-container{
                position:fixed;
                bottom:48px;
                right:105px;
                display:table;
                visibility: hidden;
              }
              
              .label-text{
                color:white;
                background:black;
                display:table-cell;
                vertical-align:middle;
                padding:10px;
                border-radius:3px;
                z-index=999;
              }

              
              .float{
                position:fixed;
                width:60px;
                height:60px;
                bottom:40px;
                right:40px;
                background-color:#FFCCCC;
                color:#FFF;
                border-radius:50px;
                text-align:center;
                box-shadow: 2px 2px 3px #999;
                z-index: 999;
              }
              
              .my-float{
                font-size:24px;
                margin-top:20px;
                color: #FF9966;
              }
              
              a.float + div.label-container {
                visibility: hidden;
                opacity: 0;
                transition: visibility 1s, opacity 1s ease;
              }
              
              a.float:hover + div.label-container{
                visibility: visible;
                opacity: 1;
              }
          </style>
          <body>
              <a href='https://api.whatsapp.com/send?phone=60169874564' class='float' target='_blank'>
              <i class='fa fa-phone my-float'></i>
              </a>
              <div class='label-container'>
              </div>
          </body>
      </html>";
      echo($contact_flag);
    ?>

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

</body>

</html>
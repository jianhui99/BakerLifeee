<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="dashboard.php">BakerAdmin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="banner.php">Banner</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="testimonial.php">Testimonial</a>
      </li>
    </ul>

    <h3 style="margin-right: 10px;">Hi, <?= ucfirst($admin_name) ?></h3>
    <a class="btn btn-outline-danger my-2 my-sm-0" href="logout.php">Logout</a>

  </div>
</nav>
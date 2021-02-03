<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ROCKET</title>

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

  <!-- Custom CSS file -->
  <link rel="stylesheet" href="style.css">

  <?php
    // Require MySQL connection
    require ('db.php');
  ?>
</head>
<body>
  <!-- header -->
  <header id="header" style='z-index: 1'>
    <!-- Primary navbar -->
    <nav class="navbar navbar-expand-lg navbar-light color-header-bg">
      <!-- Rocket Logo -->
      <a class="navbar-brand font-baloo font-size-16" href="../Rocket/index.php">
        <img src="images/clipart1530219.png" width="35" height="35" alt="">ROCKET
      </a>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Service & Support -->
        <ul class="navbar-nav float-left">
          <li class="nav-item">
            <a class="nav-link font-baloo font-weight-bold font-size-18" href="maintenance.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link font-baloo font-weight-bold font-size-18 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Service
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item font-baloo" href="maintenance.php"><i class="fas fa-book"></i> Terms</a>
              <a class="dropdown-item font-baloo" href="maintenance.php"><i class="fas fa-file-word"></i> Warranty</a>
              <a class="dropdown-item font-baloo" href="maintenance.php"><i class="fas fa-syringe"></i> Disease Control</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link font-baloo font-weight-bold font-size-18 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Support
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item font-baloo" href="maintenance.php"><i class="fa fa-envelope"></i> Email</a>
              <a class="dropdown-item font-baloo" href="maintenance.php"><i class="fa fa-comments"></i> Chat</a>
              <a class="dropdown-item font-baloo" href="maintenance.php"><i class="fa fa-phone"></i> Phone Support</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="maintenance.php"><i class="fa fa-credit-card"></i> Make a Payment</a>
            </div>
          </li>
        </ul>

        <!-- Search box -->
        <div class="search form-inline navbar-center m-auto">
          <form action="search.php" method="POST">
            <input id="search-box" class="form-control mr-sm-2" style="width:400px" type="textbox" onfocus="this.value=''"
              placeholder="Search..." name="search">
            <input class="form-control mr-sm-2" type="submit" name="submit">
          </form>
        </div>

        <!-- Sign in & Cart section -->
        <ul class="navbar-nav float-left">
          <li class="nav-item">
            <a class="nav-link font-baloo font-weight-bold font-size-16 px-4 border-left" href="maintenance.php"><i class="fas fa-signature"></i> Sign in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-baloo font-weight-bold font-size-16 px-4 border-left border-right" href="upload.php"><i class="fas fa-sign-in-alt"></i> Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-baloo font-weight-bold font-size-16 px-4 border-right" href="maintenance.php"><i class="fas fa-shopping-cart"></i> Cart (0)</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Secondary navbar -->
    <nav class="navbar-expand-lg navbar-dark color-navbar-bg">
      <!-- Product categories -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav m-auto font-rubik">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pokemons
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="maintenance.php"><i class="fas fa-seedling"></i> Wild</a>
              <a class="dropdown-item" href="maintenance.php"><i class="fas fa-warehouse"></i> Farmed</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="maintenance.php">Best Sellers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="maintenance.php">New Releases</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="maintenance.php">Coming Soon</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
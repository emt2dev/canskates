<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CAN Skates</title>
  <?php
  // boostrap
    $_SESSION['base_url'] = 'http://localhost/canskates/';
      echo "
      <link href='".$_SESSION['base_url']."/includes/assets/css/bootstrap.min.css' rel='stylesheet'>
      <link rel='stylesheet' href='".$_SESSION['base_url']."/includes/assets/css/forms.css'>
      <script src='".$_SESSION['base_url']."/includes/assets/js/bootstrap.bundle.min.js'></script>
      ";
  ?>
</head>
<header>
  <div class="bg-dark">
    <center>
      <img src='<?=$_SESSION['base_url']?>includes/assets/media/placeholder.svg' width='225px' height='175px'>
      <h4>CAN Skates</h4>
    </center>
  </div>
</header>
<body class="bg-dark">
<div class="wrapper" style="background-color: #C3FF99">
  <div class="row">
      <div class="dropdown col-md-2 bg-success">
        <a class="btn btn-success dropdown-toggle text-warning" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          SHOP
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">NEW</a></li>
          <li><a class="dropdown-item" href="#">DECKS</a></li>
          <li><a class="dropdown-item" href="#">COMPLETES</a></li>
          <li><a class="dropdown-item" href="#">APPAREL & SWAG</a></li>
          <li><a class="dropdown-item" href="#">ACCESSORIES</a></li>
        </ul>
      </div>
      <!-- <div class="col-md-3 btn-success text-warning">
        <h4>TEAM</h4>
      </div> -->
      <div class="dropdown col-md-2 bg-success">
        <a class="btn btn-success dropdown-toggle text-warning" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          MEET THE TEAM
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">COMING SOON</a></li>
          <!-- <li><a class="dropdown-item" href="#">DECKS</a></li>
          <li><a class="dropdown-item" href="#">COMPLETES</a></li>
          <li><a class="dropdown-item" href="#">APPAREL & SWAG</a></li>
          <li><a class="dropdown-item" href="#">ACCESSORIES</a></li> -->
        </ul>
      </div>
      <div class="dropdown col-md-2 bg-success">
        <a class="btn btn-success dropdown-toggle text-warning" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          OUR CATALOG
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">COMING SOON</a></li>
          <!-- <li><a class="dropdown-item" href="#">DECKS</a></li>
          <li><a class="dropdown-item" href="#">COMPLETES</a></li>
          <li><a class="dropdown-item" href="#">APPAREL & SWAG</a></li>
          <li><a class="dropdown-item" href="#">ACCESSORIES</a></li> -->
        </ul>
      </div>
      <div class="dropdown col-md-2 bg-success">
        <a class="btn btn-success dropdown-toggle text-warning" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          SPONSORSHIP
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">COMING SOON</a></li>
          <!-- <li><a class="dropdown-item" href="#">DECKS</a></li>
          <li><a class="dropdown-item" href="#">COMPLETES</a></li>
          <li><a class="dropdown-item" href="#">APPAREL & SWAG</a></li>
          <li><a class="dropdown-item" href="#">ACCESSORIES</a></li> -->
        </ul>
      </div>
      <div class="dropdown col-md-2 bg-success">
        <a class="btn btn-success dropdown-toggle text-warning" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          MY ACCOUNT
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="<?=$_SESSION['base_url']?>/dashboard">DASHBOARD</a></li>
          <li><a class="dropdown-item" href="<?=$_SESSION['base_url']?>/entry.php">LOGIN / REGISTER</a></li>
          <?php
            if (isset($_SESSION['can_id'])) {
              echo "
                <li>
                <form action='".$_SESSION['base_url']."includes/controllers/general.php' method='post'>
                  <button class='dropdown-item' type='submit' name='account_logout'>Log out</button>
                </form>
                </li>
              ";
            }
          ?>
          <?php
            if (isset($_SESSION['user_id'])) {
              echo "
                <li>
                <form action='".$_SESSION['base_url']."includes/controllers/general.php' method='post'>
                  <button class='dropdown-item' type='submit' name='account_logout'>Log out</button>
                </form>
                </li>
              ";
            }
          ?>
        </ul>
      </div>
      <div class="dropdown col-md-2 bg-success">
        <a class="btn btn-success dropdown-toggle text-warning" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          CART
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">WISHLIST</a></li>
          <li><a class="dropdown-item" href="#">VIEW CART</a></li>
          <li><a class="dropdown-item" href="#">SUPPORT</a></li>
        </ul>
      </div>
    </div>
<br />
  <div class="container" style="background-color: #FEF5AC">
    <div class="row">
      <div class="col">
        <img src="<?=$_SESSION['base_url']?>includes/assets/media/gram.png" height="50px" width="50px">
      </div>
      <div class="col">
        <img src="<?=$_SESSION['base_url']?>includes/assets/media/twttr.png" height="50px" width="75px">
      </div>
      <div class="col">
        <img src="<?=$_SESSION['base_url']?>includes/assets/media/yt.png" height="45px" width="100px">
      </div>
      <div class="col">
        <img src="<?=$_SESSION['base_url']?>includes/assets/media/tktk.png" height="50px" width="50px">
      </div>
    </div>
  </div>
  <br />

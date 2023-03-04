<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CAN Skates</title>
  <?php
  session_start();
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
  <div class="bg-success">
    <center>
      <a href="<?=$_SESSION['base_url']?>"><img src='<?=$_SESSION['base_url']?>includes/assets/media/placeholder.svg' width='225px' height='175px'></a>
      <h4>CAN Skates</h4>
    </center>
  </div>
</header>
<body class="bg-success">
<div class="wrapper" style="background-color: #C3FF99">
  <div class="bg-success">
    <div class="row"><br />
      <div class="container col" style="background-color: #FFF347">
        <h4>Login</h4>
        <form class="form" action="<?=$_SESSION['base_url']?>includes/controllers/general.php" method="post">
          <div class="input-group input-group-icon">
            <label class="text-dark" for="email">
              <?php
                if (isset($_SESSION['email_unfound'])) {
                  echo $_SESSION['email_unfound'];
                }
              ?>
              <?php
                if (isset($_SESSION['new_user_message'])) {
                  echo $_SESSION['new_user_message'];
                } else {
                  echo "Email";
                }
              ?>
            </label>
              <input class="bg-warning" type="text" value="
              <?php
                if (isset($_SESSION['new_user_email'])) {
                  echo $_SESSION['new_user_email'];
                }
              ?>"
               name="email">
          </div>
          <div class="input-group input-group-icon">
            <label class="text-dark" for="password">Password</label>
            <?php
              if (isset($_SESSION['ci_pw_message'])) {
                echo $_SESSION['ci_pw_message'];
              } else {
                echo "Password";
              }
            ?>
              <input class="bg-warning" type="password" name="password" value='Test' />
          </div>
          <button type="submit" class="btn btn-success" name="login_btn">Login</button>
        </form>
        <form class="" action="<?=$_SESSION['base_url']?>includes/controllers/general.php" method="post">
          <div class="">
            <button type="submit" class="btn btn-danger" name="account_logout">Debug Logout</button>
          </div>
        </form>
      </div>
      <div class="container col" style="background-color: #FFF347">
        <h4>Register</h4>
        <form class="form" action="<?=$_SESSION['base_url']?>includes/controllers/general.php" method="post">
          <div class="input-group input-group-icon">
            <label class="text-dark" for="email">Email</label>
              <input class="bg-warning" type="email" name="email">
          </div>
          <div class="input-group input-group-icon">
            <label class="text-dark" for="password">Password</label>
              <input class="bg-warning" type="password" name="password" value='Test'/>
          </div>
          <div class='input-group input-group-icon'>
            <label class='form-label text-dark' for='first'>First Name</label><br />
              <input class="bg-warning" type='text' name='first' required /><br />
          </div>
          <div class='input-group input-group-icon'>
            <label class='form-label text-dark' for='last'>Last Name</label><br />
              <input class="bg-warning" type='text' name='last' required /><br />
          </div>
          <div class='col input-group input-group-icon'>
            <select name='status' class="bg-warning" required>
              <option value='I skate for fun'>I skate for fun</option>
              <option value='I skate and have a fanbase'>I skate and have a fanbase</option>
              <option value='Competitive Skater'>Competitive Skater</option>
              <option value='Looking for Sponsorship'>Looking for Sponsorship</option>
              <option value='Currently Sponsored'>Currently Sponsored</option>
              <option value='Currently Sponsored, but looking for another organization'>Currently Sponsored, but looking for another organization</option>
              <option value='Pro Skater for another brand'>Pro Skater for another brand</option>
              <!-- <option value='Pro Skater for CAN Skates' disabled>Pro Skate for CAN Skates</option> -->
            </select><br />
          </div>
          <div class="input-group">
            <input type="checkbox" checked name="tos" value='1'>
            <label class="text-dark" for="tos">Agree to Terms of Service?</label>
          </div>
          <button type="submit" class="btn btn-success" name="register_btn">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

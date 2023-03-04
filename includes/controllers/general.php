<?php
include "../database/database.php";
include "../models/user_model.php";
include "../models/login_model.php";

/* login button */
if(isset($_POST['login_btn'])) {
    $login_received = new Login_model($_POST['email'], $_POST['password']);
    $login_received->ua_login($connection);
}

/* Logout button */
if(isset($_POST['account_logout'])) {

  session_destroy();
  unset($_SESSION);

  header('Location: http://localhost/canskates/');
  exit();
}

/* clear button, used to clear session variables */
if(isset($_POST['clear'])) {
  unset($_SESSION);
  session_destroy();

  header('Location: http://localhost/canskates/');
  exit();
}


/* Here is our registration code block */
if(isset($_POST['register_btn'])) {

  if ($_POST['tos'] != '1') {

    $_SESSION['tos_agreement'] = 'Sorry, you must agreed to terms of service before registering';
    // header('Location: http://localhost/canskates/entry.php');
    // exit();
  }

/* Sanitize the user input */
  // First Name
  $first = $_POST['first']; // where ever we find a space, remove it (space, remove-space, newVarName)
  $first = ucfirst(strtolower($first)); // converts all letters to lowercase and capitalize the first letter
  $first = filter_var($first, FILTER_SANITIZE_STRING);

  // last_name
  $last = $_POST['last'];
  $last = ucfirst(strtolower($last));
  $last = filter_var($last, FILTER_SANITIZE_STRING);
  // $last_name_temp = " ".$last;

// status
  $status = $_POST['status']; // where ever we find a space, remove it (space, remove-space, newVarName)

  // email
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  $new_password = $_POST['password'];
  $new_password = password_hash($new_password, PASSWORD_DEFAULT); // salts 10 times, encrypts
  $emailCheck = mysqli_query($connection, "SELECT email FROM user_accounts WHERE email='$email'");


  $numberOfRows = mysqli_num_rows($emailCheck); // Counts how many results are returned from this search
  if ($numberOfRows > 0) {
    $_SESSION['email_exists'] = "<a class='btn btn-larg btn-info' href='http://localhost/canskates/entry.php'>This email already exists. Login Here</a>";

    header('Location: http://localhost/canskates/entry.php');
    exit();
  } else {

    $new_user = new User_model($email, $new_password, $status, $first, $last);
    $new_user->ua_save($connection);
    $new_user->dir_setter($connection);
    $new_user->dir_save($connection);

    $_SESSION['registered'] = "You have successfully registered your account.<br />Please check you email for instructions.<br />";

    /* send email here */
     // $new_am_email0 = new Email_model($new_account->email);
     // $new_am_email0->new_am($new_account->vkey);

    unset($_SESSION['password_not_match']);
    unset($_SESSION['email_exists']);
    $_SESSION['new_user_message'] = "Please login using the information you just created";
    $_SESSION['new_user_email'] = $email;

    header('Location: http://localhost/canskates/entry.php');
    exit();
  }
}





?>

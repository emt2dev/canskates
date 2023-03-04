<?php
include "../database/database.php";
include "../models/user_model.php";
include "../models/uploads_model.php";
include "../models/sr_model.php";

$uid_finder = $_SESSION['user_id'];
$ua_email_finder = $_SESSION['email'];

if(isset($_POST['fv_ack_btn'])) {

  unset($_SESSION['file_validity']);

  header('Location: http://localhost/canskates/dashboard/');
  exit();
}


if(isset($_POST['sr_ack_btn'])) {

  unset($_SESSION['sr_sent_message']);

  header('Location: http://localhost/canskates/dashboard/');
  exit();
}

if(isset($_POST['user_sr_btn'])) {
  $u_email = $_SESSION['email'];
  $u_sr_time = time();

  $u_sr = new sr_model($u_email, $_POST['request_reason'], $_POST['request_comments'], $u_sr_time);
  $u_sr->sr_validator($connection, $ua_email_finder);

}

/* upload button */
if(isset($_POST['user_upload_btn'])) {

  $ua_title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $_FILES["user_file"]["name"] = $ua_title;

  $ua_body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);

  $target_dir = "../../uploads/users/".$_SESSION['user_id'].$_SESSION['first'].$_SESSION['last']."/"; // specifies the directory where the file is going to be placed

  if(is_dir($target_dir)) {
    $target_file = $target_dir . basename($_FILES["user_file"]["name"]); // specifies the path of the file to be uploaded

    $uploadOk = 1; //  is not used yet (will be used later) IDK?
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // holds the file extension of the file (in lower case)

  // Check if image file is a actual image or fake image
    // $check = getimagesize($_FILES["user_file"]["tmp_name"]);
    // if($check !== false) {
    //   echo "File is an image - " . $check["mime"] . ".";
    //   $uploadOk = 1;
    // } else {
    //   echo "File is not an image.";
    //   $uploadOk = 0;
    // }

    // Check if file already exists
    if (file_exists($target_file)) {
      $_SESSION['file_exists'] = "File name already exists, please change the name.";
      $uploadOk = 0;

      header('Location: http://localhost/canskates/dashboard/');
      exit();
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["user_file"]["tmp_name"], $target_file)) {
        $_SESSION['file_validity'] =  htmlspecialchars(basename($_FILES["user_file"]["name"])). " has been uploaded.";

        $where_ = "uploads/users/".$_SESSION['user_id'].$_SESSION['first'].$_SESSION['last'];
        $uid_finder = $_SESSION['user_id'];

        $uu_upload = new uploads_model($ua_title, $ua_body);
        $uu_upload->uu($connection, $uid_finder, $where_, $target_file);

        header('Location: http://localhost/canskates/dashboard/');
        exit();
      } else {
        $_SESSION['file_validity'] =  "Sorry, there was an error uploading your file.".$_FILES["user_file"]['error'];

        header('Location: http://localhost/canskates/dashboard/');
        exit();
      }
    }
  } else {
    mkdir($target_dir);

    $target_file = $target_dir . basename($_FILES["user_file"]["name"]); // specifies the path of the file to be uploaded

    $uploadOk = 1; //  is not used yet (will be used later) IDK?
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // holds the file extension of the file (in lower case)

  // Check if image file is a actual image or fake image
    // $check = getimagesize($_FILES["user_file"]["tmp_name"]);
    // if($check !== false) {
    //   $uploadOk = 1;
    // } else {
    //   $_SESSION['file_validity'] = "File is not an image.";
    //   $uploadOk = 0;
    // }

    // Check if file already exists
    if (file_exists($target_file)) {
      $_SESSION['file_exists'] = "File name already exists, please change the name.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["user_file"]["tmp_name"], $target_file)) {
        $_SESSION['file_validity'] = htmlspecialchars(basename($_FILES["user_file"]["name"])). " has been uploaded.";

        $where_ = "uploads/users/".$_SESSION['user_id'].$_SESSION['first'].$_SESSION['last'];
        $uid_finder = $_SESSION['user_id'];

        $uu_upload = new uploads_model($ua_title, $ua_body);
        $uu_upload->uu($connection, $uid_finder, $where_, $target_file);

        header('Location: http://localhost/canskates/dashboard/');
        exit();
      } else {
        $_SESSION['file_validity'] = "Sorry, there was an error uploading your file.".$_FILES["user_file"]['error'];

        header('Location: http://localhost/canskates/dashboard/');
        exit();
      }
    }
  }
}

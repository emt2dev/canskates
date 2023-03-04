<?php
include "../database/database.php";
include "../models/uploads_model.php";

$cid_finder = $_SESSION['can_id'];

$np_1q = "UPDATE product_list SET new_product_indicator=0 WHERE new_product_indicator=1";
$np_2q = "UPDATE product_list SET new_product_indicator=0 WHERE new_product_indicator=2";
$np_3q = "UPDATE product_list SET new_product_indicator=0 WHERE new_product_indicator=3";

$na_1q = "UPDATE posts SET new_post_indicator=0 WHERE new_post_indicator=1";
$na_2q = "UPDATE posts SET new_post_indicator=0 WHERE new_post_indicator=2";
$na_3q = "UPDATE posts SET new_post_indicator=0 WHERE new_post_indicator=3";


if(isset($_POST['fv_ack_btn'])) {

  unset($_SESSION['file_validity']);

  header('Location: http://localhost/canskates/admin/');
  exit();
}



/* Add blog button */
if(isset($_POST['can_article_btn'])) {
  $article_title = filter_var($_POST['article_title'], FILTER_SANITIZE_STRING);
  $article_body = filter_var($_POST['article_body'], FILTER_SANITIZE_STRING);

  $new_post_indicator = intval($_POST['new_post_indicator']);

  if ($new_post_indicator == 1) {
    $na_1q = mysqli_query($connection, $na_1q);
  } else if ($new_post_indicator == 2) {
    $na_2q = mysqli_query($connection, $na_2q);
  } else if ($new_post_indicator == 3) {
    $na_3q = mysqli_query($connection, $na_3q);
  }

  $article_query = "INSERT INTO posts (new_post_indicator, title, body, admin_bool) VALUES (?,?,?,?)" ;
  $article_prep = $connection->prepare($article_query);
  $article_prep->bind_param("issi", $a, $b, $c, $d);

    $a = intval($new_post_indicator);
    $b = $article_title;
    $c = $article_body;
    $d = 1;

  $article_prep->execute();

  $_SESSION['blog_submitted'] = "Created Blog!";

  header('Location: http://localhost/canskates/admin/');
  exit();
}

/* Add product button */
if(isset($_POST['add_product_btn'])) {

  $productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
  $productName = str_replace(' ', '', $productName);

  $productDescription  = filter_var($_POST['productDescription'], FILTER_SANITIZE_STRING);

  $productCost = '';
  $productCost  = filter_var($_POST['productCost'], FILTER_SANITIZE_STRING);
  $productCost = urlencode($_POST['productCost']);
  $productCost = floatval($productCost);

  $productQuantity  = filter_var($_POST['productQuantity'], FILTER_SANITIZE_STRING);
  $productQuantity  = intval($productQuantity);

  $productColor  = filter_var($_POST['productColor'], FILTER_SANITIZE_STRING);
  $productColor = str_replace(' ', '', $productColor);

  $productType  = filter_var($_POST['productType'], FILTER_SANITIZE_STRING);
  $supplierName  = filter_var($_POST['supplierName'], FILTER_SANITIZE_STRING);
  $supplierWebsite  = filter_var($_POST['supplierWebsite'], FILTER_SANITIZE_STRING);
  $supplierInStockBool  = filter_var($_POST['supplierInStockBool'], FILTER_SANITIZE_STRING);

  $product_num_tripwire = 1;

  if ($product_num_tripwire == 1) {
    $product_num_tripwire_send = mysqli_query($connection, "SELECT product_id FROM product_list");
    $product_num_count = mysqli_num_rows($product_num_tripwire_send);

    $product_num_tripwire = 0;
  }
  $new_product_indicator = intval($_POST['new_product_indicator']);

  if ($new_product_indicator == 1) {
    $np_1q = mysqli_query($connection, $np_1q);
  } else if ($new_product_indicator == 2) {
    $np_2q = mysqli_query($connection, $np_2q);
  } else if ($new_product_indicator == 3) {
    $np_3q = mysqli_query($connection, $np_3q);
  }

// /* FILE UPLOAD */
  $_FILES["product_file"]["name"] = strtolower($productName).".".pathinfo($_FILES["product_file"]["name"],PATHINFO_EXTENSION);
  $uploadDir = "../../uploads/products/".$productType."_".$productColor."_";
  $fileName = $uploadDir . basename($_FILES["product_file"]["name"]);

  $db_dir = $_SESSION['base_url'].'uploads/products/'.$productType."_".$productColor."_". basename($_FILES["product_file"]["name"]);

  echo $db_dir;
  $uploadOk = 1; //  is not used yet (will be used later) IDK?
  // $imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
    // $check = getimagesize($_FILES["product_file"]["tmp_name"]);
    // if($check !== false) {
    //   echo "File is an image - " . $check["mime"] . ".";
    //   $uploadOk = 1;
    // } else {
    //   echo "File is not an image.";
    //   $uploadOk = 0;
    // }

    // Check if file already exists
    if (file_exists($fileName)) {

      $_SESSION['file_exists'] = "File name already exists, please change the name.";
      $uploadOk = 0;

      header('Location: http://localhost/canskates/admin/');
      exit();
    } else {
      if (move_uploaded_file($_FILES["product_file"]["tmp_name"], $fileName)) {

        $_SESSION['file_validity'] = $fileName . " has been uploaded.";

        $np_object = new Uploads_model($productName, $productDescription);
        $np_object->new_product($connection, $new_product_indicator, $productCost, $productQuantity, $productColor, $productType, $fileName, $db_dir, $supplierInStockBool, $supplierName, $supplierWebsite);

        header('Location: http://localhost/canskates/admin/');
        exit();
      } else {

        $_SESSION['file_validity'] = "Sorry, there was an error uploading your file.".$_FILES["product_file"]['error'];

        header('Location: http://localhost/canskates/admin/');
        exit();
      }
    }
}

/* update password button */
if(isset($_POST['pw_update_btn'])) {
    $new_ci_pw = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $ci_pw_q = "UPDATE can_staff SET password='$new_ci_pw' WHERE can_id=$cid_finder";

    $ci_pw_send = mysqli_query($connection, $ci_pw_q);

    $_SESSION['ci_pw_message'] = "Password updated, please login with your new password.";

    unset($_SESSION['can_id']);

    header('Location: http://localhost/canskates/entry.php');
    exit();
}

/* Logout button */
if(isset($_POST['account_logout'])) {

  session_destroy();
  unset($_SESSION);

  header('Location: http://localhost/canskates/');
  exit();
}

?>

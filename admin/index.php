<?php
include "../includes/database/database.php";

if (!isset($_SESSION['can_id'])) {

  header('Location: http://localhost/canskates/entry.php');
  exit();
}

include "../includes/partials/header.php";
?>
<div class="container" style="background-color: #C3FF99">
  <div class="row">
    <div class="col">
      <?php
        if (isset($_SESSION['file_validity'])) {

          echo "
          <form action='".$_SESSION['base_url']."/includes/controllers/admin.php' method='post'>
            <button class='btn btn-outline-info' type='submit' id='acknowledge' name='fv_ack_btn'>".$_SESSION['file_validity']."</button>
          </form>
          ";
        }
      ?>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#view_sr_modal">
        <?php
          $cid_finder = $_SESSION['can_id'];
          $sr_unassigned_q_1 = "SELECT * FROM support_request WHERE assigned_to=''";
          $sr_unassigned_send_1 = mysqli_query($connection, $sr_unassigned_q_1);
          $usr_unassigned_counter_1 = mysqli_num_rows($sr_unassigned_send_1);

          if (mysqli_num_rows($sr_unassigned_send_1)) {
            $sr_unassigned_q_2 = "SELECT * FROM support_request WHERE assigned_to=$cid_finder";
            $sr_unassigned_send_2 = mysqli_query($connection, $sr_unassigned_q_2);
            $usr_unassigned_counter_2 = mysqli_num_rows($sr_unassigned_send_2);

            $usr_unassigned_counter_3 = $usr_unassigned_counter_1+$usr_unassigned_counter_2;
            echo $usr_unassigned_counter_3;
          } else {
            echo "0";
          }
        ?>
         SUPPORT REQUESTS
      </button>
    </div>
    <div class="col">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_blog_modal">
        CREATE BLOG
      </button>
    </div>
    <div class="col">
      <?php if(isset($_SESSION['blog_submitted'])) {
        echo $_SESSION['blog_submitted'];
      } ?>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_product_modal">
        ADD PRODUCT
      </button>
    </div>
    <div class="col">
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#update_pw_modal">
        UPDATE PASSWORD
      </button>
    </div>
  </div>
</div>

 <!-- tri feed -->
<div class="wrapper bg-success">
  <div class="row">
    <center>
    <div class="col-lg-8">
      <br />
      <h4>BLOG FEED</h4>
      <?php
        include "../includes/modules/blog_feed.php";
      ?>
      <br />
    </div>
    <div class="col-lg-8">
      <br />
      <h4>USER SUBMITTED FEED</h4>
      <?php
        include "../includes/modules/user_feed.php";
      ?>
      <br />
    </div>
    <div class="col-lg-8">
      <br />
      <h4>NEW PRODUCTS FEED</h4>
      <?php
        include "../includes/modules/products_feed.php";
      ?>
      <br />
    </div>
    </center>
  </div>
  <br />
</div>

<!-- BELOW ARE THE MODALS -->

<!-- Add Blog -->
<div class="modal fade" id="add_blog_modal" tabindex="-1" aria-labelledby="add_blog_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header bg-dark">
        <h4 class="modal-title" id="add_blog_label">Create a blog!</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container" style="background-color: #C3FF99">
          <form class="form" action="<?=$_SESSION['base_url']?>includes/controllers/admin.php" method="post">
            <div class="col input-group input-group-icon">
              <label class="text-dark" for="new_post_indicator">Highlight This Blog?</label>
            </div>
            <div class='col input-group input-group-icon'>
              <select name='new_post_indicator' class="bg-warning" required>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='0'>No</option>
                <!-- <option value='Pro Skater for CAN Skates' disabled>Pro Skate for CAN Skates</option> -->
              </select><br />
            </div>
            <div class="input-group input-group-icon">
                <label class='text-dark' for=""><strong>Title</strong></label>
                  <input class='text-dark' type="text" name="article_title" />
            </div>
            <div class="input-group input-group-icon">
                <label class='text-dark' for=""><strong>Body</strong></label>
                <textarea name="article_body" rows="8" cols="80"></textarea>
            </div>
            <div class="input-group input-group-icon">
                <button type="submit" name="can_article_btn">Post</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- add product -->
<div class="modal fade" id="add_product_modal" tabindex="-1" aria-labelledby="add_product_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="add_product_label">Add Product</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container" style="background-color: #C3FF99">
          <form class="form" action="<?=$_SESSION['base_url']?>includes/controllers/admin.php" enctype='multipart/form-data' method="post">
            <div class="col input-group input-group-icon">
              <label class="text-dark" for="new_product_indicator">Highlight This Product?</label>
            </div>
            <div class='col input-group input-group-icon'>
              <select name='new_product_indicator' class="bg-warning" required>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='0'>No</option>
                <!-- <option value='Pro Skater for CAN Skates' disabled>Pro Skate for CAN Skates</option> -->
              </select><br />
            </div>
            <div class="input-group input-group-icon">
              <label class="text-dark" for="productName">Product Name</label>
                <input class="text-light bg-dark" type="text" name="productName" />
            </div>
            <div class="input-group input-group-icon">
              <label class="text-dark" for="productDescription">Product Description</label>
                <input class="text-light bg-dark" type="text" name="productDescription" />
            </div>
            <div class="input-group input-group-icon">
              <label class="text-dark" for="productCost">Product Cost</label>
                <input class="text-light bg-dark" type="text" name="productCost" />
            </div>
            <div class="input-group input-group-icon">
              <label class="text-dark" for="productQuantity">Product Quantity (Our stock)</label>
                <input class="text-light bg-dark" type="number" name="productQuantity" />
            </div>
            <div class="col input-group input-group-icon">
              <label class="text-dark" for="productColor">Product Color</label>
                <input class="text-light bg-dark" type="text" name="productColor" />
            </div>
            <div class=''>
              <label class='text-light' for='product_file'>Upload File</label><br />
                <input type='file' name='product_file' required /><br />
            </div>
            <div class="col input-group input-group-icon">
              <label class="text-dark" for="productType">Product Type</label>
            </div>
            <div class='col input-group input-group-icon'>
              <select name='productType' class="bg-warning" required>
                <option value='Decks'>Decks</option>
                <option value='Complete'>Completes</option>
                <option value='Apparel'>Apparel</option>
                <option value='Swag'>Swag</option>
                <option value='Accessories'>Accessories</option>
                <!-- <option value='Pro Skater for CAN Skates' disabled>Pro Skate for CAN Skates</option> -->
              </select><br />
            </div>
            <div class="input-group input-group-icon">
              <label class="text-dark" for="supplierName">Supplier Name</label>
                <input class="text-light bg-dark" type="text" name="supplierName" />
            </div>
            <div class="input-group input-group-icon">
              <label class="text-dark" for="supplierWebsite">Supplier Website</label>
                <input class="text-light bg-dark" type="text" name="supplierWebsite" />
            </div>
            <div class="col input-group input-group-icon">
              <label class="text-dark" for="supplierInStockBool">Supplier In-stock?</label>
            </div>
            <div class='col input-group input-group-icon'>
              <select name='supplierInStockBool' class="bg-warning" required>
                <option value='In stock'>In Stock</option>
                <option value='Out of stock'>Out of stock</option>
                <option value='Back Order'>Back order</option>
                <!-- <option value='Pro Skater for CAN Skates' disabled>Pro Skate for CAN Skates</option> -->
              </select><br />
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="add_product_btn">Add Product</button>
          </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- view sr -->
<div class="modal fade" id="view_sr_modal" tabindex="-1" aria-labelledby="view_sr_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>COMING SOON</h4>
        <h5 class="modal-title" id="view_sr_label">View Support Requests</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container" style="background-color: #C3FF99">
          <form class="form" action="<?=$_SESSION['base_url']?>includes/controllers/admin.php" method="post">
            <div class="input-group input-group-icon">
                <button type="submit" name="view_sr_all_btn">View all not assigned to anyone</button>
                <button type="submit" name="view_sr_me_btn">View all assigned to me</button>
            </div>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Update PW -->
<div class="modal fade" id="update_pw_modal" tabindex="-1" aria-labelledby="update_pw_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_pw_label">Update Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container" style="background-color: #C3FF99">
          <form class="form" action="<?=$_SESSION['base_url']?>includes/controllers/admin.php" method="post">
            <div class="input-group input-group-icon">
              <label class="text-dark" for="password">Update Password</label>
                <input class="text-light bg-dark" type="text" name="password" />
            </div>
            <button type="submit" name="pw_update_btn">Change Password</button>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

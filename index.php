<?php
// include "includes/database/database.php";
include "includes/partials/header.php";
?>
<!-- <div class="wrapper" style="background-color: #7FB77E"> -->
<div class="wrapper bg-success">
  <div class="row">
    <center>
    <div class="col-lg-8">
      <br />
      <h4>BLOG FEED</h4>
      <?php
        include "includes/modules/blog_feed.php";
      ?>
      <br />
    </div>
    <div class="col-lg-8">
      <br />
      <h4>USER SUBMITTED FEED</h4>
      <?php
        include "includes/modules/user_feed.php";
      ?>
      <br />
    </div>
    <div class="col-lg-8">
      <br />
      <h4>NEW PRODUCTS FEED</h4>
      <?php
        include "includes/modules/products_feed.php";
      ?>
      <br />
    </div>
    </center>
  </div>
  <br />
</div>
</body>
<?php
include "includes/partials/footer.php";
?>

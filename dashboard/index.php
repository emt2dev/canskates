<?php
include "../includes/database/database.php";
if (!isset($_SESSION['user_id'])) {

  header('Location: http://localhost/canskates/entry.php');
  exit();
}

include "../includes/partials/header.php";

?>
<div class="wrapper" style="background-color: #C3FF99">
  <div class='container' style="background-color: #C3FF99">
    <?php
      if (isset($_SESSION['file_validity'])) {

        echo "
        <form action='".$_SESSION['base_url']."/includes/controllers/admin.php' method='post'>
          <button class='btn btn-outline-info' type='submit' id='acknowledge' name='fv_ack_btn'>".$_SESSION['file_validity']."</button>
        </form>
        ";
      }
    ?>
    <?php
      if (isset($_SESSION['sr_sent_message'])) {
          echo "
          <form action='".$_SESSION['base_url']."/includes/controllers/users.php' method='post'>
            <button class='btn btn-outline-info' type='submit' id='acknowledge' name='sr_ack_btn'>".$_SESSION['sr_sent_message']."</button>
          </form>
          ";
        }
    ?>
    <br />
    <div class='row'>
      <div class='col' >
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#sponsorshipModal">
          Sponsorship
        </button>
      </div>
      <div class='col' >
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadModal">
          Upload footage
        </button>
      </div>
      <div class='col' >
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#describeModal">
          Who are you?
        </button>
      </div>
    </div>
    <br />
    <div class='row'>
      <div class='col' >
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#messagesModal">
          <?php
            $uid_finder = $_SESSION['user_id'];
            $u_msg_q = "SELECT * FROM messages WHERE receiver_id=$uid_finder";
            $u_msg_send = mysqli_query($connection, $u_msg_q);
            $u_msg_counter = mysqli_num_rows($u_msg_send);

            if (mysqli_num_rows($u_msg_send)) {
              echo $u_msg_counter;
            } else {
              echo "0";
            }
          ?> Messages
        </button>
      </div>
      <div class='col' >
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#orderHistoryModal">
          Order History
        </button>
      </div>
      <div class='col' >
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#supportModal">
          Contact Support
        </button>
      </div>
    </div>
  </div>
</div>
<br />

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

<!-- Modal -->
<div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-success">
      <div class="modal-header">
        <h4 class="modal-title" id="supportModalLabel">How can we help?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class='' enctype='multipart/form-data' action='<?=$_SESSION['base_url']?>includes/controllers/users.php' method='post'>
          <label for="request_reason">How can we help?</label>
          <div class='input-group'>
              <select name='request_reason' class="text-light bg-secondary" required>
                <option value='Visit my city'>Visit my city</option>
                <option value='Sponsorship Request'>Sponsorship Request</option>
                <option value='Incorrect Items'>Received incorrect items</option>
                <option value='Other reason'>Other</option>
              </select>
          </div>
          <div class=''>
            <label class='text-light' for='request_comments'>Comments</label>
              <input class='text-dark' type='text' name='request_comments' />
          </div>
          <br />
          <button type='submit' class='btn btn-warning' name='user_sr_btn'>Send</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="describeModal" tabindex="-1" aria-labelledby="describeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-success">
      <div class="modal-header">
        <h4 class="modal-title" id="infoModalLabel">Tell us more about yourself!</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class='' enctype='multipart/form-data' action='<?=$_SESSION['base_url']?>includes/controllers/users.php' method='post'>
          <div class='col input-group'>
            <label class='text-light' for='first'>First</label>
              <input class='text-dark' type='text' name='first' value="
              <?php
                if(isset($_SESSION['first'])) {
                  echo $_SESSION['first'];
                }
              ?>
              ">
          </div>
          <div class='col input-group'>
            <label class='text-light' for='last'>Last</label>
              <input class='text-dark' type='text' name='last' value="
              <?php
                if(isset($_SESSION['last'])) {
                  echo $_SESSION['last'];
                }
              ?>
              "/>
          </div>
          <div class='col input-group'>
            <label class='text-light' for='age'>Age</label>
              <input class='text-dark' type='text' name='age' maxlength="3" value="
              <?php
                if(isset($_SESSION['age'])) {
                  echo $_SESSION['age'];
                }
              ?>
              "/>
          </div>
          <div class='col input-group'>
            <select name='status' class="text-light bg-secondary" required>
              <?php
                if ($_SESSION['status']) {
                  echo "
                    <option value=".$_SESSION['status'].">".$_SESSION['status']."</option>
                  ";
                }
              ?>
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
          <div class='col input-group'>
            <label class='text-light' for='street'>Street Address</label>
              <input class='text-dark' type='text' name='street' value="
              <?php
                if(isset($_SESSION['street'])) {
                  echo $_SESSION['street'];
                }
              ?>
              ">
          </div>
          <div class='col input-group'>
            <label class='text-light' for='apartment'>Apartment</label>
              <input class='text-dark' type='text' name='apartment' value="
              <?php
                if(isset($_SESSION['apartment'])) {
                  echo $_SESSION['apartment'];
                }
              ?>
              "/>
          </div>
          <div class='col input-group'>
            <label class='text-light' for='city'>City</label>
              <input class='text-dark' type='text' value="
                <?php
                  if(isset($_SESSION['city'])) {
                    echo $_SESSION['city'];
                  }
                ?>
              " name='city' />
          </div>
          <div class='col input-group input-group-icon'>
            <select name='state' class="text-light bg-secondary"  required>
              <?php
                if ($_SESSION['state']) {
                  echo "
                    <option value=".$_SESSION['state'].">".$_SESSION['state']."</option>
                  ";
                }
              ?>
              <option value='AL'>ALABAMA</option>
              <option value='AR'>ARKANSAS</option>
              <option value='AZ'>ARIZONA</option>
              <option value='CA'>CALIFORNIA</option>
              <option value='CO'>COLORADO</option>
              <option value='CT'>CONNECTICUT</option>
              <option value='DE'>DELAWARE</option>
              <option value='DC'>DISTRICT OF COLUMBIA</option>
              <option value='FL'>FLORIDA</option>
              <option value='GA'>GEORGIA</option>
              <option value='GU'>GUAM</option>
              <option value='HI'>HAWAII</option>
              <option value='ID'>IDAHO</option>
              <option value='IL'>ILLINOIS</option>
              <option value='IN'>INDIANA</option>
              <option value='IA'>IOWA</option>
              <option value='KS'>KANSAS</option>
              <option value='LA'>LOUISIANA</option>
              <option value='ME'>MAINE</option>
              <option value='MD'>MARYLAND</option>
              <option value='MA'>MASSACHUSSETTS</option>
              <option value='MI'>MICHIGAN</option>
              <option value='MN'>MINNESOTA</option>
              <option value='MS'>MISSISSIPPI</option>
              <option value='MO'>MISSOURI</option>
              <option value='MT'>MONTANA</option>
              <option value='NE'>NEBRASKS</option>
              <option value='NV'>NEVADA</option>
              <option value='NH'>NEW HAMPSHIRE</option>
              <option value='NJ'>NEW JERSEY</option>
              <option value='NM'>NEW MEXICO</option>
              <option value='NY'>NEW YORK</option>
              <option value='NC'>NORTH CAROLINA</option>
              <option value='ND'>NORTH DAKOTA</option>
              <option value='OH'>OHIO</option>
              <option value='OK'>OKLAHOMA</option>
              <option value='OR'>OREGON</option>
              <option value='PA'>PENNSYLVANIA</option>
              <option value='PR'>PUERTO RICO</option>
              <option value='RI'>RHODE ISLAND</option>
              <option value='SC'>SOUTH CAROLINA</option>
              <option value='SD'>SOUTH DAKOTA</option>
              <option value='TN'>TENESSEE</option>
              <option value='TX'>TEXAS</option>
              <option value='UT'>UTAH</option>
              <option value='VT'>VERMONT</option>
              <option value='VI'>VIRGIN ISLANDS</option>
              <option value='VA'>VIRGINIA</option>
              <option value='WA'>WASHINGTON</option>
              <option value='WV'>WEST VIRGINIA</option>
              <option value='WI'>WISCONSIN</option>
              <option value='WY'>WYOMING</option>
            </select><br />
          </div>
          <div class='col input-group'>
            <label class='text-light' for='zip'>Zip Code</label>
              <input class='text-dark' type='text' value="
                <?php
                  if(isset($_SESSION['zip'])) {
                    echo $_SESSION['zip'];
                  }
                ?>
              " name='zip' />
          </div>
          <div class=''>
            <input type='checkbox' checked name='tos' value='1'>
            <label class='text-light' for='tos'>Agree to Terms of Service?</label>
          </div>
          <button type='submit' class='btn btn-warning' name='user_upload_btn'>Save Changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-success">
      <div class="modal-header">
        <h4 class="modal-title" id="uploadModalLabel">Upload your footage here and be featured on our website!</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class='' enctype='multipart/form-data' action='<?=$_SESSION['base_url']?>includes/controllers/users.php' method='post'>
          <div class=''>
            <label class='text-light' for='title'>Title</label>
              <input class='text-dark' type='text' name='title'>
          </div>
          <div class=''>
            <label class='text-light' for='body'>Description</label>
              <input class='text-dark' type='text' name='body' />
          </div>
          <div class=''>
            <label class='text-light' for='user_file'>Upload File</label><br />
              <input type='file' name='user_file' required /><br />
          </div>
          <div class=''>
            <input type='checkbox' checked name='tos' value='1'>
            <label class='text-light' for='tos'>Agree to Terms of Service?</label>
          </div>
          <button type='submit' class='btn btn-warning' name='user_upload_btn'>UPLOAD NOW!</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
include "../includes/partials/footer.php";
?>

<?php
class Login_model {
  public function __construct($email, $password) {
    $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $this->password = $password;
  }

  public function ua_login($connection) {

      $ua_query = "SELECT * FROM can_staff WHERE email=?";

      $ua_builder = $connection->prepare($ua_query);
      $ua_builder->bind_param("s", $ua_email);

      $ua_email = $this->email;

      $ua_builder->execute();

      $ua_login = $ua_builder->get_result();
      if($ua_login->num_rows == 0) {
        $ua_query = "SELECT * FROM user_accounts WHERE email=?";

        $ua_builder = $connection->prepare($ua_query);
        $ua_builder->bind_param("s", $ua_email);

        $ua_email = $this->email;

        $ua_builder->execute();

        $ua_login = $ua_builder->get_result();
        $data = $ua_login->fetch_assoc();

        if($data['email'] != $this->email) {
          $_SESSION['email_unfound'] = "Your email is incorrect!";
          unset($_SESSION['new_user_message']);
          unset($_SESSION['new_user_email']);
          unset($_SESSION['password_incorrect']);

          header('Location: http://localhost/canskates/entry.php');
          exit();
        }

        if(password_verify($this->password, $data['password'])) {
          $_SESSION['user_id'] = $data['user_id'];
          $_SESSION['email'] = $data['email'];
          $_SESSION['display_name'] = $data['display_name'];
          $_SESSION['status'] = $data['status'];

          $_SESSION['first'] = $data['first'];
          $_SESSION['last'] = $data['last'];

          $_SESSION['age'] = $data['age'];

          $_SESSION['created_on'] = $data['created_on'];
          $_SESSION['verified_bool'] = $data['verified_bool'];
          $_SESSION['dir_route'] = $data['user_id'].$data['first'].$data['last'];

          $_SESSION['street'] = $data['street'];
          $_SESSION['apartment'] = $data['apartment'];
          $_SESSION['city'] = $data['city'];
          $_SESSION['state'] = $data['state'];
          $_SESSION['zip'] = $data['zip'];
          $_SESSION['country'] = $data['country'];

          unset($_SESSION['email_unfound']);
          unset($_SESSION['password_incorrect']);
          unset($_SESSION['new_user_message']);
          unset($_SESSION['new_user_email']);

          header('Location: http://localhost/canskates/dashboard/');
          exit();

        } else {
          $_SESSION['password_incorrect'] = "This password does not match the email on file";
          unset($_SESSION['new_user_message']);
          unset($_SESSION['new_user_email']);

          header('Location: http://localhost/canskates/entry.php');
          exit();
        }
      } else {

          $data = $ua_login->fetch_assoc();

          // if(password_verify($this->password, $data['password'])) {
            $_SESSION['can_id'] = $data['can_id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['address'] = $data['address'];
            $_SESSION['position'] = $data['position'];

            header('Location: http://localhost/canskates/admin');
            exit();
          // }
      }
  }
}
?>

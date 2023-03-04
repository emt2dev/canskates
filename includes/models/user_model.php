<?php
class User_model {
  public function __construct($email, $new_password, $status, $first, $last) {
    $this->email = $email;
    $this->password = $new_password;
    $this->status = $status;

    $this->first = $first;
    $this->last = $last;

    $this->vkey = password_hash(time().$first.$last.$status, PASSWORD_DEFAULT);
    $this->created_on = strval(time());

    $this->uid = 0;
    $this->dir_route = '';
}

  public function ua_save($connection) {
    $ua_save = "INSERT INTO user_accounts (email, password, status, first, last, vkey, created_on) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $ua_sender = $connection->prepare($ua_save);
    $ua_sender->bind_param("sssssss", $a, $b, $c, $d, $f, $m, $n);

      $a = $this->email;
      $b = $this->password;
      $c = $this->status;
      $d = $this->first;
      $f = $this->last;
      $m = $this->vkey;
      $n = $this->created_on;

    $ua_sender->execute();
  }

  public function dir_setter($connection) {
    $uaid_query = "SELECT user_id FROM user_accounts WHERE email='$this->email'";
    $uaid_query_send = mysqli_query($connection, $uaid_query);
    $uaid_query_fetcher = $uaid_query_send->fetch_assoc();

    $this->uid = $uaid_query_fetcher['user_id'];
  }

  public function dir_save($connection) {
    $this->dir_route = $this->uid.$this->first.$this->last;


    $dir_query = "UPDATE user_accounts SET dir_route='$this->dir_route' WHERE user_id=$this->uid";
    $dir_query_send = mysqli_query($connection, $dir_query);
  }
}

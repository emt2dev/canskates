<?php
class sr_model {
  public function __construct($u_email, $request_reason, $request_comments, $u_sr_time) {
    $this->email = $u_email;
    $this->request_reason = filter_var($request_reason, FILTER_SANITIZE_STRING);
    $this->request_comments = filter_var($request_comments, FILTER_SANITIZE_STRING);
    $this->time = $u_sr_time;
  }

  public function sr_validator($connection, $ua_email_finder) {
    $sr_c_query = "SELECT * FROM support_request WHERE requester_email='$ua_email_finder'";

    $sr_c_send = mysqli_query($connection, $sr_c_query);

    $sr_counter = mysqli_num_rows($sr_c_send);

    if ($sr_counter > 0) {
      $_SESSION['sr_sent_message'] = "We received your message! Please check your messages within 24 hours.";

      header('Location: http://localhost/canskates/dashboard/');
      exit();
    } else {
      $sr_query = "INSERT INTO support_request (requester_email, request_reason, request_comments, date_submitted) VALUES (?, ?, ?, ?)";

      $sr_send = $connection->prepare($sr_query);
      $sr_send->bind_param("ssss", $d, $a, $b, $c);

        $d = $this->email;
        $a = $this->request_reason;
        $b = $this->request_comments;
        $c = strval($this->time);

      $sr_send->execute();

      $_SESSION['sr_sent_message'] = "We received your message! Please check your messages within 24 hours.";

      header('Location: http://localhost/canskates/dashboard/');
      exit();
    }
  }


}

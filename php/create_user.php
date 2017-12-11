<?php
  require_once('./connection.php');

  $first_name = trim($_REQUEST['first_name']);
  $last_name = trim($_REQUEST['last_name']);
  $email = trim($_REQUEST['email']);
  $dob = trim($_REQUEST['dob']);
  $screen_name = trim($_REQUEST['screen_name']);
  $password = trim($_REQUEST['password']);
  $favorite_break = trim($_REQUEST['favorite_break']);

  $t = time();
  $member_since = date("Y-m-d h:m:s",$t);

  $insert_SQL = "INSERT INTO users (first_name, last_name, email, dob, screen_name, password, favorite_break, member_since) " .
                  "VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $dob . "', '" . $screen_name . "', '" . $password . "', '" . $favorite_break . "', '" . $member_since . "');";

  mysqli_query($connection, $insert_SQL);

  echo "$insert_SQL";
 ?>

<?php
  require_once('./connection.php');

  $screen_name = trim($_REQUEST['username']);
  $password = trim($_REQUEST['password']);

  $login_SQL = 'SELECT first_name FROM users WHERE screen_name="'  . $screen_name . '" AND password="' . $password . '";';
  $response = mysqli_query($connection, $login_SQL);

if($response){
  $name = $response->fetch_array();
  echo '<h1>Welcome back to WVRPT, ' . $name[0] . '!!!</h1>';
}
 ?>

<?php
  $servername = "localhost";
  $username = "kellys11";
  $password = "gswd1q";
  $db = "kellys11_db";

  $connection = new mysqli($servername, $username, $password, $db);

  if ($connection -> connect_error) {
    echo('<span class="connection_fail">Failed</span>' . $conn -> connect_error);
  } else {
    return $connection;
  }
?>

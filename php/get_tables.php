<?php
  require_once('connection.php');
  require('buoy_data.php');

  $sql = "SHOW TABLES FROM kellys11_db;";

  if ($connection){
    $result = mysqli_query($connection, $sql);
  }
  if ($result->num_rows > 0){
      while ( $row = mysqli_fetch_row($result) ) {
        if ( $row[0] === 'users' ){
          return;
        }
        echo '<li name="' . $row[0] . '"><a href="#' . $row[0] . '">' . $row[0] ."</a></li><br />";
      }
  }
  else {
    echo "Tables unavailable";
  }
 ?>

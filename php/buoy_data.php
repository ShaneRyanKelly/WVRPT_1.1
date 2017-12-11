<?php
  require_once('./connection.php');

  $start = 0;
  $end = 20;

  $buoys = array
  (
  array('44017_2016'),
  array('44018_2016'),
  array('44025_2016'),
  array('44065_2016')
  );

  $sql = "SELECT * FROM " . $buoys[0][0] . " LIMIT " . $start . "," . $end . ";";
  $result = mysqli_query($connection, $sql);
  $data = array();
  while ($row = mysql_fetch_assoc($result)) {
    $data.push($row);
    unset($row);
  }

  $json_data = json_encode($data);
  file_put_contents('44017_2016.json', $json_data);
/*
  foreach ($buoys as $buoy) {
    $sql = "SELECT * FROM " . $buoy[0] . " LIMIT " . $start . "," . $end . ";";
    $result = mysqli_query($connection, $sql);
    while ($row = $result->fetch_array()){
      array_push($buoy, $row);
    }
  }*/
?>

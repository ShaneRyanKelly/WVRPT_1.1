<?php
  require_once('connection.php');

  $table_name = $_POST['table_name'];

  $query = "SELECT * FROM 44018_2016 LIMIT 0, 20;";

  $result = mysqli_query($connection, $query);

  $table = array();

  $table['cols'] = array(
    array('id' => 'timestamp', 'label' => 'timestamp', 'type' => 'string'),
    array('id' => 'wind_dir', 'label' => 'wind_dir', 'type' => 'number'),
    array('id' => 'wind_spd', 'label' => 'wind_spd', 'type' => 'number'),
    array('id' => 'gust', 'label' => 'gust', 'type' => 'number'),
    array('id' => 'wave_height', 'label' => 'wave_height', 'type' => 'number'),
    array('id' => 'dpd', 'label' => 'dpd', 'type' => 'number'),
    array('id' => 'apd', 'label' => 'apd', 'type' => 'number'),
    array('id' => 'mwd', 'label' => 'mwd', 'type' => 'number'),
    array('id' => 'pressure', 'label' => 'pressure', 'type' => 'number'),
    array('id' => 'air_temp', 'label' => 'air_temp', 'type' => 'number'),
    array('id' => 'wtmp', 'label' => 'wtmp', 'type' => 'number'),
    array('id' => 'dewp', 'label' => 'dewp', 'type' => 'number'),
    array('id' => 'vis', 'label' => 'vis', 'type' => 'number'),
    array('id' => 'tide', 'label' => 'tide', 'type' => 'number')
  );

  $rows = array();

  foreach($result as $row){
    $temp = array();

    $temp[] = array('c' => array('v' => (string) $row['timestamp']));
    $temp[] = array('c' => array('v' => (integer) $row['wind_dir']));
    $temp[] = array('c' => array('v' => (float) $row['wind_spd']));
    $temp[] = array('c' => array('v' => (float) $row['gust']));
    $temp[] = array('c' => array('v' => (float) $row['wave_height']));
    $temp[] = array('c' => array('v' => (float) $row['dpd']));
    $temp[] = array('c' => array('v' => (float) $row['apd']));
    $temp[] = array('c' => array('v' => (float) $row['mwd']));
    $temp[] = array('c' => array('v' => (float) $row['pressure']));
    $temp[] = array('c' => array('v' => (float) $row['air_temp']));
    $temp[] = array('c' => array('v' => (float) $row['wtmp']));
    $temp[] = array('c' => array('v' => (float) $row['dewp']));
    $temp[] = array('c' => array('v' => (float) $row['vis']));
    $temp[] = array('c' => array('v' => (float) $row['tide']));

    $rows[] = $temp;
  }

  $result->free();
  $table['rows'] = $rows;
  $jsonTable = json_encode($table, true);

  echo "<pre>";
  echo json_encode($table, JSON_PRETTY_PRINT);
  echo "</pre>";

 ?>

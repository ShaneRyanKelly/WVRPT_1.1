<?php
  require_once('connection.php');

  $table_name = $_POST['table_name'];
  $surf_month = $_POST['month'];

  $query = "SELECT * FROM " . $table_name . " WHERE month = " . $surf_month . ";";

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
    array('id' => 'airtemp', 'label' => 'airtemp', 'type' => 'number'),
    array('id' => 'wtmp', 'label' => 'wtmp', 'type' => 'number'),
    array('id' => 'dewp', 'label' => 'dewp', 'type' => 'number'),
    array('id' => 'vis', 'label' => 'vis', 'type' => 'number'),
    array('id' => 'tide', 'label' => 'tide', 'type' => 'number')
  );

  $rows = array();

  foreach($result as $row){
    $temp = array();

    $temp[] = array('v' => (string) $row['timestamp']);
    $temp[] = array('v' => (integer) $row['wind_dir']);
    $temp[] = array('v' => (float) $row['wind_spd']);
    $temp[] = array('v' => (float) $row['gust']);
    $temp[] = array('v' => (float) $row['wave_height'] * 10);
    $temp[] = array('v' => (float) $row['dpd']);
    $temp[] = array('v' => (float) $row['apd']);
    $temp[] = array('v' => (float) $row['mwd']);
    $temp[] = array('v' => (float) $row['pressure']);
    $temp[] = array('v' => (float) $row['airtemp']);
    $temp[] = array('v' => (float) $row['wtmp']);
    $temp[] = array('v' => (float) $row['dewp']);
    $temp[] = array('v' => (float) $row['vis']);
    $temp[] = array('v' => (float) $row['tide']);

    $rows[] = array('c' => $temp);
  }

  $result->free();
  $table['rows'] = $rows;
  $jsonTable = json_encode($table);

  echo $jsonTable;

 ?>

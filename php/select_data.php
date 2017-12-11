<?php
  require_once('connection.php');

  $table_name = $_POST['table_name'];
  $fields = $_POST['fields'];
  $surf_day = $_POST['day'];

  $query = "SELECT * FROM " . $table_name . " WHERE date = '" . $surf_day . "';";

  $result = mysqli_query($connection, $query);

  $table = array();

  $table['cols'] = array(
    array('id' => 'timestamp', 'label' => 'timestamp', 'type' => 'string')
  );

  foreach ($fields as $field){
    array_push($table['cols'], array('id' => "'" . $field . "'", 'label' => "'" . $field . "'", 'type' => 'number'));
  }

  $rows = array();

  foreach($result as $row){
    $temp = array();


    $temp[] = array('v' => (string) substr($row['timestamp'], 11, 5));
    foreach ($fields as $field){
      if ($field == 'wave_height'){
        $value = (float) $row[$field] * 10;
        $temp[] = array('v' => (float) $value);
      } else if ($field == 'pressure'){
        $value = (float) $row[$field] - 1000;
        $temp[] = array('v' => (float) $value);
      }  else {
        $temp[] = array('v' => (float) $row[$field]);
      }
    }

    $rows[] = array('c' => $temp);
  }

  $result->free();
  $table['rows'] = $rows;
  $jsonTable = json_encode($table, true);

  echo $jsonTable;
?>

<?php
  require_once('./connection.php');

  $buoy = $argv[1];
  $csv = $buoy . ".csv";

  $create = "CREATE TABLE IF NOT EXISTS " . $buoy . " (year VARCHAR(4), month VARCHAR(2), day VARCHAR(2), hour INT(2), minute INT(2), wind_dir INT(3), wind_spd FLOAT(8), gust FLOAT(8), wave_height Float(8), dpd FLOAT(8), apd FLOAT(8), mwd FLOAT(8), pressure FLOAT(8), airtemp FLOAT(8), wtmp FLOAT(8), dewp FLOAT(8), vis FLOAT(8), tide FLOAT(8))";
  $load = "LOAD DATA LOCAL INFILE '" . $csv . "' INTO TABLE " . $buoy . " FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 2 LINES";
  $alter_date = "ALTER TABLE " . $buoy . " ADD date DATE;";
  $dates = "UPDATE " . $buoy . " SET date = STR_TO_DATE(CONCAT(year,'-',month,'-',day), '%Y-%m-%d')";
  $alter_time = "ALTER TABLE " . $buoy . " ADD time TIME;";
  $times = "UPDATE " . $buoy . " SET time = STR_TO_DATE(CONCAT(hour,':',minute), '%H:%i')";
  $alter_datetime = "ALTER TABLE " . $buoy . " ADD timestamp DATETIME;";
  $stamp = "UPDATE " . $buoy . " SET timestamp = STR_TO_DATE(CONCAT(date,' ',time), '%Y-%m-%d %H:%i')";
  mysqli_query($connection, $create);
  mysqli_query($connection, $load);
  mysqli_query($connection, $alter_date);
  mysqli_query($connection, $dates);
  mysqli_query($connection, $alter_time);
  mysqli_query($connection, $times);
  mysqli_query($connection, $alter_datetime);
  mysqli_query($connection, $stamp);
?>

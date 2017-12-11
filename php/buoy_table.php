<?php
require "./connection.php";
$table_name = $_POST["table_name"];
$start = $_POST["start"];
$end = $_POST["end"];
$sql = "SELECT * FROM " . $table_name . " LIMIT " . $start . "," . $end . ";";
echo $table_name;
$result = mysqli_query($connection, $sql);
if ($table_name){
if ($result->num_rows > 0){
  echo '<div id="datatable"><table class="table table-striped">';
  echo "<tr><thead><th>Date/Time</th><th>Wind Direction</th><th>Wind Speed</th><th>Gust</th><th>Wave Height</th><th>DPD</th><th>APD</th><th>MWD</th><th>Pressure</th><th>Air Temp</th><th>Wtmp</th><th>Dewp</th><th>Visibility</th><th>Tide</th></thead></tr>";
  while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row["timestamp"] . "</td><td>" . $row["wind_dir"] . "</td><td>" . $row["wind_spd"] . "</td><td>" . $row["gust"] . "</td><td>" . $row["wave_height"] . "</td><td>" . $row["dpd"] . "</td><td>" . $row["apd"] . "</td><td>" . $row["mwd"] . "</td><td>" . $row["pressure"] . "</td><td>" . $row["airtemp"] . "</td><td>" . $row["wtmp"] . "</td><td>" . $row["dewp"] . "</td><td>" . $row["vis"] . "</td><td>" . $row["tide"] . "</td>";
    echo "</tr>";
  }
  echo "</table></div>";
  } else {
    echo "results empty";
  }
}
else {
echo '<p>
  select a buoy from the left
</p>';
}
 ?>

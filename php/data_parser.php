<?php
  $file_name = $argv[1];
  $out_file = str_replace('txt', 'csv', $file_name);

  $raw_data = fopen($file_name, "r");
  $output_csv = fopen($out_file, "w");

  while (!feof($raw_data)){
    $current_line = fgets($raw_data);
    $fields = str_getcsv($current_line, " ", "\\");
    $i = 0;
    foreach ($fields as $field){
      if ($field === ''){
      }else if ($i === count($fields) - 1){
        fwrite($output_csv, $field);
        fwrite($output_csv, "\n");
      } else {
        fwrite($output_csv, $field . ',');
      }
      $i++;
    }
  }

  fclose($raw_data);
  fclose($output_csv);
?>

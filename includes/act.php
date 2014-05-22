<?php

require_once("db_connect.php");

$filename="activities.txt";
// Open the file
$fp = fopen($filename, 'r'); 

// Add each line to an array
if ($fp) {
   $array = explode("\n", fread($fp, filesize($filename)));
   foreach ($array as $value) {
   	# code...
   	$postquery = mysqli_query($mysqli,"INSERT INTO activity (activityname) VALUES ('".$value."')");
   }
}

?>
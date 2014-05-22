<?php

require_once("db_connect.php");

// $_GET['term']="tr";
$term = trim(strip_tags($_GET['term'])); 
$a_json = array();
$a_json_row = array();
if ($data = $mysqli->query("SELECT * FROM activity WHERE activityname LIKE '%$term%'")) {
	while($row = mysqli_fetch_array($data)) {
		
		$activityname = htmlentities(stripslashes($row['activityname']));

		$a_json_row["value"] = $activityname;

		array_push($a_json, $a_json_row);
	}
}
// jQuery wants JSON data
echo json_encode($a_json);
flush();
 
$mysqli->close();
?>
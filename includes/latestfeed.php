<?php

require_once("db_connect.php");

// $time = "1398352086";
// $latest = date("Y-m-d H:i:s",$time);

// Uncomment the line below if you are testing this page alone
$_POST['activityid'] = "1";
$_POST['user_name'] = "kaushik";
$_POST['title'] = "test_title";
$_POST['textcontent'] = "test";
// $_POST['multimedia'] = "";
$_POST['locationid']="12";


if(isset($_POST['textcontent'])){
	// if(isset($_POST['multimedia'])){

	echo $activityid = $_POST['activityid'];
	echo $user_name = $_POST['user_name'];
	echo $title = $_POST['title'];
	echo $textcontent = $_POST['textcontent'];
	// echo $multimedia = $_POST['multimedia'];
	echo $locationid = $_POST['locationid'];

	// $studentid=$_SESSION['$studentid']; //when session variables are set
	// $univid=$_SESSION['$univid'];		//when session variables are set

	$postquery = $mysqli->prepare("INSERT INTO posts (activityid, user_name, title, textcontent, locationid) VALUES (?,?,?,?,?)");
	if($postquery){
		$postquery->bind_param('isssi',$activityid,$user_name,$title,$textcontent,$locationid);
		$postquery->execute();
		echo "success";
		$postquery->close();
	}
	else {
		/* Error */
		printf("Mazaak: %s\n", $mysqli->error); //Prepared Statement Error
	}
	// }
}

updateposts();

function updateposts(){
	if(isset($_POST['latest'])){

		$latest = date("Y-m-d H:i:s",$_POST['latest']);

		$query = mysqli_query($con,"SELECT * FROM home_posts WHERE update_timestamp > '".$latest."' ORDER BY update_timestamp DESC");

		if(mysqli_num_rows($query)!=0){
			while($row = mysqli_fetch_array($query)){

				// echo "<div id=".strtotime($row['update_timestamp']).">"; //div id stores unixtimestamp of the post

				// echo $row['update_timestamp'];

				// echo $row['messageid'] . ".  " . $row['message'];

				// echo "<br><br><br> </div>";

				include "includes/posts.php";			

			}
		}
	}
	else {echo "Mazaak: Beta, For every output you expect, there must be an input given.";}
}

?>
<?php

require_once("db_connect.php");
include_once 'functions.php';

sec_session_start();

// $_POST['activityid'] = "1";
// $_POST['user_name'] = "kaushik";
// $_POST['title'] = "test_title2";
// $_POST['textcontent'] = "test2";
// $_POST['locationid']=12;

$_POST['commentcontent'];
$_POST['postid'];
$_SESSION['user_name'];


if(isset($_POST['commentcontent'],$_POST['postid'],$_SESSION['user_name'])){

	$commentquery = mysqli_query($mysqli,"INSERT INTO comments_posts (postid,user_name,commentcontent) VALUES ('".$_POST['postid']."','".$_SESSION['user_name']."','".$_POST['commentcontent']."')");
	
	if($commentquery){
		echo "success";
	}

	else {
		/* Error */
		printf("Mazaak: %s\n", $mysqli->error); //MySQL Error
	}
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
// header ("Location: ../home.php");
// echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";

?>
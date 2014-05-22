<?php

require_once("db_connect.php");
include_once 'functions.php';

sec_session_start();

if(isset($_POST['like'])){
	$likequery = mysqli_query($mysqli,"INSERT INTO post_likes (postid,user_name) VALUES ('".$_POST['postlid']."','".$_SESSION['user_name']."')");
	if($likequery) echo "success";
	else printf("Mazaak: %s\n", $mysqli->error); //MySQL Error
}

if(isset($_POST['unlike'])){
	$unlikequery = mysqli_query($mysqli,"DELETE FROM post_likes WHERE postid='".$_POST['postlid']."' AND user_name='".$_SESSION['user_name']."'");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
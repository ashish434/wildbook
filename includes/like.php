<?php
require_once("db_connect.php");
include_once 'functions.php';

sec_session_start();

// $id=1;  // User id
if($_POST)
{
$pinsid=$_POST['sid'];
$status=$_POST['sta'];
$chkpinu=mysqli_query($mysqli,"SELECT * FROM post_likes WHERE postid='".$pinsid."' AND user_id='".$_SESSION['user_name']."')";
$chknum=mysqli_num_rows($chkpinu);
if($status=="like")
{
if($chknum==0)
{
$add=mysqli_query($mysqli,"INSERT INTO post_likes VALUES(".$_SESSION['user_name']."','".$pinsid."')");
echo $add;
}
}
else if($status=="unlike")
{
if($chknum!=0)
{
$rem=mysqli_query($mysqli,"DELETE FROM post_likes WHERE postid='".$pinsid."' AND user_id='".$_SESSION['user_name']."'");
echo $rem;
}
}
}
?>
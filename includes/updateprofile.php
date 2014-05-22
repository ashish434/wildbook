<?php

require_once("db_connect.php");
include_once 'functions.php';

sec_session_start();

if ($_POST){

  echo $firstname=$_POST['firstname'];
  echo $lastname=$_POST['lastname'];
  echo $gender=$_POST['gender'];
  echo $dob=$_POST['dob'];
  echo $education=$_POST['education'];
  echo $work=$_POST['work'];
  

 mysqli_query($mysqli,"update users set firstname='".$firstname."',lastname='".$lastname."',dob='".$dob."',gender='".$gender."',education='".$education."',work='".$work."' where user_name='".$_SESSION['user_name']."'");

}
mysqli_close($mysqli);

header('LOCATION:'.$_SERVER['HTTP_REFERER']);

?>

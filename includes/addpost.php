<?php

require_once("db_connect.php");
include_once 'functions.php';

sec_session_start();

// $_POST['activityname'] = "1";
// $_POST['user_name'] = "kaushik";
// $_POST['title'] = "test_title2";
// $_POST['textcontent'] = "test2";
// $_POST['location']=12;

$activityname="";
$user_name="";
$recipient="";
$title="";
$textcontent="";
$multimedia="";
$location="";

if(!isset($_FILES['userfile']))
    {
    echo '<p>Please select a file</p>';
    }
else
    {
    try    {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';
        }
    catch(Exception $e)
        {
        echo '<h4>'.$e->getMessage().'</h4>';
        }
    }

function upload(){
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = md5(rand() * time());
    $_POST['multimedia']=$name;
    $maxsize = 99999999;


    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** connect to db ***/
        $dbh = new PDO("mysql:host=localhost;dbname=wild", 'root', '');

                /*** set the error mode ***/
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
        $stmt = $dbh->prepare("INSERT INTO testblob (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

        /*** bind the params ***/
        $stmt->bindParam(1, $type);
        $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
        $stmt->bindParam(3, $size);
        $stmt->bindParam(4, $name);

        /*** execute the query ***/
        $stmt->execute();
        }
    else
        {
        /*** throw an exception is image is not of type ***/
        throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}

$cond=$_POST['textcontent']||$_POST['multimedia'];

if(isset($cond)){

	if(isset($_POST['activityname'])) echo $activityname = $_POST['activityname'];
	if(isset($_SESSION['user_name'])) echo $user_name = $_SESSION['user_name'];
	if(isset($_POST['recipient'])) echo $recipient = $_POST['recipient'];
	if(isset($_POST['title'])) echo $title = $_POST['title'];
	if(isset($_POST['textcontent'])) echo $textcontent = $_POST['textcontent'];
	if(isset($_POST['multimedia'])) echo $multimedia = $_POST['multimedia'];
	if(isset($_POST['privacy'])) echo $privacy = $_POST['privacy'];
	if(isset($_POST['autocomplete'])) echo $location = $_POST['autocomplete'];

	$postquery = mysqli_query($mysqli,"INSERT INTO posts (activityname,user_name,recipient,title,textcontent,privacyid,multimedia,location) VALUES ('".$activityname."','".$user_name."','".$recipient."','".$title."','".$textcontent."','".$privacy."','".$multimedia."','".$location."')");
	
	if($postquery){
		// $postquery->bind_param('isssi',$activityname,$user_name,$title,$textcontent,$location);
		// $postquery->execute();
		echo "success";
		// $postquery->close();
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
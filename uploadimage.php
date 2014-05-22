<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="uploadimage.php" method="post" enctype="multipart/form-data">
<input type="file" name="image" >
<input type="submit" value="upload" name="submit">

</form>

<?php							
if(isset($_POST['submit'])){
	$connection=mysql_connect("localhost","root","");
	if(!$connection)
	echo "connectuon failed";
	$image=mysql_select_db("wild");
	if(!$image)
	echo "database connection failed";
	$imagename=mysql_real_escape_string($_FILES["image"]["name"]);
	//print_r($imagename);
	$imagedata=mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
	//echo $imagedata;
	$imagetype=mysql_real_escape_string($_FILES["image"]["type"]);
	//echo strlen($imagedata);	 
	if(substr($imagetype,0,5)=="image"){
		
		//echo "working code";
		$query=mysql_query("INSERT INTO posts(multimedia) values('$imagedata')");
		if(!$query)
		echo "failed";
		}
	
	
	}

?>
<img src="showImage.php?postid=6">
</body>
</html>


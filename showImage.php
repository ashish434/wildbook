<?php
$connection=mysql_connect("localhost","root","");
	$image=mysql_select_db("wild");
	$postid=$_GET['postid'];
	$query=mysql_query("SELECT * FROM posts where postid=$postid");
	header("Content-type: image/jpeg");
	while($row=mysql_fetch_array($query)){
		print $row['multimedia'];
		}
?>
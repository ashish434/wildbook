<?php

			echo "<div class='post panel panel-default col-md-9' id=".strtotime($row['posttime']).">"; //div id stores unixtimestamp of the post

			echo "<div class='panel-body posts' id=".$row['postid'].">";

			echo '<table class="table"><div class="media"><a class="pull-left" href="profile.php?user='.$row["user_name"].'"> <img class="media-object img-circle" src="images/user.jpg" alt="User" width="80" height="80"> </a>';

			echo "<div class='well media-body'>";

			if($row['title']){
				echo "<h4 class='media-heading'>".$row['title']."</h4>";
			}

			if(!$row['multimedia']==""){
			$imgresult=mysqli_query($mysqli,"SELECT image, image_type FROM testblob WHERE image_name='".$row['multimedia']."'"); //Checks current login user liked this status or not
			$imgexist=mysqli_num_rows($imgresult);
			if($imgexist){
				while($imgrow=mysqli_fetch_array($imgresult)){
					$image  = $imgrow['image'];
					echo '<div>';
					echo '<img class="thumbnail" src="data:image/jpeg;base64,'.base64_encode($image).'" alt="photo"><br>';
					echo '</div>';
				}
			}
			}

			echo $row['textcontent']."<br>";

			echo "<span class='text-muted'>Posted by <a href='profile.php?user=".$row['user_name']."'>".$row['user_name']."</a>";

			if(!$row["recipient"]=="")
			echo " >> <a href='profile.php?user=".$row['recipient']."'>".$row['recipient']."</a>";

			if(!$row["activityname"]=="")
			echo " while ".$row['activityname'];

			if(!$row["location"]=="")
			echo " at ".$row['location'];		

			echo " (".nicetime($row['posttime']).")<span class='pull-right'>".$row['privacyid']."</span></span><br></div></div>";

			//code for likes start

			$qnumlikes=mysqli_query($mysqli,"SELECT * FROM post_likes WHERE user_name='".$_SESSION['user_name']."' AND postid='".$row['postid']."'"); //Checks current login user liked this status or not
			$numlikes=mysqli_num_rows($qnumlikes);
			$qtotallikes=mysqli_query($mysqli,"SELECT * FROM post_likes WHERE postid='".$row['postid']."'");  // Total number of likes for the status message
			$totallikes=mysqli_num_rows($qtotallikes);
			
			echo "<div class='likesdiv panel' id='".$row['postid']."'>";
			echo "<form id='likesform' action='includes/postlikes.php' method='post'>";
			echo "<input type='hidden' name='postlid' value='".$row['postid']."'>";
			if($numlikes==0) echo "<button type='submit' class='btn btn-link' name='like' id='".$totallikes."'>Like</button>";
			else if($numlikes==1) echo "<button type='submit' class='btn btn-link' name='unlike' id='".$totallikes."'>Unlike</button>";
			echo "</form>";
			echo "<span class='numlike text-muted' id='lik".$row['postid']."'>(". $totallikes." people liked this)</span></div>";

			$reply_query = "select * from comments_posts where postid='".$row['postid']."' ORDER BY commenttime";
			$reply_result = mysqli_query($mysqli,$reply_query);
			$commentexist=mysqli_num_rows($reply_result);

			echo "<div id='comments' class='col-md-7 col-md-offset-1'>";

			if($commentexist){

				while($row1 = mysqli_fetch_array($reply_result)){

					echo "<div id='".strtotime($row1['commenttime'])."'>";
					echo '<div class="media"><a class="pull-left" href="#"> <img class="media-object img-circle" src="images/user.jpg" alt="User" width="60" height="60"> </a>';
					echo "<div class='well media-body'>";
						echo $row1['commentcontent']."<br>";
						echo "<span class='text-muted'>says <a class='text-muted' href='profile.php?user=".$row1['user_name']."'>".$row['user_name']."</a>";
						echo " (".nicetime($row1['commenttime']).")</span><br></div></div>";
					echo "</div>";
				}
			}
			else{
				echo "<div id='0000000000'> <tr> <td> <p class='text-muted'>No comments yet, Be the First one to comment </p> </td> </tr> </div>";
			}
			echo "</div>";
			// echo "<br><br><br><br><br>";
			echo "<div id='postcomment'>";
			echo "<form id='commentform' action='includes/addcomment.php' method='post'><tr><td>";
    		// need to supply post id with hidden field
    		echo "<input type='hidden' name='postid' value='".$row['postid']."'>";
    	
      		echo "<textarea name='commentcontent' class='form-control postval' rows='2' placeholder='Comment Here' required></textarea>";
    		echo "<button type='submit' class='btn btn-success btn-md btn-block'>Submit Comment</button>";

			echo "</td></tr></form></div><br>";

			echo "</table> </div> </div><br>";

?>
<?php
// include_once '/includes/db_connect.php';
include "age.php";
include "checkfriendship.php";
// $friendship='';

$proquery = "select * from users where user_name='".$_GET['user']."'";
$proresult = mysqli_query($mysqli,$proquery);
$proexist = mysqli_num_rows($proresult);

			if($proexist){
				$i=1;
				while($prow = mysqli_fetch_array($proresult)){
					if($i){

?>

      <div class="row featurette well">
        <div class="col-md-3 col-md-offset-1">
          <img class="featurette-image img-responsive img-circle" src="images/user.jpg" width="200" height="200" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading"><?php echo $prow['firstname']." ".$prow['lastname'] ?> <small class="text-muted"><?php echo "(".$prow['gender'].")" ?></small></h2>
          <p class="lead"><?php echo $prow['education'] ?><br>
          Age: <?php echo age($prow['dob']) ?><br>
          <?php if($prow['work']!="") echo "Works at ".$prow['work'];?>
        </p>

        <?php if($friendship=='friend') echo "<button class='btn btn-default btn-primary disabled' name='friend'>Friends</button>";
        else if($friendship=='pending') echo "<button class='btn btn-default btn-primary disabled' name='fpending'>Friend Request Sent</button>";
        else if($friendship=='withheld'){
          echo "<form id='addfriend' action='includes/addfriend.php' method='post'>";
          echo "<input type='hidden' name='addfriend' value='1'>";
          echo "<input type='hidden' name='sender' value='".$_GET['user']."'>";
          echo"<button type='submit' class='btn btn-default btn-primary' id='add friend'>Accept Friend Request</button></form>";          
        }
        else{
          echo "<form id='addfriend' action='includes/addfriend.php' method='post'>";
          echo "<input type='hidden' name='friend' value='".$_GET['user']."'>";
          echo"<button type='submit' class='btn btn-default btn-primary' id='add friend'>Add Friend</button></form>";
        }
        ?>

        </div>
      </div>

<?php
						$i=0;
					}

				}
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include_once '/includes/db_connect.php';
include_once '/includes/functions.php';

sec_session_start();

$friendsquery = mysqli_query($mysqli,"SELECT user_name,friendsusername,accept FROM friends WHERE friendsusername='".$_SESSION['user_name']."'
  UNION
  SELECT user_name,friendsusername,accept FROM friends WHERE user_name='".$_SESSION['user_name']."'");
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kaushik">
    <link rel="shortcut icon" href="images/experiments.ico">

    <title>Wildbook</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="cover.css" rel="stylesheet"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
</head>

<body>
  <?php if (login_check($mysqli) == true) : ?>
      <div class="navbar navbar-inverse navbar-fixed-top span11" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Wildbook</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="profile.php?user=<?php echo htmlentities($_SESSION['user_name']); ?>"><?php echo htmlentities($_SESSION['user_name']); ?></a></li>
              <li><a class="glyphicon glyphicon-cog" href="settings.php?user=<?php echo htmlentities($_SESSION['user_name']); ?>"></a></li>
              <li class="pull-right"><a href="includes/logout.php" style="align:right;">LogOut</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    <br><br>
    <br><br>
    <div class="container panel">
      <div class="page-header">
        <center><h3>Friends</h3></center>
      </div>
      <?php
      $frnds=mysqli_num_rows($friendsquery);
      if($frnds){
        while($frow = mysqli_fetch_array($friendsquery)){
          //checking where friend's name is
          if($frow["user_name"]!=$_SESSION['user_name']){
            $friend=$frow["user_name"];
            $friendship="withheld";
          }
          else{
            $friend=$frow["friendsusername"];
            $friendship="pending";
          }

          echo '<div class="media well"><a class="pull-left" href="profile.php?user='.$friend.'"> <img class="media-object img-circle" src="images/user.jpg" alt="User" width="80" height="80"> </a>';
          echo "<div class='well media-body'>";
          echo '<div class="col-md-6"><a class="lead" href="profile.php?user='.$friend.'">'.$friend.'</a></div>';
          
          if($frow['accept']==1){
          echo "<form id='delfriendform' action='includes/addfriend.php' method='post'>";
          echo "<input type='hidden' name='delfriend' value='1'>";
          echo "<input type='hidden' name='friendnow' value='".$friend."'>";
          echo"<div class='col-md-6'><button type='submit' class='pull-right btn btn-default btn-primary' id='add friend'>Remove Friend</button></div></form>";
          }
          else if($frow['accept']==0){
            if($friendship=="pending") echo"<div class='col-md-6'><button type='submit' class='pull-right btn btn-default btn-primary disabled' id='pending'>Request Pending</button></div>";
            else if($friendship=='withheld'){
              echo "<form id='addfriend' action='includes/addfriend.php' method='post'>";
              echo "<input type='hidden' name='addfriend' value='1'>";
              echo "<input type='hidden' name='sender' value='".$friend."'>";
              echo"<button type='submit' class='btn btn-default btn-primary pull-right' id='add friend'>Accept Friend Request</button></form>";          
            }
          }
          echo "</div></div>";
        }
    }
    else{
      echo "<h4>You have NO Friends</h4>";
    }
    ?>
    </div>

    <?php else : ?>
                <script>
                    window.alert("You are not authorized to access this page.\n\n\t\t\tPlease LogIn");
                    window.location.href='index.php';
                </script>
            <?php endif; ?>
</body>

</html>
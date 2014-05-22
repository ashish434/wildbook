<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include_once '/includes/db_connect.php';
include_once '/includes/functions.php';

sec_session_start();
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
  <?php if (login_check($mysqli) == true) : 
  if (isset($_GET['user']) and $_GET['user']==$_SESSION['user_name']):?>
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

    <div class="container" style="width:50%">
      <div class="page-header">
        <h3>Update Profile</h3>
      </div>

      <!-- <h3> Test </h3>  -->

      <?php
  
  $result=mysqli_query($mysqli,"SELECT firstname,lastname,gender,dob,education,work FROM users  WHERE user_name='".$_SESSION['user_name']."' ");
  $exist=mysqli_num_rows($result);
  
  if($exist){
  while($row = mysqli_fetch_array($result)){
    echo "<form action='includes/updateprofile.php' method='post' name='insert'>";
    echo "First Name:<input class='form-control' type='text' name='firstname' value='".$row['firstname']."'><br>";
    echo "Last Name:<input class='form-control' type='text' name='lastname' value='".$row['lastname']."'><br>";
    echo"Gender:";
    echo "<div class='form-control'>";
    if($row['gender']=='Male')
      echo "Male <input type='radio' name='gender' value='Male' checked> &nbsp;&nbsp;&nbsp;&nbsp; Female <input type='radio' name='gender' value='Female' ><br>";
    
    else
      echo "Gender: &nbsp;&nbsp;&nbsp;&nbsp; Male <input type='radio' name='gender' value='Male'> &nbsp;&nbsp;&nbsp;&nbsp; Female <input type='radio' name='gender' value='Female' checked></body></html>";
    
    echo "</div>";

    echo "Date of Birth:<input class='form-control' type='text' name='dob' value='".$row['dob']."'><br>";
    echo "Education:<input class='form-control' type='text' name='education' value='".$row['education']."'><br>";
    echo "Worked at:<input class='form-control' type='text' name='work' value='".$row['work']."'></h4><br>";
  }
  echo "<button type='submit' class='btn btn-primary form-control'>Update</button></form>";
}
  else {
    /* Error */
    printf("Mazaak: %s\n", $mysqli->error); //MySQL Error
  }

mysqli_close($mysqli);

?>
    </div>

    <?php
    endif;
    else : ?>
                <script>
                    window.alert("You are not authorized to access this page.\n\n\t\t\tPlease LogIn");
                    window.location.href='index.php';
                </script>
            <?php endif; ?>
</body>

</html>
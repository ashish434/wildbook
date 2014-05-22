<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    // $logged = 'in';
  header('Location: home.php');
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kaushik">
    <link rel="shortcut icon" href="images/experiments.ico">

    <title>Wild Book</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>

<body>

    <?php
    if(isset($_GET["error"])){
        if($_GET['error']=='1')  echo "Invalid Username/Password";
      }
    ?>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">


          <div class="masthead clearfix">
            <div class="inner">
              <a href="index.php"><h3 class="masthead-brand">Wildbook</h3></a>
              <ul class="nav masthead-nav">
                <!-- <li><a href="http://experiments.sourcenxt.in/#projects" onclick="show('projects')"> &lt &lt Back to Projects</a></li> -->
                
              </ul>
            </div>
          </div>

          <div class="innercover" id="home">
            <h1 class="cover-heading">Wild Book</h1>
            <p class='lead'>

              <span class="text-muted">Enter the Explorer Network</span>
              <form role="form" action="includes/process_login.php" method="post" name="login_form">
                <div class="form-group">
                  <input type="email" placeholder="Email" name="user_id" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password" name="password" class="form-control">
                </div>
                <!-- <button type="submit" class="btn btn-success" onclick="formhash(this.form, this.form.password);">Sign in</button> -->
                <div class="btn-group">
                  <div class="btn-group">
                    <!-- <button type="button" class="btn btn-info" onclick="register.php">Register</button> -->
                    <a href="register.php" class="btn btn-info">Register</a>
                  </div>
                  <div class="btn-group">
                    <button type="submit" class="btn btn-success" onclick="formhash(this.form, this.form.password);">Sign In</button>
                  </div>
                </div>

              </form>

            </p>
          
          </div>
      
      
          <div class="mastfoot">
            <div class="inner">
              <p>WildBook by <a href="#" target="poly">Developers</a> at <a href="http://engineering.nyu.edu/">NYU</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>

</body>
</html>
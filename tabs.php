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
    <br><br><br>
    <div>
      <!-- <h3> Test </h3>  -->
      <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
  <li><a href="#profile" data-toggle="tab">Profile</a></li>
  <li><a href="#messages" data-toggle="tab">Messages</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane fade active" id="home"><?php include "settab.php"; ?></div>
  <div class="tab-pane fade" id="profile">...</div>
  <div class="tab-pane fade" id="messages">...</div>
  <div class="tab-pane fade" id="settings">...</div>
</div>

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
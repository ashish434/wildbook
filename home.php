<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include_once '/includes/db_connect.php';
include_once '/includes/functions.php';
include_once '/includes/nicetime.php';

sec_session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

// <script>
// var tags = [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
// $( "#activity" ).autocomplete({
// source: function( request, response ) {
// var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
// response( $.grep( tags, function( item ){
// return matcher.test( item );
// }) );
// }
// });
// </script>

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
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script type="text/javascript" src="js/likescript.js"></script>

</head>

<body onload="initialize()">
  <?php if (login_check($mysqli) == true) : ?>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Wildbook</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="profile.php?user=<?php echo htmlentities($_SESSION['user_name']); ?>"><?php echo htmlentities($_SESSION['user_name']); ?></a></li>
            <li class="pull-right"><a href="includes/logout.php" style="align:right;">LogOut</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <br><br>

    <div class="page-header panel well panel-default col-md-8 col-md-offset-2" id="addpost">
      <div class="panel-body container-fluid">
        <form enctype="multipart/form-data" id="postform" action="includes/addpost.php" method="post">
          <input type="text" name="title" class="form-control" placeholder="Title">
          <textarea name="textcontent" class="form-control" rows="3" placeholder="Post Content"></textarea>
          <div class="btn-group">
            <button type="button" class="btn btn-success" onclick='$("#activitydiv").show()'>Activity</button>
            <button type="button" class="btn btn-default" onclick='$("#locationdiv").show()'>Location</button>
            <button type="button" class="btn btn-info" onclick='$("#multimediadiv").show()'>Upload</button>
            <button type="button" class="btn btn-default" onclick='$("#privacy").show()'>Privacy</button>
          </div>
            <button type="submit" class="pull-right btn btn-primary">Post</button>

          <br><br>
            <!-- <input type="text" class="form-control" placeholder="Location"> -->
            <!-- <input type="text" class="form-control" placeholder="Activity"> -->
          <div id="activitydiv" class="input-group" style="display: none;">
            <span class="input-group-addon">Activity</span>
            <input id="activityname"  name="activityname" type="text" class="form-control" placeholder="Type Activity name">
            <br>
          </div>

          <div id="locationdiv" class="input-group" style="display: none;">
            <span class="input-group-addon">Location</span>
            <!-- <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" placeholder="Type Location name"> -->
            <?php include_once "includes/gapi.php";?>
          </div>

          <div id="multimediadiv" style="display: none;">
            <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
            <div><input name="userfile" type="file" /></div>
          </div>

          <div id="privacy" style="display: none;">
            <input type='radio' name='privacy' value='public' checked>Public &nbsp;
            <input type='radio' name='privacy' value='friends'>Friends &nbsp;
            <input type='radio' name='privacy' value='fof'>Friend of friends
          </div>

        </form>
      </div>
    </div>

    <div id="posts" class="container col-md-8 col-md-offset-2">
          <?php
    $result = mysqli_query($mysqli,"SELECT * FROM posts WHERE user_name='".$_SESSION['user_name']."' OR user_name IN
            (SELECT user_name FROM friends WHERE friendsusername='".$_SESSION['user_name']."' AND accept=1
              UNION
            SELECT friendsusername FROM friends WHERE user_name='".$_SESSION['user_name']."' AND accept=1)
             ORDER BY posttime DESC");
    while($row = mysqli_fetch_array($result)) {

      include "includes/posts.php";
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
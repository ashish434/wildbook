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
      echo "Gender: &nbsp;&nbsp;&nbsp;&nbsp; Male <input type='radio' name='gender' value='Male'> &nbsp;&nbsp;&nbsp;&nbsp; Female <input type='radio' name='gender' value='Female' checked></form></body></html>";
    
    echo "</div>";

    echo "Date of Birth:<input class='form-control' type='text' name='dob' value='".$row['dob']."'><br>";
    echo "Education:<input class='form-control' type='text' name='education' value='".$row['education']."'><br>";
    echo "Worked at:<input class='form-control' type='text' name='work' value='".$row['work']."'></h4><br>";
  }
  echo "<button type='submit' class='btn btn-primary form-control'>Update</button>";
}
  else {
    /* Error */
    printf("Mazaak: %s\n", $mysqli->error); //MySQL Error
  }

mysqli_close($mysqli);
?>
</div>
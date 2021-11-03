<?php
    session_start();
    if($_SESSION['studentID']==null)
    {
        header("Location:AdminLogin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include 'Plugins.php' ?>
    <title>Admin Dashboard</title>
  </head>
  <body>
    <!-- NAVBAR-->

    <?php include 'AdminHeader.php' ?>
    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">
      <h4>Enter Faculty Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
          <div class="col-md-6">
            <label for="facultyName">Faculty Name:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="facultyName"
                id="facultyName"
                placeholder="Enter Faculty Name"
                required
              />
            </div>
          </div>
          <div class="col-md-6">
            <label for="selectBranch">Branch:</label>
            <select id="selectBranch" name="selectBranch">
            <option>--Select Department--</option>
              <?php
              include 'dbconn.php';
              $sql = "SELECT * FROM department";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))
                {
                    echo '<option value='.$resultArray['Department_ID'].'>';
                    echo ''.$resultArray['Department_Name'].'';
                    echo '</option>';
                }?>
            </select>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-6">
            <label for="username">Email ID:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                placeholder="Enter Username"
              />
            </div>
            </div>

            <div class="col-md-6">
              <label for="Password">Password:</label>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  name="Password"
                  id="Password"
                  placeholder="Enter Password"
                />
              </div>
            </div>
          </div>
<br>
        <div class="row">
        <div class="col-md-6">
        <label for="username">Desgination:</label>
            <div class="form-group">
              <select id="selectBranch" name="TeacherLevel">
              <option>--SELECT DESIGNATION--</option>
              <option value="0">Teacher</option>
              <option value="1"> Head of Department </option>
              <option value="2"> Admin </option>
              </select>
        </div>
        <br>
          <!--BUTTON TO ADD -->
          <button class="btn btn-default" id="addBranch">ADD</button>
        </div>
</div>
       
      </form>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->
    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
  {

    include 'dbconn.php';
    $Sname = $_POST['facultyName'];
    $SUsername = $_POST['username'];
    $Spassword = $_POST['Password'];
    $Sclass= $_POST['selectBranch'];
    $Level = $_POST['TeacherLevel'];
  
    $sql="INSERT INTO teacher(TeacherName,Username,SPassword,Dept_ID,TeacherLevel)
          VALUES ('$Sname','$SUsername','$Spassword','$Sclass','$Level')";
     
    if(mysqli_query($conn,$sql))
    {
     // header("Location: Faculty.php");
        echo "<script>alert('Registration successful'); window.open('Faculty.php', '_self');</script>";
       
    }
    else
    {
        echo "Error :".mysqli_error($conn);
    }

  }

?>
    <script>
      function myFunction() {
        var x = document.getElementById("header");
        if (x.className === "header") {
          x.className += " responsive";
        } else {
          x.className = "header";
        }
      }
    </script>
  </body>
</html>

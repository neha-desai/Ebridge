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
      <h4>Enter Student Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
          <div class="col-md-6">
            <label for="facultyName">Student Name:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="StudentName"
                id="StudentName"
              
              />
            </div>
          </div>
          <div class="col-md-6">
            <label for="selectBranch">Branch:</label>
            <select id="selectBranch" name="selectBranch">   
            <option>--Select Branch--</option>       
              <?php
              include 'dbconn.php';
              $sql = "SELECT * FROM department";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))
                {
                    echo '<option value='.$resultArray['Department_ID'].'>';
                    echo ''.$resultArray['Department_Name'].'';
                    echo '</option>';
                }
              ?>
            </select>
          </div>
        </div>
        <br />


        <div class="row">
                <div class="col-md-6">
                <label for="emailID">Email-ID:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="emailID"
                  id="emailID"              
                />
              </div>
                </div>

                <div class="col-md-6">
                <label for="password">Password:</label>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  name="password"
                  id="password"
                />
              </div>
                </div>
                </div>


                <br />

        <div class="row">
          <div class="col-md-4">
            <label for="username">Semester:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="semester"
                id="semester"
              />
            </div>
            </div>

            <div class="col-md-4">
              <label for="Password">Roll No.:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="rollno"
                  id="rollno"
                />
              </div>
            </div>

            <div class="col-md-4">
              <label for="seatNo">SeatNo.:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="seatNo"
                  id="seatNo"
                />
              </div>
            </div>
          </div>
<br>

             


        <div class="row">
        <br>
        <div class="col-md-3">
          <!--BUTTON TO ADD -->
          <button class="btn btn-default" id="addBranch">ADD</button>
          </div>
        </div>
</div>
       
      </form>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->
    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
  {

    include 'dbconn.php';
    $Sname = $_POST['StudentName'];
    $Semester = $_POST['semester'];
    $Sclass= $_POST['selectBranch'];
    $seatNo = $_POST['seatNo'];
    $rollno = $_POST['rollno'];
    $email = $_POST['emailID'];
    $SPassword = $_POST['password'];
  
    $sql="INSERT INTO student(Student_Name,Department,Semester,SeatNo,RollNo,EmailID,SPassword)
          VALUES ('$Sname','$Sclass','$Semester','$seatNo','$rollno','$email','$SPassword')";
     
    if(mysqli_query($conn,$sql))
    {
        //echo "<script>alert('Registration successful');</script>";
        echo "<script>alert('Registration successful'); window.open('Student.php', '_self');</script>";
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

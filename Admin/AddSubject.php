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
      <h4>Enter Subject Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
          
          <div class="col-md-6">
            <label for="facultyName">Subject Name:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="SubjectName"
                id="SubjectName"
                placeholder="Enter Subject Name"
              />
            </div>
          </div>
         
          <div class="col-md-6">
            <label for="selectBranch">Branch:</label>
            <select id="selectBranch" name="selectBranch">
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
            <label for="username">Semester:</label>
            <div class="form-group">
             <select id="selectBranch" name="semester">
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
             <option value="6">6</option>
             <option value="7">7</option>
             <option value="8">8</option>
             </select>
            </div>
            </div>

            <div class="col-md-6">
              <label for="Password">Subject Type:</label>
              <div class="form-group">
               <select id="selectBranch" name="subjectType">
               <option value="">Select subject type</option>
               <option value="1">Theory</option>
               <option value="2">Practical</option>
               </select>
              </div>
            </div>
          </div>
<br>

        <div class="row">
        <div class="col-md-6">
        <label for="username">Assign Teacher:</label>
            <div class="form-group">
            <select id="selectBranch" name="assignTeacher">
            <option>Select Teacher</option>
              <?php
              include 'dbconn.php';
              $sql = "SELECT * FROM teacher";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))
                {
                    echo '<option value='.$resultArray['Teacher_ID'].'>';
                    echo ''.$resultArray['TeacherName'].'';
                    echo '</option>';
                }
                mysqli_close($conn);
              ?>
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
    $Sname = $_POST['SubjectName'];
    $Dept= $_POST['selectBranch'];
    $SubjectType = $_POST['subjectType'];
    $Semester = $_POST['semester'];
    $Teacher = $_POST['assignTeacher'];
    
 
  
    $sql="INSERT INTO subject_table(Subject_Name,Semester,Teacher_ID,Dept_ID,Subject_Type)
          VALUES ('$Sname','$Semester','$Teacher','$Dept','$SubjectType')";
     
    if(mysqli_query($conn,$sql))
    {
        //echo "<script>alert('Registration successful');</script>";
        //header("Location: Subject.php");
        echo "<script>alert('Subject Added successfully!').then(() => { window.location.href='Subject.php'; });</script>";
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

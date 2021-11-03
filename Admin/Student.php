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
  </head>
  <body>
   <!-- NAVBAR-->

    <!------------ TOP NAVIGATION STARTS HERE------>
    <?php include 'AdminHeader.php' ?>


    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">
    <h4>Student</h4>
      <br />
      <!--BUTTON TO ADD -->
      <a href="AddStudent.php">
        <button class="btn btn-default" id="addBranch">
          Add Student <span class="fa fa-plus"></span></button
      ></a>
    </div>

    <div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Department</th>
              <th>Semester</th>
              <td></td>
              <td></td>
            </tr>
          </thead>
          <?php
          
          include 'dbconn.php';

          $sql = "SELECT * FROM student";

        $result = mysqli_query($conn,$sql);

        while($resultArray = mysqli_fetch_array($result))

        {
          $Dept = $resultArray['Department'];
            echo '<tr>';
            echo '<td>'.$resultArray['Student_Name'].'</td>';

            $Dept_SQL = "SELECT * FROM department WHERE Department_ID = $Dept";
            $results= mysqli_query($conn,$Dept_SQL);
            while($resultDept = mysqli_fetch_array($results))
            {
              echo '<td>'.$resultDept['Department_Name'].'</td>';
            }
            echo '<td>'.$resultArray['Semester'].'</td>';
            echo '<td> <a href="EditStudent.php?id='.$resultArray['Student_ID'].'"><span id="editbtn" class="fa fa-pencil-alt" title="Edit"></span></a></td>';
            echo '<td> <a href="DeleteStudent.php?id='.$resultArray['Student_ID'].'"><span id="deletebtn" class="fas fa-trash" title="Delete"></span></a></td>';
            echo '</tr>';
  
        }
          ?>
          
        </table>
      </div>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->

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

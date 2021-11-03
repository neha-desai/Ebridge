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
    <h4>Subject</h4>
      <br />
      <!--BUTTON TO ADD -->
      <a href="AddSubject.php">
        <button class="btn btn-default" id="addBranch">
          Add Subject <span class="fa fa-plus"></span></button
      ></a>
    </div>

    <div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Subject Name</th>
              <th>Department</th>
              <td></td>
              <td></td>
            </tr>
          </thead>
          <?php
          
          include 'dbconn.php';

          $sql = "SELECT * FROM subject_table";

        $result = mysqli_query($conn,$sql);

        while($resultArray = mysqli_fetch_array($result))

        {
          $Dept = $resultArray['Dept_ID'];
            echo '<tr>';
            echo '<td>'.$resultArray['Subject_Name'].'</td>';

            $Dept_SQL = "SELECT * FROM department WHERE Department_ID = $Dept";
            $results= mysqli_query($conn,$Dept_SQL);
            while($resultDept = mysqli_fetch_array($results))
            {
              echo '<td>'.$resultDept['Department_Name'].'</td>';
            }
            
            echo '<td> <a href="EditSubject.php?id='.$resultArray['Subject_ID'].'"><span id="editbtn" class="fa fa-pencil-alt" title="Edit"></span></a></td>';
            echo '<td> <a href="DeleteSubject.php?id='.$resultArray['Subject_ID'].'"><span id="deletebtn" class="fas fa-trash" title="Delete"></span></a></td>';
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

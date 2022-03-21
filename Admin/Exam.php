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
    <h4>Exam</h4>
      <br />
      <!--BUTTON TO ADD -->
      <a href="AddExam.php">
        <button class="btn btn-default" id="addBranch">
          Add Exam <span class="fa fa-plus"></span></button
      ></a>
    </div>

    <div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Department</th>
              <th>Date</th>
              <td></td>
              <td></td>
            </tr>
          </thead>
          <?php
          
          include 'dbconn.php';

          $sql = "SELECT * FROM exam ORDER BY Exam_Date";

        $result = mysqli_query($conn,$sql);

        while($resultArray = mysqli_fetch_array($result))

        {
          $subject = $resultArray['Subject_ID'];
            echo '<tr>';
            
            $subj_SQL = "SELECT * FROM subject_table WHERE Subject_ID = $subject";
            $results= mysqli_query($conn,$subj_SQL);
            while($resultDept = mysqli_fetch_array($results))
            {
              $DeptID = $resultDept['Dept_ID'];
              echo '<td>'.$resultDept['Subject_Name'].'</td>';


              $dept_SQL = "SELECT * FROM department WHERE Department_ID = $DeptID";
              $resul = mysqli_query($conn,$dept_SQL);
              while($resultD = mysqli_fetch_array($resul))
              {
                echo '<td>'.$resultD['Department_Name'].'</td>';
              }
            }
            $dates = strtotime($resultArray['Exam_Date']);
            echo '<td>'.date('d/m/y', $dates).'</td>';
            echo '<td> <a href="EditExam.php?id='.$resultArray['Exam_ID'].'"><span id="editbtn" class="fa fa-pencil-alt" title="Edit"></span></a></td>';
            echo '<td> <a href="DeleteExam.php?id='.$resultArray['Exam_ID'].'"><span id="deletebtn" class="fas fa-trash" title="Delete"></span></a></td>';
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

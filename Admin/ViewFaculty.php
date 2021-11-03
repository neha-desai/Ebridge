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
      <h4>Faculty</h4>
      
      <hr size="2" />

    

      <!--------------------TABLE STARTS HERE-------------------------->

   

      <!-----------------SAMPLE TABLE FOR FRONT END PURPOSE. DYNAMIC DATA-------------->
 
         
          <?php

                include 'dbconn.php';
                $sid = $_GET['id'];
                $sql = "SELECT * FROM teacher WHERE Teacher_ID = $sid";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))

                {
                        
                        echo '<p> <b>Name:</b> '.$resultArray['TeacherName'].'</p>';
                        echo '<p> <b>Email ID:</b> '.$resultArray['Username'].'</p>';
                        $dept = $resultArray['Dept_ID'];
                        $deptSQL = "SELECT * FROM department WHERE Department_ID = '$dept'";
                        $resultdept = mysqli_query($conn,$deptSQL);
                        while($resultArrayDept = mysqli_fetch_array($resultdept))
                        {
                            echo '<p> <b>Department:</b> '.$resultArrayDept['Department_Name'].'</p>';
                        }

                        echo '<p><b>Subject: </b><ul>';
                        $subSQL = "SELECT * FROM subject_table WHERE TEACHER_ID = '$sid'";
                        $resultsubj = mysqli_query($conn,$subSQL);
                        while($resultArraySubj = mysqli_fetch_array($resultsubj))
                        {
                            echo '<li>'.$resultArraySubj['Subject_Name'].'</li>';
                        }
                        echo '</ul>';
                        echo '<p><b>No.of Leaves: </b>'.$resultArray['NoofLeaves'].' </p>';
                        
                        
                       
  
                }
            ?>
         
        
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

<?php
    session_start();
    if($_SESSION['studentID']==null)
    {
        header("Location:StudentDashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include 'Plugins.php' ?>
  </head>
  <body style="background-color: #f6f8fa">
    
    <!--Side Navbar-->
    <?php include 'SideNavbar.php' ;?>

    <!--RIGHT SIDE MAIN DIV-->
    <div id="main" class="openmain">
     
    <!--TOP NAV -->
    <?php include 'TopNav.php';?>


      <!--MAIN DIVS-->

      <div class="row">
        <div class="col-md-6">
          <div class="maindivs">
          <?php 
          include 'dbconn.php';
          $tid = $_SESSION['studentID'];
          $sql = "SELECT * from student where Student_ID =  '$tid'";

          $result = mysqli_query($conn,$sql);

          while($resultArray = mysqli_fetch_array($result))
          {
            $deptID = $resultArray['Department'];
            $deptsql = "SELECT * FROM department where Department_ID = $deptID";
            $deptresult = mysqli_query($conn,$deptsql);
            while($resultArrayDept = mysqli_fetch_array($deptresult))
            {
              echo '<b>Department: </b>'.$resultArrayDept['Department_Name'];
            }
            echo '<br><b>Semester: </b>'.$resultArray['Semester'];
            echo '<br>';
            echo '<b>Roll no. </b>'.$resultArray['RollNo'];            
          
          ?>
          </div>
        </div>


        <div class="col-md-3">
          <div class="maindivs">
                <h5>Your seat no.:</h5>
                <?php
                    echo '<h4 class="text-info">'.$resultArray['SeatNo'].'</h4>';
          
                ?>
          </div>
        </div>

      
      </div>

      <div class="row">
      <div class="col-md-4">
      <div class="maindivs">
      <p style="color: black;"><b>Subjects you will study this semester:</b></p>
                <?php
                $sem = $resultArray['Semester'];
                $subjsql = "SELECT * FROM subject_table WHERE Dept_ID = $deptID AND Semester = $sem";
                $resultsubj = mysqli_query($conn,$subjsql);
                
                echo '<ul>';
              while($resultArraySubj = mysqli_fetch_array($resultsubj))
              { 
                echo '<li>'.$resultArraySubj['Subject_Name'].'</li>';
              }
              echo '</ul>';
            }
              ?>
      </div>
      </div>
      </div>
    </div>


    <script>
      function closeNav() {
        var sidebar = document.getElementById("sideNavbar");
        var mainDiv = document.getElementById("main");

        if (sidebar.className === "sideNavbar") {
          sidebar.classList.add("closebar");
          mainDiv.classList.add("closemain");
        } else {
          sidebar.classList.remove("closebar");
          mainDiv.classList.remove("closemain");
        }
      }

      $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>

  </body>
</html>


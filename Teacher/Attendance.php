<?php
    session_start();
    if($_SESSION['studentID']==null)
    {
        header("Location:TeacherLogin.php");
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
        <div class="col-md-12">          
          <div class="maindivs">
              <!--ADD A LECTURE BTN-->
          <a href="AddAttendance.php"> <button class="btn btn-primary">Add a new Lecture Attendance <span class="fas fa-plus"></span></button></a>
        <br><br>

<!--LECTURES BRIEF-->
    <h4>No.of of lectures</h4><br>
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
              <tr>
                <th>Subject Name</th>
                <th>No.of Lectures</th>           
              </tr>
              </thead>

              <?php
            include 'dbconn.php';
            $red = $_SESSION['studentID'];
            
            $sql = "SELECT DISTINCT(Subject_ID) FROM lectures WHERE Teacher_ID = '$red'";
            
            $result = mysqli_query($conn,$sql);
            
            while($resultArray = mysqli_fetch_array($result))
            
            {  
              echo '<tr>';      
              

              $Subj = $resultArray['Subject_ID'];
              $subj_Name = "SELECT * FROM subject_table WHERE Subject_ID = '$Subj'"; 
              $SubName= mysqli_query($conn,$subj_Name);
              while($resultSubName = mysqli_fetch_array($SubName))
              {
                echo '<td>'.$resultSubName['Subject_Name'].'</td>';
              }

              $subj_SQL = "SELECT COUNT(Subject_ID) AS CountLec FROM lectures WHERE Subject_ID = '$Subj'";
              $Subjresults= mysqli_query($conn,$subj_SQL);
              while($resultDept = mysqli_fetch_array($Subjresults))
              {
                echo '<td>'.$resultDept['CountLec'].'</td>';
              }
                           
                echo '</tr>';
            }
            ?>



          </table>
        </div> <!--TABLE-RESPONSIVE END-->


          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">          
          <div class="maindivs">
            
                
        
          <!--DISPLAY ATTENDANCE-->
         
          <h4>Detailed list of lectures</h4><br>
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
              <tr>
                <th>Subject Name</th>
                <th>Date</th>           
                <th>Absent Students</th> 
              </tr>
              </thead>

              <?php
            include 'dbconn.php';
            $red = $_SESSION['studentID'];
            
            $sql = "SELECT * FROM lectures WHERE Teacher_ID = '$red'";
            
            $result = mysqli_query($conn,$sql);
            
            while($resultArray = mysqli_fetch_array($result))
            
            {  
              echo '<tr>';
           
              $Subj = $resultArray['Subject_ID'];
              $subj_SQL = "SELECT * FROM subject_table WHERE Subject_ID = '$Subj'";
              $Subjresults= mysqli_query($conn,$subj_SQL);
              while($resultDept = mysqli_fetch_array($Subjresults))
              {
                echo '<td>'.$resultDept['Subject_Name'].'</td>';
              }
              $dates = strtotime($resultArray['Lec_Date']);              
                echo '<td>'.date('d/m/y', $dates).'</td>';
                echo '<td>'.$resultArray['attendance'].'</td>';                             
                echo '</tr>';
            }
            ?>



          </table>
        </div> <!--TABLE-RESPONSIVE END-->
       
            
            


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

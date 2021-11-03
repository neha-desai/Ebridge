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
          <?php

            $con=mysqli_connect("localhost", "root", "","ebdrige");
            if(mysqli_connect_errno()){
                echo "Connection Fail".mysqli_connect_error();
            }

            $sid = $_GET['id'];
            $sql = "SELECT Leave_ID,SStatus, Teacher_ID, SDescription, StartDate, Till_Date, Applied_Date, Applied_Time, LeaveType, DATEDIFF(Till_Date, StartDate)AS days FROM leavedetails WHERE Leave_ID = $sid";

            $result = mysqli_query($conn,$sql);

            while($resultArray = mysqli_fetch_array($result))
            {
 
                //GET TEACHER NAME
                $teacher_id = $resultArray['Teacher_ID'];

                $teacher = "SELECT * FROM teacher WHERE Teacher_ID = $teacher_id";
                $res = mysqli_query($conn,$teacher);
                while($resarr = mysqli_fetch_array($res))
                {
                    echo $resarr['TeacherName'];
                    echo '<br>';
                }
                

                //Leave Details
                $leavedays = $resultArray['days'] + 1;
                echo '<br><br> <b>No.of Days: </b>'.$leavedays;
                echo '<br><b>Leave applied from </b>'.$resultArray['StartDate'].'<b> to </b>'.$resultArray['Till_Date'];
                
                echo '<br><b>Leave type: </b>';
                $Ltype = $resultArray['LeaveType'];
                if($Ltype == 0) {echo 'Sick Leave';}
                if($Ltype == 1) {echo 'Maternity Leave';}
                if($Ltype == 2) {echo 'Paternity Leave';}
                if($Ltype == 3) {echo 'Other';}
                echo '<br><b>Leave type: </b>'.$resultArray['LeaveType'];
                echo '<br><b>Note: </b>'.$resultArray['SDescription'];
                echo '<br><b>Date Applied: </b>'.$resultArray['Applied_Date'];
                echo '<br><b>Time Applied: </b>'.$resultArray['Applied_Time'];

                if($resultArray['SStatus']== 0)
                {
                  echo '<p style="margin: 20px 0px">
                  <a class="approvebtns" id="approve" href="Approve.php?id='.$resultArray['Leave_ID'].'"> Approve </a>              
                  <a class="approvebtns" id="reject" href="Reject.php?id='.$resultArray['Leave_ID'].'"> Reject </a>';
                }

               
                if($resultArray['SStatus'] == 2)
                {
                  echo '<p style="margin: 20px 0px">
                  <a class="approvebtns" id="approve" href="Approve.php?id='.$resultArray['Leave_ID'].'"> Approve </a>
                  <a class="approvebtns" id="MoveToPending" href="MoveToPending.php?id='.$resultArray['Leave_ID'].'"> Move to Pending </a>';
                }

               
            }
        
?>

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

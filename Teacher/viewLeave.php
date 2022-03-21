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
            $sql = "SELECT Leave_ID,SStatus, Teacher_ID, SDescription, StartDate, Till_Date, Applied_Date,Rejected_Reason, Applied_Time, LeaveType, DATEDIFF(Till_Date, StartDate)AS days FROM leavedetails WHERE Leave_ID = $sid";

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
                echo '<br><br><p style="color: black;"> <b>No.of Days: </b>'.$leavedays.'</p>';
                echo '<p style="color: black;"><b>Leave applied from </b>'.$resultArray['StartDate'].'<b> to </b>'.$resultArray['Till_Date'].'</p>';
                
                $Ltype = $resultArray['LeaveType'];
                if($Ltype == 0) {$LeaveTypeDisplay = 'Sick Leave';}
                if($Ltype == 1) {$LeaveTypeDisplay =  'Maternity Leave';}
                if($Ltype == 2) {$LeaveTypeDisplay =  'Paternity Leave';}
                if($Ltype == 3) {$LeaveTypeDisplay =  'Other';}
                echo '<p style="color: black;"><b>Leave type: </b>'.$LeaveTypeDisplay.'</p>';
                echo '<p style="color: black;"><b>Note: </b>'.$resultArray['SDescription'].'</p>';
                echo '<p style="color: black;"><b>Date Applied: </b>'.$resultArray['Applied_Date'].'</p>';
                echo '<p style="color: black;"><b>Time Applied: </b>'.$resultArray['Applied_Time'].'</p>';
                echo '<b>Rejected reason: </b><form action="Reject.php" method="GET"> 
                      <textarea id="rejectedReason" name="rejectedReason" rows="4" cols="50">'.$resultArray['Rejected_Reason'].'</textarea>
                      </form>';
                

                if($resultArray['SStatus']== 0)
                {
                  echo '<script>var val = document.getElementbyId("rejectedReason").value;</script>';
                  $Reason = '<script> </script>';
                  echo '<p style="margin: 20px 0px">
                  <a class="approvebtns" id="approve" href="Approve.php?id='.$resultArray['Leave_ID'].'"> Approve </a>              
                  <a class="approvebtns" id="reject" onclick="test()" > Reject </a>';
                  $GLOBALS['leaveid'] = $resultArray['Leave_ID'];
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

      function test()
      {
        var val = document.getElementById("rejectedReason").value;
        var hrf="Reject.php?id=<?php echo $leaveid ?>&reason="+val;
        document.getElementById("reject").href=hrf;
      };
    
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

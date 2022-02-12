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
      <h4>Leave Details</h4>
      <br />
      <?php

            $con=mysqli_connect("localhost", "root", "","ebdrige");
            if(mysqli_connect_errno()){
                echo "Connection Fail".mysqli_connect_error();
            }

            $sid = $_GET['id'];
            $sql = "SELECT Leave_ID,SStatus, Teacher_ID, SDescription, StartDate, Till_Date, Applied_Date,Rejected_Reason, Applied_Time, LeaveType, DATEDIFF(Till_Date, StartDate)AS days FROM leavedetails WHERE Leave_ID = $sid";

            $result = mysqli_query($con,$sql);

            while($resultArray = mysqli_fetch_array($result))
            {
 
                //GET TEACHER NAME
                $teacher_id = $resultArray['Teacher_ID'];

                $teacher = "SELECT * FROM teacher WHERE Teacher_ID = $teacher_id";
                $res = mysqli_query($con,$teacher);
                while($resarr = mysqli_fetch_array($res))
                {
                    echo '<h3>'.$resarr['TeacherName'].'</h3>';
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
      

      
      <hr size="2" />

   
      
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->

    <script>

function test()
      {
        var val = document.getElementById("rejectedReason").value;
        var hrf="Reject.php?id=<?php echo $leaveid ?>&reason="+val;
        document.getElementById("reject").href=hrf;
      }

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

<?php
ob_start();
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
        <div class="col-md-12">
          <div class="maindivs">
          <div class="table-responsive">
            <table class="table table-striped ">
            <thead>
              <tr>
                <th>Subject Name</th>
                <th>Total No.of Lectures</th>    
                <th>No. of attended Lectures</th> 
                <th>Percentage (%)</th>       
              </tr>
              </thead>


              <?php
            include 'dbconn.php';
            $red = $_SESSION['studentID'];            
            $Distinctsql = "SELECT DISTINCT(Subject_ID) FROM lectures";            
            $Distinctresult = mysqli_query($conn,$Distinctsql);            
            while($DistinctresultArray = mysqli_fetch_array($Distinctresult))
            
            {  
              echo '<tr>';      
              
              $Subj = $DistinctresultArray['Subject_ID'];
              $subj_Name = "SELECT * FROM subject_table WHERE Subject_ID = '$Subj'"; 
              $SubName= mysqli_query($conn,$subj_Name);
              while($resultSubName = mysqli_fetch_array($SubName))
              {
                echo '<td>'.$resultSubName['Subject_Name'].'</td>'; //FETCHING SUBJECT NAME                
              }
                $subj_SQL = "SELECT COUNT(Subject_ID) AS CountLec FROM lectures WHERE Subject_ID = '$Subj'";
                $Subjresults= mysqli_query($conn,$subj_SQL);
                while($resultDept = mysqli_fetch_array($Subjresults))
                {
                  echo '<td>'.$resultDept['CountLec'].'</td>';  //COUNTING THE TOTAL NO.OF LECS
                  $TotalLec = $resultDept['CountLec'];
                  $studID = $_SESSION['studentID'];            
                  $sql = "SELECT * FROM student WHERE Student_ID = '$studID'";             
                  $result = mysqli_query($conn,$sql);             
                  while($resultArray = mysqli_fetch_array($result))  
                  {
                    $rollno = $resultArray['RollNo'];                       
                    $AttendanceSQL = "SELECT COUNT(Subject_ID) AS CountLec FROM lectures WHERE attendance LIKE '%$rollno%' AND Subject_ID='$Subj'";             
                    $AttendaneResult = mysqli_query($conn,$AttendanceSQL);             
                    while($AttendaneResultArray = mysqli_fetch_array($AttendaneResult))  
                    {
                      $AttendedLec = $TotalLec - $AttendaneResultArray['CountLec'];
                     echo '<td>'.$AttendedLec.'</td>';  //COUNTING THE TOTAL NO.OF LECS
                     $Percentage = round(($AttendedLec / $TotalLec)*100);
                     if($Percentage<75){ echo '<td class="text-danger"><b>'.$Percentage.'%</b></td>';}
                     else{ echo '<td>'.$Percentage.'%</td>';}
                    
                    }
                  }
                }
                
               echo '</tr>';
            }
            ?>

              </table>
            </div>

            <p style="color: #5b5b5b;font-size: 12px;">* Your attendance in every subject should be >= 75%.<br><i class="fas fa-exclamation-triangle" style="color:#ff5b5b"></i> If your attendance is less than 75%, you need to contact the respective facutly or else you will not be granted Term Work for this semester. </p>
          </div>
        </div>
      </div>



      <!--DETAILED TABLE-->
      <div class="row">
        <div class="col-md-12">
          <div class="maindivs">
          <h4>Details of Absent Lectures:</h4><br>
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
            <thead>
              <tr style="background-color: #92b0e8">
                <th>Subject Name</th>
                <th>Date</th>    
                <th>Time</th>        
              </tr>
              </thead>




             <?php
             include 'dbconn.php';
             $red = $_SESSION['studentID'];            
             $sql = "SELECT * FROM student WHERE Student_ID = '$red'";             
             $result = mysqli_query($conn,$sql);             
             while($resultArray = mysqli_fetch_array($result))           
             { 
              $rollno = $resultArray['RollNo'];                       
             $AttendanceSQL = "SELECT * FROM lectures WHERE attendance LIKE '%$rollno%'";             
             $AttendaneResult = mysqli_query($conn,$AttendanceSQL);             
             while($AttendaneResultArray = mysqli_fetch_array($AttendaneResult))  
             {
               echo '<tr>';
              $Subj = $AttendaneResultArray['Subject_ID'];
              $subj_Name = "SELECT * FROM subject_table WHERE Subject_ID = '$Subj'"; 
              $SubName= mysqli_query($conn,$subj_Name);
              while($resultSubName = mysqli_fetch_array($SubName))
              {
                if($resultSubName['Subject_Type']==1){ echo '<td>'.$resultSubName['Subject_Name'].' (Theory) </td>';}
                else{ echo '<td>'.$resultSubName['Subject_Name'].' (Practical) </td>';}
              }

              $dates = strtotime($AttendaneResultArray['Lec_Date']);
              echo '<td>'.date('d/m/y l', $dates).'</td>';
              $startTime = strtotime($AttendaneResultArray['Start_Time']);                          
              $EndTime = strtotime($AttendaneResultArray['End_Time']);              
              echo '<td>'.date('h:i A', $startTime).' - '.date('h:i A', $EndTime).'</td>';
             }
              echo '</tr>';
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


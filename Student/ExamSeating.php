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
        <div class="col-md-12">
          <div class="maindivs">
          <div class="table-responsive">          
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Subject</th>
             <th>Date</th>
             <th>Room No.</th>
             <th>Start Time</th>
             <th>End Time</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
 <?php

include 'dbconn.php';

$red = $_SESSION['studentID'];

$SQLDemo = "SELECT exam.Exam_ID,exam.Exam_Date,exam.Start_Time,exam.End_Time, exam.Subject_ID, allotment.Student_ID, allotment.Room_ID FROM exam INNER JOIN allotment where allotment.Exam_ID = exam.Exam_ID AND allotment.Student_ID = $red ORDER BY exam.Exam_Date ASC";


$result = mysqli_query($conn,$SQLDemo);

while($resultArray = mysqli_fetch_array($result))

{
 echo '<tr>';
 
   $subid = $resultArray['Subject_ID'];
   $subsql = "SELECT Subject_Name FROM subject_table WHERE Subject_ID = $subid";
   $subjectresult = mysqli_query($conn,$subsql);
   while($resultArraysubject = mysqli_fetch_array($subjectresult))
   {
    echo '<td>'.$resultArraysubject['Subject_Name'].'</td>';
   }
   $dates = strtotime($resultArray['Exam_Date']);
   echo '<td>'.date('d/m/y', $dates).'</td>';
    
 

 //SELECT ROOM SQL
 $rid=$resultArray['Room_ID'];
 $roomsql = "SELECT * FROM room WHERE Room_ID = $rid";
 $roomresult = mysqli_query($conn,$roomsql);
 while($resultArrayroom = mysqli_fetch_array($roomresult))
 {
  echo '<td>'.$resultArrayroom['Room_Number'].'</td>';
 }
 echo '<td>'.$resultArray['Start_Time'].'</td>';
 echo '<td>'.$resultArray['End_Time'].'</td>';

 echo '</tr>';
 
}

?>

</table>
</div> <!--table-responsive div ends here-->
</div> <!--Table that displays leave END DIV-->
          </div>
        </div>

<div class="maindivs">
<i class="fas fa-exclamation-circle" style="color: grey;"></i> Make sure you report to your respective rooms 15 mins prior to your exam!
</div>

<div class="maindivs">
<i class="fas fa-exclamation-triangle" style="color: grey;"></i> Carry your hallticket with you. To download your hall ticket <a href="">Click Here</a>
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


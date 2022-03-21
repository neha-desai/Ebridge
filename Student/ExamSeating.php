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
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Subject</th>
             <th>Date</th>
             <th>Room No.</th>
             <th>Start Time</th>
             <th>End Time</th>
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
  <form method="post">
<i class="fas fa-exclamation-triangle" style="color: grey;"></i> Carry your hallticket with you. To download your hall ticket <button name="createPDF" class="btn btn-primary">Click Here</button>
</form>
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

<!--PHP FUNCTION TO DOWNLOAD PDF-->
<?php
function fetch_data()
{
  include 'dbconn.php';
  $red = $_SESSION['studentID'];
  $output ='';
$SQLDemo = "SELECT exam.Exam_ID,exam.Exam_Date,exam.Start_Time,exam.End_Time, exam.Subject_ID, allotment.Student_ID, allotment.Room_ID FROM exam INNER JOIN allotment where allotment.Exam_ID = exam.Exam_ID AND allotment.Student_ID = $red ORDER BY exam.Exam_Date ASC";
$result = mysqli_query($conn,$SQLDemo);

while($resultArray = mysqli_fetch_array($result))

{
 //echo '<tr>';
 
   $subid = $resultArray['Subject_ID'];
   $subsql = "SELECT Subject_Name FROM subject_table WHERE Subject_ID = $subid";
   $subjectresult = mysqli_query($conn,$subsql);
   while($resultArraysubject = mysqli_fetch_array($subjectresult))
   {
     $output .= '<tr> <td>'.strtoupper($resultArraysubject['Subject_Name']).'</td>';
    //echo '<td>'.$resultArraysubject['Subject_Name'].'</td>';
   }
   $dates = strtotime($resultArray['Exam_Date']);
   $output .= '<td>'.date('d/m/y', $dates).'</td>';
  // echo '<td>'.date('d/m/y', $dates).'</td>';
    
 $output .='<td>'.$resultArray['Start_Time'].'</td> <td>'.$resultArray['End_Time'].'</td> </tr>';
 //echo '<td>'.$resultArray['Start_Time'].'</td>';
 //echo '<td>'.$resultArray['End_Time'].'</td>';

 //echo '</tr>';
 
 
}
return $output;  
}
//FETCH STUDENT DATA
function fetch_studentData()
{
  include 'dbconn.php';
  $red = $_SESSION['studentID'];
  $output ='';
  $SQLDemo = "SELECT * FROM student WHERE Student_ID=$red";
  $result = mysqli_query($conn,$SQLDemo);

while($resultArray = mysqli_fetch_array($result))
{
  $GLOBALS['candidatePhoto'] = $resultArray['CandidatePhoto'];
  $output .= '<tr style="text-align:center;"><td> Sem '.$resultArray['Semester'].'</td>
                  <td>Choice Based</td>
                  <td>982</td>
                  <td>982</td>
                  <td>'.$resultArray['SeatNo'].'</td></tr>';

  $output .= '<tr><td><b>Student Name</b></td>
                  <td colspan="4">'.$resultArray['Student_Name'].'</td></tr>';
                  $deptID = $resultArray['Department'];

  $deptsql = "SELECT * FROM department where Department_ID = $deptID";
  $deptresult = mysqli_query($conn,$deptsql);
  while($resultArrayDept = mysqli_fetch_array($deptresult))
  {
    $output .= '<tr><td><b>Department</b></td>
    <td colspan="4">'.$resultArrayDept['Department_Name'].'</td></tr>';

  }
 
}
return $output;
}
if(isset($_POST['createPDF']))
{

  require_once("../tcpdf_min/tcpdf.php");
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT,true,'UTF-8',false);
  $obj_pdf->SetCreator(PDF_CREATOR);
  $obj_pdf->SetTitle("Hall Ticket");
  $obj_pdf->SetHeaderData('','',PDF_HEADER_TITLE, PDF_HEADER_STRING);
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $obj_pdf->SetDefaultMonospacedFont('Corbel');  
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
  $obj_pdf-> setPrintHeader(false);  
  $obj_pdf->setPrintFooter(false);  
  $obj_pdf->SetAutoPageBreak(TRUE, 10);  
  $obj_pdf->SetFont('helvetica', '', 10);
  $obj_pdf->AddPage();  
  $obj_pdf->SetTopMargin(15);
  $obj_pdf->SetLineStyle( array( 'width' => 0.5, 'color' => array(0,0,0)));
  $obj_pdf->Rect(15, 15, 180, 200);
  $content = '';  
  $content .=
  '<br><h3 align="center">EXAMINATION HALL TICKET</h3>
  <table border="1" cellspacing="0" cellpadding="5">  
  <tr style="background-color:#F2F2F2;text-align: center;">
  <thead>
  <th><b>Semester</b></th>
  <th><b>Pattern</b></th>
  <th><b>College</b></th>
  <th><b>Center</b></th>
  <th><b>Seat No.</b></th>
  </thead>
</tr>';
$content .= fetch_studentData();  
$content .= '</table>';  

  $content .= '   
 <br />
 <h3 align="center">EXAMINATION DETAILS</h3><br /><br />
  <table border="1" cellspacing="0" cellpadding="5">  
  <tr style="background-color:#F2F2F2;">
  <thead>
  <th style="width: 45%;"><b>Subject</b></th>
  <th style="width: 12%"><b>Date</b></th>
  <th style="width: 21.5%"><b>Start Time</b></th>
  <th style="width: 21.5%"><b>End Time</b></th>
  </thead>
</tr>';
$content .= fetch_data(); 
$content .= '<tr>
<td colspan="3" style="font-size:8px;"><b>  Note:</b><br>
1. This hallticket is valid ONLY if signed by the principal of the institue.<br>
2. The hallticket of not eligible (detained or other case) candidates shall be withheld. <br>
3. The subjects and heads applied for examination are display. <br>
4. No candidates shall be allowed without hallticket.</td>

<td>
<img src="img/'.$GLOBALS['candidatePhoto'].'">
</td>
</tr>'; 
$content .= '</table>';  

$obj_pdf->writeHTML($content);  
ob_end_clean();
$obj_pdf->Output('sample.pdf', 'I');  
}
?>
  </body>
</html>


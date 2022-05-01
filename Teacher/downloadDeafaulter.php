<?php
session_start();
if($_SESSION['studentID']==null)
{
    header("Location:TeacherLogin.php");
}

include('dbconn.php');
$teacherID = $_SESSION['studentID']; 
$month = $_GET['month'];
$Subject_ID = $_GET['SubjectID'];
$Total_Count;

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
  $content .='<br><h3 align="center">DEFAULTER LIST FOR ';
  if($month == '01'){$content .=  'JANUARY';}
  if($month == '02'){$content .=  'FEBRUARY';}
  if($month == '03'){$content .=  'MARCH';}
  if($month == '04'){$content .=  'APRIL';}
  if($month == '05'){$content .=  'MAY';}
  if($month == '06'){$content .=  'JUNE';}
  if($month == '07'){$content .=  'JULY';}
  if($month == '08'){$content .=  'AUGUST';}
  if($month == '09'){$content .=  'SEPTEMBER';}
  if($month == '10'){$content .=  'OCTOBER';}
  if($month == '11'){$content .=  'NOVEMBER';}
  if($month == '12'){$content .=  'DECEMBER';}
  
  $content.= '</h3>';
  $content .='<br><h4 align="center">Date: ';
  $t=time();
  $content .= date("d-m-Y",$t);
  $content .= '</h4>';

  //FETCH TEACHER NAME
  $teacher = "SELECT * FROM teacher WHERE Teacher_ID = $teacherID";
  $teacherresults= mysqli_query($conn,$teacher);
  while($resultTeacher = mysqli_fetch_array($teacherresults))
  {
    $content .='<br><h4 align="center">By: ';
    $content .= $resultTeacher['TeacherName'];
    $content .= '</h4>';
  }

  $content .= '<table border="1" cellspacing="0" cellpadding="5">';

  //COUNT TOTAL NO.OF LECTURES FROM THAT MONTH
  $subj_SQL = "SELECT COUNT(Subject_ID) AS CountLec FROM lectures WHERE Subject_ID = '$Subject_ID' AND Lec_Date LIKE '%$month%'";
  $Subjresults= mysqli_query($conn,$subj_SQL);
  while($resultDept = mysqli_fetch_array($Subjresults))
  {
    $Total_Count = $resultDept['CountLec'];
    $content .= '<tr>
    <td colspan="3" style="background-color:#F2F2F2"><b>  Total no.of lectures conducted: </b></td><td>'.$Total_Count.'</td></tr>';
  }

  $content .= '<tr style="background-color:#F2F2F2;">
  <thead>
  <th><b>Students below 75%</b></th>
  </thead>
</tr>
<tr><td>';
  //COUNTING THE STUDENTS
$subjSemester = "SELECT Semester FROM subject_table WHERE Subject_ID = $Subject_ID";
$result = mysqli_query($conn,$subjSemester);
while($resultArray = mysqli_fetch_array($result))
{
    $SubjSemester = $resultArray['Semester'];
    
    $countStudent = "SELECT * FROM student WHERE Semester = $SubjSemester";
    $resultStudent = mysqli_query($conn,$countStudent);
    while($resultArrayStudent = mysqli_fetch_array($resultStudent))
    {
        $StudRollNo = $resultArrayStudent['RollNo'];
        $query = "SELECT COUNT(*) AS attendanceCount FROM lectures WHERE attendance LIKE '%$StudRollNo%' AND Subject_ID = $Subject_ID AND Lec_Date LIKE '%$month%'";
        $resultLec = mysqli_query($conn,$query);
        while($resultArrayLec = mysqli_fetch_array($resultLec))
        {
            $AttendedLec = $Total_Count - $resultArrayLec['attendanceCount'];
           $percent = round(($AttendedLec/ $Total_Count) * 100);
           if($percent<75)
           { $content .= $StudRollNo.',';     }
           
         
        }
        
    }

}

 
$content .= '</td></tr></table>';  
$obj_pdf->writeHTML($content);  
ob_end_clean();
$obj_pdf->Output('sample.pdf', 'I');  

?>
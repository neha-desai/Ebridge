<?php
session_start();
include('dbconn.php');
$month = $_GET['month'];
$Subject_ID = $_GET['SubjectID'];

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
  $content .='<br><h3 align="center">DEFAULTER LIST FOR </h3>';

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
        $query = "SELECT COUNT(*) FROM lectures WHERE Lec_Date LIKE '%_____$month%' AND Subject_ID = $Subject_ID AND attendace LIKE '%$StudRollNo%'";
        $resultLec = mysqli_query($conn,$query);
        while($resultArrayLec = mysqli_fetch_array($resultLec))
        {
            $content .= $StudRollNo;
            //$content .= $resultArrayLec['Lec_ID'];
        }
        
    }

}

 

$obj_pdf->writeHTML($content);  
ob_end_clean();
$obj_pdf->Output('sample.pdf', 'I');  

?>
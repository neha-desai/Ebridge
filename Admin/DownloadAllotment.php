<?php
session_start();
include('dbconn.php');

$query = "SELECT S.Student_Name,S.SeatNo,R.Room_Number,E.Exam_Date FROM student S ,allotment A, room R, exam E WHERE S.Student_ID = A.Student_ID AND E.Exam_ID = A.Exam_ID ";
if (!$result = mysqli_query($conn, $query)) {
    exit(mysqli_error($conn));
}

$History = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $History[] = $row;      
        //$History[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Exam seating Details.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Student Name', 'Seat No','Room Number',"Exam Date"));

if (count($History) > 0) {
    foreach ($History as $row) {
        fputcsv($output, $row);
    }
}
?>
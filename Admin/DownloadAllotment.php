<?php
session_start();
include('dbconn.php');
$room_ID = $_GET['roomId'];
$Exam_ID = $_GET['Exam_ID'];

//$query = "SELECT S.SeatNo, R";
$query = "SELECT S.SeatNo,S.Student_Name, R.Room_Number, E.Exam_Date FROM student S,room R,exam E WHERE R.Room_ID = $room_ID AND E.Exam_ID = $Exam_ID";
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
fputcsv($output, array( 'Seat No','Student Name','Room Number','Exam_Date'));

if (count($History) > 0) {
    foreach ($History as $row) {
        fputcsv($output, $row);
    }
}
?>
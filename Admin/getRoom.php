<?php

include 'dbconn.php';

$sid = $_POST['Exam_ID'];
$getexamdetails = "SELECT * FROM exam WHERE Exam_ID = '$sid'";
$resultexam = mysqli_query($conn,$getexamdetails);
echo '<option>--Select Room--</option>';
while($resultArrayexam = mysqli_fetch_array($resultexam))
{
    $Exam_Date = $resultArrayexam['Exam_Date'];
    $Start_Time = $resultArrayexam['Start_Time'];
    $End_Time = $resultArrayexam['End_Time'];

    $getRoomSql = "SELECT * FROM room WHERE Room_ID NOT IN (SELECT Room_ID FROM roomstatus WHERE EDate='$Exam_Date')";
    //$getRoomSql = "SELECT * FROM room";
    $resultroom = mysqli_query($conn,$getRoomSql);
    while($resultArrayroom = mysqli_fetch_array($resultroom))
    {?>
        <option value="<?php echo $resultArrayroom['Room_ID']?>" > <?php echo $resultArrayroom['Room_Number'] ." [" .  $resultArrayroom['Strength'] . "]" ?></option>

        <?php
    }
}

?>
<?php

include 'dbconn.php';

$sid = $_GET['id'];
$sql = "DELETE FROM notice WHERE Notice_ID='$sid'";
$del = mysqli_query($conn,$sql);
if($del)
{
  //echo '<script> alert("Leave was approved! "); </script>';
  header("Location:DisplayNotice.php");
}
else
{
    echo '<script>alert("Something went wrong, Try again.'.mysqli_error($con).'")</script>';
}
?>
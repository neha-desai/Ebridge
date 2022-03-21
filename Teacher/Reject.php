<?php
session_start();
$con=mysqli_connect("localhost", "root", "","ebdrige");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

$sid = $_GET['id'];
$reason = $_GET['reason'];
$rejectedBy = $_SESSION['studentID'];
$sql = "UPDATE leavedetails SET SStatus = '2', Rejected_Reason = '$reason',RejectedBy='$rejectedBy' WHERE Leave_ID='$sid'";

$del = mysqli_query($con,$sql);
if($del)
{
  //echo '<script> alert("Leave was approved! "); </script>';
  header("Location:ApproveLeave.php");
}
else
{
    echo '<script>alert("Something went wrong, Try again.'.mysqli_error($con).'")</script>';
}
?>
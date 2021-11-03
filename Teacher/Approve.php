<?php

$con=mysqli_connect("localhost", "root", "","ebdrige");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

$sid = $_GET['id'];

//FETCH TEACHER ID
$constr = "SELECT Teacher_ID FROM leavedetails WHERE Leave_ID='$sid'";
$res = mysqli_query($con,$constr);
$teacher;
while($resarr = mysqli_fetch_array($res))
{
   $teacher = $resarr['Teacher_ID'];
   //UPDATE LEAVE DAYS
   $sqls = "UPDATE teacher SET NoofLeaves = (NoofLeaves-1)  WHERE Teacher_ID='$teacher'";
    $dels = mysqli_query($con,$sqls);
if($dels)
{
  echo '<script> alert("Leave was approved! "); </script>';

}
else
{
    echo '<script>alert("Something went wrong, Try again.'.mysqli_error($con).'")</script>';
}
}


//CHANGE STATUS
$sql = "UPDATE leavedetails SET SStatus = '1' WHERE Leave_ID='$sid'";
$del = mysqli_query($con,$sql);
if($del)
{
  echo '<script> alert("Leave was approved! "); </script>';
  header("Location:ApproveLeave.php");
}
else
{
    echo '<script>alert("Something went wrong, Try again.'.mysqli_error($con).'")</script>';
}



?>
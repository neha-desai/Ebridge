<?php
    session_start();
    if($_SESSION['studentID']==null)
    {
        header("Location:AdminLogin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include 'Plugins.php' ?>
    <title>Admin Dashboard</title>
  </head>
  <body>
    <!-- NAVBAR-->

    <?php include 'AdminHeader.php' ?>
    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">

      <b style="color: #F76F72;"> Teachers on Leave Today: </b><br>


      <div class="table-responsive">          
       <table class="table table-striped">
         <thead>
           <tr>
             <th></th>
             <th>Branch</th>           
           </tr>
         </thead>
         <tbody>

  <?php include 'dbconn.php';

if(!$conn){
    die("connection failed:" . mysqli_connect_error());
}

$sql = "SELECT Dept_ID,TeacherName from teacher where Teacher_ID IN (SELECT Teacher_ID FROM leavedetails WHERE CURRENT_DATE BETWEEN StartDate AND Till_Date)";

$result = mysqli_query($conn,$sql);

while($resultArray = mysqli_fetch_array($result))
{
 
    echo '<tr>';
   echo '<td>'.$resultArray['TeacherName'].'</td>';
   $dept = $resultArray['Dept_ID'];
   $deptsql = "SELECT Department_Name FROM department WHERE Department_ID='$dept'";
   $result = mysqli_query($conn,$deptsql);
   while($resultA = mysqli_fetch_array($result))
   {
       echo '<td>'.$resultA['Department_Name'].'</td>';
   }
   echo '</tr>';
 
}
?>
</tbody>
</table>
</div>
<hr size="2" />
      <!-----------------Leave APproval------------------------->
<?php include 'ApproveInclude.php' ?>
  
    </div>
    
    <!-----------MAIN DIVISION ENDS HERE----------->
   
    <script>
      function myFunction() {
        var x = document.getElementById("header");
        if (x.className === "header") {
          x.className += " responsive";
        } else {
          x.className = "header";
        }
      }
    </script>
  </body>
</html>



<div class="maindivs"> <!--THREE TABS TO APPROVE START HERE -->
   
   <div class="tab">
   <button class="tablinks" onclick="openCity(event, 'London')">Pending</button>
<button class="tablinks" style="background-color: #F76463;"onclick="openCity(event, 'Paris')">Rejected</button>
<button class="tablinks" style="background-color: #8BE78B;" onclick="openCity(event, 'Tokyo')">Approved</button>
</div>

<div id="London" class="tabcontent">
<div class="maindivs">
<h3>Pending Leaves:</h3>
 <div class="table-responsive">          
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Teacher Name</th>
             <th>Date for leave</th>            
             <th></th>
           </tr>
         </thead>
         <tbody>
 <?php

$servername="localhost";
$username="root";
$password="";
$dbname="ebdrige";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
   die("connection failed:" . mysqli_connect_error());
}
$red = $_SESSION['studentID'];
$dept = $_SESSION['deptID'];

$sqls = "SELECT t.*, l.* FROM teacher t, leavedetails l WHERE t.Teacher_ID = l.Teacher_ID AND l.SStatus='0' AND t.Dept_ID='$dept' AND l.Teacher_ID <> $red";

$result = mysqli_query($conn,$sqls);

while($resultArray = mysqli_fetch_array($result))

{
 
 echo '<tr>';
 echo '<td>'.$resultArray['TeacherName'].'</td>';
 echo '<td>'.$resultArray['StartDate'].'</td>';
 echo '<td><button class="btn btn-primary"><a style="text-decoration: none;color: white;" href="viewLeave.php?id='.$resultArray['Leave_ID'].'">View</a></button></td>';
 echo '</tr>';
 
}

?>

</table>
</div> <!--table-responsive div ends here-->
</div> <!--Table that displays leave END DIV-->
</div>

<div id="Paris" class="tabcontent">

<div class="maindivs">
<h3>Rejected:</h3>
 <div class="table-responsive">          
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Teacher Name</th>
             <th>Date for leave</th>           
             <th></th>
           </tr>
         </thead>
         <tbody>
 
 <?php 
 
 $sqlr = "SELECT t.*, l.* FROM teacher t, leavedetails l WHERE t.Teacher_ID = l.Teacher_ID AND l.SStatus='2' AND t.Dept_ID='$dept' AND l.Teacher_ID <> $red";
 $result = mysqli_query($conn,$sqlr);

 while($resultArray = mysqli_fetch_array($result))
 
 {
   echo '<tr>';
   echo '<td>'.$resultArray['TeacherName'].'</td>';
   echo '<td>'.$resultArray['StartDate'].'</td>';
   echo '<td><button class="btn btn-primary"><a style="text-decoration: none;color: white;" href="viewLeave.php?id='.$resultArray['Leave_ID'].'">View</a></button></td>';
   echo '</tr>';
   
 }
 
 ?>
 </table>
</div> <!--table-responsive div ends here-->
</div> <!--Table that displays leave END DIV-->
</div>

<div id="Tokyo" class="tabcontent">

 <div class="maindivs">
 <h3>Approved:</h3>
 <div class="table-responsive">          
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Teacher Name</th>
             <th>Date for leave</th>           
             <th></th>
           </tr>
         </thead>
         <tbody>

 <?php 
 
 $sqlr = "SELECT t.*, l.* FROM teacher t, leavedetails l WHERE t.Teacher_ID = l.Teacher_ID AND l.SStatus='1'AND t.Dept_ID='$dept' AND l.Teacher_ID <> $red";
 $result = mysqli_query($conn,$sqlr);

 while($resultArray = mysqli_fetch_array($result))
 
 {
   echo '<tr>';
   echo '<td>'.$resultArray['TeacherName'].'</td>';
   echo '<td>'.$resultArray['StartDate'].'</td>';
   echo '<td><button class="btn btn-primary"><a style="text-decoration: none;color: white;" href="viewLeave.php?id='.$resultArray['Leave_ID'].'">View</a></button></td>';
   echo '</tr>';
   
 }
 
 ?>
 </table>
</div> <!--table-responsive div ends here-->
</div> <!--Table that displays leave END DIV-->
</div>

<script>
function openCity(evt, cityName) {
 var i, tabcontent, tablinks;
 tabcontent = document.getElementsByClassName("tabcontent");
 for (i = 0; i < tabcontent.length; i++) {
   tabcontent[i].style.display = "none";
 }
 tablinks = document.getElementsByClassName("tablinks");
 for (i = 0; i < tablinks.length; i++) {
   tablinks[i].className = tablinks[i].className.replace(" active", "");
 }
 document.getElementById(cityName).style.display = "block";
 evt.currentTarget.className += " active";
}
</script>
   </div><!--THREE TABS TO APPROVE ENDS HERE -->
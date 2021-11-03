

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
             <th>Date for leave</th>
             <th>No.of days</th>
             <th>Description</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
 <?php

include 'dbconn.php';

$red = $_SESSION['studentID'];
$sqls = "SELECT SDescription,StartDate,DATEDIFF(Till_Date,StartDate) AS days FROM leavedetails WHERE Teacher_ID = $red AND SStatus = '0'";

$result = mysqli_query($conn,$sqls);

while($resultArray = mysqli_fetch_array($result))

{
 echo '<tr>';
 echo '<td>'.$resultArray['StartDate'].'</td>';
 echo '<td>'.$resultArray['days'].'</td>';
 echo '<td>'.$resultArray['SDescription'].'</td>';
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
           <th>Date for leave</th>
             <th>No.of days</th>
             <th>Description</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
 
 <?php 
 
 


$red = $_SESSION['studentID'];
$sqls = "SELECT SDescription,StartDate,DATEDIFF(Till_Date,StartDate) AS days FROM leavedetails WHERE Teacher_ID = $red AND SStatus = '2'";

$result = mysqli_query($conn,$sqls);

while($resultArray = mysqli_fetch_array($result))

{
 echo '<tr>';
 echo '<td>'.$resultArray['StartDate'].'</td>';
 echo '<td>'.$resultArray['days'].'</td>';
 echo '<td>'.$resultArray['SDescription'].'</td>';
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
           <th>Date for leave</th>
             <th>No.of days</th>
             <th>Description</th>
             <th></th>
           </tr>
         </thead>
         <tbody>

 <?php 
 
$red = $_SESSION['studentID'];
$sqls = "SELECT SDescription,StartDate,DATEDIFF(Till_Date,StartDate) AS days FROM leavedetails WHERE Teacher_ID = $red AND SStatus = '1'";

$result = mysqli_query($conn,$sqls);

while($resultArray = mysqli_fetch_array($result))

{
 echo '<tr>';
 echo '<td>'.$resultArray['StartDate'].'</td>';
 echo '<td>'.$resultArray['days'].'</td>';
 echo '<td>'.$resultArray['SDescription'].'</td>';
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
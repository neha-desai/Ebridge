<?php
    session_start();
    if($_SESSION['studentID']==null)
    {
        header("Location:TeacherLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'Plugins.php' ?>
  </head>
  <body style="background-color: #f6f8fa">
    <!--Side Navbar-->

    <?php include 'SideNavbar.php' ;?>

    <!--RIGHT SIDE MAIN DIV-->
    <div id="main" class="openmain">
    
     <!--TOP NAV -->
     <?php include 'TopNav.php';?>

      <!--MAIN DIVS-->

      <div class="row">
        <div class="col-md-12">          
          <div class="maindivs">
            <div class="row">        
              <div class="col-md-2"> 
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
              <label for="cal">Start Date of leave:</label><br>
                <input type="date" name="cal" id="cal" style="padding: 5px 5px 5px 5px;border-radius: 3px;border: 1px solid lightgrey;width: 100%; " placeholder="Date for leave">
              </div>

              <div class="col-md-2"> 
              <label for="cal">End Date of leave:</label><br>
                <input type="date" name="Lastcal" id="Lastcal" style="padding: 5px 5px 5px 5px;border-radius: 3px;border: 1px solid lightgrey;width: 100%;" placeholder="Date for leave">             
              </div>

              <div class="col-md-2">
              <label for="Description">Leave Type:</label><br>
                <select name="LType" id="LType" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;">
                    <option>--Select Leave Type--</option>
                    <option value="0">Sick Leave</option>
                    <option value="1">Maternity Leave</option>
                    <option value="2">Paternity Leave</option>
                    <option value="3">Other</option>
                </select>
                
              </div>

              <div class="col-md-4">
              <label for="Description">Note:</label><br>
                <input class="form-control" type="text" name="Description" id="Description" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;" placeholder="Note"> 
              </div>

              <div class="col-md-2">
              <label for="applybtn"></label><br>
                <input type="submit"class="btn" id="applybtn" value="Apply">
              </div>
            </form> 
        </div>      
          </div>

          <?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
  {

  $servername="localhost";
    $username="root";
    $password="";
    $dbname="ebdrige";

    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
        die("connection failed".mysqli_connect_error());

    }
   
    $Descrip = $_POST['Description'];
    $StartDate = $_POST['cal'];
    $EndDate = $_POST['Lastcal'];
    $redID = $_SESSION['studentID'];
    $ltype = $_POST['LType'];

    $sql="INSERT INTO leavedetails(Teacher_ID, SDescription, StartDate, Till_Date, SStatus, LeaveType)
          VALUES ('$redID','$Descrip','$StartDate','$EndDate','0','$ltype')";
     
    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Leave applied successful!');</script>";
    }
    else
    {
        echo "Error :".mysqli_error($conn);
    }


   mysqli_close($conn);
}
   ?>

  <!--Table that displays leave-->
  <?php
include 'DisplayLeave.php';
  ?>

        </div>
     </div>
    </div>

    <script>
      function closeNav() {
        var sidebar = document.getElementById("sideNavbar");
        var mainDiv = document.getElementById("main");

        if (sidebar.className === "sideNavbar") {
          sidebar.classList.add("closebar");
          mainDiv.classList.add("closemain");
        } else {
          sidebar.classList.remove("closebar");
          mainDiv.classList.remove("closemain");
        }
      }

      $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>

  </body>
</html>

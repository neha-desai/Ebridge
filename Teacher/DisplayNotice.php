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
               <a href="AddNotice.php"> <button class="btn btn-primary">Add a new notice <span class="fas fa-plus"></span></button></a>
            </div>
        </div>
    </div>

<!--Notice displays-->
<?php
include 'dbconn.php';
$red = $_SESSION['studentID'];
$Did= $_SESSION['deptID'];

$sql = "SELECT * FROM notice WHERE Dept_ID = '$Did' ORDER BY Time_Uploaded desc";

$result = mysqli_query($conn,$sql);

while($resultArray = mysqli_fetch_array($result))

{
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<div class="maindivs">';
        echo '<b>'.$resultArray['NoticeTitle'].'</b>';
        echo '<p class="NoticeDescription"style="color: #4e5053; ">'.$resultArray['NoticeDescription'].'</p>';
        echo '<a href="ViewNotice.php"><button  class="btn btn-outline-info">View</button></a>';
        echo '<button style="margin-left: 10px;float:right;" class="btn btn-outline-secondary">Edit</button>';
        echo '<button style="margin-left: 10px;float:right;" class="btn btn-outline-danger">Delete</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

 
}
?>
      




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

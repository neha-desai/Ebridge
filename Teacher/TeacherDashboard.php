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
        <div class="col-md-6">
          <div class="maindivs">
            <h4>Subjects for this semester</h4>
          <?php 
          include 'dbconn.php';
          $tid = $_SESSION['studentID'];
          $sql = "SELECT * from subject_table where Teacher_ID =  '$tid'";

          $result = mysqli_query($conn,$sql);

          while($resultArray = mysqli_fetch_array($result))
          {
            if($resultArray['Subject_Type'] == 1){echo ' <li>'.$resultArray['Subject_Name'].' - Theory</li>';}
            else{echo ' <li>'.$resultArray['Subject_Name'].' - Practical</li>';}
          }
          ?>
          </div>
        </div>


        <div class="col-md-3">
          <div class="maindivs">
                
          </div>
        </div>



        <div class="col-md-3">
          <div class="maindivs">
          No. of Leaves you are left with: 
          <?php 
        
          $sql = "SELECT NoofLeaves from teacher where Teacher_ID =  '$tid'";

          $result = mysqli_query($conn,$sql);

          while($resultArray = mysqli_fetch_array($result))
          {
            echo ' <h1 style="text-align: center;font-size: 54px;font-weight: 700">'.$resultArray['NoofLeaves'].'</h1> ';
          }
          ?>
             
              
          </div>
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

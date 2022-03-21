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
                <?php 
                include 'dbconn.php';
               
                $nid = $_GET['id'];
                
                $sql = "SELECT * FROM notice WHERE Notice_ID = '$nid'";
                
                $result = mysqli_query($conn,$sql);
                
                while($resultArray = mysqli_fetch_array($result))
                {
                  echo '<h4>'.$resultArray['NoticeTitle'].'</h4> <br>';
                  echo '<span class="badge badge-info">'.$resultArray['Date_Uploaded'].'</span><br>';
                  echo $resultArray['NoticeDescription'];
                  echo '<br> <br><a href="../Teacher/uploads/'.$resultArray['NoticeImage'].'" target="_blank"> View File </a>';
                } ?>
            
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

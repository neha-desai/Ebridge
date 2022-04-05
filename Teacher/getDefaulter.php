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
              <!--ADD A LECTURE BTN-->
              <div class="table-responsive">
            <table class="table table-striped">
            <thead>
              <tr>
                <th>Subject Name</th>
                <th></th>   
                <th></th> 
                <th></th>   
                <th></th> 
                <th></th>   
                <th></th> 
                <th></th>   
                <th></th> 
                <th></th>   
                <th></th> 
                <th></th>   
                <th></th>        
              </tr>
              </thead>

              <?php
            include 'dbconn.php';
            $red = $_SESSION['studentID'];
            
            $sql = "SELECT DISTINCT(Subject_ID) FROM lectures WHERE Teacher_ID = '$red'";
            
            $result = mysqli_query($conn,$sql);
            
            while($resultArray = mysqli_fetch_array($result))
            
            {  
              echo '<tr>';      
              

              $Subj = $resultArray['Subject_ID'];
              $subj_Name = "SELECT * FROM subject_table WHERE Subject_ID = '$Subj'"; 
              $SubName= mysqli_query($conn,$subj_Name);
              while($resultSubName = mysqli_fetch_array($SubName))
              {
                echo '<td>'.$resultSubName['Subject_Name'].'</td>';
              }

             echo '<td><a href="downloadDeafaulter.php?month=01&SubjectID='.$resultArray['Subject_ID'].'">January</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=02&SubjectID='.$resultArray['Subject_ID'].'">February</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=03&SubjectID='.$resultArray['Subject_ID'].'">March</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=04&SubjectID='.$resultArray['Subject_ID'].'">April</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=05&SubjectID='.$resultArray['Subject_ID'].'">May</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=06&SubjectID='.$resultArray['Subject_ID'].'">June</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=07&SubjectID='.$resultArray['Subject_ID'].'">July</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=08&SubjectID='.$resultArray['Subject_ID'].'">August</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=09&SubjectID='.$resultArray['Subject_ID'].'">September</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=10&SubjectID='.$resultArray['Subject_ID'].'">October</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=11&SubjectID='.$resultArray['Subject_ID'].'">November</a></td>';
             echo '<td><a href="downloadDeafaulter.php?month=12&SubjectID='.$resultArray['Subject_ID'].'">December</a></td>';
                           
                echo '</tr>';
            }
            ?>



          </table>
        </div> <!--TABLE-RESPONSIVE END-->




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

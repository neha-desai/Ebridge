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
              <div class="col-md-3"> 
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
              <label for="NTitle"><b>Lecture Date</b></label><br>
                <input class="form-control" type="date" name="LecDate" id="LecDate" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;" placeholder="Keep the title short!">
              </div> 

              <div class="col-md-3">               
              <label for="NTitle"><b>Lecture Start Time</b></label><br>
                <input class="form-control" type="time" name="LecStartTime" id="LecStartTime" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;" placeholder="Keep the title short!">
              </div>
              
              <div class="col-md-3">               
              <label for="NTitle"><b>Lecture End Time</b></label><br>
                <input class="form-control" type="time" name="LecEndTime" id="LecEndTime" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;" placeholder="Keep the title short!">
              </div> 
            </div>     

            <br><br> 
            <div class="row">        
              <div class="col-md-4"> 
              <label for="selectSubject"><b>Subject:</b></label>
            <select id="selectSubject" name="selectSubject">
            <option>--Select Subject--</option>
              <?php
              $teacherID = $_SESSION['studentID'];
              include 'dbconn.php';
              $sql = "SELECT * FROM subject_table WHERE Teacher_ID = $teacherID";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))
                {
                    echo '<option value='.$resultArray['Subject_ID'].'>';
                    if($resultArray['Subject_Type']==1) {echo $resultArray['Subject_Name'].' (Theory)';}   
                    else {echo $resultArray['Subject_Name'].' (Practical)';}               
                    echo '</option>';
                }
                ?>
            </select>
              </div>        
            </div>   
            <br><br> 
            <div class="row">
              <div class="col-md-7">
              <label for="NTitle"><b>List of Absent students</b></label><br>
                <input class="form-control" type="text" name="absentList" id="absentList" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;" placeholder="Write Roll no of student">
         
                <i class="fas fa-exclamation-triangle"></i> Write Roll Numbers of absent students seperated by Comma(,). <b>Do not give space after Comma.</b>
  
              </div>
              </div>
           <br>
            <input class ="btn btn-primary" type="submit" value="Submit" name="submit">
         </form>

<?php 

include 'dbconn.php';

if(isset($_POST["submit"]))
{


$LecData =$_POST['LecDate'];
$LecStartTime = $_POST['LecStartTime'];
$LecEndTime=$_POST['LecEndTime'];
$TeacherID = $_SESSION['studentID'];
$SubjectID = $_POST['selectSubject'];
$absentList = $_POST['absentList'];

$sql="INSERT INTO lectures(Lec_Date, Start_Time,End_Time,Subject_ID, Teacher_ID,attendance) VALUES ('$LecData','$LecStartTime','$LecEndTime','$SubjectID','$TeacherID','$absentList')";
           
          if(mysqli_query($conn,$sql))
          {
            echo "<script>alert('Lecture added Successfully'); window.open('Attendance.php', '_self');</script>";
          }
          else
          {
              echo "Error :".mysqli_error($conn);
          }
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

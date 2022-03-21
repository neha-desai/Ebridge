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
              <div class="col-md-6"> 
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
              <label for="NTitle"><b>Notice Title</b></label><br>
                <input class="form-control" type="text" name="NTitle" id="NTitle" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;" placeholder="Keep the title short!">
              </div>        
            </div>     

            <br><br> 
            <div class="row">        
              <div class="col-md-6"> 
              <label for="NDescription"><b>Notice Description</b></label><br>
                <input class="form-control" type="text" name="NDescription" id="NDescription" style="padding: 5px 5px 5px 5px; border-radius: 3px; border: 1px solid lightgrey;height: 200px;width:100%;" placeholder="Start typing your notice...">              
              </div>        
            </div>    
            <br><br>

            <div class="row">        
              <div class="col-md-4"> 
              <b>Select Image File to attach with your notice:</b> <input type="file" name="file">
              </div>        
            </div>    
            <br><br>
            <input type="submit" value="Submit" name="submit">
         </form>

<?php 

include 'dbconn.php';

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
{
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
echo $targetFilePath;

$NTitle =$_POST['NTitle'];
$NDescription = $_POST['NDescription'];
$TID=$_SESSION['studentID'];
$DID = $_SESSION['deptID'];
                $sql="INSERT INTO notice(NoticeTitle, NoticeDescription,Teacher_ID,Dept_ID, NoticeImage) VALUES ('$NTitle','$NDescription','$TID','$DID','$fileName')";
           
          if(mysqli_query($conn,$sql))
          {
              echo "<script>alert('Notice uploaded successful!');</script>";
              header('Location: DisplayNotice.php');
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

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
      <h4>Enter Exam Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
       
          <div class="col-md-6">
            <label for="selectSubject">Subject:</label><br>
            <select id="selectSubject" name="selectSubject">          
            <option>--Select Subject--</option>
              <?php
              include 'dbconn.php';
              $sql = "SELECT * FROM subject_table";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))
                {
                  $dept = $resultArray['Dept_ID'];
                  $sqls = "SELECT * FROM department where Department_ID = $dept";

                  $results = mysqli_query($conn,$sqls);
  
                  while($resultArrays = mysqli_fetch_array($results))
                  {
                    echo '<option value='.$resultArray['Subject_ID'].'>';
                    echo '<b>'.$resultArrays['Department_Name'].'</b>: '.$resultArray['Subject_Name'].'';
                    echo '</option>';
                  }

                    
                }
              ?>
            </select>
          </div>

              <div class="col-md-6">
              <label for="username">Date:</label>
              <div class="form-group">
              <input
                type="date"
                class="form-control"
                name="ExamDate"
                id="ExamDate"
               
              />
            </div>             
              </div>
        </div>
        <br />


        <div class="row">
        
        <div class="col-md-6">
        <label for="username">Start Time:</label>
              <div class="form-group">
              <input
                type="time"
                class="form-control"
                name="StartTime"
                id="StartTime"
               
              />
            </div>      
        </div>


        <div class="col-md-6">
        <label for="username">End Time:</label>
              <div class="form-group">
              <input
                type="time"
                class="form-control"
                name="EndTime"
                id="EndTime"
               
              />
            </div>      
        </div>
        </div>
      
<br>
        <div class="row">
        <br>
        <div class="col-md-3">
          <!--BUTTON TO ADD -->
          <button class="btn btn-default" id="addBranch">ADD</button>
          </div>
        </div>
</div>
       
      </form>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->
    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
  {

    include 'dbconn.php';
    $subject = $_POST['selectSubject'];
    $date = $_POST['ExamDate'];
    $startTime= $_POST['StartTime'];
    $endTime = $_POST['EndTime'];
  
    $sql="INSERT INTO exam(Exam_Date,Start_Time,End_Time,Subject_ID)
          VALUES ('$date','$startTime','$endTime','$subject')";
     
    if(mysqli_query($conn,$sql))
    {
        //echo "<script>alert('Registration successful');</script>";
        echo "<script>alert('Registration successful'); window.open('Exam.php', '_self');</script>";
    }
    
    else
    {
        echo "Error :".mysqli_error($conn);
    }

  }

?>
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

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
      <?php include 'Plugins.php';
   $sid = $_GET['id'];

   include 'dbconn.php';
   
   $sql = "SELECT * FROM exam where Exam_ID=?";
            
   $stmt = $conn->stmt_init();
   $stmt->prepare($sql);
   $stmt->bind_param("i", $sid);
   $stmt->execute();
   $result = $stmt->get_result();
   $resultArray = $result->fetch_assoc();
   if($resultArray)
   {
    $ExamDate = $resultArray['Exam_Date'];
    $StartTime = $resultArray['Start_Time'];
    $EndTime = $resultArray['End_Time'];
    $SubjectID= $resultArray['Subject_ID'];

   }
   else
   {
       echo "<script>swal('No data found');</script>";
   }

    ?>
      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
       
          <div class="col-md-6">
            <label for="selectSubject">Subject:</label><br>
            <select id="selectSubject" name="selectSubject">          
            <option>--Select Subject--</option>

            <?php  
           include 'dbconn.php';
               $c1 = "SELECT * FROM subject_table";
                $result = $conn->query($c1);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $dept = $row['Dept_ID'];
                        $sqls = "SELECT * FROM department where Department_ID = $dept";
                        $results = $conn->query($sqls);
                        while ($rows = mysqli_fetch_array($results)){
                        ?>
                        <option value="<?php echo $row["Subject_ID"];?>"<?php if($SubjectID==$row["Subject_ID"]){ echo "Selected";}?>>
                        <?php echo $rows['Department_Name'].': '.$row['Subject_Name']; ?>
                        </option>
                        <?php
                      }
                }} else {echo "0 results";}
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
               value="<?php echo $ExamDate; ?>"
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
                value="<?php echo $StartTime; ?>"
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
               value = "<?php echo $EndTime;?>"
              />
            </div>      
        </div>
        </div>
      
<br>
        <div class="row">
        <br>
        <div class="col-md-3">
          <!--BUTTON TO ADD -->
          <button class="btn btn-default" id="addBranch">UPDATE</button>
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
  
    $sql="UPDATE exam SET Subject_ID = '$subject', Start_Time='$startTime', End_Time='$endTime', Exam_Date='$date' WHERE Exam_ID = '$sid'";
    
    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Update successful'); window.open('Exam.php', '_self');</script>";
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

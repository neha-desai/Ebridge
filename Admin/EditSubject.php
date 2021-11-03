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

    <?php

        include 'dbconn.php';
        $sid = $_GET['id'];
            $name="";
            $branch="";
            $semester="";
            $subjectType="";
            $teacher="";
            
            $sql = "SELECT * FROM subject_table where Subject_ID=?";
            
            $stmt = $conn->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("i", $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultArray = $result->fetch_assoc();
            if($resultArray)
            {
                $name= $resultArray['Subject_Name'];;
                $branch= $resultArray['Dept_ID'];
                $semester= $resultArray['Semester'];
                $subjectType=$resultArray['Subject_Type'];
                $teacher=$resultArray['Teacher_ID'];

               
            }
            else
            {
                echo "<script>swal('No data found');</script>";
            }
            
            mysqli_close($conn);

    ?>


    <?php include 'AdminHeader.php' ?>
    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">
      <h4>Enter Subject Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
          
          <div class="col-md-6">
            <label for="facultyName">Subject Name:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="SubjectName"
                id="SubjectName"
                placeholder="Enter Subject Name"
                value="<?php echo $name; ?>"
              />
            </div>
          </div>
         
          <div class="col-md-6">
            <label for="selectBranch">Branch:</label>
            <select id="selectBranch" name="selectBranch">
            <option value="">--Select Branch--</option>
           <?php  
           include 'dbconn.php';
               $c1 = "SELECT * FROM department";
                $result = $conn->query($c1);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {?>
                        <option value="<?php echo $row["Department_ID"];?>"<?php if($branch==$row["Department_ID"]){ echo "Selected";}?>>
                        <?php echo $row['Department_Name']; ?>
                        </option>
                        <?php
                      }
                } else {
                echo "0 results";
                }
                ?>
                 </select>
           
          </div>
        </div>


        <br />
        <div class="row">
          <div class="col-md-6">
            <label for="username">Semester:</label>
            <div class="form-group">
             <select id="selectBranch" name="semester">
             <option value="1" <?php if($semester == 1) {echo "Selected";} ?>>1</option>
             <option value="2" <?php if($semester == 2) {echo "Selected";} ?>>2</option>
             <option value="3" <?php if($semester == 3) {echo "Selected";} ?>>3</option>
             <option value="4" <?php if($semester == 4) {echo "Selected";} ?>>4</option>
             <option value="5" <?php if($semester == 5) {echo "Selected";} ?> >5</option>
             <option value="6" <?php if($semester == 6) {echo "Selected";} ?> >6</option>
             <option value="7" <?php if($semester == 7) {echo "Selected";} ?>>7</option>
             <option value="8" <?php if($semester == 8) {echo "Selected";} ?>>8</option>
             </select>
            </div>
            </div>

            <div class="col-md-6">
              <label for="Password">Subject Type:</label>
              <div class="form-group">
               <select id="selectBranch" name="subjectType">
               <option value="">Select subject type</option>
               <option value="1" <?php if($subjectType == 1) {echo "Selected";} ?>>Theory</option>
              <option value="2" <?php if($subjectType == 2) {echo "Selected";} ?>>Practical </option>
               </select>
              </div>
            </div>
          </div>
<br>

        <div class="row">
        <div class="col-md-6">
        <label for="username">Assign Teacher:</label>
            <div class="form-group">
            <select id="selectBranch" name="assignTeacher">
            <option>Select Teacher</option>

            <?php  
           include 'dbconn.php';
               $c2 = "SELECT * FROM teacher";
                $result2 = $conn->query($c2);
                if ($result2->num_rows > 0) {
                    while ($row2 = mysqli_fetch_array($result2)) {?>
                        <option value="<?php echo $row2["Teacher_ID"];?>"<?php if($teacher==$row2["Teacher_ID"]){ echo "Selected";}?>>
                        <?php echo $row2['TeacherName']; ?>
                        </option>
                        <?php
                      }
                } else {
                echo "0 results";
                }
                ?>

          </select>
        </div>
        <br>
          <!--BUTTON TO ADD -->
          <button class="btn btn-default" id="addBranch">UPDATE</button>
        </div>
</div>
       
      </form>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->
    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
  {

    include 'dbconn.php';
    $Sname = $_POST['SubjectName'];
    $Dept= $_POST['selectBranch'];
    $SubjectType = $_POST['subjectType'];
    $Semester = $_POST['semester'];
    $Teacher = $_POST['assignTeacher'];
    
 
  
    $sql="UPDATE subject_table SET Subject_Name = '$Sname',Semester='$Semester',Teacher_ID='$Teacher',Dept_ID='$Dept',Subject_Type='$SubjectType' WHERE Subject_ID = '$sid'";
     
    if(mysqli_query($conn,$sql))
    {
      echo "<script>alert('Update successful'); window.open('Subject.php', '_self');</script>";
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

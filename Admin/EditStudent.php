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
      <h4>Enter Student Details</h4>

      <hr size="2" />
      <?php include 'Plugins.php';
   $sid = $_GET['id'];

   include 'dbconn.php';
   
   $sql = "SELECT * FROM student where Student_ID=?";
            
   $stmt = $conn->stmt_init();
   $stmt->prepare($sql);
   $stmt->bind_param("i", $sid);
   $stmt->execute();
   $result = $stmt->get_result();
   $resultArray = $result->fetch_assoc();
   if($resultArray)
   {
    $Sname = $resultArray['Student_Name'];
    $Department = $resultArray['Department'];
    $Semester= $resultArray['Semester'];
    $Seatno = $resultArray['SeatNo'];
    $Rollno = $resultArray['RollNo'];
    $EmailID = $resultArray['EmailID'];
    $Spassword = $resultArray['SPassword'];
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
            <label for="facultyName">Student Name:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="StudentName"
                id="StudentName"
              value="<?php echo $Sname?>"
              />
            </div>
          </div>
          <div class="col-md-6">
            <label for="selectBranch">Branch:</label>
            <select id="selectBranch" name="selectBranch">   
            <option>--Select Branch--</option>       
            <?php  
           include 'dbconn.php';
               $c1 = "SELECT * FROM department";
                $result = $conn->query($c1);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {?>
                        <option value="<?php echo $row["Department_ID"];?>"<?php if($Department==$row["Department_ID"]){ echo "Selected";}?>>
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
                <label for="emailID">Email-ID:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="emailID"
                  id="emailID"  
                  value="<?php echo $EmailID ?>"            
                />
              </div>
                </div>

                <div class="col-md-6">
                <label for="password">Password:</label>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  name="password"
                  id="password"
                  value = "<?php echo $Spassword ?>"
                />
              </div>
                </div>
                </div>


                <br />

        <div class="row">
          <div class="col-md-4">
            <label for="username">Semester:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="semester"
                id="semester"
                value="<?php echo $Semester ?>"
              />
            </div>
            </div>

            <div class="col-md-4">
              <label for="Password">Roll No.:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="rollno"
                  id="rollno"
                  value="<?php echo $Rollno ?>"
                />
              </div>
            </div>

            <div class="col-md-4">
              <label for="seatNo">SeatNo.:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="seatNo"
                  id="seatNo"
                  value="<?php echo $Seatno ?>"
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
    $Sname = $_POST['StudentName'];
    $Semester = $_POST['semester'];
    $Sclass= $_POST['selectBranch'];
    $seatNo = $_POST['seatNo'];
    $rollno = $_POST['rollno'];
    $email = $_POST['emailID'];
    $SPassword = $_POST['password'];
  
    $sql="UPDATE student SET Student_Name ='$Sname',Department='$Sclass',Semester='$Semester',SeatNo='$seatNo',RollNo='$rollno',EmailID='$email',SPassword='$SPassword' WHERE Student_ID = $sid";
     
    if(mysqli_query($conn,$sql))
    {
        //echo "<script>alert('Registration successful');</script>";
        echo "<script>alert('Update successful'); window.open('Student.php', '_self');</script>";
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

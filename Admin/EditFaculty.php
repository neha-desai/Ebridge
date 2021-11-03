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
   <?php include 'Plugins.php';
   $sid = $_GET['id'];

   include 'dbconn.php';
   
   $sql = "SELECT * FROM teacher where Teacher_ID=?";
            
   $stmt = $conn->stmt_init();
   $stmt->prepare($sql);
   $stmt->bind_param("i", $sid);
   $stmt->execute();
   $result = $stmt->get_result();
   $resultArray = $result->fetch_assoc();
   if($resultArray)
   {
    $Sname = $resultArray['TeacherName'];
    $SUsername = $resultArray['Username'];
    $Spassword = $resultArray['SPassword'];
    $Sclass= $resultArray['Dept_ID'];
    $Level = $resultArray['TeacherLevel'];
    $branch = $resultArray['Dept_ID'];
    $teacherLevel = $resultArray['TeacherLevel'];
   }
   else
   {
       echo "<script>swal('No data found');</script>";
   }

    ?>

    <title>Admin Dashboard</title>
  </head>
  <body>
    <!-- NAVBAR-->

    <?php include 'AdminHeader.php' ?>
    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">
      <h4>Enter Faculty Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
          <div class="col-md-6">
            <label for="facultyName">Faculty Name:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="facultyName"
                id="facultyName"
                placeholder="Enter Faculty Name"
                value="<?php echo $Sname ?>"
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
            <label for="username">Username:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                placeholder="Enter Username"
                value="<?php echo $SUsername ?>"
              />
            </div>
            </div>

            <div class="col-md-6">
              <label for="Password">Password:</label>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  name="Password"
                  id="Password"
                  placeholder="Enter Password"
                  value="<?php echo $Spassword; ?>"
                />
              </div>
            </div>
          </div>
<br>
        <div class="row">
        <div class="col-md-6">
        <label for="username">Desgination:</label>
            <div class="form-group">
              <select id="selectBranch" name="TeacherLevel">
              <option value="0" <?php if($teacherLevel == 0) {echo "Selected";} ?>>Teacher</option>
              <option value="1" <?php if($teacherLevel == 1) {echo "Selected";} ?>>Head of Department </option>
              <option value="2" <?php if($teacherLevel == 2) {echo "Selected";} ?>>Admin </option>
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

    
    $Sname = $_POST['facultyName'];
    $SUsername = $_POST['username'];
    $Spassword = $_POST['Password'];
    $Sclass= $_POST['selectBranch'];
    $Level = $_POST['TeacherLevel'];
  
    $sql="UPDATE teacher SET TeacherName='$Sname',Username='$SUsername',SPassword='$Spassword',Dept_ID='$Sclass',TeacherLevel='$Level' WHERE  Teacher_ID=$sid";
     
    if(mysqli_query($conn,$sql))
    {
       // echo "<script>alert('Updation successful');</script>";
       // header("Location: Faculty.php");
       echo "<script>alert('Updation successful!').then(() => { window.location.href='Faculty.php'; });</script>";
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

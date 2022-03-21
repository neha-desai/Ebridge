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
      <h4>Enter Faculty Details</h4>

      <hr size="2" />

      <!-----------------FORMS STARTS HERE------------------------->

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="row">
          <div class="col-md-6">
            <label for="facultyName">Room No:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="RoomNo"
                id="RoomNo"
                placeholder="Enter Room no."
              />
            </div>
          </div>


          <div class="col-md-6">
              <label for="Password">Strength:</label>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="Strength"
                  id="Strength"
                  placeholder="Enter Strength"
                />
              </div>
            </div>

        </div>
        <br />

        <div class="row">
          <div class="col-md-6">
            <label for="username">Floor:</label>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="floor"
                id="floor"
                placeholder="Enter floor"
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
    $RoomNo = $_POST['RoomNo'];
    $Strenth= $_POST['Strength'];
    $Floor = $_POST['floor'];
  
    $sql="INSERT INTO room(Room_Number,Strength,Floor_No)
          VALUES ('$RoomNo','$Strenth','$Floor')";
     
    if(mysqli_query($conn,$sql))
    {
        //echo "<script>alert('Registration successful');</script>";
        header("Location: Room.php");
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

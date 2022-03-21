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
      <?php
   $sid = $_GET['id'];

   include 'dbconn.php';
   
   $sql = "SELECT * FROM room where Room_ID=?";
            
   $stmt = $conn->stmt_init();
   $stmt->prepare($sql);
   $stmt->bind_param("i", $sid);
   $stmt->execute();
   $result = $stmt->get_result();
   $resultArray = $result->fetch_assoc();
   if($resultArray)
   {
    $roomno = $resultArray['Room_Number'];
    $strength = $resultArray['Strength'];
    $floorno = $resultArray['Floor_No'];

   }
   else
   {
       echo "<script>swal('No data found');</script>";
   }

    ?>
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
               value="<?php echo $roomno; ?>"
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
                  value="<?php echo $strength; ?>"
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
                value="<?php echo $floorno; ?>"
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
    $RoomNo = $_POST['RoomNo'];
    $Strenth= $_POST['Strength'];
    $Floor = $_POST['floor'];
  
    $sql="UPDATE room SET Room_Number='$RoomNo',Strength='$Strenth',Floor_No='$Floor' WHERE Room_ID = '$sid'";
     
    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Update successful'); window.open('Room.php', '_self');</script>";
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

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
  </head>
  <body>
   <!-- NAVBAR-->

    <!------------ TOP NAVIGATION STARTS HERE------>
    <?php include 'AdminHeader.php' ?>


    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">
    <h4>Room</h4>
      <br />
      <!--BUTTON TO ADD -->
      <a href="AddRoom.php">
        <button class="btn btn-default" id="addBranch">
          Add Room <span class="fa fa-plus"></span></button
      ></a>
    </div>

    <div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Room No.</th>
              <th>Strength</th>
              <th>Floor</th>
              <td></td>
              <td></td>
            </tr>
          </thead>
          <?php
          
          include 'dbconn.php';

          $sql = "SELECT * FROM room";

        $result = mysqli_query($conn,$sql);

        while($resultArray = mysqli_fetch_array($result))

        {
         
            echo '<tr>';
            echo '<td>'.$resultArray['Room_Number'].'</td>';
            echo '<td>'.$resultArray['Strength'].'</td>';
            echo '<td>'.$resultArray['Floor_No'].'</td>';
            echo '<td> <a href="EditRoom.php?id='.$resultArray['Room_ID'].'"><span id="editbtn" class="fa fa-pencil-alt" title="Edit"></span></a></td>';
            echo '<td> <a href="DeleteRoom.php?id='.$resultArray['Room_ID'].'"><span id="deletebtn" class="fas fa-trash" title="Delete"></span></a></td>';
            echo '</tr>';
            
  
        }
          ?>
          
        </table>
      </div>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->

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

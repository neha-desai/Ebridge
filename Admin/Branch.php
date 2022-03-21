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
      <h4>Branch</h4>
      <br />
    
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <!--BUTTON TO ADD -->
      <div class="row">
        <div class="col-md-9">
          <input
            type="text"
            name="branchName"
            id="branchName"
            class="form-control"
            placeholder="Enter Branch Name"
          />
        </div>
        <input type="submit" class="btn btn-default" id="addBranch" value="Add Branch" name="addBranch">
          
      </div>
    </form>


      <hr size="2" />

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
  {

   include 'dbconn.php';
  
    $branchName = $_POST['branchName'];
    
    $sql="INSERT INTO department(Department_Name) VALUES ('$branchName')";
     
    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Branch added successful');</script>";
    }
    else
    {
        echo "Error :".mysqli_error($conn);
    }


   mysqli_close($conn);
}

?>
      <!--------------------TABLE STARTS HERE-------------------------->

      <br />

      <!-----------------SAMPLE TABLE FOR FRONT END PURPOSE. DYNAMIC DATA-------------->
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Branch Name</th>
              <td></td>
              <td></td>
            </tr>
          </thead>
          <?php
          
          include 'dbconn.php';

          $sql = "SELECT * FROM department";

        $result = mysqli_query($conn,$sql);

        while($resultArray = mysqli_fetch_array($result))

        {
            echo '<tr>';
            echo '<td>'.$resultArray['Department_Name'].'</td>';
            echo '<td> <span onclick="turnonoverlay()" id="editbtn" class="fa fa-pencil-alt" title="Edit"></span></td>';
            echo '<td> <a href="DeleteBranch.php?id='.$resultArray['Department_ID'].'"><span id="deletebtn" class="fas fa-trash" title="Delete"></span></a></td>';
            echo '</tr>';
  
        }
          ?>
          
        </table>
      </div>

      <!--OVERLAY-->
      <?php include 'EditBranch.php' ?>
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

      function turnoffoverlay() {
        document.getElementById("overlay").style.display = "none";
      }

      function turnonoverlay() {
        document.getElementById("overlay").style.display = "block";
      }
    </script>
  </body>
</html>

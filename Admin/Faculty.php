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
      <h4>Faculty</h4>
      <br />
      <!--BUTTON TO ADD -->
      <a href="AddFaculty.php">
        <button class="btn btn-default" id="addBranch">
          Add Faculty <span class="fa fa-plus"></span></button
      ></a>

      
      <hr size="2" />

    

      <!--------------------TABLE STARTS HERE-------------------------->

      <!----Table controls like search,dropdown to sort by branch------>
      <div class="tableControl">
        <div class="row">
          <div class="col-md-9">
            <select style="padding: 7px 20px">
              <option value="">Sort By Branch</option>
              <!--this list will come from backend from branch table. Given data is for demo-->
              <option value="">Mechanical Engineering</option>
              <option value="">Computer Engineering</option>
            </select>
          </div>
          <input type="text" placeholder="Search" id="searchBtn" required />
        </div>
      </div>
      <br />

      <!-----------------SAMPLE TABLE FOR FRONT END PURPOSE. DYNAMIC DATA-------------->
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Branch</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <?php

                include 'dbconn.php';
                $sql = "SELECT d.*,t.* FROM teacher t,department d WHERE d.Department_ID = t.Dept_ID";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))

                {
                        echo '<tr>';
                        echo '<td>'.$resultArray['TeacherName'].'</td>';
                        echo '<td>'.$resultArray['Department_Name'].'</td>';
                        echo '<td><a href="ViewFaculty.php?id='.$resultArray['Teacher_ID'].'">View</a></td>';
                        echo '<td> <a href="EditFaculty.php?id='.$resultArray['Teacher_ID'].'"><span id="editbtn" class="fa fa-pencil-alt" title="Edit"></span></a></td>';
                        echo '<td> <a href="DeleteFaculty.php?id='.$resultArray['Teacher_ID'].'"><span id="deletebtn" class="fas fa-trash" title="Delete"></span></a></td>';
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

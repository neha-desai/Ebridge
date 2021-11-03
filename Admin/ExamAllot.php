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
        <div class="col-md-5">
        <select id="selectBranch" name="selectBranch">
        <option>--Select exam--</option>
              <?php
              include 'dbconn.php';
              $GLOBALS['semester'];
              $sql = "SELECT * FROM exam";

                $result = mysqli_query($conn,$sql);

                while($resultArray = mysqli_fetch_array($result))
                {
                    $subj = $resultArray['Subject_ID'];

                    $sqls = "SELECT * FROM subject_table WHERE Subject_ID = $subj";

                    $resultd = mysqli_query($conn,$sqls);
                    while($resultArrayd = mysqli_fetch_array($resultd))
                    {
                        $dept = $resultArrayd['Dept_ID'];                      
                        $sqlt = "SELECT * FROM department where Department_ID = $dept";
      
                        $resultt = mysqli_query($conn,$sqlt);
        
                        while($resultArrayt = mysqli_fetch_array($resultt))
                        {
                          echo '<option value='.$resultArray['Exam_ID'].'>';
                          echo '<b>'.$resultArrayt['Department_Name'].'</b>: '.$resultArrayd['Subject_Name'].'';
                          echo '</option>';
                        }

                    }
                   
                    
                }
              ?>
            </select>
        </div>

        <div class="col-md-3">
        <select id="selectRoom" name="selectRoom">
        <option>--Select Room--</option>
              <?php
              include 'dbconn.php';
              $sql = "SELECT * FROM room";

                $resultr = mysqli_query($conn,$sql);

                while($resultArrayr = mysqli_fetch_array($resultr))
                {
                  echo '<option value='.$resultArrayr['Room_ID'].'>';
                  echo '<b>'.$resultArrayr['Room_Number'].'</b> ['.$resultArrayr['Strength'].']';
                  echo '</option>';
                 }
              ?>
            </select>  
        </div>
      
        <div class="col-md-2">
        <div class="form-group">
              <input
                type="number"
                class="form-control"
                name="startRoll"
                id="startRoll"
                placeholder="Starting Roll no."
              />
            </div>
        </div>

        <div class="col-md-2">
        <div class="form-group">
              <input
                type="number"
                class="form-control"
                name="endRoll"
                id="endRoll"
                placeholder="Ending Roll no."
              />
            </div>
        </div> 


      </div>
      <div class="row">
        <div class="col-md-3">
          <input type="submit" class="btn btn-default" id="addBranch" value="Allot seat" name="addBranch">
        </div>
        </div>
    </form>


      <hr size="2" />

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
  {

   include 'dbconn.php';
  
    $exam = $_POST['selectBranch'];
    $room = $_POST['selectRoom'];
    $startroll = $_POST['startRoll'];
    $endroll = $_POST['endRoll'];
    //$GLOBALS['semester'];
    
    $capacitys = ($endroll - $startroll) + 1;
   
       //SELECT ROOM STRENGTH
       $capasql = "SELECT Strength from room where Room_ID=$room" ;
       $resultcapa = mysqli_query($conn,$capasql);
       while($resultArraycapa = mysqli_fetch_array($resultcapa))
       {
          
        $GLOBALS['capacity']= $resultArraycapa['Strength'];          
       }
   
   $strength = $GLOBALS['capacity'];
 
    if($capacitys > $strength)
    {
      echo '<script>alert("Room cannot hold the number of students you entered! ")</script>';
    }

else{
    //SELECT THE SEMESTER
     $roomsql = "SELECT Subject_ID from exam where Exam_ID=$exam" ;
     $resultroom = mysqli_query($conn,$roomsql);
     while($resultArrayrrom = mysqli_fetch_array($resultroom))
     {
        
         $subjid =  $resultArrayrrom['Subject_ID'];
         $semsql = "SELECT Semester from subject_table where Subject_ID = $subjid";
         $resultsem = mysqli_query($conn,$semsql);
         while($resultArraysem = mysqli_fetch_array($resultsem))
         {
          $GLOBALS['semester'] = $resultArraysem['Semester'];
         }
        
     }

      $semstud = $GLOBALS['semester'];
    

    //SELECT THE students
     $studsql = "SELECT * FROM student WHERE semester = $semstud AND RollNo BETWEEN $startroll AND $endroll";
     $resultstud = mysqli_query($conn,$studsql);
     while($resultArraystud = mysqli_fetch_array($resultstud))
     {
         $std = $resultArraystud['Student_ID'];
        $allotsql = "INSERT INTO allotment(Student_ID,Exam_ID,ROom_ID) VALUES ('$std','$exam','$room')";
        mysqli_query($conn,$allotsql);
    }

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

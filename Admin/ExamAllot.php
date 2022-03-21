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
      <h4>Allotment</h4>
      <br />
    
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <!--BUTTON TO ADD -->
      <div class="row">
        <div class="col-md-5">
        <select id="selectBranch" name="selectBranch" onchange="getRoom(this.value);">
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
     $roomsql = "SELECT * from exam where Exam_ID=$exam" ;
     $resultroom = mysqli_query($conn,$roomsql);
     while($resultArrayrrom = mysqli_fetch_array($resultroom))
     {
        $GLOBALS['ExamDate'] = $resultArrayrrom['Exam_Date'];
        $GLOBALS['StartTime'] = $resultArrayrrom['Start_Time'];
        $GLOBALS['EndTime'] = $resultArrayrrom['End_Time'];

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

    //ROOMSTATUS
    $ExamDate =  $GLOBALS['ExamDate'];
    $STartTime = $GLOBALS['StartTime'];
    $EndTime = $GLOBALS['EndTime'];
    $statussql = "INSERT INTO roomstatus(Room_ID, EDate,Start_Time,End_Time) VALUES ('$room','$ExamDate','$STartTime','$EndTime')";
    mysqli_query($conn,$statussql);
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
              <th>Alloted Exam</th>
              <th>Semester</th>
              <th>Date</th>
              <th>Room Number</th>
              <th></th>
            </tr>
          </thead>
          <?php
          
          include 'dbconn.php';

          $sql = "SELECT COUNT(Student_ID) as totalStudent,Exam_ID,Room_ID FROM allotment GROUP BY Exam_ID";

        $result = mysqli_query($conn,$sql);

        while($resultArray = mysqli_fetch_array($result))

        {
            echo '<tr>';
            $ExamID = $resultArray['Exam_ID'];
            $examsql = "SELECT * FROM exam WHERE Exam_ID = '$ExamID'";
            $resultexam = mysqli_query($conn,$examsql);
            while($resultArrayExam = mysqli_fetch_array($resultexam))
            {
             
              $SubjID = $resultArrayExam['Subject_ID'];
              $subjsql = "SELECT * FROM subject_table WHERE Subject_ID=$SubjID";
              $resultsubj = mysqli_query($conn,$subjsql);
              while($resultArraySubj = mysqli_fetch_array($resultsubj))
              {
                echo '<td>'.$resultArraySubj['Subject_Name'].'</td>';
                echo '<td>'.$resultArraySubj['Semester'].'</td>';
              }
               echo '<td>'.$resultArrayExam['Exam_Date'].'</td>';
               //echo '<td>'.$resultArray['totalStudent'].'</td>';

               $roomID = $resultArray['Room_ID'];
               $roomSQL = "SELECT * FROM room WHERE Room_ID = $roomID";
               $resultRoom = mysqli_query($conn,$roomSQL);
               while($resultArray = mysqli_fetch_array($resultRoom))
               {
                echo '<td>'.$resultArray['Room_Number'].'</td>';
               }
               
            }
            
            echo '</tr>';
  
        }
          ?>
          
        </table>
        <a href="DownloadAllotment.php"><button id="addBranch" name="addBranch" class="btn btn-default">Print</button></a>

      </div>

      <!--OVERLAY-->
      <?php include 'EditBranch.php' ?>
    </div>
    <!-----------MAIN DIVISION ENDS HERE----------->

    <script>

function getRoom(val)
{
  $.ajax({
    type: "POST",
    url: "getRoom.php",
    data: 'Exam_ID='+val,
    success: function(data){
      $("#selectRoom").html(data);
    }
  });
}

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

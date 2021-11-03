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
   

    <!------------ TOP NAVIGATION STARTS HERE------>
  <?php include 'AdminHeader.php' ?>
    

    <!-----------MAIN DIVISION STARTS HERE----------->
    <div class="container">
      <!--THIS IS THE CARD ROW WHICH IS STATIC. ALL BELOW CONTENT WILL BE STATIC-->
      <div class="row">
        <!--Card1 ACTIVITY CARD-->
        <div class="col-md-3">
          <div class="cards" id="activityCards">
            <h5>Time Table <span class="fa fa-calendar-check-o"></span></h5>
            <div class="moreinfo">
              <a href="activitydashboard.html"
                >More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>

        <!--Card2 FACULTY CARD-->
        <div class="col-md-3">
          <div class="cards" id="facultyCards">
            <h5>Faculty <span class="fas fa-chalkboard-teacher"></span></h5>
            <div class="moreinfo">
              <a href="Faculty.php"
                >More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>

        <!--Card3 STUDENT CARD-->
        <div class="col-md-3">
          <div class="cards" id="studentCards">
            <h5>Student <span class="fas fa-user-graduate"></span></h5>
            <div class="moreinfo">
              <a href="Student.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>

        <!--Card4 BRANCH CARD-->
        <div class="col-md-3">
          <div class="cards" id="branchCards">
            <h5>Branch <span class="fas fa-award"></span></h5>
            <div class="moreinfo">
              <a href="branch.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>

         <!--Card5 BRANCH CARD-->
         <div class="col-md-3">
          <div class="cards" id="branchCards">
            <h5>Subject <span class="fas fa-book"></span></h5>
            <div class="moreinfo">
              <a href="Subject.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>

        <!--Card6 DEGREE CARD-->
        <div class="col-md-3">
          <div class="cards" id="studentCards">
            <h5>Leave <span class="fas fa-graduation-cap"></span></h5>
            <div class="moreinfo">
              <a href="ApproveLeave.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>

        <!-- EXAM DIV-->
        <div class="col-md-3">
          <div class="cards" id="degreeCards">
            <h5>Exam <span class="fas fa-paste"></span></h5>
            <div class="moreinfo">
              <a href="Exam.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>


        <div class="col-md-3">
          <div class="cards" id="facultyCards">
            <h5>Room <span class="fas fa-chalkboard"></span></h5>
            <div class="moreinfo">
              <a href="Room.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>


        <div class="col-md-3">
          <div class="cards" id="facultyCards">
            <h5>Exam slot allotment <span class="fas fa-chalkboard"></span></h5>
            <div class="moreinfo">
              <a href="ExamAllot.php">
                More Info <span class="fa fa-info-circle"></span
              ></a>
            </div>
          </div>
        </div>



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

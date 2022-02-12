<?php
//start the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--CSS FILE LINK HERE-->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/css/bootstrap.min.css"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="/jquery.min.js"></script>
    <link rel="stylesheet" href="login.css">
    <title>Activity Portal</title>
  </head>


  <body>
 <marquee width="60%" direction="up" height="100px">
This is a sample scrolling text 
</marquee>
  <div class="loginMainDiv">
        <div class="centerMainDiv">
            <div class="loginTitle"><b>UCOE COLLEGE </b></div>
            
            <form action="<?php $_SERVER['PHP_SELF'];?>" METHOD ="POST">
            <div id="formMain" class="container">

              <input type="text" placeholder="Email ID" name="email" id="Email">
              <input type="password" placeholder="Enter Password" name="password" id="password"><br><br>

              <input type="submit" value="Login">
              </form>
        </div>
        </div>
    </div>
   
   

    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="ebdrige";
            //create connection
            $conn=mysqli_connect($servername,$username,$password,$dbname);
            //check connection
            if(!$conn){
                die("connection failed:" . mysqli_connect_error());
            }

            $Semail=$_POST['email'];
            $Spassword=$_POST['password'];
            
            $sql = "SELECT * FROM teacher where Username=? and SPassword=?";
            
            $stmt = $conn->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("ss", $Semail,$Spassword);
            $stmt->execute();
            $result = $stmt->get_result();
           $resultArray = $result->fetch_assoc();
            if($resultArray)
            {   //here session variable is created
                //student id is the key of the session
                //regid is the value for the session with key studentid
                
                $_SESSION['studentID'] = $resultArray['Teacher_ID'];
                $_SESSION['deptID'] = $resultArray['Dept_ID'];
                
                if($resultArray['TeacherLevel'] == 1)
                { header("Location:HODDashboard.php"); }
                else if($resultArray['TeacherLevel'] == 2)
                {header("Location: ../Admin/AdminDashboard.php");}
                else
                {header("Location:TeacherDashboard.php");}

                
            }
            else
            {
                echo "<script>alert('Invalid Login credentials.')</script>";
            }
            
            mysqli_close($conn);

        }
    ?>

    </div>

    
    
    </div>
</body>
</html>
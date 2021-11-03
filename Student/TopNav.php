<?php include 'dbconn.php';

          $tid= $_SESSION['studentID'];
          $sql = "SELECT * FROM student where Student_ID=?";
            
          $stmt = $conn->stmt_init();
          $stmt->prepare($sql);
          $stmt->bind_param("i", $tid);
          $stmt->execute();
          $result = $stmt->get_result();
          $resultArray = $result->fetch_assoc();
          if($resultArray)
          {
           $Sname = $resultArray['Student_Name'];            
          }
          else
          {
              echo "<script>swal('No data found');</script>";
          }?>

<div class="topNav">
        <span style="font-size: 24px; cursor: pointer" onclick="closeNav()"
          >&#9776;
        </span>

        <div class="profile">
          <span class="far fa-user-circle"></span>
          <?php echo $Sname; ?>
          <a href="logout.php" data-toggle="tooltip" title="Logout">
            <span class="fas fa-power-off" alt="logout"></span
          ></a>
        </div>
      </div>
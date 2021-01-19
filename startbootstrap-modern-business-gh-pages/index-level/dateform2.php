<?php
  require_once "../config.php";

  if(!isset($_SESSION)) {
    session_start();
  }
  
  $fullyBookedDates = array();
  $bookedDates = "SELECT Date FROM appointment WHERE branch = ? ";
  if($stmt = mysqli_prepare($link, $bookedDates)){
    mysqli_stmt_bind_param($stmt, "s", $param_branchName);
    $param_branchName = $_SESSION["branchName"];
    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_bind_result($stmt, $date);
      while(mysqli_stmt_fetch($stmt)){
        $appointmentsOnThatDate = "SELECT * FROM appointment WHERE branch = ? AND Date = ?";
        if($apptStmt = mysqli_prepare($link, $appointmentsOnThatDate)){
          mysqli_stmt_bind_param($apptStmt, "ss", $param_branchName, $param_Date);
          $param_branchName = $_SESSION["branchName"];
          $param_Date = $date;
          if(mysqli_stmt_execute($apptStmt)){
            mysqli_stmt_store_result($apptStmt);
            if(mysqli_stmt_num_rows($apptStmt) == 6){
              $year = str_split($date, 4)[0];
              $month = str_split(str_split($date, 5)[1], 2)[0];
              $day = str_split(str_split($date, 8)[1], 2)[0];
              $aDate = array($day, $month, $year);
                
              if(!in_array($aDate, $fullyBookedDates)){
                array_push($fullyBookedDates, $aDate);
              }
            }
          }else{
            echo "<h1>".mysqli_stmt_error($apptStmt)."</h1>"; 
          }
          mysqli_stmt_close($apptStmt);
        }else{
          echo "<h1>".mysqli_error($link)."</h1>";
        }
      }
    }else{
      echo "<h1>".mysqli_stmt_error($stmt)."</h1>";
    }
    mysqli_stmt_close($stmt);
  }else{
    echo "<h1>".mysqli_stmt_error($stmt)."</h1>";
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $apptDate = trim($_POST["appointmentDate"]);
    if(!empty($firstName) && !empty($lastName) && !empty($apptDate)){
      $_SESSION["firstName"] = $firstName;
      $_SESSION["lastName"] = $lastName;
      $_SESSION["apptDate"] = $apptDate;
      header("location: dateform3.php");
    }
  }
  
  $title="Επικοινωνία - Κλείστε Ραντεβού";
  require_once "../top.php";
?>

  <div class="container my-4">
    <!-- NOTE: breadcrumb section starts here -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
        <li class="breadcrumb-item"><a href="contact.php">Επικοινωνία</a></li>
        <li class="breadcrumb-item"><a href="dateform.php">Κλείσιμο Ραντεβού - Εύρεση Παραρτήματος</a></li>
        <li class="breadcrumb-item active" aria-current="page">Κλείσιμο Ραντεβού - Επιλογή Ημερομηνίας</li>
      </ol>
    </nav>

    <form id="apptDateForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2>Στοιχεία Ατόμου</h2>
      <div class="form-group row">
        <label for="FirstName" class="col-sm-2 col-form-label">Όνομα<small>*</small>:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="firstName" id="FirstName" required>
          <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
        </div>
      </div>
      <div class="form-group row <?php echo (empty($lastName)) ? 'has-danger' : ''; ?>">
        <label for="LastName" class="col-sm-2 col-form-label">Επώνυμο<small>*</small>:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="lastName" id="LastName" required>
          <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
        </div>
      </div>
      
      <!--date-->
      <div class="form-group row">
        <label for="apptDate" class="col-sm-2 col-form-label">Επιλέξτε Ημερομηνία<small>*</small>:</label>
        <div class="col-10">              
          <input type="text" name="appointmentDate" id="apptDate" required>
          <div class="invalid-feedback">Η επιλογή ημερομηνίας είναι υποχρεωτική.</div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" id="nextBtn">Επιλογή ώρας</button>
    </form>
  </div>
          
  <script>
    <?php echo "var invalidDates = [";
    for($i = 0; $i < count($fullyBookedDates); $i++){
      echo "[".$fullyBookedDates[$i][0].", ".$fullyBookedDates[$i][1].", ".$fullyBookedDates[$i][2]."]";
      if($i != count($fullyBookedDates) - 1){
        echo ", ";
      }
    }
    echo "];";
    ?>
    
    $(document).ready(function(){
      $("#apptDate").datepicker({beforeShowDay:nonworkingdates});
      function nonworkingdates(datep){
          var day = datep.getDay();
          if(day == 0 || day == 1 || day == 6){
              return [false];
          }
          var date = datep.getDate();
          var month = datep.getMonth() + 1;

          for (var i = 0; i < invalidDates.length; i++) {
            if(datep.getFullYear() == invalidDates[i][2]){
              if(month.toString() == invalidDates[i][1].toString()){
                if(date.toString() == invalidDates[i][0].toString()){
                  return [false];
                }
              }
            }
          }
          return [true];
      }
    });

  </script>

  <!-- NOTE: Footer section starts here -->
  <footer class="py-0 bg-light">
    <div class="container">
      <p class="m-0 text-center">Copyright &copy; Ypakp 2020</p>
    </div>
  </footer>
</body>

</html>      
    
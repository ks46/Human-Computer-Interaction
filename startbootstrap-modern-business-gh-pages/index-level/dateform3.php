<?php
  require_once "../config.php";

  if(!isset($_SESSION)) {
    session_start();
  }
  
  $title="Επικοινωνία - Κλείστε Ραντεβού";
  require_once "../top.php";
?>

  <div class="container my-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
        <li class="breadcrumb-item"><a href="contact.php">Επικοινωνία</a></li>
        <li class="breadcrumb-item"><a href="dateform.php">Κλείσιμο Ραντεβού - Εύρεση Παραρτήματος</a></li>
        <li class="breadcrumb-item"><a href="dateform2.php">Κλείσιμο Ραντεβού - Επιλογή Ημερομηνίας</a></li>
        <li class="breadcrumb-item active" aria-current="page">Κλείσιμο Ραντεβού - Επιλογή Ώρας</li>
      </ol>
    </nav>
    
    
    <form id="apptTimeForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group row">
        <label for="DOY" class="col-sm-2 col-form-label">Επιλέξτε Ώρα:</label>
        <select class="select" name="apptTime" id="appointmentTime" required>
          <option value="default" selected>Επιλέξτε</option>
          <?php   
            $availableTimes = "SELECT Time FROM appointment WHERE Date = ? ORDER BY Time ASC";
            if($stmt = mysqli_prepare($link, $availableTimes)){
              mysqli_stmt_bind_param($stmt, "s", $param_Date);
              $param_Date = "2021-01-20";
              // $param_Date = $_SESSION["apptDate"];
              $timesArray = array("09.00", "09.30", "10.00", "10.30", "11.00", "11.30");
              $timeValuesArray = array(9, 9.5, 10, 10.5, 11, 11.5);
              if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $time);
                while(mysqli_stmt_fetch($stmt)){
                  $key = array_search($time, $timeValuesArray);
                  unset($timeValuesArray[$key]);
                  unset($timesArray[$key]);
                }
                $timeValuesArray = array_values($timeValuesArray); 
                $timesArray = array_values($timesArray);
                print_r($timeValuesArray);
                print_r($timesArray);
                for($i = 0; $i < count($timeValuesArray); $i++){
                  echo "<option value=\"".$timeValuesArray[$i]."\">".$timesArray[$i]."</option>";
                }
              }else{
                echo "<h1>".mysqli_error($link)."</h1>";
              }
              mysqli_stmt_close($stmt);
            }else{
              echo "<h1>".mysqli_error($link)."</h1>";
            }
          ?>
        </select>
        <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
      </div>
      <button type="submit" class="btn btn-primary" id="nextBtn">Οριστικοποίηση Ραντεβού</button>

    </form>
    
  </div>
<?php
  require_once "../bottom.php";
?>
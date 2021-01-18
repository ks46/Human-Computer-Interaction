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
  $title="COVID-19 - Άδεια Ειδικού Σκοπού - Πληροφορίες";
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

    <h2>Στοιχεία Ατόμου</h2>
    <div class="form-group row">
      <label for="FirstName" class="col-sm-2 col-form-label">Όνομα:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="employeeFirstName">
        <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
      </div>
    </div>
    <div class="form-group row">
      <label for="LastName" class="col-sm-2 col-form-label">Επώνυμο:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="employeeLastName">
        <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
      </div>
    </div>
    
    <!--date-->
    <h2>Επιλέξτε Ημερομηνία</h2>
    <div class="form-group row">
        <label for="begOfSusp" class="col-sm-2 col-form-label">Από:</label>
        <div class="col-10">
            <!-- <input type="date" id="begOfSusp" min="2021-01-01">-->
            
            <!---->
            
            <input type="text" id="begOfSusp">
            
            <!---->
            
            <!-- <input type="time" id="TimeSusp"> -->
            <div class="invalid-feedback">Η επιλογή ημερομηνίας είναι υποχρεωτική.</div>
        </div>
    </div>
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
    
    var toTest = 3;
    $(document).ready(function(){
      $("#begOfSusp").datepicker({beforeShowDay:nonworkingdates});
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



   // function valiDate(){
        // var br = document.getElementById("BRANCH");
        // var fn = document.getElementById("FirstName");
        // var ln = document.getElementById("LastName");
        // var valid1 = true;
        // var valid2 = true;
        // var valid3 = true;
        // // var valid = true;
        // var erstr1 = new String();
        // var erstr2 = new String();
        // var erstr3 = new String();
        
        // var frow1 = br.parentNode;
        // var frow2 = fn.parentNode.parentNode;
        // var frow3 = ln.parentNode.parentNode;
        
        // var ncn1;
        // var ncn2;
        // var ncn3;
        
        // //var x, i, input, valid = true;
        // // x = document.getElementsByClassName("tab");
        // // formGroups = x[currentTab].getElementsByClassName("form-group row");
        
        // // for(i=0;i<formGroups.length;i++{
            // // input = formGroups[i].getElementsByTagName("input");
            // if(br.value == "default"){
                // if(br.className.indexOf(" is-invalid") == -1){
                    // br.className += " is-invalid";
                // }
                // erstr1+= "Η επιλογή παραρτήματος είναι υποχρεωτική!\n";
                // valid1 = false;
            // }
            // if(fn == ""){ 
                // if(fn.className.indexOf(" is-invalid") == -1){
                    // fn.className += " is-invalid";
                // }
                // erstr2+= "Η εισαγωγή ονόματος είναι υποχρεωτική!\n";
                // valid2 = false;
            // }
            // if(ln.value == ""){
                // if(ln.className.indexOf(" is-invalid") == -1){
                    // ln.className += " is-invalid";
                // }
                // erstr3+= "Η εισαγωγή επωνύμου είναι υποχρεωτική!\n";
                // valid3 = false;
            // }
            
            // if(!valid1){
                // if(br.className.indexOf(" is-invalid") == -1){
                    // br.className += " is-invalid";
                // }
                // if(frow1.className.indexOf(" has-danger") == -1){
                    // frow1.className += " has-danger";
                // }
            // }else{
                // if(br.className.indexOf(" is-invalid") !== -1){
                    // ncn1 = br.className.replace(" is-invalid", "");
                    // br.className = ncn1;
                // }
                // if(frow1.className.indexOf(" has-danger") !== -1){
                    // ncn1 = frow1.className.replace(" has-danger", "");
                // }
                // br.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            // }
            
            // if(!valid2){
                // if(fn.className.indexOf(" is-invalid") == -1){
                    // fn.className += " is-invalid";
                // }
                // if(frow2.className.indexOf(" has-danger") == -1){
                    // frow2.className += " has-danger";
                // }
            // }else{
                // if(fn.className.indexOf(" is-invalid") !== -1){
                    // ncn2 = fn.className.replace(" is-invalid", "");
                    // fn.className = ncn2;
                // }
                // if(frow2.className.indexOf(" has-danger") !== -1){
                    // ncn2 = frow2.className.replace(" has-danger", "");
                // }
                // fn.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            // }
            
            // if(!valid3){
                // if(ln.className.indexOf(" is-invalid") == -1){
                    // ln.className += " is-invalid";
                // }
                // if(frow3.className.indexOf(" has-danger") == -1){
                    // frow3.className += " has-danger";
                // }
            // }else{
                // if(ln.className.indexOf(" is-invalid") !== -1){
                    // ncn3 = ln.className.replace(" is-invalid", "");
                    // ln.className = ncn3;
                // }
                // if(frow3.className.indexOf(" has-danger") !== -1){
                    // ncn3 = frow3.className.replace(" has-danger", "");
                // }
                // ln.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            // }
        // // }
        // return valid;
    // }     
  </script>

  <!-- NOTE: Footer section starts here -->
  <footer class="py-0 bg-light">
    <div class="container">
      <p class="m-0 text-center">Copyright &copy; Ypakp 2020</p>
    </div>
  </footer>
</body>

</html>      
    
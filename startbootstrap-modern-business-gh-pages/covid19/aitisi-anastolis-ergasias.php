<?php

// require_once "chromephp-master/ChromePhp.php";
 
// Initialize the session
if(!isset($_SESSION)) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"])) {
  header("location: ../index-level/login.php");
  exit;
}

// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$employer_FirstName = $employer_LastName = "";
$employer_FirstName_err = $employer_LastName_err = $employer_AFM_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // Empty checks are done via JavaScript before submit

  // Validate credentials
  $AFM_is_valid = "SELECT * FROM user WHERE AFM = ?";
  $employerAFM = trim($_POST["employer_AFM"]);
  $employerFirstName = trim($_POST["employer_FirstName"]);
  $employerLastName = trim($_POST["employer_LastName"]);
  
  // sleep(5);
  if($stmt_0 = mysqli_prepare($link, $AFM_is_valid)){
    mysqli_stmt_bind_param($stmt_0, "s", $param_AFM);
    $param_AFM = $employerAFM;
    if(mysqli_stmt_execute($stmt_0)){
      mysqli_stmt_store_result($stmt_0);
      if(mysqli_stmt_num_rows($stmt_0) != 1) {
        $employer_AFM_err = "Το ΑΦΜ που καταχωρήσατε δεν αντιστοιχεί με αυτό στο σύστημα";
      }else{
        $verify_name = "SELECT first_name, last_name FROM user WHERE AFM = ?";
        if($stmt_1 = mysqli_prepare($link, $verify_name)){
          mysqli_stmt_bind_param($stmt_1, "s", $param_AFM);
          $param_employerFirstName = $employerFirstName;
          
          if(mysqli_stmt_execute($stmt_1)){
            mysqli_stmt_store_result($stmt_1);
            if(mysqli_stmt_num_rows($stmt_1) == 1){
              mysqli_stmt_bind_result($stmt_1, $res_employerFirstName, $res_employerLastName);
              if(mysqli_stmt_fetch($stmt_1)) {
                if($employerFirstName != $res_employerFirstName){ 
                  $employer_FirstName_err = "Το όνομα που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
                }else if($employerLastName != $res_employerLastName){
                  $employer_LastName_err = "Το επίθετο που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
                }else{
                  // header("confirmed.php");
                }
              }
            }
          }else{
            $employer_FirstName_err = "Το όνομα που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
            $employer_LastName_err = "Το επίθετο που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
          }
          mysqli_stmt_close($stmt_1);
        }
      }
    }
    // Close statement
    mysqli_stmt_close($stmt_0);
  }
  
  // Close connection
  mysqli_close($link);
}
?>

<?php
  $title="Αναστολή Σύμβασης Εργασίας Υπαλλήλου";
  require_once "../top.php";
  require_once "../config.php";
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


    <div class="container mt-4">
      <!-- NOTE: Breadcrumbs section starts here -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-bg">
          <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
          <li class="breadcrumb-item active" aria-current="page">COVID-19 / Αίτηση Αναστολής Εργασίας</li>
        </ol>
      </nav>
      <!-- NOTE: Breadcrumbs section ends here -->

      <form id="suspForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Αίτηση Αναστολής Σύμβασης Εργασίας Υπαλλήλου</h1>
        <div class="tab">
          <h2 class="py-2">Στοιχεία Εργοδότη</h2>
          <div class="form-group row <?php echo (!empty($employer_FirstName_err)) ? 'has-danger' : ''; ?>">
            <label for="employerFirstName" class="col-sm-2 col-form-label">Όνομα:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control <?php echo (!empty($employer_FirstName_err)) ? 'is-invalid' : ''; ?>" name="employer_FirstName" id="employerFirstName" value="<?php echo(empty($employer_FirstName_err)) ? $employerFirstName : ''; ?>" required>
              <div class="invalid-feedback"><?php echo (!empty($employer_FirstName_err)) ?  $employer_FirstName_err : 'Το πεδίο είναι υποχρεωτικό'; ?>.</div>
            </div>
          </div>
          <div class="form-group row <?php echo (!empty($employer_LastName_err)) ? 'has-danger' : ''; ?>">
            <label for="employerLastName" class="col-sm-2 col-form-label">Επώνυμο:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control <?php echo (!empty($employer_LastName_err)) ? 'is-invalid' : ''; ?>" name="employer_LastName" id="employerLastName" value="<?php echo(empty($employer_LastName_err)) ? $employerLastName : ''; ?>" required>
              <div class="invalid-feedback"><?php echo (!empty($employer_LastName_err)) ?  $employer_LastName_err : 'Το πεδίο είναι υποχρεωτικό'; ?>.</div>
            </div>
          </div>
          <div class="form-group row <?php echo (!empty($employer_AFM_err)) ? 'has-danger' : ''; ?>">
            <label for="employerAFM" class="col-sm-2 col-form-label">ΑΦΜ:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control <?php echo (!empty($employer_AFM_err)) ? 'is-invalid' : ''; ?>" name="employer_AFM" id="employerAFM" maxlength="9" value="<?php echo(empty($employer_AFM_err)) ? $employerAFM : ''; ?>" onblur="validateAFM(this.id)" required>
              <div class="invalid-feedback" id="employerAFMError"><?php echo (!empty($employer_AFM_err)) ?  $employer_AFM_err : 'Το πεδίο είναι υποχρεωτικό'; ?>.</div>
            </div>
          </div>
          <div class="form-group row">
            <label for="employerEMail" class="col-sm-2 col-form-label">E-Mail:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="employerEMail" required>
              <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
            </div>
          </div>
          <hr>
          <h2>Στοιχεία Επιχείρισης</h2>
          <div class="form-group row">
            <label for="businessName" class="col-sm-2 col-form-label">Επωνυμία:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="businessName" required>
              <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
            </div>
          </div>
          <div class="form-group row">
            <label for="DOY" class="col-sm-2 col-form-label">ΔΟΥ:</label>
            <?php   
              
              $doy_list = mysqli_query($link, "SELECT * FROM doy");
              
              $value = 0;
              echo "<select class=\"select\" id=\"DOY\">";
              echo "<option value=\"$value\" selected>Επιλέξτε</option>";
              while($doy = mysqli_fetch_array($doy_list)){
                $value++;
                echo "<option value=\"$value\">$doy[0]</option>";
              }
              echo "</select>";
            ?>
            <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
          </div>
        </div>

        <!-- <div class="tab">
          <h2>Στοιχεία Υπαλλήλου</h2>
            <div class="form-group row">
              <label for="employeeFirstName" class="col-sm-2 col-form-label">Όνομα:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="employeeFirstName" required>
                <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
              </div>
            </div>
            <div class="form-group row">
              <label for="employeeLastName" class="col-sm-2 col-form-label">Επώνυμο:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="employeeLastName" required>
                <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
              </div>
            </div>
            <div class="form-group row">
              <label for="employeeAFM" class="col-sm-2 col-form-label">ΑΦΜ:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="employeeAFM" maxlength="9" onblur="validateAFM(this.id)" required>
                <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
              </div>
            </div>
            <div class="form-group row">
              <label for="employeeEMail" class="col-sm-2 col-form-label">E-Mail:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="employeeEMail" required>
                <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
              </div>
            </div>
        </div> -->

        <!-- <div class="tab">
          <h2>Διάστημα Αναστολής Σύμβασης</h2>
          <div class="form-group row">
            <label for="begOfSusp" class="col-sm-2 col-form-label">Από:</label>
            <div class="col-10">
              <input class="form-control" type="date" id="begOfSusp" min="2021-01-01" max="2021-01-20" oninput="restrictEndDate()" required>
              <div class="invalid-feedback">Η επιλογή ημερομηνίας αφετηρίας αναστολής είναι υποχρεωτική.</div>
            </div>
          </div>
          <div class="form-group row">
            <label for="endOfSusp" class="col-sm-2 col-form-label">Έως:</label>
            <div class="col-10">
              <input class="form-control" type="date" id="endOfSusp" min="2021-01-01" max="2021-01-20"oninput="restrictStartDate()" required>
              <div class="invalid-feedback">Η επιλογή ημερομηνίας λήξης αναστολής είναι υποχρεωτική.</div>
            </div>
          </div>
        </div> -->
        <div class="form-group">
          <div style="overflow:auto;">
            <div style="float:right;"> 
              <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Προηγούμενο</button>
              <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Επόμενο</button>
            </div>
          </div>
        </div>
        
        <!-- Circles which indicates the steps of the form: -->
        <!-- <div style="text-align:center;margin-top:40px;"> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
        <!-- </div> -->

      </form>
    </div>


    <script>
      var currentTab = 0; // Current tab is set to be the first tab (0)
      showTab(currentTab); // Display the current tab

      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      if(dd<10){
        dd='0'+dd
      }
      if(mm<10){
        mm='0'+mm
      }
      today = yyyy+'-'+mm+'-'+dd;

      var today2 = new Date();
      var dd2 = today2.getDate();
      var mm2 = today2.getMonth()+1; //January is 0!
      var yyyy2 = today2.getFullYear();
      if(dd2<10){
        dd2='0'+dd2
      }
      if(mm2<10){
        mm2='0'+mm2
      }

      today2 = yyyy2+'-'+mm2+'-'+dd2;
      // document.getElementById("begOfSusp").setAttribute("min", today);
      // document.getElementById("endOfSusp").setAttribute("min", today2);

      function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
          document.getElementById("prevBtn").style.display = "none";
        } else {
          document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
          document.getElementById("nextBtn").innerHTML = "Υποβολή";
          document.getElementById("nextBtn").type = "submit";
        } else {
          document.getElementById("nextBtn").innerHTML = "Επόμενο";
        }

        //... and run a function that will display the correct step indicator:
        <!-- fixStepIndicator(n); -->
      }

      function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
          // ... the form gets submitted:
          currentTab = 0;
          document.getElementById("suspForm").submit();
          // return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
      }

      function validateForm() {
        // This function deals with validation of the form fields
        var x, i, valid = true;
        var formGroups, input, feedbackMsg;
        var newClassName;
        x = document.getElementsByClassName("tab");
        formGroups = x[currentTab].getElementsByClassName("form-group row");
        <!-- // A loop that checks every input field in the current tab: -->
        if(currentTab !== x.length - 1){
          for(i = 0; i < formGroups.length; i++){
            // If a field is empty...
            input = formGroups[i].getElementsByTagName("input");
            if(typeof input[0] === 'undefined'){
              input = formGroups[i].getElementsByTagName("select");
            }
            if(input[0].value == "" || input[0].value == 0){
              // add an "invalid" class to the field:
              input[0].className += " is-invalid";
              formGroups[i].className += " has-danger";
              // and set the current valid status to false
              valid = false;
            }else{
              // removing class "invalid" from field
              if(input[0].className.indexOf(" is-invalid") !== -1){
                newClassName = input[0].className.replace(" is-invalid", "");
                input[0].className = newClassName;
                newClassName = formGroups[i].className.replace(" has-danger", "");
                formGroups[i].className = newClassName;
              }
            }
          }
        }
        <!-- // If the valid status is true, mark the step as finished and valid: -->
        <!-- if (valid) { -->
          <!-- document.getElementsByClassName("step")[currentTab].className += " finish"; -->
        <!-- } -->
        return valid; // return the valid status
      }

      function validateAFM(id){
        var AFM = document.getElementById(String(id));
        var valid = true;
        var formRow = AFM.parentNode.parentNode;
        var errorString = new String();
        var newClassName;
        if(AFM.value.length != 9){
          valid = false;
          errorString = "Το ΑΦΜ πρέπει να είναι 9ψήφιο.\n";
        }
        if(AFM.value.match(/^[0-9]+$/) == null){
          valid = false;
          errorString += "Το ΑΦΜ πρέπει να περιέχει μόνο ψηφία και όχι γράμματα.\n";
        }
        if(!valid){
          if(AFM.className.indexOf(" is-invalid") == -1){
            AFM.className += " is-invalid";
          }
          if(formRow.className.indexOf(" has-danger") == -1){
            formRow.className += " has-danger";
          }
          AFM.nextSibling.nextSibling.innerHTML = errorString;
        }else{
          if(AFM.className.indexOf(" is-invalid") !== -1){
            newClassName = AFM.className.replace(" is-invalid", "");
            AFM.className = newClassName;
          }
          if(formRow.className.indexOf(" has-danger") !== -1){
            newClassName = formRow.className.replace(" has-danger", "");
            formRow.className = newClassName;
          }
          AFM.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
        }
      }

      // const employermail = document.getElementById("employerEMail");
      // employermail.addEventListener("blur", function(){invalidEmail("employerEMail")});

      // const employeemail = document.getElementById("employeeEMail");
      // employeemail.addEventListener("blur", function(){invalidEmail("employeeEMail")});

      function invalidEmail(id) {
        mail = document.getElementById(id);
        errorMsg = new String();
        if(mail.validity.typeMismatch){
          if(mail.parentNode.parentNode.className.indexOf(" has-danger") == -1){
            <!-- // first time showing an error for this field -->
            mail.parentNode.parentNode.className += " has-danger";
            mail.className += " is-invalid";
            errorMsg = "Μη έγκυρη μορφή ηλεκτρονικού ταχυδρομείου.\nΠαραδείγμα: marpap15@mail.gr";
            mail.nextSibling.nextSibling.innerHTML = errorMsg;
          }
        }else{
          if(mail.parentNode.parentNode.className.indexOf(" has-danger") !== -1){
            var newClassName = mail.parentNode.parentNode.className.replace(" has-danger", "");
            mail.parentNode.parentNode.className = newClassName;
            newClassName = mail.className.replace(" is-invalid", "");
            mail.className = newClassName;
            errorMsg = "Το πεδίο είναι υποχρεωτικό.";
            mail.nextSibling.nextSibling.innerHTML = errorMsg;
          }
        }
      }

      function restrictEndDate(){
        var begSuspDate = new Date();
        begSuspDate = document.getElementById("begOfSusp").value;
        document.getElementById("endOfSusp").setAttribute("min", begSuspDate);
      }

      function restrictStartDate(){
        var endSuspDate = new Date();
        endSuspDate = document.getElementById("endOfSusp").value;
        document.getElementById("begOfSusp").setAttribute("max", endSuspDate);
      }

      function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
          x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
      }
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>

<?php 
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

$userAFM = $_SESSION["AFM"];
// validate user has child younger than 12
$validate_child = "SELECT * FROM employee WHERE AFM = $userAFM";
$validation_result = mysqli_query($link, $validate_child);
$row = mysqli_fetch_array($validation_result);
if($row[3] != 1){
  header("location: no-child-younger-than-12-warning.php");
}

// Define variables and initialize with empty values

$startDate = "";
$endDate = "";

$employeeAFM = $_SESSION["AFM"];


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $myCompanyName = "SELECT companyName FROM employee WHERE AFM = ".$_SESSION["AFM"];
  $companyName = mysqli_query($link, $myCompanyName);
  $companyName = mysqli_fetch_array($companyName)[0];
  $myEmployerAFM = "SELECT AFM FROM employer WHERE Company_Name = \"$companyName\"";
  $employerAFM = mysqli_fetch_array(mysqli_query($link, $myEmployerAFM))[0];

  $startDate = trim($_POST["_begOfLeave"]);
  $endDate = trim($_POST["_endOfLeave"]);
  $createFormLine = "INSERT INTO parentalleavecertificate (employerAFM, employeeAFM, startDate, endDate) VALUES (?, ?, ?, ?)";
  if($stmt = mysqli_prepare($link, $createFormLine)){
    mysqli_stmt_bind_param($stmt, "iiss", $param_employerAFM, $param_employeeAFM, $param_startDate, $param_endDate);
    $param_employerAFM = $employerAFM;
    $param_employeeAFM = $_SESSION["AFM"];
    $param_startDate = $startDate;
    $param_endDate = $endDate;
    if(!mysqli_stmt_execute($stmt)){
      echo "Problem with insertion.";
    }
  }
  $updateWorkStatus = "UPDATE employee SET workStatus = \"parentalleave\" WHERE AFM = ".$_SESSION["AFM"];
  mysqli_query($link, $updateWorkStatus);
  header("location: confirmation.php");
}
?>

<?php
$title = "Αίτηση Άδειας Ειδικού Σκοπού ";
require_once "../top.php";
?>

   <div class="container mt-4">
      <!-- NOTE: Breadcrumbs section starts here -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-bg">
          <li class="breadcrumb-item"><a href="../index-level/index.html">Αρχική</a></li>
          <li class="breadcrumb-item"><a href="adeia-eidikou-skopou-info.php">COVID-19 / Άδεια Ειδικού Σκοπού</a></li>
          <li class="breadcrumb-item"><a href="adeia-eidikou-skopou-intermediate.php">Προαπαιτούμενα Αίτησης</a></li>
          <li class="breadcrumb-item active" aria-current="page">Υποβολή Αίτησης</li>
        </ol>
      </nav>
      <!-- NOTE: Breadcrumbs section ends here -->
      <h4><b>Υποβολή Αίτησης:</b></h4>
      <h5><u>Στοιχεία Αιτούντος/ούσας:</u><h5>

      <!-- <div class = "tab">
        <p class = "formitem">Κατηγορία:
            <input type="radio" name="radcat" value="ye"/><label class="radbutitem">ΥΕ</label>
            <input type="radio" name="radcat" value="de"/><label class="radbutitem">ΔΕ</label>
            <input type="radio" name="radcat" value="te"/><label class="radbutitem">ΤΕ</label>
            <input type="radio" name="radcat" value="pe"/><label class="radbutitem">ΠΕ</label>
        </p>
        <p class = "formitem">Ιδιότητα:
            <input type="radio" name="radspec" value="perm"/><label class="radbutitem">Μόνιμος</label>
            <input type="radio" name="radspec" value="idax"/><label class="radbutitem">Ι.Δ.Α.Χ</label>
            <input type="radio" name="radspec" value="idox"/><label class="radbutitem">Ι.Δ.Ο.Χ</label>
        </p>
        <p class = "formitem">Υπηρεσία:
        <input class = "inputitem" type="text" name="txtUsername" value="" maxlength="45" size="35"/>
        </p>
        <p class = "formitem">Τηλέφωνο:
        <input class = "inputitem" type="text" name="txtUsername" value="" maxlength="10" size="10"/>
        </p>
      </div> -->
    
      <!-- <div class = "tab">
      <br/>
        <label style="font-size:15px;">Αριθμός τέκνων</label>
        <select name="selkidcount" style="-webkit-appearance: menulist-button; height: 60%;">
            <option selected="selected" value="one">1</option>
            <option value="two">2</option>
            <option value="three">3</option>
            <option value="four">4</option>
            <option value="more">Άλλο</option>
        </select>
      </div> -->
      
      <form id="parentalLeave" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class = "tab">
          <h6 style="font-size:15px; color: red;">Ελάχιστο τέσσερις(4) ημέρες</h6>
          <p class = "formitem">Αριθμός Ημερών:</p>
          <div class="form-group row">
            <label for="begOfLeave" class="col-sm-2 col-form-label">Από<small>*</small>:</label>
            <div class="col-10">
              <input class="form-control" type="date" name="_begOfLeave" id="begOfLeave" min="2021-01-01" value="<?php echo $startDate; ?>" required>
              <div class="invalid-feedback">Η επιλογή ημερομηνίας αφετηρίας άδειας είναι υποχρεωτική.</div>
            </div>
          </div>
          <div class="form-group row">
            <label for="endOfLeave" class="col-sm-2 col-form-label">Έως<small>*</small>:</label>
            <div class="col-10">
              <input class="form-control" type="date" name="_endOfLeave" id="endOfLeave" min="2021-01-01" value="<?php echo $endDate; ?>" required>
              <div class="invalid-feedback" id="endDateError">Η επιλογή ημερομηνίας λήξης άδειας είναι υποχρεωτική.</div>
            </div>
          </div>
        </div>        
        <div style="overflow:auto;">
          <div style="float:right;">
            <button type="button" class = "btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Προηγούμενο</button>
            <button type="button" class = "btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Επόμενο</button>
          </div>
        </div>
      </form>
      
    </div>
</body>

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

  var temptoday = new Date();
  var today2 = new Date(temptoday.getTime() + 4*24*60*60*1000);
  var dd2 = today2.getDate();
  var mm2 = today2.getMonth()+1; //January is 0!
  var yyyy2 = today2.getFullYear();
  if(dd2<10){
    dd2='0'+dd2;
  }
  if(mm2<10){
    mm2='0'+mm2;
  }



  today2 = yyyy2+'-'+mm2+'-'+dd2;
  document.getElementById("begOfLeave").setAttribute("min", today);
  document.getElementById("endOfLeave").setAttribute("min", today2);
      

  function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Υποβολή";
    } else {
      document.getElementById("nextBtn").innerHTML = "Επόμενο";
    }
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !verifyDates()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
      //...the form gets submitted:
      document.getElementById("parentalLeave").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }
  
  function verifyDates(){
    // This function deals with validation of the form fields
    var x, i, valid = true;
    var formGroups, input, feedbackMsg;
    var newClassName;
    x = document.getElementsByClassName("tab");
    formGroups = x[currentTab].getElementsByClassName("form-group row");
    <!-- // A loop that checks every input field in the current tab: -->
    for(i = 0; i < formGroups.length; i++){
      // If a field is empty...
      input = formGroups[i].getElementsByTagName("input");
      if(input[0].value == ""){
        if(input[0].className.indexOf(" is-invalid") == -1){
          // add an "invalid" class to the field:
          input[0].className += " is-invalid";
          formGroups[i].className += " has-danger";
        }
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
    return valid; // return the valid status          
  }
  
  function restrictEndDate(){
    var begLeaveDate = new Date(document.getElementById("begOfLeave").value);
    newEndLeaveDate = new Date(Date.parse(begLeaveDate) + 4*24*60*60*1000);
    console.log(newEndLeaveDate);
    
    var day = newEndLeaveDate.getDate();
    var month = newEndLeaveDate.getMonth()+1; //January is 0!
    var year = newEndLeaveDate.getFullYear();
    if(day<10){
      day='0'+day
    }
    if(month<10){
      month='0'+month
    }
    newEndLeaveDate = year+'-'+month+'-'+day;
    console.log(newEndLeaveDate);
    document.getElementById("endOfLeave").setAttribute("min", newEndLeaveDate);
  }

  function restrictStartDate(){
    var endLeaveDate = new Date();
    endLeaveDate = document.getElementById("endOfLeave").value;
    document.getElementById("begOfLeave").setAttribute("max", endLeaveDate);
  }

</script>

<!-- Bootstrap core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php
require_once "../bottom.php";
?>
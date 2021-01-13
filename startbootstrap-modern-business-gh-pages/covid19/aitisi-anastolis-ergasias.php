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
require_once "aitisi-anastolis-dynamic.php";

$userAFM = $_SESSION["AFM"];
$validate_user_is_employer = "SELECT * from employer WHERE AFM = $userAFM";
$employer = mysqli_query($link, $validate_user_is_employer);
$Company_Name = "";

if(mysqli_num_rows($employer) == 0){
  // Όχι εργοδότης
  header("location: not-employer-warning.php");
}else{
  $row = mysqli_fetch_array($employer); // only one employer by that AFM => only one row
  $Company_Name = $row[1];
}
// Define variables and initialize with empty values

$startDate = "";
$endDate = "";

$employerAFM = $_SESSION["AFM"];


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // the order of elements in the post array is checkbox, radio, radio
  // so for the first element and every 3rd element after that, we check to
  // see if its value is not empty
  // if it is, we don't bother with the radios
  // if it isn't, we check to see which value was selected and execute a suitable query
  // if all checkboxes are empty, then the form goes back to the first step
  // if not, it is submitted
  
  $checkbox_iterator = 0;
  $checkbox_count = 0;
  $startDate = trim($_POST["_begOfSusp"]);
  $endDate = trim($_POST["_endOfSusp"]);
  for($checkbox_iterator = 0; $checkbox_iterator < count($_POST); $checkbox_iterator += 3){
    if(!empty($_POST["_employee".$checkbox_count])){
      if(!empty("status".$checkbox_count)){
        $createFormLine = "INSERT INTO employerforms (employerAFM, employeeAFM, startDate, endDate, typeOfForm) VALUES (?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $createFormLine)){
          mysqli_stmt_bind_param($stmt, "iisss", $param_employerAFM, $param_employeeAFM, $param_startDate, $param_endDate, $param_type);
          $param_employerAFM = $employerAFM;
          $param_employeeAFM = $_POST["_employee".$checkbox_count];
          $param_startDate = $startDate;
          $param_endDate = $endDate;
          $param_type = $_POST["status".$checkbox_count];
        }
        $updateWorkStatus = "UPDATE employee SET workStatus = \"".$_POST["status".$checkbox_count]."\" WHERE AFM = ".$_POST["_employee".$checkbox_count];
        mysqli_query($link, $updateWorkStatus);
      }
    }
    $checkbox_count++;
  }
  
}
?>

<?php
  $title="Αναστολή Σύμβασης Εργασίας Υπαλλήλου";
  require_once "../top.php";

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

      <form id="suspForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  >
        <h1>Αίτηση Ειδικού Εργασιακού Καθεστώτος Υπαλλήλου</h1>
        <div class="tab">
          <p id="noEmployeeChosenError" style="color: red; font-size: 20px; display: none;">Δεν επιλέξατε κάποιον υπάλληλο!</p>
          <h3>Επιλέξτε τους υπαλλήλους που θέλετε να θέσετε σε ειδικό εργασιακό καθεστώς</h3>
          <div class="container mt-4">
            <?php 
              $fetch_employees = "SELECT * FROM employee WHERE companyName = \"$Company_Name\" AND workStatus = \"normal\"";
              $employees = mysqli_query($link, $fetch_employees);
              $number = 0;
              while($row = mysqli_fetch_array($employees)){
                $user_query = "SELECT first_name, last_name FROM user WHERE AFM = $row[0]";
                $user = mysqli_query($link, $user_query);
                $user_row = mysqli_fetch_array($user);
                echo "<div class=\"form-check\">";
                echo "<input type=\"checkbox\" class=\"form-check-input\" id=\"employee$number\" name=\"_employee$number\" value=\"$row[0]\" onchange=\"displayMyRadioButtons(this.id)\"></input>";
                echo "<label for=\"employee$number\" class=\"form-check-label\">$user_row[0] $user_row[1]</label>";

                echo "</br>";
    
                echo "<div class=\"form-check form-check-inline disabled\" id=\"radios$number\">";
                echo "<input class=\"form-check-input\" type=\"radio\" name=\"status$number\" id=\"suspended$number\" value=\"suspended\" disabled>";
                echo "<label class=\"form-check-label\" for=\"suspended$number\">Αναστολή Σύμβασης</label>";
                echo "<input class=\"form-check-input\" type=\"radio\" name=\"status$number\" id=\"remote$number\" value=\"remote\" disabled>";
                echo "<label class=\"form-check-label\" for=\"remote$number\">Τηλεργασία</label>";
                echo "<div class=\"invalid-feedback\">Δεν επιλέξατε νέα εργασιακή κατάσταση για τον υπάλληλο!</div>";
                echo "</div>";

                echo "</div>";
                $number++;
              }
            ?>
          </div>
        </div>

        <div class="tab">
          <h2>Διάστημα Αναστολής Σύμβασης</h2>
          <div class="form-group row">
            <label for="begOfSusp" class="col-sm-2 col-form-label">Από:</label>
            <div class="col-10">
              <input class="form-control" type="date" name="_begOfSusp" id="begOfSusp" min="2021-01-01" max="2021-01-20" oninput="restrictEndDate()" value="<?php echo $startDate; ?>" required>
              <div class="invalid-feedback">Η επιλογή ημερομηνίας αφετηρίας αναστολής είναι υποχρεωτική.</div>
            </div>
          </div>
          <div class="form-group row">
            <label for="endOfSusp" class="col-sm-2 col-form-label">Έως:</label>
            <div class="col-10">
              <input class="form-control" type="date" name="_endOfSusp" id="endOfSusp" min="2021-01-01" max="2021-01-20"oninput="restrictStartDate()" value="<?php echo $endDate; ?>" required>
              <div class="invalid-feedback">Η επιλογή ημερομηνίας λήξης αναστολής είναι υποχρεωτική.</div>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div style="overflow:auto;">
            <div style="float:right;"> 
              <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Προηγούμενο</button>
              <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Επόμενο</button>
            </div>
          </div>
        </div>

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
      document.getElementById("begOfSusp").setAttribute("min", today);
      document.getElementById("endOfSusp").setAttribute("min", today2);
      
      function displayMyRadioButtons(id){
        var checkbox = document.getElementById(String(id));
        var no = checkbox.id.slice(8);
        var radiosno = "radios" + no;
        var radios = document.getElementById(radiosno);
        var buttons = document.getElementsByName("status" + no);
        console.log(buttons);
        var i;
        if(radios.className.indexOf(" disabled") == -1){
          radios.className += " disabled";
          for(i = 0; i < buttons.length; i++){
            buttons[i].disabled = true;
          }
        }else{
          var newClassName = radios.className.replace(" disabled", "");
          radios.className = newClassName;
          for(i = 0; i < buttons.length; i++){
            buttons[i].disabled = false;
          }
        }
      }

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
        } else {
          document.getElementById("nextBtn").innerHTML = "Επόμενο";
        }
      }

      function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !verifyEmployees()) return false;
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
      
      function verifyEmployees(){
        var inputs = document.getElementsByTagName("input"); 
        var i, anyChecked = false;
        for(i = 0; i < inputs.length; i++){
          if(inputs[i].type == "checkbox"){
            if(inputs[i].checked == true){
              anyChecked = true;
              break;
            }
          }
        }
        var error = document.getElementById("noEmployeeChosenError");
        var missingRadios = false;
        if(anyChecked == false){
          error.style.display = "inline";
          return false;
        }else{
          error.style.display = "none";    
          var div, radios, radio1, radio2;
          for(i = 0; i < inputs.length; i++){
            if(inputs[i].type == "checkbox" && inputs[i].checked == true){
              //get the div, we'll change the class to " has-danger" if needed
              // or if everything is okay but it wasn't before we'll remove this class name
              div = inputs[i].nextSibling.nextSibling.nextSibling;
              //get the radio buttons, same thing with div but with the class " is-invalid"
              var no = inputs[i].id.slice(8);;
              var radiosName = "status" + no;
              radios  = document.getElementsByName(radiosName);
              if(radios[0].checked == false && radios[1].checked == false){
                if(div.className.indexOf(" has-danger") == -1){
                  div.className += " has-danger";
                }
                missingRadios = true;
                if(radios[0].className.indexOf(" is-invalid") == -1){
                  radios[0].className += " is-invalid";
                }
                if(radios[1].className.indexOf(" is-invalid") == -1){
                  radios[1].className += " is-invalid";
                }
              }else{
                var newClassName;
                if(div.className.indexOf(" has-danger") != -1){
                  newClassName = div.className.replace(" has-danger", "");
                  div.ClassName = newClassName;
                }
                if(radios[0].className.indexOf(" is-invalid") != -1){
                  newClassName = radios[0].className.replace(" is-invalid", "");
                  radios[0].className = newClassName;
                }
                if(radios[1].className.indexOf(" is-invalid") != -1){
                  newClassName = radios[1].className.replace(" is-invalid", "");
                  radios[1].className = newClassName;
                }
              }
            }
          }
          if(missingRadios == true){
            return false;
          }
        }
        return true;
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
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

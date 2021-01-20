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
  for($checkbox_iterator = 0; $checkbox_iterator < count($_POST); $checkbox_iterator++){
    if(!empty($_POST["_employee".$checkbox_iterator])){
      $deleteFormLine = "DELETE FROM employerforms WHERE employerAFM = ? AND employeeAFM =  ?";
      if($stmt = mysqli_prepare($link, $deleteFormLine)){
        mysqli_stmt_bind_param($stmt, "ii", $param_employerAFM, $param_employeeAFM);
        $param_employerAFM = $employerAFM;
        $param_employeeAFM = $_POST["_employee".$checkbox_iterator];
        if(!mysqli_stmt_execute($stmt)){
            echo "<h1>".mysqli_stmt_error($stmt)."</h1>";
        }
        mysqli_stmt_close($stmt);
      }
      $updateWorkStatus = "UPDATE employee SET workStatus = \"normal\" WHERE AFM = ".$_POST["_employee".$checkbox_iterator];
      mysqli_query($link, $updateWorkStatus);
    }
  }
  header("location: confirmation.php");
}
?>

<?php
  $title="Άρση Ειδικής Εργασιακής Κατάστασης Υπαλλήλου";
  require_once "../top.php";

?>    
    <div class="container mt-4">
      <!-- NOTE: Breadcrumbs section starts here -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-bg">
          <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
          <li class="breadcrumb-item active" aria-current="page">COVID-19 / Άρση Ειδικής Εργασιακής Κατάστασης Υπαλλήλων</li>
        </ol>
      </nav>
      <!-- NOTE: Breadcrumbs section ends here -->

      <form id="suspForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  >
        <h1>Άρση Ειδικής Εργασιακής Κατάστασης Υπαλλήλου</h1>
        <div class="tab">
          <p id="noEmployeeChosenError" style="color: red; font-size: 20px; display: none;">Δεν επιλέξατε κάποιον υπάλληλο!</p>
          <h3>Επιλέξτε τους υπαλλήλους των οποίων το ειδικό εργασιακό καθεστώς θέλετε να άρετε.</h3>
          <div class="container mt-4">
            <?php 
              $fetch_employees = "SELECT * FROM employee WHERE companyName = \"$Company_Name\" AND workStatus <> \"normal\" AND workStatus <> \"parentalleave\"";
              $employees = mysqli_query($link, $fetch_employees);
              echo "<h1>".mysqli_error($link)."</h1>";
              $number = 0;
              if(mysqli_num_rows($employees) == 0){
                echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">";
                echo "Κανείς από τους υπαλλήλους σας δεν βρίσκεται σε ειδικό εργασιακό καθεστώς!";
                echo "<hr><a class=\"btn btn-primary btn-lg btn-warning\" href=\"anastoli-info.php\" role=\"button\">Επιστροφή στην ιστοσελίδα των πληροφοριών.</a>";
                echo "</div>";
              }else{
                while($row = mysqli_fetch_array($employees)){
                  $user_query = "SELECT first_name, last_name FROM user WHERE AFM = $row[0]";
                  $user = mysqli_query($link, $user_query);
                  $user_row = mysqli_fetch_array($user);
                  echo "<div class=\"form-check\">";
                  echo "<input type=\"checkbox\" class=\"form-check-input\" id=\"employee$number\" name=\"_employee$number\" value=\"$row[0]\"></input>";
                  echo "<label for=\"employee$number\" class=\"form-check-label\">$user_row[0] $user_row[1]</label>";
                  echo "</div>";
                  $number++;
                }
                echo "<div class=\"form-group\">";
                echo "<div style=\"overflow:auto;\">";
                echo "<div style=\"float:right;\">"; 
                echo "<button type=\"button\" class=\"btn btn-primary\" id=\"prevBtn\" onclick=\"nextPrev(-1)\">Προηγούμενο</button>";
                echo "<button type=\"button\" class=\"btn btn-primary\" id=\"nextBtn\" onclick=\"nextPrev(1)\">Επόμενο</button>";
                echo "</div>";
                echo  "</div>";
                echo "</div>";                
              }
            ?>
          </div>
        </div>

      </form>
    </div>

    <script>
      var currentTab = 0; // Current tab is set to be the first tab (0)
      showTab(currentTab); // Display the current tab

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
        }
        return true;
      }
    </script>
<?php 
require_once "../bottom.php";
?>
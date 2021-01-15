<?php
  if(!isset($_SESSION)) {
    session_start();
  }
  require_once "../config.php";
  
  $myCompany = mysqli_query($link, "SELECT Company_Name FROM employer WHERE AFM = ".$_SESSION["AFM"]);
  $myCompany = mysqli_fetch_array($myCompany)[0];
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $doy = trim($_POST["_doy"]);

    
    $updateDoy = "UPDATE company SET Doy = \"$doy\" WHERE Company_Name= \"$myCompany\"";
    mysqli_query($link, $updateDoy);

    $updateCompanyName = "UPDATE employer SET Company_Name = \"".$_POST["_companyName"]."\" WHERE AFM = ".$_SESSION["AFM"];
    mysqli_query($link, $updateCompanyName);
  
    header("location: confirmation.php");
  }
?>

<?php
  $title = "Αλλαγή - Το προφίλ μου";
  require_once "../top.php";  
?>

  <div class="container mt-4">
    <!-- NOTE: Breadcrumbs section starts here -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
        <li class="breadcrumb-item"><a href="../index-level/userprofile.php">Το προφίλ μου</a></li>
        <li class="breadcrumb-item active" aria-current="page">Επεξεργασία στοιχείων</li>
      </ol>
    </nav>
    
    <!-- Sidebar Column -->
    <h1>Επεξεργασία Στοιχείων</h1>
    <form id="changeInfo" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="tab">
        <p>Οι τιμές στα πεδία είναι αυτές που έχετε μέχρι στιγμής καταχωρήσει στο σύστημα.</br>
        Αν δεν επιθυμείτε να αλλάξατε κάποιο από τα στοιχεία σας, απλά αγνοήστε το.</p>
        <?php 
            $fetchAccountType = "SELECT type FROM user WHERE username = \"".$_SESSION["username"]."\"";
            $accountType = mysqli_query($link, $fetchAccountType);
            if(mysqli_num_rows($accountType) == 0){
              echo "<p>Sth went terribly wrong</p>";
            }else{
              $accountTypeRow = mysqli_fetch_array($accountType);
              if($accountTypeRow[0] == "employer"){
                echo "<div class=\"form-group row\">";
                echo "<label for=\"companyName\" class=\"col-sm-2 col-form-label\">Νέα Επωνυμία Επιχείρησης</label>";
                echo "<div class=\"col-10\">";
                echo "<input type=\"text\" class=\"form-control\" id=\"companyName\" name=\"_companyName\" value=\"$myCompany\" onblur=\"changeNewCompanyName()\">";
                echo "</div>";
                echo "</div>";
                $doy_list = mysqli_query($link, "SELECT * FROM doy ORDER BY Name ASC");
                $myCompanysDoy = mysqli_query($link, "SELECT Doy FROM company WHERE Company_Name = \"$myCompany\"");
                $myCompanysDoy = mysqli_fetch_array($myCompanysDoy)[0];
                echo "<div class=\"form-group row\">";
                echo "<label for=\"DOY\" class=\"col-sm-2 col-form-label\">Νέα ΔΟΥ Επιχείρησης:</label>";
                echo "<div class=\"col-10\">";
                echo "<select class=\"select\" name=\"_doy\" id=\"DOY\" oninput=\"changeNewDoy()\">";
                while($row = mysqli_fetch_array($doy_list)){
                  echo "<option value=\"$row[0]\"";
                  if($myCompanysDoy == $row[0]){
                    echo " selected";
                  }
                  echo ">$row[0]</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "</div>";
              }
            }
        ?>
      </div>
      <div class="tab">
        <h2>Νέα στοιχεία Επιχείρησης</h2>
          <p id="newCompanyName">Νέα Επωνυμία Επιχείρησης: <b><?php echo $myCompany; ?></b></p> 
          <p id="newDoy">Νέα ΔΟΥ: <b><?php echo $myCompanysDoy; ?></b></p> 
          <p>Αν είστε σίγουροι για τα νέα στοιχεία, πατήστε 'Υποβολή', αλλιώς πατήστε 'Προηγούμενο' για να τα τροποποιήσετε περαιτέρω.</p>
      </div>
      <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" class = "btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Προηγούμενο</button>
          <button type="button" class = "btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Επόμενο</button>        
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
      x[currentTab].style.display = "none";
      x[n].style.display = "block";
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
      currentTab = n;
      // //... and fix the Previous/Next buttons:
    }
    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      // if (n == 1 && !verifyDates()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form... :
      if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("changeInfo").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }
    function changeNewDoy(){
      var newDoyInput = document.getElementById("DOY").value;
      var confirmParagraph  = document.getElementById("newDoy");
      var bold = confirmParagraph.firstElementChild;
      bold.innerHTML = newDoyInput;
    }
    
    function changeNewCompanyName(){
      var newCompanyNameInput = document.getElementById("companyName").value;
      console.log(newCompanyNameInput);
      var confirmParagraph  = document.getElementById("newCompanyName");
      var bold = confirmParagraph.firstElementChild;
      bold.innerHTML = newCompanyNameInput;
    }
  </script>
  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  
<?php 
require_once "../bottom.php";
?>
<?php
  // if(!isset($_SESSION)) {
    // session_start();
  // }

  require_once "../config.php";
  // include_once('sdi1700060.sql');
  // if($_POST['Name']){
      // $Name = $_POST['Name'];
      // if()
  // }
  $res = mysqli_query($link,"Select * FROM regionalunit");
  $toprint = "";
  $pesaved = "";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesaved = trim($_POST["pe"]);
    if($pesaved != "default"){
        $peres = mysqli_query($link, "SELECT * FROM branch WHERE RegUnit = \"$pesaved\"");
        $toprint = "<option value=\"default\" selected>Επιλέξτε</option>";
        while($resrow = mysqli_fetch_array($peres)){
            $toprint .= "<option value=\"$resrow[0]\">$resrow[0]</option>";
        }
    }
  }
  
//path cd /mnt/c/xampp/htdocs
?>

<?php
$title="Επικοινωνία - Κλείστε Ραντεβού";
?>

<?php
// Initialize the session
if(!isset($_SESSION)) {
  session_start();
}
// // Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: welcome.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <meta name="description" content=""> -->
  <!-- <meta name="author" content=""> -->

  <title><?php echo $title ?> - Υπουργείο Εργασίας</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  <link href="../css/styles.css" rel="stylesheet">
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
  
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
 

  
</head>

<body>
  <header>
    <!-- NOTE: Navigation section starts here -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../index-level/index.php">
          <img src="../logo.png" alt="Υπουργείο Εργασίας και Κοινωνικών Υποθέσεων"
               height="53" width="183">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-dark" href="../index-level/index.php">Αρχική</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownCOVID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                COVID-19
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCOVID">
                <a class="dropdown-item" href="../covid19/ores-leitourgias-grafeion.php">Λειτουργία Υπηρεσιών Υπουργείου</a>
                <a class="dropdown-item" href="../covid19/covid19-info.php">Ενημέρωση - Έκτακτα Μέτρα</a>
                <a class="dropdown-item" href="../covid19/tilergasia-info.php">Απασχόληση Εργαζομένων με Τηλεργασία</a>
                <a class="dropdown-item" href="../covid19/adeia-eidikou-skopou-info.php">Άδεια Ειδικού Σκοπού</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownErgodotes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Εργοδότες
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownErgodotes">
                <a class="dropdown-item" href="#">Σχετικά με τον COVID-19</a>
                <a class="dropdown-item" href="#">Νέες Επιχειρήσεις</a>
                <a class="dropdown-item" href="#">Τροποποίηση Εργασιακής Κατάστασης - Απολαβών Εργαζομένων</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownErgazomenoi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Εργαζόμενοι
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownErgazomenoi">
                <a class="dropdown-item" href="#">Σχετικά με τον COVID-19</a>
                <a class="dropdown-item" href="#">Άδειες</a>
                <a class="dropdown-item" href="#">Φορολογικές Εισφορές - Ένσημα</a>
                <a class="dropdown-item" href="#">Κατώτατος Μισθός - Δώρα</a>
                <a class="dropdown-item" href="#">Μέριμνα για ΑΜΕΑ</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="#">Άνεργοι</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="#">Συνταξιούχοι</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="../index-level/contact.php">Επικοινωνία</a>
            </li>
            <li class="nav-item">
              <?php
                // Check if the user is already logged in, if yes then show user's name
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
              ?>
                  <a class="nav-link text-dark" href="#">Username</a>
              <?php } else { ?>
                  <a class="nav-link text-dark" href="../index-level/login.php">Σύνδεση</a>
              <?php } ?>
            </li>
            <?php
              // Check if the user is already logged in, if yes then show user's name
              if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            ?>
              <li class="nav-item">
                <a class="nav-link text-dark" href="../index-level/logout.php">Αποσύνδεση</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- NOTE: Navigation section ends here -->
  </header>



<!-- Page Content -->
<div class="container my-4">
  <!-- NOTE: breadcrumb section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
      <li class="breadcrumb-item"><a href="contact.php">Επικοινωνία</a></li>
      <li class="breadcrumb-item active" aria-current="page">Κλείσιμο Ραντεβού</li>
    </ol>
  </nav>
  <!-- NOTE: breadcrumb section ends here -->

  <!-- NOTE: alert section starts here -->
  <div class="alert alert-danger text-center" role="alert">
    Λόγω του καθολικού lockdown, μπορείτε να προσέλθετε στα γραφεία του υπουργείου
    <strong>
    μόνο κατόπιν ραντεβού.
    </strong>
    <!-- <br> -->
    </div>
  <!-- NOTE: alert section ends here -->


  <!-- NOTE: contact info section starts here -->
    <form id="suspForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Κλείσιμο Ραντεβού</h1>
          <h2 class="py-2">Βρείτε παράρτημα με βάση την περιφερειακή σας ενότητα</h2>
          <div class="form-group row">
            <label for="DOY" class="col-sm-2 col-form-label">Περιφερειακή Ενότητα:</label>
            
            <select class="select" name="pe" id="DOY"> <!--oninput="showTab()">-->
              <?php
                echo "<option value=\"default\"";
                if(empty($pesaved) || $pesaved =="default"){
                  echo " selected";
                }
                echo ">Επιλέξτε</option>";
                while( $row = mysqli_fetch_array($res)){
                  echo "<option value=\"$row[0]\"";
                  if($pesaved == $row[0]){
                    echo " selected";
                  }
                  echo ">$row[0]</option>";
                }
               ?>
            </select>
            
            <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
          </div>
          <div class = "tab" style="<?php echo (!empty($toprint)) ? "display: inline;" : "display: none;";?>">
            <div class="form-group row">
                <label for="BRANCH" class="col-sm-2 col-form-label">Παράρτημα:</label>
                <!--Branch drop down-->
            
                <select class="select form-control" name="brn" id="BRANCH">
                    <?php
                        echo "<option value=\"default\"";
                        if(empty($toprint) || $toprint == "default"){
                            echo " selected";
                        }
                        echo ">Επιλέξτε</option>";
                        $temp = mysqli_query($link, "SELECT * FROM branch WHERE RegUnit = \"$pesaved\"");
                        while($brsaved = mysqli_fetch_array($temp)){
                            echo "<option value=\"$brsaved\"";
                            if($toprint == $brsaved[0]){
                                echo "selected";
                            }
                            echo ">$brsaved[0]</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
          </div>
          
          <!--should appear after a selection has been made to ^-->
          
          <div class="tab" style="<?php echo (!empty($toprint)) ? "display: inline;" : "display: none;";?>">
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
                <label class="col-sm-2 col-form-label">Επιλέξτε Ημερομηνία:</label>
                <div class="form-group row">
                    <label for="begOfSusp" class="col-sm-2 col-form-label">Από:</label>
                    <div class="col-10">
                        <!-- <input type="date" id="begOfSusp" min="2021-01-01">-->
                        
                        <!---->
                        
                        <input type="text" id="begOfSusp">
                        
                        <!---->
                        
                        <input type="time" id="TimeSusp">
                        <div class="invalid-feedback">Η επιλογή ημερομηνίας είναι υποχρεωτική.</div>
                    </div>
                </div>
          </div>

        <button type="submit" class="btn btn-primary" id="nextBtn"><?php echo (empty($pesaved) || $pesaved == "default") ? "Εύρεση παραρτημάτων" : "Οριστικοποίηση Ραντεβού";?></button>
    </form>
    </div>
<!-- End of Content -->

<script>
    function valiDate(){
        var br = document.getElementById("BRANCH");
        var fn = document.getElementById("FirstName");
        var ln = document.getElementById("LastName");
        var valid1 = true;
        var valid2 = true;
        var valid3 = true;
        // var valid = true;
        var erstr1 = new String();
        var erstr2 = new String();
        var erstr3 = new String();
        
        var frow1 = br.parentNode;
        var frow2 = fn.parentNode.parentNode;
        var frow3 = ln.parentNode.parentNode;
        
        var ncn1;
        var ncn2;
        var ncn3;
        
        //var x, i, input, valid = true;
        // x = document.getElementsByClassName("tab");
        // formGroups = x[currentTab].getElementsByClassName("form-group row");
        
        // for(i=0;i<formGroups.length;i++{
            // input = formGroups[i].getElementsByTagName("input");
            if(br.value == "default"){
                if(br.className.indexOf(" is-invalid") == -1){
                    br.className += " is-invalid";
                }
                erstr1+= "Η επιλογή παραρτήματος είναι υποχρεωτική!\n";
                valid1 = false;
            }
            if(fn == ""){ 
                if(fn.className.indexOf(" is-invalid") == -1){
                    fn.className += " is-invalid";
                }
                erstr2+= "Η εισαγωγή ονόματος είναι υποχρεωτική!\n";
                valid2 = false;
            }
            if(ln.value == ""){
                if(ln.className.indexOf(" is-invalid") == -1){
                    ln.className += " is-invalid";
                }
                erstr3+= "Η εισαγωγή επωνύμου είναι υποχρεωτική!\n";
                valid3 = false;
            }
            
            if(!valid1){
                if(br.className.indexOf(" is-invalid") == -1){
                    br.className += " is-invalid";
                }
                if(frow1.className.indexOf(" has-danger") == -1){
                    frow1.className += " has-danger";
                }
            }else{
                if(br.className.indexOf(" is-invalid") !== -1){
                    ncn1 = br.className.replace(" is-invalid", "");
                    br.className = ncn1;
                }
                if(frow1.className.indexOf(" has-danger") !== -1){
                    ncn1 = frow1.className.replace(" has-danger", "");
                }
                br.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            }
            
            if(!valid2){
                if(fn.className.indexOf(" is-invalid") == -1){
                    fn.className += " is-invalid";
                }
                if(frow2.className.indexOf(" has-danger") == -1){
                    frow2.className += " has-danger";
                }
            }else{
                if(fn.className.indexOf(" is-invalid") !== -1){
                    ncn2 = fn.className.replace(" is-invalid", "");
                    fn.className = ncn2;
                }
                if(frow2.className.indexOf(" has-danger") !== -1){
                    ncn2 = frow2.className.replace(" has-danger", "");
                }
                fn.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            }
            
            if(!valid3){
                if(ln.className.indexOf(" is-invalid") == -1){
                    ln.className += " is-invalid";
                }
                if(frow3.className.indexOf(" has-danger") == -1){
                    frow3.className += " has-danger";
                }
            }else{
                if(ln.className.indexOf(" is-invalid") !== -1){
                    ncn3 = ln.className.replace(" is-invalid", "");
                    ln.className = ncn3;
                }
                if(frow3.className.indexOf(" has-danger") !== -1){
                    ncn3 = frow3.className.replace(" has-danger", "");
                }
                ln.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            }
        // }
        return valid;
    }

    // var today = new Date();
    // var dd = today.getDate();
    // var mm = today.getMonth()+1; //January is 0!
    // var yyyy = today.getFullYear();
    // if(dd<10){
      // dd='0'+dd
    // }
    // if(mm<10){
      // mm='0'+mm
    // }
    // today = yyyy+'-'+mm+'-'+dd;
    // document.getElementById("begOfSusp").setAttribute("min", today);
    
    // jQuery(document).ready(function($) {
        // $(".datepicker").datepicker({
            // beforeShowDay: function(date) {
                // var day = date.getDay();
                // return [(day != 1), ''];
            // }
        // })
    // });
    
    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      var dropdowns = document.getElementsByTagName("select");
      var dropdownfirst = dropdowns[0];
      //... and fix the Previous/Next buttons:
      if (dropdownfirst.value != "default") {
        x[0].style.display = "block";
      }else{
        x[0].style.display = "none";
      }
    }
    
    // function keepres(){
        // sessionStorage.setItem('SelectedItem');
        // case :
    // }
    </script>

    
    
<!-- NOTE: Footer section starts here -->
<footer class="py-0 bg-light">
  <div class="container">
    <p class="m-0 text-center">Copyright &copy; Ypakp 2020</p>
  </div>
</footer>
<!-- NOTE: Footer section ends here -->
<!-- Contact form JavaScript -->
<!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
<!-- Bootstrap core JavaScript -->
    
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../js/appdatepick.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!--
        <button type="submit" class="btn btn-primary" id="nextBtn"> <?php //echo (empty($pesaved) || $pesaved == "default") ? "Εύρεση παραρτημάτων" : "Οριστικοποίηση Ραντεβού";?></button>
        -->
        <!-- Circles which indicates the steps of the form: -->
        <!-- <div style="text-align:center;margin-top:40px;"> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
        <!-- </div> -->
        
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
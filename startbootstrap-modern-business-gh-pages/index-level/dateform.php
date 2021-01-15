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
require_once "../top.php";
?>
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
          <div class="form-group row">
            <div class = "tab" style="<?php echo (!empty($toprint)) ? "display: inline;" : "display: none;";?>">
                <label for="BRANCH" class="col-sm-2 col-form-label">Παράρτημα:</label>
                <!--Branch drop down-->
            
                <select class="select form-control" id="BRANCH">
                  <?php
                    if(!empty($toprint)){
                        echo $toprint;
                    }
                  ?> 
                </select>
            </div>
            <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
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

        <button type="submit" class="btn btn-primary" id="nextBtn"><?php echo (empty($pesaved) || $pesaved == "default") ? "Εύρεση παραρτημάτων" : "Οριστικοποίηση Ραντεβού";?></button>
        <!-- Circles which indicates the steps of the form: -->
        <!-- <div style="text-align:center;margin-top:40px;"> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
          <!-- <span class="step"></span> -->
        <!-- </div> -->

      </form>
    </div>
<!-- End of Content -->

<script>
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
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
  </body>
</html>
<?php require_once "../bottom.php"; ?>
<?php
  $title="Επικοινωνία - Κλείστε Ραντεβού";
  require_once "../top.php";
  require_once "../config.php";
  // include_once('sdi1700060.sql');
  // if($_POST['Name']){
      // $Name = $_POST['Name'];
      // if()
  // }
  $res = mysqli_query($link,"Select * FROM regionalunit");
//path cd /mnt/c/xampp/htdocs
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
  <form id="suspForm" action="">
        <h1>Κλείσιμο Ραντεβού</h1>
          <h2 class="py-2">Βρείτε παράρτημα με βάση την περιφερειακή σας ενότητα</h2>
          <div class="form-group row">
            <label for="DOY" class="col-sm-2 col-form-label">Περιφερειακή Ενότητα:</label>
            
            <select class="select" id="DOY" oninput="showTab()">
              <option value="default" selected>Επιλέξτε</option>
             
              <?php
                // $res = mysqli_query($link,"Select * FROM regionalunit");
                $i = 1;
                while( $row = mysqli_fetch_array($res)){
                    echo "<option value=\"$row[0]\">$row[0]</option>";
                }
               ?>
            </select>
            
            <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
          </div>
          <div class="form-group row">
            <div class = "tab">
                <label for="BRANCH" class="col-sm-2 col-form-label">Παράρτημα:</label>
                <!--Branch drop down-->
            
                <select class="select" id="BRANCH">
                 <option value="default" selected>Επιλέξτε</option>
                  <?php
                    
                    // echo "<script>console.log($i)</script> ";
                    
                    $restemp = mysqli_query($link, "SELECT * FROM branch");
                    
                    
                    // $res2 = mysqli_query($link,"Select * FROM branch WHERE RegUnit = ".regunit);
                    while( $row2 = mysqli_fetch_array($restemp)){
                        echo "<option value=\"$row2[0]\">$row2[0] - $row2[1]</option>";
                    }
                  ?> 
                </select>
            </div>
            <?php                    
                // $res2 = mysqli_query($link,"Select * FROM branch");
                // while( $row = mysqli_fetch_array($res2)){
                    // echo "$row[0].$row[1]<br/>";
                    // // $res2 = mysqli_query($link,"Select * FROM branch WHERE row[0].row[1] == ")
                // }
            ?>
            
            
            <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
          </div>

        <div class="tab">
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
        </div>


        <button type="submit" class="btn btn-primary" id="nextBtn">Οριστικοποίηση Ραντεβού</button>
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
      // <?php
        // $tempstring = "<option value=\"default\" selected>Επιλέξτε</option>";
        // $res2 = mysqli_query($link,"Select * FROM branch WHERE RegUnit = ".document.getElementById("DOY").value);
        // while( $row2 = mysqli_fetch_array($res2)){
            // $branchstring += "<option value=\"$row2[0]\">$row2[0] - $row2[1]</option>";
        // }
      // ?>
      
      
      // if (n == (x.length - 1)) {
      //   document.getElementById("nextBtn").innerHTML = "Υποβολή";
      // } else {
      //   document.getElementById("nextBtn").innerHTML = "Επόμενο";
      // }
    }
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
  </body>
</html>
<?php require_once "../bottom.php"; ?>
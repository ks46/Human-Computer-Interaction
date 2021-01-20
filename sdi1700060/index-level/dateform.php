<?php
  // Initialize the session
  if(!isset($_SESSION)) {
    session_start();
  }

  require_once "../config.php";

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
    $branchName = trim($_POST["brn"]);
    if($branchName != "default"){
      $_SESSION["branchName"] = $branchName;
      header("location: dateform2.php");
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
      <li class="breadcrumb-item active" aria-current="page">Κλείσιμο Ραντεβού - Εύρεση Παραρτήματος</li>
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
          <h2 class="py-2 lead">Βρείτε παράρτημα με βάση την περιφερειακή σας ενότητα</h2>
          <div class="form-group row">
            <label for="DOY" class="col-sm-3 col-form-label">Περιφερειακή Ενότητα:</label>
            <select class="col-lg-5 form-control custom-select" name="pe" id="DOY">
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
            <span class="col-lg-4 form-text invalid-feedback">Το πεδίο είναι υποχρεωτικό.</span>
          </div>

          <div class = "tab" style="<?php echo (!empty($toprint)) ? "display: inline;" : "display: none;";?>">
            <div class="form-group row">
                <label for="BRANCH" class="col-sm-3 col-form-label">Παράρτημα:</label>
                <!--Branch drop down-->
                <select class="col-lg-5 form-control custom-select" name="brn" id="BRANCH">
                    <?php
                        echo "<option value=\"default\"";
                        if(empty($toprint) || $toprint == "default"){
                            echo " selected";
                        }
                        echo ">Επιλέξτε</option>";
                        $temp = mysqli_query($link, "SELECT * FROM branch WHERE RegUnit = \"$pesaved\"");
                        while($brsaved = mysqli_fetch_array($temp)){
                            echo "<option value=\"$brsaved[0]\"";
                            if($toprint == $brsaved[0]){
                                echo "selected";
                            }
                            echo ">$brsaved[0]</option>";
                        }
                    ?>
                </select>
            </div>
            <span class="col-lg-4 form-text invalid-feedback">Το πεδίο είναι υποχρεωτικό.</span>
          </div>

        <button type="submit" class="btn btn-primary" id="nextBtn"><?php echo (empty($pesaved) || $pesaved == "default") ? "Εύρεση παραρτημάτων" : "Εύρεση Ημερομηνιών";?></button>
    </form>
    </div>
<!-- End of Content -->
<?php
require_once "../bottom.php";
?>

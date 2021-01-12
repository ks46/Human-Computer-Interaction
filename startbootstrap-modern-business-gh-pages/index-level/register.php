<?php
require_once "../config.php";                             // Include config file

// Define variables and initialize with empty values
$username = $password = $confirm_password = $first_name = $last_name = $AFM = $company_name = "";
$username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = $AFM_err = $select_err = $company_name_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate username
  if(empty(trim($_POST["username"]))) {
    $username_err = "Συμπληρώστε το πεδίο.";
  } else {
    // Prepare a select statement
    $sql = "SELECT AFM FROM user WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = trim($_POST["username"]);

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)) {
        // store result
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "Αυτό το όνομα χρήστη χρησιμοποιείται ήδη.";
        } else {
          $username = trim($_POST["username"]);
        }
      } else {
          echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate password
  if(empty(trim($_POST["password"]))) {
    $password_err = "Συμπληρώστε το πεδίο.";
  } elseif(strlen(trim($_POST["password"])) < 6) {
    $password_err = "Ο κωδικός θα πρέπει να έχει τουλάχιστον 6 χαρακτήρες.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Συμπληρώστε το πεδίο.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Ο κωδικός δεν ταιριάζει και στα δύο πεδία.";
    }
  }

  // Validate first_name
  if(empty(trim($_POST["first_name"]))) {
    $first_name_err = "Συμπληρώστε το πεδίο.";
  } else {
    $first_name = trim($_POST["first_name"]);
  }

  // Validate last_name
  if(empty(trim($_POST["last_name"]))) {
    $last_name_err = "Συμπληρώστε το πεδίο.";
  } else {
    $last_name = trim($_POST["last_name"]);
  }

  // Validate AFM
  if(empty(trim($_POST["AFM"]))) {
    $AFM_err = "Συμπληρώστε το πεδίο.";
  } else {
    // Prepare a select statement
    $sql = "SELECT AFM FROM user WHERE AFM = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "i", $param_AFM);

      // Set parameters
      $param_AFM = trim($_POST["AFM"]);

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)) {
        // store result
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1) {
          $AFM_err = "Υπάρχει ήδη λογαριασμός με αυτόν τον αριθμό ΑΦΜ.";
        } else {
          $AFM = trim($_POST["AFM"]);
        }
      } else {
          echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }


  // Check input errors before inserting in database
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO user (username, password, AFM, first_name, last_name, type) VALUES (?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_AFM, $param_first_name, $param_last_name, $param_type);

      // Set parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
      // $param_AFM = 123456788;
      $param_first_name = $first_name;
      $param_last_name = $last_name;
      $param_type = "employee";

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)) {
        // Redirect to login page
        header("location: login.php");
      } else {
        echo "Προέκυψε κάποιο λάθος, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>

<?php
$title = "Εγγραφή νέου χρήστη";
require_once "../top.php";
?>

<!-- NOTE: Page Content starts here -->
<div class="container mt-4">
  <!-- NOTE: Breadcrumbs section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">Εγγραφή νέου χρήστη</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <!-- NOTE: form section starts here -->
  <section>
    <h1>Εγγραφή νέου χρήστη</h1>
    <p class="lead">Συμπληρώστε την ακόλουθη φόρμα για να εγγραφείτε στο site του Υπουργείου Εργασίας</p>
    <p>Τα πεδία με αστερίσκο * είναι υποχρεωτικά.</p>

    <form class="mt-4 mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <!-- <h2 class="mb-3">Στοιχεία Λογαριασμού</h2> -->
      <!-- Type of user -->
      <div class="form-group row <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="user_type" class="col-sm-3 col-form-label">Ιδιότητα *</label>
        <div class="col-lg-5">
          <select class="custom-select" oninput="showTab()">
            <option value="default" selected>Επιλέξτε ιδιότητα</option>
            <option value="employee">Εργαζόμενος</option>
            <option value="employer">Εργοδότης</option>
          </select>
        </div>
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>

      <!-- Username -->
      <div class="form-group row <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="username" class="col-sm-3 col-form-label">Όνομα Χρήστη *</label>
        <div class="col-lg-5">
          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" id="username" placeholder="MariaPapadopoulou" required>
        </div>
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>

      <!-- Password -->
      <div class="form-group row <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label for="password" class="col-sm-3 col-form-label">Κωδικός (6 ψηφία τουλάχιστον) *</label>
        <div class="col-lg-5">
          <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" id="password" placeholder="password" required>
        </div>
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>

      <!-- Password confirmation -->
      <div class="form-group row <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <label for="password" class="col-sm-3 col-form-label">Επιβεβαίωση Κωδικού *</label>
        <div class="col-lg-5">
          <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" id="confirm_password" placeholder="password" required>
        </div>
        <span class="help-block"><?php echo $confirm_password_err; ?></span>
      </div>

      <!-- First name -->
      <div class="form-group row <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
        <label for="first_name" class="col-sm-3 col-form-label">Όνομα *</label>
        <div class="col-lg-5">
          <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" id="first_name" placeholder="Μαρία" required>
        </div>
        <span class="help-block"><?php echo $first_name_err; ?></span>
      </div>

      <!-- Last name -->
      <div class="form-group row <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
        <label for="last_name" class="col-sm-3 col-form-label">Επώνυμο *</label>
        <div class="col-lg-5">
          <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" id="last_name" placeholder="Παπαδοπούλου" required>
        </div>
        <span class="help-block"><?php echo $last_name_err; ?></span>
      </div>

      <!-- AFM -->
      <div class="form-group row <?php echo (!empty($AFM_err)) ? 'has-error' : ''; ?>">
        <label for="AFM" class="col-sm-3 col-form-label">
          <abbr title="Αριθμός Φορολογικού Μητρώου">Α.Φ.Μ.</abbr> *
        </label>
        <div class="col-lg-5">
          <input type="number" name="AFM" class="form-control" value="<?php echo $AFM; ?>" id="AFM" min="000000000" max="999999999" placeholder="123456789" required>
        </div>
        <span class="help-block"><?php echo $AFM_err; ?></span>
      </div>

      <!-- NOTE: the following fields will appear only if user is an employee -->
      <div class="tab">
        <!-- company name for employees -->
        <div class="form-group row mt-0 <?php echo (!empty($AFM_err)) ? 'has-error' : ''; ?>">
          <label for="AFM" class="col-sm-3 col-form-label">Εταιρεία Απασχόλησης *</label>
          <div class="col-lg-5">
            <select class="custom-select">
              <option value="deafault" selected>Επιλέξτε εταιρεία</option>
              <!-- retrieve all company names from database as separate options -->
              <?php
              // Prepare a select statement
              $sql = "SELECT Company_Name FROM company";
              if($stmt = mysqli_prepare($link, $sql)) {
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)) {
                  $result = mysqli_stmt_get_result($stmt);
                  // fetch company name from each row of result
                  while ($company_name = mysqli_fetch_array($result)[0]) {
                    ?>
                    <option value=<?php echo $company_name; ?>>
                      <?php echo $company_name; ?>
                    </option>
                    <?php
                  }
                } else {
                  echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
              }
              ?>
            </select>
          </div>
          <!-- <span class="help-block"><?php echo $select_err; ?></span>    -->
        </div>

        <!-- Has young children?? NOTE: available ONLY IF user registers as an employee -->
        <div class="form-group row">
          <label class="form-check-label col-sm-3" for="has_young_children">Έχω παιδιά κάτω των 12 ετών</label>
          <div class="col-lg-5">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has_young_children">
            </div>
          </div>
        </div>
      </div>

      <div class="tab">
        <!-- Company_name for employers -->
        <!-- Company name -->
        <div class="form-group row mt-0 <?php echo (!empty($company_name_err)) ? 'has-error' : ''; ?>">
          <label for="Company_Name" class="col-sm-3 col-form-label">Επωνυμία Εταιρείας *</label>
          <div class="col-lg-5">
            <input type="text" name="Company_Name" class="form-control" value="<?php echo $company_name; ?>" id="Company_Name" placeholder="" required>
          </div>
        <span class="help-block"><?php echo $company_name_err; ?></span>
        </div>
      </div>

      <!-- Buttons -->
      <div class="form-group mt-4">
        <input type="submit" class="btn btn-primary" value="Εγγραφή">
        <input type="reset" class="btn btn-link mx-3" value="Καθαρισμός πεδίων">
      </div>
    </form>

  </section>
  <!-- NOTE: form section ends here -->

</div>
<!-- NOTE: Page Content ends here -->
<script>
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  var dropdowns = document.getElementsByTagName("select");
  var dropdownfirst = dropdowns[0];
  //... and fix the Previous/Next buttons:
  if (dropdownfirst.value == "employer") {
    x[0].style.display = "none";
    x[1].style.display = "block";
  } else if(dropdownfirst.value == "employee"){
    x[1].style.display = "none";
    x[0].style.display = "block";
  } else{
    x[0].style.display = x[1].style.display = "none";
  }
  // if (n == (x.length - 1)) {
  //   document.getElementById("nextBtn").innerHTML = "Υποβολή";
  // } else {
  //   document.getElementById("nextBtn").innerHTML = "Επόμενο";
  // }
}
</script>
<?php require_once "../bottom.php"; ?>

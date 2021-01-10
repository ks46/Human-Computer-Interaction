<?php
require_once "../config.php";                             // Include config file
//
// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $afm = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $afm_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate username
  if(empty(trim($_POST["username"]))) {
    $username_err = "Εισάγετε όνομα χρήστη.";
  } else {
    // Prepare a select statement
    $sql = "SELECT AFM FROM users WHERE username = ?";

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
          $username_err = "Αυτό το όνομα χρήστη χρησιμοπιείται ήδη.";
        } else {
          $username = trim($_POST["username"]);
        }
      } else {
          echo "Προέκυψε κάποιο λάθος, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate password
  if(empty(trim($_POST["password"]))) {
    $password_err = "Εισάγετε κωδικό.";
  } elseif(strlen(trim($_POST["password"])) < 6) {
    $password_err = "Ο κωδικός θα πρέπει να έχει τουλάχιστον 6 χαρακτήρες.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Επιβεβαιώστε τον κωδικό σας.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Ο κωδικός δεν ταιριάζει και στα δύο πεδία.";
    }
  }

  // Check input errors before inserting in database
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    if($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

      // Set parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

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

    <!-- action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2 class="mb-3">Στοιχεία Λογαριασμού</h2>

      <!-- Username -->
      <div class="form-group row <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="username" class="col-sm-2 col-form-label">Όνομα Χρήστη</label>
        <div class="col-lg-5">
          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" id="username" placeholder="username" required>
        </div>
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>

      <!-- Password -->
      <div class="form-group row <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label for="password" class="col-sm-2 col-form-label">Κωδικός</label>
        <div class="col-lg-5">
          <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" id="password" placeholder="password" required>
        </div>
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>

      <!-- Password confirmation -->
      <div class="form-group row <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <label for="password" class="col-sm-2 col-form-label">Επιβεβαίωση Κωδικού</label>
        <div class="col-lg-5">
          <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" id="confirm_password" placeholder="password" required>
        </div>
        <span class="help-block"><?php echo $confirm_password_err; ?></span>
      </div>

      <h2 class="py-3">Στοιχεία Χρήστη</h2>

      <!-- First name -->
      <div class="form-group row <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
        <label for="firstname" class="col-sm-2 col-form-label">Όνομα</label>
        <div class="col-lg-5">
          <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" id="firstname" required>
        </div>
        <span class="help-block"><?php echo $firstname_err; ?></span>
      </div>

      <!-- Last name -->
      <div class="form-group row <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
        <label for="lastname" class="col-sm-2 col-form-label">Επώνυμο</label>
        <div class="col-lg-5">
          <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" id="lastname" required>
        </div>
        <span class="help-block"><?php echo $lastname_err; ?></span>
      </div>

      <!-- AFM -->
      <div class="form-group row <?php echo (!empty($afm_err)) ? 'has-error' : ''; ?>">
        <label for="afm" class="col-sm-2 col-form-label">
          <abbr title="Αριθμός Φορολογικού Μητρώου">Α.Φ.Μ.</abbr>
        </label>
        <div class="col-lg-5">
          <input type="number" name="afm" class="form-control" value="<?php echo $afm; ?>" id="afm" min="000000000" max="999999999" required>
          <!-- <input type="text" name="afm" class="form-control" value="<?php echo $afm; ?>" id="afm" required pattern="[0-9]{9}"> -->
        </div>
        <span class="help-block"><?php echo $afm_err; ?></span>
      </div>

      <!-- Company_name -->

      <!-- Is an Employer? -->
      <!-- TODO: how do we pass this into php ?? -->
      <div class="form-group row">
        <label class="form-check-label col-sm-2" for="is_employer">Είμαι Εργοδότης</label>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_employer">
          </div>
        </div>
      </div>

      <!-- Buttons -->
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Εγγραφή">
        <input type="reset" class="btn btn-link mx-3" value="Καθαρισμός πεδίων">
      </div>
    </form>

  </section>
  <!-- NOTE: form section ends here -->

</div>
<!-- NOTE: Page Content ends here -->

<?php require_once "../bottom.php"; ?>

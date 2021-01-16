<?php
// Initialize the session
if(!isset($_SESSION)) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}

// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if(empty(trim($_POST["username"]))){
      $username_err = "Εισάγετε το όνομα χρήστη σας.";
  } else{
      $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if(empty(trim($_POST["password"]))){
      $password_err = "Εισάγετε τον κωδικό σας.";
  } else{
      $password = trim($_POST["password"]);
  }

  // Validate credentials
  if(empty($username_err) && empty($password_err)){
    // Prepare a select statement
    $sql = "SELECT AFM, username, password FROM user WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $AFM, $username, $hashed_password);
          if(mysqli_stmt_fetch($stmt)) {
            if(password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["AFM"] = $AFM;
              $_SESSION["username"] = $username;

              // Redirect user to welcome page      // TODO: redirect to user's profile ???
              header("location: index.php");
            } else {
              // Display an error message if password is not valid
              $password_err = "Λανθασμένος κωδικός.";
            }
          }
        } else {
          // Display an error message if username doesn't exist
          $username_err = "Δεν υπάρχει λογαριασμός με αυτό το όνομα χρήστη.";
        }
      } else {
        echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
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
$title = "Σύνδεση Χρήστη";
require_once "../top.php" ?>


<div class="container mt-5">
  <!-- NOTE: form section starts here -->
  <section style="margin: auto; width: 60%; padding: 10px;">
  <!-- <section style="padding: 70px 0;  text-align: center;"> -->
    <h1>Σύνδεση Χρήστη</h1>
    <p class="lead">Συμπληρώστε τα στοιχεία σας για να συνδεθείτε</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

      <!-- Submit Button -->
      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Σύνδεση">
      </div>
      <p class="lead mt-5">Ξεχάσατε τον κωδικό σας; <a class="btn btn-link" href="#" role="button">Κάντε Επαναφορά Κωδικού</a></p>
      <p class="lead mb-3">Δεν έχετε λογαριασμό; <a class="btn btn-primary ml-3" href="register.php" role="button">Κάντε εγγραφή</a></p>
    </form>
  </section>
  <!-- NOTE: form section ends here -->
</div>

<?php require_once "../bottom.php"; ?>

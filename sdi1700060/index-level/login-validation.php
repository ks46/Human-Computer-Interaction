<?php
// Initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  // TODO: redirect to user's previous page, or user's profile
  header("location: index.php");
  exit;
}

// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  // Check if username is empty
  if (empty($username)) {
    $username_err = "Εισάγετε το όνομα χρήστη σας";
  }
  // Check if password is empty
  if (empty($password)) {
    $password_err = "Εισάγετε τον κωδικό σας";
  }
  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT AFM, username, password FROM user WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      // Set parameters
      $param_username = $username;
      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);
        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $AFM, $username, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();
              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["AFM"] = $AFM;
              $_SESSION["username"] = $username;
              // TODO: redirect to user's previous page, or user's profile
              header("location: index.php");
            } else {
              // Display an error message if password is not valid
              $password_err = "Λανθασμένος κωδικός";
            }
          }
        } else {
          // Display an error message if username doesn't exist
          $username_err = "Δεν υπάρχει λογαριασμός με αυτό το όνομα χρήστη";
        }
      } else {
        $err = "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>

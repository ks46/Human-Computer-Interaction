<?php
require_once "../config.php";                             // Include config file

/* NOTE: register form has the following inputs:
 * name                    html tag          restrictions
 *********************************************************************************************
 * user_type               select            cannot be left as default
 * username                input(text)       non-empty, unique inside user DB table
 * password                input(password)   non-empty, at least 6 characters
 * confirm password        input(password)   non-empty, at least 6 characters, same as password
 * first_name              input(text)       non-empty, only alpha chars
 * last_name               input(text)       non-empty, only alpha chars
 * AFM                     input(number)     non-empty, exactly 9 digits, unique inside user DB table
 * Company_Name            select            non-default, applies only to employees
 * hasChildYoungerThan12   checkbox          applies only to employees
 * employer_Company_Name   input(text)       non-empty, unique inside company DB table, applies only to employers
 * DOY                     select            non-default, applies only to employers
*/

// variables that store form values, initialized as empty
$user_type = $username = $password = $confirm_password = $first_name = $last_name = $AFM = $Company_Name = $employer_Company_Name = $DOY = "";
// variables that store error messages, initialized as empty
$user_type_err = $username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = $AFM_err = $Company_Name_err = $employer_Company_Name_err = $DOY_err = "";
// are all fields valid?
$is_form_valid = true;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // set form variables
  $user_type = $_POST["user_type"];
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $confirm_password = trim($_POST["confirm_password"]);
  $first_name = trim($_POST["first_name"]);
  $last_name = trim($_POST["last_name"]);
  $AFM = trim($_POST["AFM"]);
  $Company_Name = isset($_POST["Company_Name"]) ? $_POST["Company_Name"] : "";
  $hasChildYoungerThan12 = (isset($_POST["hasChildYoungerThan12"]) && $_POST["hasChildYoungerThan12"] == "1") ? 1 : 0;
  $employer_Company_Name = isset($_POST["employer_Company_Name"]) ? trim($_POST["employer_Company_Name"]) : "";
  $DOY = isset($_POST["DOY"]) ? $_POST["DOY"] : "";

  // Validate Type of user
  if ($user_type == "default") {
    $user_type_err = "Επιλέξτε ιδιότητα.";
    $is_form_valid = false;
  }
  // Validate username
  if (empty($username)) {
    $username_err = "Συμπληρώστε το πεδίο.";
    $is_form_valid = false;
  } else {
    // Prepare a select statement
    $sql = "SELECT AFM FROM user WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      // Set parameters
      $param_username = $username;
      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // store result
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "Αυτό το όνομα χρήστη χρησιμοποιείται ήδη.";
          $is_form_valid = false;
        }
      } else {
        echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate password
  if (empty($password)) {
    $password_err = "Συμπληρώστε το πεδίο.";
    $is_form_valid = false;
  } elseif (strlen($password) < 6) {
    $password_err = "Ο κωδικός θα πρέπει να έχει τουλάχιστον 6 χαρακτήρες.";
    $is_form_valid = false;
  }
  // Validate password confirmation
  if (empty($confirm_password)) {
    $confirm_password_err = "Συμπληρώστε το πεδίο.";
    $is_form_valid = false;
  } elseif (empty($password_err) && ($password != $confirm_password)) {
    $confirm_password_err = "Ο κωδικός δεν ταιριάζει και στα δύο πεδία.";
    $is_form_valid = false;
  }
  // Validate first_name
  if (empty($first_name)) {
    $first_name_err = "Συμπληρώστε το πεδίο.";
    $is_form_valid = false;
  } // elseif (!preg_match("/^[a-zA-Zα-ωΑ-Ω]*$/", $first_name)) {
  //   $first_name_err = "Μόνο γράμματα επιτρέπονται στο πεδίο Όνομα";
  //   $is_form_valid = false;
  // }
  // Validate last_name
  if (empty($last_name)) {
    $last_name_err = "Συμπληρώστε το πεδίο.";
    $is_form_valid = false;
  } // elseif (!preg_match("/^[a-zA-Zα-ωΑ-Ω]*$/", $last_name)) {
  //   $last_name_err = "Μόνο γράμματα επιτρέπονται στο πεδίο Επώνυμο";
  //   $is_form_valid = false;
  // }

  // Validate AFM
  if (empty($AFM)) {
    $AFM_err = "Συμπληρώστε το πεδίο.";
    $is_form_valid = false;
  } elseif (!preg_match("/^\d{9}$/", $AFM)) {
    $AFM_err = "Ο αριθμός ΑΦΜ αποτελείται από 9 ακριβώς ψηφία.";
    $is_form_valid = false;
  } else {
    // Prepare a select statement
    $sql = "SELECT AFM FROM user WHERE AFM = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "i", $param_AFM);
      // Set parameters
      $param_AFM = $AFM;
      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // store result
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $AFM_err = "Υπάρχει ήδη λογαριασμός με αυτόν τον αριθμό ΑΦΜ.";
          $is_form_valid = false;
        }
      } else {
        echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate fields that only apply to specific type of user
  if ($user_type == "employee") {
    // Validate Company_Name
    if ($Company_Name == "default") {
      $Company_Name_err = "Επιλέξτε εταιρεία.";
      $is_form_valid = false;
    }
  } elseif ($user_type == "employer") {
    // Validate employer_Company_Name
    if (empty($employer_Company_Name)) {
      $employer_Company_Name_err = "Συμπληρώστε το πεδίο.";
      $is_form_valid = false;
    } else {
      // Prepare a select statement
      $sql = "SELECT Company_Name FROM company WHERE Company_Name = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_employer_Company_Name);
        // Set parameters
        $param_employer_Company_Name = $employer_Company_Name;
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          // store result
          mysqli_stmt_store_result($stmt);
          // make sure employer_Company_Name hasn't already been registered in db
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $employer_Company_Name_err = "Υπάρχει ήδη λογαριασμός για αυτήν την επωνυμία εταιρείας.";
            $is_form_valid = false;
          }
        } else {
          echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
      }
    }

    // Validate selected DOY
    if ($DOY == "default") {
      $DOY_err = "Επιλέξτε ΔΟΥ.";
      $is_form_valid = false;
    }
  }

  // insert new user in DB provided that all form fields are valid
  if ($is_form_valid) {
    // prepare an insert statement into user table
    $sql = "INSERT INTO user (username, password, AFM, first_name, last_name, type) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt_insert_user = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt_insert_user, "ssisss", $param_username, $param_password, $param_AFM, $param_first_name, $param_last_name, $param_type);
      // Set parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
      $param_AFM = $AFM;
      $param_first_name = $first_name;
      $param_last_name = $last_name;
      $param_type = $user_type;
      // execute query
      if (mysqli_stmt_execute($stmt_insert_user)) {
        // query executed successfully, can move on to next query
        // prepare statements according to type of user
        if ($user_type == "employee") {
          // prepare an insert statement into employee table
          $sql = "INSERT INTO employee (AFM, companyName, hasChildYoungerThan12) VALUES (?, ?, ?)";
          if($stmt_insert_employee = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt_insert_employee, "isi", $param_AFM, $param_companyName, $param_hasChildYoungerThan12);
            // Set parameters
            $param_AFM = $AFM;
            $param_companyName = $Company_Name;
            $param_hasChildYoungerThan12 = $hasChildYoungerThan12;
            // execute query
            if (mysqli_stmt_execute($stmt_insert_employee)) {
              // query executed successfully, can redirect to next page
              $is_form_valid = true;
            } else {
              $is_form_valid = false;
              echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
              echo mysqli_stmt_error($stmt_insert_employee);
            }
            mysqli_stmt_close($stmt_insert_employee);
          }
        } elseif ($user_type == "employer") {
          $sql = "INSERT INTO employer (AFM, Company_Name) VALUES (?, ?)";
          if ($stmt_insert_employer = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt_insert_employer, "ss", $param_AFM, $param_companyName);
            // Set parameters
            $param_AFM = $AFM;
            $param_companyName = $employer_Company_Name;
            // execute query
            if (mysqli_stmt_execute($stmt_insert_employer)) {
              // query executed successfully, can redirect to next page
              $sql = "INSERT INTO company (Company_Name, Doy) VALUES (?, ?)";
              if ($stmt_insert_company = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt_insert_company, "ss", $param_companyName, $param_Doy);
                // Set parameters
                $param_companyName = $employer_Company_Name;
                $param_Doy = $DOY;
                // execute query
                if (mysqli_stmt_execute($stmt_insert_company)) {
                  $is_form_valid = true;
                }else {
                  $is_form_valid = false;
                  echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
                }
                mysqli_stmt_close($stmt_insert_company);
              }
            } else {
              $is_form_valid = false;
              echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
            }
            mysqli_stmt_close($stmt_insert_employer);
          }
        }
      } else {
        $is_form_valid = false;
        echo "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα.";
      }
      // Close statement
      mysqli_stmt_close($stmt_insert_user);
    }
  }

  // Close connection

  if ($is_form_valid) {
    mysqli_close($link);
    header("location: successful-register.php");                     // Redirect
  }
}
?>

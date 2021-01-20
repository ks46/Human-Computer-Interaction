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
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
                <a class="dropdown-item" href="../covid19/anastoli-info.php">Αναστολή Συμβάσεων Εργαζομένων</a>
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
                  <a class="nav-link text-dark" href="#">
                    <?php echo $_SESSION["username"] ?>
                  </a>
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

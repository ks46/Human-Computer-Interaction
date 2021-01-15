<?php

// require_once "chromephp-master/ChromePhp.php";
 
// Initialize the session
if(!isset($_SESSION)) {
  session_start();
}

// Include config file
$title = "Επιβεβαίωση";
require_once "../config.php";
require_once "../top.php";

?>
  <div class="container mt-4">
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Τα στοιχεία σας άλλαξαν επιτυχώς!</h4>
      <hr>
      <a class="btn btn-success" href="userprofile.php" role="button">ΟΚ.</a>
    </div>
  </div>

<?php
require_once "../bottom.php";
?>
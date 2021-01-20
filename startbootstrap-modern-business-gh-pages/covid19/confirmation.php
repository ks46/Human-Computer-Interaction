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
  <div class="container my-5">
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Η αίτησή σας υποβλήθηκε επιτυχώς!</h4>
      <hr>
      <a class="btn btn-success" href="anastoli-info.php" role="button">ΟΚ</a>
    </div>
  </div>

<?php
require_once "../bottom.php";
?>

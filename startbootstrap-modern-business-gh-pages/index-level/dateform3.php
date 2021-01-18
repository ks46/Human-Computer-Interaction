<?php
  require_once "../config.php";

  if(!isset($_SESSION)) {
    session_start();
  }
  
  $title="Επικοινωνία - Κλείστε Ραντεβού";
  require_once "../top.php";
?>


<?php
  require_once "../bottom.php";
?>
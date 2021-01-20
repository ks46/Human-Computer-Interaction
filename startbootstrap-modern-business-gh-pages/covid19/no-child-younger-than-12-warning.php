<?php
$title = "ΠΡΟΣΟΧΗ";
require_once "../top.php";
require_once "../config.php";
?>

  <div class="container mt-4">
    <div class="alert alert-danger" role="alert">
      <p>Δεν είστε δικαιούχος για την συγκεκριμένη αίτηση.</br>Αν έχετε αποκτήσει τέκνο και δεν το έχετε δηλώσει
      στην πλατφόρμα, <a href="#">κάντε αλλαγή των στοιχείων σας</a>.</br>ΠΡΟΣΟΧΗ: η καταχώριση ψευδών στοιχείων διώκεται από τον νόμο.</p>
      <hr>
      <a class="btn btn-danger" href="../index-level/index.php" role="button">Επιστροφή στην αρχική</a>
    </div>
  </div>

<?php
  require_once "../bottom.php";
?>

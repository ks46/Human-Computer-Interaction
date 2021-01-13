<?php
$title = "ΠΡΟΣΟΧΗ ";
require_once "../top.php";
require_once "../config.php";
?>

  <div class="container mt-4">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Μη Εξουσιοδοτημένος Λογαριασμός για Υποβολή Αίτησης!</h4>
      <p>Η συγκεκριμένη αίτηση μπορεί να υποβληθεί μόνο από έναν λογαριασμό <b>εργοδότη</b>.</br> 
      Αποσυνδεθείτε και συνδεθείτε ξανά με έναν λογαρισμό εργοδότη.</p>
      <hr>
      <a class="btn btn-danger" href="../index-level/index.php" role="button">Επιστροφή στην αρχική</a>
    </div>
  </div>
  
<?php
  require_once "../bottom.php";
?>
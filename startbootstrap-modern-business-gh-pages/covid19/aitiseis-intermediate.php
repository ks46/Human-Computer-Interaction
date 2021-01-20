<?php

if(!isset($_SESSION)) {
  session_start();
}
require_once "../config.php";
$title = "Προαπαιτούμενα Αιτήσεων";
require_once "../top.php";
?>


  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
        <li class="breadcrumb-item"><a href="anastoli-info.php">COVID-19 / Αίτηση Αναστολής Εργασίας</a></li>
        <li class="breadcrumb-item active" aria-current="page">Προαπαιτούμενα Αιτήσεων.</li>
      </ol>
    </nav>
    
    <h2>Προαπαιτούμενα Υποβολής Αίτησης Αναστολής Σύμβασης Εργασίας/Απασχόλησης από Απόσταση Υπαλλήλου.</h2>    
    <?php
      if(!isset($_SESSION["loggedin"])){
        echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">";
        echo "Για να αιτηθείτε άδεια ειδικού σκοπού, πρέπει να είστε <b>συνδεδεμένος</b> στην πλατφόρμα ως <b>εργοδότης</b>.";
        echo "</div>";
        echo "<button class=\"btn btn-primary\">Σύνδεση</button>";
        echo "<button class=\"btn btn-primary ml-3\">Εγγραφή</button>";
      }else if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $amIEmployee = "SELECT * FROM user WHERE AFM = ".$_SESSION["AFM"];
        $result = mysqli_query($link, $amIEmployee);
        $row = mysqli_fetch_array($result);
        if($row[5] == "employee"){
          echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">";
          echo "Για να αιτηθείτε άδεια ειδικού σκοπού, πρέπει να είστε συνδεδεμένοι στην πλατφόρμα ως <b>εργοδότης</b>.";
          echo "</br>Αυτή την στιγμή, είστε συνδεδεμένοι με λογαριασμό <b>εργαζόμενου με το όνομα χρήστη: ".$_SESSION["username"]."</b>.";
          echo "</div>";
          echo "<a class=\"btn btn-primary\" href=\"../index-level/logout.php\">Αποσύνδεση</a>";
          echo "<a class=\"btn btn-primary ml-3\" href=\"../index-level/index.php\">Επιστροφή στην Αρχική</a>";
        }else{
          echo "<section>";
          echo "<p style=\"font-size: 20px;\">Θα σας ζητηθεί να επιλέξετε ποιους από τους υπαλλήλους σας θέλετε να εντάξετε σε ειδικό εργασιακό καθεστώς. ";
          echo "Όταν επιλέξετε έναν υπάλληλο, καλείστε να επιλέξετε αν θα αναστείλετε την σύμβασή του ή θα τον απασχολήσετε εξ'αποστάσεως. ";
          echo "Τέλος, θα επιλέξετε το διάστημα για το οποίο θα ισχύσει το ειδικό καθεστώς (κοινό για όλους τους επιλεγέντες υπαλλήλους). ";
          echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">Προσοχή: Οι υπάλληλοι που εμφανίζονται στην ακόλουθη φόρμα είναι αυτοί των οποίων η εργασιακή κατάσταση";
          echo "δεν έχει ήδη μεταβληθεί σε ένα από τα 2 ειδικά καθεστώτα και δεν έχουν βρίσκονται σε άδεια ειδικού σκοπού.";
          echo "Αν επιθυμείτε να αλλάξετε την εργασιακή κατάσταση ενός υπαλλήλου από εξ'αποστάσεως απασχόληση σε αναστολή ή το αντίστροφο,";
          echo "κάνετε πρώτα <a href=\"arsi-anastolis-ergasias.php\">άρση της τρέχουσας κατάστασής του εδώ</a>.\n</div>";
          echo "<a class=\"btn btn-primary btn-lg\" href=\"aitisi-anastolis-ergasias.php\" role=\"button\">Συνεχίστε στην αίτηση</a>";
          echo "</section>";
        }
      }
    ?>
  </div>
  
<?php
  require_once "../bottom.php";
?>
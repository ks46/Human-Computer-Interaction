<?php

if(!isset($_SESSION)) {
  session_start();
}
$title = "Προαπαιτούμενα Άδειας Ειδικού Σκοπού";
require_once "../top.php";
require_once "../config.php";
?>


  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="../index-level/index.html">Αρχική</a></li>
        <li class="breadcrumb-item"><a href="adeia-eidikou-skopou-info.php">COVID-19 / Άδεια Ειδικού Σκοπού</a></li>
        <li class="breadcrumb-item active" aria-current="page">Προαπαιτούμενα Αίτησης</li>
      </ol>
    </nav>

    <h2>Προαπαιτούμενα Αίτησης Άδειας Ειδικού Σκοπού</h2>
    <?php
      if(!isset($_SESSION["loggedin"])){
        echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">";
        echo "Για να αιτηθείτε άδεια ειδικού σκοπού, πρέπει να είστε <b>συνδεδεμένος</b> στην πλατφόρμα ως <b>εργαζόμενος</b>.";
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"../index-level/login.php\">Σύνδεση</a>";
        echo "<a class=\"btn btn-primary ml-3\" href=\"../index-level/register.php\">Εγγραφή</a>";
      }else if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $amIEmployee = "SELECT * FROM user WHERE AFM = ".$_SESSION["AFM"];
        $result = mysqli_query($link, $amIEmployee);
        $row = mysqli_fetch_array($result);
        if($row[5] == "employer"){
          echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">";
          echo "Για να αιτηθείτε άδεια ειδικού σκοπού, πρέπει να είστε συνδεδεμένοι στην πλατφόρμα ως <b>εργαζόμενος</b>.";
          echo "</br>Αυτή την στιγμή, είστε συνδεδεμένοι με λογαριασμό <b>εργοδότη με το όνομα χρήστη: ".$_SESSION["username"]."</b>.";
          echo "</div>";
          echo "<a class=\"btn btn-primary\" href=\"../index-level/logout.php\">Αποσύνδεση</a>";
          echo "<a class=\"btn btn-primary ml-3\" href=\"../index-level/index.php\">Επιστροφή στην Αρχική</a>";
        }else{
          echo "<section>";
          echo "<p style=\"font-size: 20px;\">Το σύστημα θα διασταυρώσει αν δικαιούστε άδεια ειδικού σκοπού με βάση την δήλωση που κάνατε κατά την εγγραφή σας ως προς την ";
          echo "ύπαρξη τέκνου σας ηλικίας κάτω των 12 ετών. </br>Αν είστε δικαιούχος, επιλέγετε το διάστημα στο οποίο θα λάβετε την άδεια.</p>";
          echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"font-size: 20px;\">Προσοχή: ";
          echo "Δεν δικαιούστε άδεια ειδικού σκοπού εάν η σύμβασή σας βρίσκεται σε αναστολή.</div>";
          echo "<a class=\"btn btn-primary btn-lg\" href=\"adeia-eidikou-skopou.php\" role=\"button\">Συνεχίστε στην αίτηση</a>";
          echo "</section>";
        }
      }
    ?>
  </div>


<?php
  require_once "../bottom.php";
?>

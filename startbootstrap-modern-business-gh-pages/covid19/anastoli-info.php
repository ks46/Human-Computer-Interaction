<?php

// require_once "chromephp-master/ChromePhp.php";
 
// Initialize the session
if(!isset($_SESSION)) {
  session_start();
}

// Include config file
$title="COVID-19 - Αναστολή Σύμβασης - YΠΑΚΠ";

require_once "../config.php";
require_once "../top.php";

?>

  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
        <li class="breadcrumb-item active" aria-current="page">COVID-19 / Αναστολή Συμβάσεων Εργαζομένων</li>
      </ol>
    </nav>

    <h1>Αναστολής Σύμβασης Εργασίας Υπαλλήλου.</h1>    
    <section>
      <p class="lead">Σε αναστολή μπορούν να βγάλουν εργαζομένους όλες οι πληττόμενες επιχειρήσεις.</p>
      <p class="lead">Αν είστε εργοδότης:</p>
      <a class="btn btn-primary btn-lg" href="aitiseis-intermediate.php" role="button">Κάντε αίτηση αναστολής.</a>
      <a class="btn btn-primary btn-lg" href="#" role="button">Κάντε Άρση της Αναστολής</a> 
    </section>
  </div>

<?php
require_once "../bottom.php";
?>
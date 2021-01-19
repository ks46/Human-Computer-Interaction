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
      <div style="font-size: 20px;">
      <p >Σε αναστολή μπορούν να θέσουν τους εργαζόμενούς τους όλοι οι εργοδότες των οποίων οι επιχειρήσεις:</p>
        <ul>
          <li>έκλεισαν λόγω του γενικού lockdown με κυβερνητική απόφαση ή </li>
          <li>πλήττονται οικονομικά λόγω αυτού </li>
        </ul>
      <p>αρκεί η πρόσληψη του εργαζόμενου να έγινε το πολύ 3 μέρες πριν την έναρξη του γενικού lockdown.</p>
      <p>Αν είστε εργοδότης και έχετε λογαριασμό στην πλατφόρμα,
      το μόνο που απαιτείται είναι να επιλέξετε ποιων υπαλλήλων την σύμβαση θέλετε να αναστείλετε.
      </p>
      </div> 
      <a class="btn btn-primary btn-lg" href="aitiseis-intermediate.php" role="button">Επιλέξτε Υπαλλήλους</a>
      <a class="btn btn-primary btn-lg" href="arsi-anastolis-ergasias.php" role="button">Κάντε Άρση της Αναστολής</a> 
    </section>
  </div>

<?php
require_once "../bottom.php";
?>
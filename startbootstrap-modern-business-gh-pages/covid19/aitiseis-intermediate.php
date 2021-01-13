<?php

// require_once "../covid19/chromephp-master/ChromePhp.php";
if(!isset($_SESSION)) {
  session_start();
}
$title = "Προαπαιτούμενα Αιτήσεων";
require_once "../top.php";
require_once "../config.php";
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
    <section>
      <p style="font-size: 20px;">Για να υποβάλλετε αίτηση αναστολή σύμβασης ή απασχόλησης από απόσταση για οποιονδήποτε από
      τους εργαζόμενούς σας, πρέπει να είστε συνδεδεμένος στην πλατφόρμα <b>ως εργοδότης.</b> Αν έχετε
      λογαριασμό στην πλατφόρμα, </br>κάντε κλικ <a href="../index-level/login.php">εδώ</a> για να συνδεθείτε. 
      Αν όχι, κάντε κλικ <a href="../index-level/register.php">εδώ</a> για να εγγραφείτε.</p>
      <p style="font-size: 20px;">Αν είστε ήδη συνδεδεμένος στην πλατφόρμα, δεν χρειάζεται κάποια ενέργεια από μέρους σας.
      Θα σας ζητηθεί να επιλέξετε ποιους από τους υπαλλήλους σας θέλετε να εντάξετε σε ειδικό εργασιακό
      καθεστώς και για τον κάθε ένα από αυτούς ξεχωριστά αν επιθυμείτε να αναστείλετε την σύμβασή του
      ή να τον απασχολήσετε εξ'αποστάσεως, καθώς και το διάστημα για το οποίο θα ισχύσει το ειδικό καθεστώς
      (κοινό για όλους τους επιλεγέντες υπαλλήλους).</p>
      <a class="btn btn-primary btn-lg" href="aitisi-anastolis-ergasias.php" role="button">Συνεχίστε στην αίτηση</a>
    </section>
  </div>
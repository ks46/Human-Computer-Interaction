<?php
  $title="Αρχική Σελίδα";
  require_once "../top.php";
?>

<!-- NOTE: COVID Info section starts here -->
<div class="jumbotron jumbotron-fluid jumbotron-bg">
  <!-- NOTE: class jumbotron-bg can be used to change the background color,
       making it darker
  -->
  <div class="container">
    <h1 class="display-4" lang="en">
      <strong>COVID-19</strong>
    </h1>
    <div class="row">
      <div class="col-lg-5">
        <p class="lead">Πληροφορίες και Έκτακτα Μέτρα για τους Εργασιακούς Χώρους</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="../covid19/covid19-info.php" role="button">Περισσότερα</a>
        </p>
      </div>
      <div class="col-lg-7">
        <p class="lead">Η προσέλευση του κοινού στα γραφεία του Υπουργείου γίνεται μόνο κατόπιν ραντεβού, για έκτακτες περιπτώσεις</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Κλείστε Ραντεβού</a>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- NOTE: COVID Info section ends here -->

<!-- NOTE: Page Content starts here -->
<div class="container">
  <!-- NOTE: FAQ section starts here -->
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h2 class="card-header h4">Εργαζόμενοι</h2>
        <div class="card-body">
            <p class="card-text"><a class="card-link" href="#">Φορολογικές Εισφορές και Ένσημα</a></p>
            <p class="card-text"><a class="card-link" href="#">Τι δώρα δικαιούμαι;</a></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h2 class="card-header h4">Εργοδότες</h2>
        <div class="card-body">
          <p class="card-text"><a class="card-link" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></p>
          <p class="card-text"><a class="card-link" href="#">Molestiae atque exercitationem ut consequuntur</a></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h2 class="card-header h4">Νέες Επιχειρήσεις</h2>
        <div class="card-body">
          <p class="card-text"><a class="card-link" href="#">Τι δικαιολογητικά χρειάζομαι για άνοιγμα νέας επιχείρησης;</a></p>
          <p class="card-text"><a class="card-link" href="#">Πώς δηλώνω τους υπαλλήλους μου;</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- NOTE: FAQ section ends here -->
</div>
<!-- NOTE: Page Content ends here -->

<?php require_once "../bottom.php"; ?>

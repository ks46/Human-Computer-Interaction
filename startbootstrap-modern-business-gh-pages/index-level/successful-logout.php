<?php
$title = "Εγγραφή νέου χρήστη";
require_once "../top.php";
?>

<!-- NOTE: Page Content starts here -->
<div class="container mt-4 mb-5">
  <!-- NOTE: Breadcrumbs section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">Επιτυχής αποσύνδεση</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <div class="alert alert-success my-5" role="alert">
    Έχετε αποσυνδεθεί επιτυχώς!
  </div>

  <p>
    <a href="index.php" class="btn btn-primary">Επιστροφή στην αρχική σελίδα</a>
    <a href="login.php" class="btn btn-link ml-3">Συνδεθείτε πάλι</a>
  </p>

</div>
<!-- NOTE: Page Content ends here -->

<?php require_once "../bottom.php"; ?>

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
      <li class="breadcrumb-item active" aria-current="page">Εγγραφή νέου χρήστη</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <div class="alert alert-success my-5" role="alert">
    Η εγγραφή σας ολοκληρώθηκε επιτυχώς!
  </div>

  <p>
    Μπορείτε πλέον να
    <a href="login.php">συνδεθείτε</a>
    χρησιμοποιώντας τα στοιχεία σύνδεσης του λογαριασμού που μόλις δημιουργήσατε.
  </p>

</div>
<!-- NOTE: Page Content ends here -->


<?php require_once "../bottom.php"; ?>

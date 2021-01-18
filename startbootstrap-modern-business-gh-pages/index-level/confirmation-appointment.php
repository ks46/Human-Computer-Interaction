<?php
$title = "Κλείσιμο Ραντεβού";
require_once "../top.php";
?>

<!-- NOTE: Page Content starts here -->
<div class="container mt-4 mb-5">
  <!-- NOTE: Breadcrumbs section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">Επικοινωνία</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <div class="alert alert-success my-5" role="alert">
    <h4 class="alert-heading">Το ραντεβού σας οριστικοποιήθηκε!</h4>
    <hr>
    <p class="mb-0">Προσθέστε το ραντεβού στο ημερολόγιό σας <a href="#">εδώ</a>.</p>
    <a class="btn btn-success" href="contact.php" role="button">ΟΚ.</a>
  </div>

</div>
<!-- NOTE: Page Content ends here -->


<?php require_once "../bottom.php"; ?>
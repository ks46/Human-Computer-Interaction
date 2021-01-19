<?php
require_once "./login-validation.php";
$title = "Σύνδεση Χρήστη";
require_once "../top.php";
?>

<div class="container mt-4">
  <!-- NOTE: Breadcrumbs section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">Σύνδεση χρήστη</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <!-- NOTE: form section starts here -->
  <section style="margin: auto; width: 60%; padding: 10px;">
    <h1>Σύνδεση Χρήστη</h1>
    <!-- TODO: do we need the following message ? -->
    <p class="lead">Συμπληρώστε τα στοιχεία σας για να συνδεθείτε</p>

    <form class="mt-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <!-- Username -->
      <div class="form-group row <?php echo (!empty($username_err)) ? 'has-danger' : ''; ?>">
        <label for="username" class="col-sm-2 col-form-label">Όνομα Χρήστη</label>
        <input type="text" name="username" id="username"
               class="form-control col-sm-5 <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
               value="<?php echo $username; ?>" placeholder="MariaPapadopoulou" required
        />
        <span class="form-text col-lg-5  <?php echo (!empty($username_err)) ? 'invalid-feedback' : ''; ?>">
          <?php echo $username_err; ?>
        </span>
      </div>

      <!-- Password -->
      <div class="form-group row <?php echo (!empty($password_err)) ? 'has-danger' : ''; ?>">
        <label for="password" class="col-sm-2 col-form-label">Κωδικός</label>
        <input type="password" name="password" id="password"
               class="form-control col-sm-5 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
               value="<?php echo $password; ?>" placeholder="password" required
        />
        <span class="form-text col-lg-5  <?php echo (!empty($password_err)) ? 'invalid-feedback' : ''; ?>">
          <?php echo $password_err; ?>
        </span>
      </div>

      <!-- General error -->
      <?php if (!empty($err)) { ?>
        <div class="form-group row has-danger">
          <span class="col-lg-5  invalid-feedback">
            <?php echo $err; ?>
          </span>
        </div>
      <?php } ?>

      <!-- Submit Button -->
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Σύνδεση">
      </div>
      <p class="lead mt-5">Ξεχάσατε τον κωδικό σας; <a class="btn btn-link" href="#" role="button">Επαναφορά Κωδικού</a></p>
      <p class="lead mb-3">Δεν έχετε λογαριασμό; <a class="btn btn-primary ml-3" href="register.php" role="button">Εγγραφή</a></p>
    </form>
  </section>
  <!-- NOTE: form section ends here -->
</div>


<script type="text/javascript">
// NOTE: attempt #2
var invalid_fields = document.querySelectorAll("input.is-invalid");
for (let i = 0; i < invalid_fields.length; ++i) {
  invalid_fields[i].addEventListener('click', function() {
    this.value = "";
    this.classList.remove('is-invalid');
  });
}
</script>

<?php require_once "../bottom.php"; ?>

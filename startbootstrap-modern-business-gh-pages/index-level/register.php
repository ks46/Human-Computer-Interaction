<?php
require_once "register-validation.php";
$title = "Εγγραφή νέου χρήστη";
require_once "../top.php";
?>

<!-- NOTE: Page Content starts here -->
<div class="container mt-4">
  <!-- NOTE: Breadcrumbs section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">Εγγραφή νέου χρήστη</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <!-- NOTE: form section starts here -->
  <section>
    <h1>Εγγραφή νέου χρήστη</h1>
    <p class="lead">Συμπληρώστε την ακόλουθη φόρμα για να εγγραφείτε στο site του Υπουργείου Εργασίας</p>
    <p>Τα πεδία με αστερίσκο * είναι υποχρεωτικά.</p>
<<<<<<< HEAD

    <form class="mt-4 mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <!-- Type of user -->
      <div class="form-group row <?php if (!empty($user_type_err)) echo "has-danger"; ?>">
        <label for="user_type" class="col-sm-3 col-form-label">Ιδιότητα *</label>
        <select name="user_type" oninput="showTab()" id="user_type"
                class="col-lg-5 form-control custom-select <?php if (!empty($user_type_err)) echo "is-invalid";?>">
          <option value="default" <?php if (isset($user_type) && ($user_type == "default" || $user_type == "")) echo 'selected'; ?>>
            Επιλέξτε ιδιότητα
          </option>
          <option value="employee" <?php if (isset($user_type) && ($user_type == "employee")) echo 'selected'; ?>>
            Εργαζόμενος
          </option>
          <option value="employer" <?php if (isset($user_type) && ($user_type == "employer")) echo 'selected'; ?>>
            Εργοδότης
          </option>
        </select>
        <span class="col-lg-4 form-text  <?php if (!empty($user_type_err)) echo 'invalid-feedback'; ?>">
          <?php echo $user_type_err; ?>
        </span>
      </div>

      <!-- Username -->
      <div class="form-group row <?php if (!empty($username_err)) echo 'has-danger'; ?>">
        <label for="username" class="col-sm-3 col-form-label">Όνομα Χρήστη *</label>
        <input type="text" name="username" id="username"
               class="form-control col-lg-5 <?php if (!empty($username_err)) echo 'is-invalid'; ?>"
               placeholder="MariaPapadopoulou" required value="<?php echo $username; ?>"
        />
        <span class="col-lg-4 form-text  <?php if (!empty($username_err)) echo 'invalid-feedback'; ?>">
          <?php echo $username_err; ?>
        </span>
      </div>

      <!-- Password -->
      <div class="form-group row <?php if (!empty($password_err)) echo 'has-danger'; ?>">
        <label for="password" class="col-sm-3 col-form-label">Κωδικός (6 ψηφία τουλάχιστον) *</label>
        <input type="password" name="password" id="password"
               class="form-control col-lg-5 <?php if (!empty($password_err)) echo 'is-invalid'; ?>"
               placeholder="password" required value="<?php echo $password; ?>"
        />
        <span class="col-lg-4 form-text  <?php if (!empty($password_err)) echo 'invalid-feedback'; ?>">
          <?php echo $password_err; ?>
        </span>
      </div>

      <!-- Password confirmation -->
      <div class="form-group row <?php if (!empty($confirm_password_err)) echo 'has-danger'; ?>">
        <label for="confirm_password" class="col-sm-3 col-form-label">Επιβεβαίωση Κωδικού *</label>
        <input type="password" name="confirm_password" id="confirm_password"
               class="form-control col-lg-5 <?php if (!empty($confirm_password_err)) echo 'is-invalid'; ?>"
               placeholder="password" required value="<?php echo $confirm_password; ?>"
        />
        <span class="col-lg-4 form-text  <?php if (!empty($confirm_password_err)) echo 'invalid-feedback'; ?>">
          <?php echo $confirm_password_err; ?>
        </span>
      </div>

      <!-- First name -->
      <div class="form-group row <?php if (!empty($first_name_err)) echo 'has-danger'; ?>">
        <label for="first_name" class="col-sm-3 col-form-label">Όνομα *</label>
        <input type="text" name="first_name" id="first_name"
               class="form-control col-lg-5 <?php if (!empty($first_name_err)) echo 'is-invalid'; ?>"
               placeholder="Μαρία" required value="<?php echo $first_name; ?>"
        />
        <span class="col-lg-4 form-text  <?php if (!empty($first_name_err)) echo 'invalid-feedback'; ?>">
          <?php echo $first_name_err; ?>
        </span>
      </div>

      <!-- Last name -->
      <div class="form-group row <?php if (!empty($last_name_err)) echo 'has-danger'; ?>">
        <label for="last_name" class="col-sm-3 col-form-label">Επώνυμο *</label>
        <input type="text" name="last_name" id="last_name"
              class="form-control col-lg-5 <?php if (!empty($last_name_err)) echo 'is-invalid'; ?>"
              placeholder="Παπαδοπούλου" required value="<?php echo $last_name; ?>"
        />
        <span class="col-lg-4 form-text  <?php if (!empty($last_name_err)) echo 'invalid-feedback'; ?>">
          <?php echo $last_name_err; ?>
        </span>
      </div>

      <!-- AFM -->
      <div class="form-group row <?php if (!empty($AFM_err)) echo 'has-danger'; ?>">
        <label for="AFM" class="col-sm-3 col-form-label">
          <abbr title="Αριθμός Φορολογικού Μητρώου">Α.Φ.Μ.</abbr> *
        </label>
        <input type="number" name="AFM" id="AFM"
               class="form-control col-lg-5 <?php if (!empty($AFM_err)) echo 'is-invalid'; ?>"
               pattern="\d{9}" placeholder="012345678" required value="<?php echo $AFM; ?>"
        />
        <span class="col-lg-4 form-text  <?php if (!empty($AFM_err)) echo 'invalid-feedback'; ?>">
          <?php echo $AFM_err; ?>
        </span>
      </div>

      <!-- NOTE: the following fields will appear only if user is an employee -->
      <div class="tab" style="<?php if (isset($user_type) && ($user_type == "employee")) echo "display: block;"; else echo "display: none"; ?>">
        <!-- company name -->
        <div class="form-group row mt-0 <?php if (!empty($Company_Name_err)) echo 'has-danger'; ?>">
          <label for="Company_Name" class="col-sm-3 col-form-label">Εταιρεία Απασχόλησης *</label>
          <div class="col-lg-5">
            <select class="custom-select <?php if (!empty($Company_Name_err)) echo 'is-invalid'; ?>" name="Company_Name" id="Company_Name">
              <option value="default" <?php if (isset($Company_Name) && ($Company_Name == "default" || $Company_Name == "")) echo "selected"; ?>>
                Επιλέξτε εταιρεία
              </option>
              <!-- retrieve all company names from database as separate options -->
              <?php
              // Prepare a select statement
              $sql = "SELECT Company_Name FROM company";
              if ($stmt = mysqli_prepare($link, $sql)) {
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                  $result = mysqli_stmt_get_result($stmt);
                  // fetch company name from each row of result
                  while ($company_name = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $company_name[0]; ?>" <?php if (isset($Company_Name) && ($Company_Name == $company_name[0])) echo "selected"; ?>>
                      <?php echo $company_name[0]; ?>
                    </option>
                    <?php
                  }
                } else {
                  $Company_Name_err = "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα";
                }
                // Close statement
                mysqli_stmt_close($stmt);
              }
              ?>
            </select>
          </div>
          <span class="col-lg-4 form-text  <?php if (!empty($Company_Name_err)) echo 'invalid-feedback'; ?>">
            <?php echo $Company_Name_err; ?>
          </span>
        </div>

        <!-- Has young children?? -->
        <div class="form-group row">
          <label class="form-check-label col-sm-3" for="hasChildYoungerThan12">Έχω παιδιά κάτω των 12 ετών</label>
          <div class="col-lg-5">
            <div class="form-check">
              <input class="form-check-input" name="hasChildYoungerThan12"
                    value="1" type="checkbox" id="hasChildYoungerThan12"
                    <?php if (isset($hasChildYoungerThan12) && ($hasChildYoungerThan12 == 1)) echo "checked"; ?>
              />
            </div>
          </div>
        </div>
      </div>

      <!-- NOTE: the following fields will appear only if user is an employer -->
      <div class="tab" style="<?php if (isset($user_type) && ($user_type == "employer")) echo "display: block;"; else echo "display: none"; ?>">
        <!-- Company name -->
        <div class="form-group row mt-0 <?php if (!empty($employer_Company_Name_err)) echo 'has-danger'; ?>">
          <label for="employer_Company_Name" class="col-sm-3 col-form-label">Επωνυμία Εταιρείας *</label>
          <input type="text" name="employer_Company_Name" id="employer_Company_Name"
                 class="form-control col-lg-5 <?php if (!empty($employer_Company_Name_err)) echo 'is-invalid'; ?>"
                 placeholder="Η Εταιρεία Μου" value="<?php echo $employer_Company_Name; ?>"
          />
          <span class="col-lg-4 form-text  <?php if (!empty($employer_Company_Name_err)) echo 'invalid-feedback'; ?>">
            <?php echo $employer_Company_Name_err; ?>
          </span>
        </div>

        <!-- DOY -->
        <div class="form-group row mt-0 <?php if (!empty($DOY_err)) echo 'has-danger'; ?>">
          <label for="DOY" class="col-sm-3 col-form-label"><abbr title="Δημόσια Οικονομική Υπηρεσία">Δ.Ο.Υ.</abbr> *</label>
          <div class="col-lg-5">
            <select class="custom-select <?php if (!empty($DOY_err)) echo 'is-invalid'; ?>" name="DOY" id="DOY">
              <option value="deafault" <?php if (isset($DOY) && ($DOY == "default" || $DOY == "")) echo "selected"; ?>>
                Επιλέξτε ΔΟΥ
              </option>
              <!-- retrieve all company names from database as separate options -->
              <?php
                // Prepare a select statement
                $sql = "SELECT Name FROM doy";
                if ($stmt = mysqli_prepare($link, $sql)) {
                  // Attempt to execute the prepared statement
                  if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    // fetch company name from each row of result
                    while ($doy_name = mysqli_fetch_array($result)) {
              ?>
              <option value=<?php echo $doy_name[0]; ?> <?php if (isset($DOY) && ($DOY == $doy_name[0])) echo "selected"; ?>>
                <?php echo $doy_name[0]; ?>
              </option>
              <?php
                    }
                  } else {
                    $DOY_err = "Παρουσιάστηκε κάποιο σφάλμα, παρακαλώ δοκιμάστε ξανά αργότερα";
                  }
                  // Close statement
                  mysqli_stmt_close($stmt);
                }
              ?>
            </select>
          </div>
          <span class="col-lg-4 form-text  <?php if (!empty($DOY_err)) echo 'invalid-feedback'; ?>">
            <?php echo $DOY_err; ?>
          </span>
        </div>
      </div>

      <!-- Buttons -->
      <div class="mt-4">
        <button class="btn btn-primary" type="submit">Εγγραφή</button>
        <button class="btn btn-link" type="reset">Καθαρισμός πεδίων</button>
      </div>
    </form>
  </section>
  <!-- NOTE: form section ends here -->

</div>
<!-- NOTE: Page Content ends here -->

<script>
function showTab() {
  var x = document.getElementsByClassName("tab");
  var dropdowns = document.getElementsByTagName("select");
  var dropdownfirst = dropdowns[0];
  if (dropdownfirst.value == "employer") {
    x[0].style.display = "none";
    x[1].style.display = "block";
  } else if(dropdownfirst.value == "employee"){
    x[1].style.display = "none";
    x[0].style.display = "block";
  } else{
    x[0].style.display = x[1].style.display = "none";
  }
}
</script>


<script type="text/javascript">
var invalid_fields = document.querySelectorAll("input.is-invalid");
for (let i = 0; i < invalid_fields.length; ++i) {
  invalid_fields[i].addEventListener('click', function() {
    this.value = "";
    this.classList.remove('is-invalid');
  });
}
</script>


<?php require_once "../bottom.php"; ?>

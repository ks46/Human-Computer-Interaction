<?php
  $title="COVID-19 - Ενημέρωση - Έκτακτα Μέτρα";
  require_once "../top.php";
?>

<!-- NOTE: Page Content starts here -->
<div class="container mt-4">
  <!-- NOTE: Breadcrumbs section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">COVID-19 / Ενημέρωση - Έκτακτα Μέτρα</li>
    </ol>
  </nav>
  <!-- NOTE: Breadcrumbs section ends here -->

  <!-- NOTE: Alert section starts here -->
  <div class="alert alert-danger alert-dismissible text-center" role="alert">
    <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
    <strong>
      Το lockdown παρατείνεται σε εθνικό επίπεδο έως τις 07/01/2021.
    </strong>
  </div>
  <!-- NOTE: Alert section ends here -->

  <h1 class="my-4">Πληροφορίες για τον COVID-19 στους εργασιακούς χώρους</h1>

  <!-- NOTE: accordion section starts here -->
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="headingOne">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <p class="mb-0">
              Ποια μέτρα οφείλω να λαμβάνω στον εργασιακό μου χώρο, εφόσον δεν απασχολούμαι μέσω τηλεργασίας;
            </p>
          </button>
      </div>

      <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
        <div class="card-body">
          <ul>
            <li>Φοράτε πάντα και παντού μάσκα</li>
            <li>Μην ακουμπάτε την μάσκα σας με τα χέρια σας</li>
            <li>Καλύψτε το στόμα και την μύτη σας με επιπλέον της μάσκας χαρτομάντηλο, αν βήξετε ή φταρνιστείτε</li>
            <li>Πλένετε τακτικά τα χέρια σας με νερό και σαπούνι για 30'' ή χρησιμοποιήστε αντισηπτικό διάλυμα.</li>
            <li>Μην ακουμπάτε το πρόσωπό σας</li>
            <li>Καθαρίζετε συχνά τις επιφάνειες στον χώρο σας με διάλυμα αραιωμένης χλωρίνης ή αντισηπτικό διάλυμα.</li>
            <li>Κρατάτε αποστάσεις με τους συναδέλφους σας</li>
            <li>Αερίζετε συχνά τον χώρο</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <hr class="my-4">
  <div class="container">
    <p class="font-weight-bold pb-2">Καθώς η διαχείριση περιστατικών στους χώρους εργασίας γίνεται με βάση το είδος του κρούσματος ή της επαφής με κρούσμα που είχε το περιστατικό, παραθέτουμε τους ορισμούς των διαφόρων κρουσμάτων και ειδών επαφών με κρούσμα.</p>
  </div>
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="secCollHeadingOne">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#secCollOne" aria-expanded="false" aria-controls="secCollOne">
            <p class="mb-0">
              Τι ορίζεται ως στενή επαφή με κρούσμα COVID-19;
            </p>
          </button>
      </div>

      <div id="secCollOne" class="collapse" aria-labelledby="secCollHeadingOne">
        <div class="card-body">
          <ul>
            <li>Άτομο που είχε επαφή πρόσωπο με πρόσωπο με ασθενή σε απόσταση μικρότερη
            των 2 μέτρων για κάτω από 15 λεπτά ή παρέμεινε σε κλειστό χώρο μαζί του
            φορώντας μάσκα για πάνω από 15 λεπτά.</li>
            <li>Συνταξιδιώτης (υπό ορισμένες προϋποθέσεις)</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="secCollHeadingTwo">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#secCollTwo" aria-expanded="false" aria-controls="secCollTwo">
            <p class="mb-0">
              Τι ορίζεται ως απλή επαφή με κρούσμα COVID-19;
            </p>
          </button>
      </div>

      <div id="secCollTwo" class="collapse" aria-labelledby="secCollHeadingTwo">
        <div class="card-body">
          <ul>
            <li>Άτομο που είχε επαφή πρόσωπο με πρόσωπο με ασθενή με COVID-19 εντός 2 μέτρων για &lt; 15 λεπτά ή παρέμεινε σε κλειστό χώρο φορώντας μάσκα για κάτω από 15’ μαζί του</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="secCollHeadingThree">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#secCollThree" aria-expanded="false" aria-controls="secCollThree">
            <p class="mb-0">
              Τι ορίζεται ως ενδεχόμενο κρούσμα COVID-19;
            </p>
          </button>
      </div>

      <div id="secCollThree" class="collapse" aria-labelledby="secCollHeadingThree">
        <div class="card-body">
          Ασθενής που έχει εμφανίσει τουλάχιστον ένα από τα παρακάτω συμπτώματα:
          <ul>
            <li>Βήχας</li>
            <li>Πυρετός</li>
            <li>Δύσπνοια</li>
            <li>Ανοσμία/Αγευσία/Δυσγευσία</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="secCollHeadingFour">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#secCollFour" aria-expanded="false" aria-controls="secCollFour">
            <p class="mb-0">
              Τι ορίζεται ως πιθανό κρούσμα COVID-19;
            </p>
          </button>
      </div>

      <div id="secCollFour" class="collapse" aria-labelledby="secCollHeadingFour">
        <div class="card-body">
          Ασθενής που
          <ol>
            <li>Έχει εμφανίσει τουλάχιστον ένα από τα παρακάτω συμπτώματα:
              <ul>
                <li>Βήχας</li>
                <li>Πυρετός</li>
                <li>Δύσπνοια</li>
                <li>Ανοσμία/Αγευσία/Δυσγευσία</li>
              </ul>
              και
              <ul>
                <li>είτε είχε στενή επαφή με επιβεβαιωμένο κρούσμα COVID-19 έως και 2 εβδομάδες πριν την έναρξη συμπτωμάτων</li>
                <li>είτε παρουσιάζει ακτινολογικά ευρήματα συμβατά με πνευμονία προκαλούμενη από COVID-19</li>
              </ul>
            </li>
            <li>Είτε παρουσιάζει ακτινολογικά ευρήματα συμβατά με πνευμονία προκαλούμενη
                από COVID-19.
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="secCollHeadingFive">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#secCollFive" aria-expanded="false" aria-controls="secCollFive">
            <p class="mb-0">
              Τι ορίζεται ως επιβεβαιωμένο κρούσμα COVID-19;
            </p>
          </button>
      </div>

      <div id="secCollFive" class="collapse" aria-labelledby="secCollHeadingFive">
        <div class="card-body">
          Άτομο το οποίο έχει υποβληθεί σε εργαστηριακό έλεγχο και έχει ανιχνευθεί ο ιός.
        </div>
      </div>
    </div>
  </div>

  <hr class="my-4">
  <div class="container">
      <p class="font-weight-bold pb-2">Πώς γίνεται η διαχείριση κρουσμάτων στους εργασιακούς χώρους;</p>
  </div>
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="thirdCollHeadingOne">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#thirdCollOne" aria-expanded="false" aria-controls="thirdCollOne">
            <p class="mb-0">
              Τι γίνεται στην περίπτωση που υπάρχει ενδεχόμενο κρούσμα;</h5>
            </p>
          </button>
      </div>

      <div id="thirdCollOne" class="collapse" aria-labelledby="thirdCollHeadingOne">
        <div class="card-body">
          Το ενδεχόμενο κρούσμα <strong>παύει</strong> να προσέρχεται στον χώρο εργασίας του, τηλεφωνεί
          στον ιατρό του και απουσιάζει για όσο χρειαστεί, προσκομίζοντας στον εργοδότη
          του βεβαίωση από τον ασφαλιστικό του φορέα.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="thirdCollHeadingTwo">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#thirdCollTwo" aria-expanded="false" aria-controls="thirdCollTwo">
            <p class="mb-0">
              Τι γίνεται στην περίπτωση που υπάρχει πιθανό κρούσμα λόγω στενής επαφής με επιβεβαιωμένο κρούσμα;</h5>
            </p>
          </button>
      </div>

      <div id="thirdCollTwo" class="collapse" aria-labelledby="thirdCollHeadingTwo">
        <div class="card-body">
          Το άτομο <strong>παύει</strong> να προσέρχεται στον εργασιακό του χώρο, παίρνει τηλέφωνο τον ιατρό του αλλά <strong>και τον ΕΟΔΥ</strong> (τηλέφωνο 1135). Ενημερώνει και τον Προϊστάμενό του, ώστε μέσω αυτού να ενημερωθεί η εταιρεία και να ξεκινήσει διαδικασία ανίχνευσης, αν αυτό κρίνεται.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="thirdCollheadingThree">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#thirdCollThree" aria-expanded="false" aria-controls="thirdCollThree">
            <p class="mb-0">
              Τι γίνεται στην περίπτωση που υπάρχει απλή επαφή κάποιου στον χώρο με κρούσμα;</h5>
            </p>
          </button>
      </div>

      <div id="thirdCollThree" class="collapse" aria-labelledby="thirdCollheadingThree">
        <div class="card-body">
          Το άτομο συνεχίζει κανονικά να προσέρχεται στον εργασιακό του χώρο, όμως παρακολουθεί τον εαυτό του για συμπτώματα.
        </div>
      </div>
    </div>
  </div>
</div>
<!-- NOTE: Page Content ends here -->

<?php require_once "../bottom.php"; ?>

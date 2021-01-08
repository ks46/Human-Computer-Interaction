<?php
  $title="Επικοινωνία";
  require_once "../top.php";
?>

<!-- Page Content -->

<div class="container my-4">
  <!-- NOTE: breadcrumb section starts here -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg">
      <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
      <li class="breadcrumb-item active" aria-current="page">Επικοινωνία</li>
    </ol>
  </nav>
  <!-- NOTE: breadcrumb section ends here -->

  <!-- NOTE: alert section starts here -->
  <div class="alert alert-danger text-center" role="alert">
    Λόγω του καθολικού lockdown, μπορείτε να προσέλθετε στα γραφεία του υπουργείου
    <strong>
    μόνο κατόπιν ραντεβού.
    </strong>
    <!-- <br> -->
     <a href="../covid19/ores-leitourgias-grafeion.php" class="alert-link">Μάθετε περισσότερα</a>.
  </div>
  <!-- NOTE: alert section ends here -->


  <!-- NOTE: contact info section starts here -->
  <section>
    <h1 class="h3">Στοιχεία Επικοινωνίας</h1>
    <div class="row">
      <!-- Contact Details Column -->
      <div class="col-lg-5 mb-4">
        <address>
          <h2 class="h4">Υπουργείο Εργασίας</h2>
          <p>Σταδίου 29, Αθήνα 105 59</p>
          <p>
            Ώρες Λειτουργίας:
            Τρίτη - Παρασκευή 9:00 - 15:00
          </p>
          <p>Τηλεφωνικό Κέντρο:
            <a href="tel:+302131516649">213-151-6649</a> - <a href="tel:+302131516651">213-151-6651</a>
          </p>
          <p>
            Email:
            <a href="mailto:pliroforisi-politi@ypakp.gr">pliroforisi-politi@ypakp.gr</a>
          </p>
        </address>
      </div>

      <!-- Map Column -->
      <!-- Embedded Google Map -->
      <div class="col-lg-7 mb-4">
        <iframe style="width: 100%; height: 250px; border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3144.859105629967!2d23.728891015323633!3d37.980417279722495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bd3bacfad54f%3A0xb64e5b8e619348ea!2sStadiou%2029%2C%20Athina%20105%2059!5e0!3m2!1sen!2sgr!4v1608727678815!5m2!1sen!2sgr"></iframe>
      </div>

      <div class="col-lg-12 mb-4">
        <h3 class="h4">Λοιπές Υπηρεσίες</h3>
        <p>
          Βρείτε το παράρτημα που σας αφορά και πληροφορηθείτε για τους τρόπους επικοινωνίας
          και για το πώς μπορείτε να κλείσετε ραντεβού.
        </p>
        <a class="btn btn-primary" href="#">Εύρεση Παραρτήματος</a>
      </div>
    </div>
  </section>
  <!-- NOTE: contact info section ends here -->

  <hr>

  <!-- NOTE: Contact Form starts here -->
  <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
  <div class="row mt-4">
    <div class="col-lg-8 mb-4">
      <h4>Φόρμα Επικοινωνίας</h4>
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="control-group form-group">
          <div class="controls">
            <label>Όνομα:</label>
            <input type="text" class="form-control" id="firstname" required data-validation-required-message="Εισάγετε όνομα">
            <p class="help-block"></p>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Επώνυμο:</label>
            <input type="text" class="form-control" id="lastname" required data-validation-required-message="Εισάγετε επώνυμο">
            <p class="help-block"></p>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Τηλέφωνο:</label>
            <input type="tel" class="form-control" id="phone" required data-validation-required-message="Εισάγετε αριθμό τηλεφώνου">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Διεύθυνση Email:</label>
            <input type="email" class="form-control" id="email" required data-validation-required-message="Εισάγετε διεύθυνση email">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Θέμα:</label>
            <input type="email" class="form-control" id="email" required data-validation-required-message="Επιλέξτε θέμα">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label>Μήνυμα:</label>
            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Εισάγετε το κείμενο που θέλετε να στείλετε" maxlength="999" style="resize:none"></textarea>
          </div>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-primary" id="sendMessageButton">Αποστολή</button>
      </form>
    </div>
    <!-- NOTE: Contact Form ends here -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->

<?php require_once "../bottom.php"; ?>

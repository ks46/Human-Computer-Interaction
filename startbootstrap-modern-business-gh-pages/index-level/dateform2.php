<?php
  require_once "../config.php";

  if(!isset($_SESSION)) {
    session_start();
  }
  
  $fullyBookedDates = array();
  $bookedDates = "SELECT Date FROM appointment WHERE branch = ? ";
  if($stmt = mysqli_prepare($link, $bookedDates)){
    mysqli_stmt_bind_param($stmt, "s", $param_branchName);
    $param_branchName = $_SESSION["branchName"];
    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_bind_result($stmt, $date);
      while(mysqli_stmt_fetch($stmt)){
        $appointmentsOnThatDate = "SELECT * FROM appointment WHERE branch = ? AND Date = ?";
        if($apptStmt = mysqli_prepare($link, $appointmentsOnThatDate)){
          mysqli_stmt_bind_param($apptStmt, "ss", $param_branchName, $param_Date);
          $param_branchName = $_SESSION["branchName"];
          $param_Date = $date;
          if(mysqli_stmt_execute($apptStmt)){
            mysqli_stmt_store_result($apptStmt);
            if(mysqli_stmt_num_rows($apptStmt) == 6){
              if(!in_array($date, $fullyBookedDates)){
                array_push($fullyBookedDates, $date);
              }
            }
          }else{
            echo "<h1>".mysqli_stmt_error($apptStmt)."</h1>"; 
          }
          mysqli_stmt_close($apptStmt);
        }else{
          echo "<h1>".mysqli_error($link)."</h1>";
        }
      }
    }else{
      echo "<h1>".mysqli_stmt_error($stmt)."</h1>";
    }
    mysqli_stmt_close($stmt);
  }else{
    echo "<h1>".mysqli_stmt_error($stmt)."</h1>";
  }
  
  $title="COVID-19 - Άδεια Ειδικού Σκοπού - Πληροφορίες";
  // require_once "../top.php";
?>

<html lang="el">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <meta name="description" content=""> -->
  <!-- <meta name="author" content=""> -->

  <title><?php echo $title ?> - Υπουργείο Εργασίας</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  <link href="../css/styles.css" rel="stylesheet">
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
  
</head>

<body>
  <div class="container my-4">
    <!-- NOTE: breadcrumb section starts here -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
        <li class="breadcrumb-item"><a href="contact.php">Επικοινωνία</a></li>
        <li class="breadcrumb-item"><a href="dateform.php">Κλείσιμο Ραντεβού - Εύρεση Παραρτήματος</a></li>
        <li class="breadcrumb-item active" aria-current="page">Κλείσιμο Ραντεβού - Επιλογή Ημερομηνίας</li>
      </ol>
    </nav>

    <h2>Στοιχεία Ατόμου</h2>
    <div class="form-group row">
      <label for="FirstName" class="col-sm-2 col-form-label">Όνομα:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="employeeFirstName">
        <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
      </div>
    </div>
    <div class="form-group row">
      <label for="LastName" class="col-sm-2 col-form-label">Επώνυμο:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="employeeLastName">
        <div class="invalid-feedback">Το πεδίο είναι υποχρεωτικό.</div>
      </div>
    </div>
    
    <!--date-->
    <h2>Επιλέξτε Ημερομηνία</h2>
    <div class="form-group row">
        <label for="begOfSusp" class="col-sm-2 col-form-label">Από:</label>
        <div class="col-10">
            <!-- <input type="date" id="begOfSusp" min="2021-01-01">-->
            
            <!---->
            
            <input type="text" id="begOfSusp">
            
            <!---->
            
            <input type="time" id="TimeSusp">
            <div class="invalid-feedback">Η επιλογή ημερομηνίας είναι υποχρεωτική.</div>
        </div>
    </div>
  </div>
          
  <script>
    function valiDate(){
        var br = document.getElementById("BRANCH");
        var fn = document.getElementById("FirstName");
        var ln = document.getElementById("LastName");
        var valid1 = true;
        var valid2 = true;
        var valid3 = true;
        // var valid = true;
        var erstr1 = new String();
        var erstr2 = new String();
        var erstr3 = new String();
        
        var frow1 = br.parentNode;
        var frow2 = fn.parentNode.parentNode;
        var frow3 = ln.parentNode.parentNode;
        
        var ncn1;
        var ncn2;
        var ncn3;
        
        //var x, i, input, valid = true;
        // x = document.getElementsByClassName("tab");
        // formGroups = x[currentTab].getElementsByClassName("form-group row");
        
        // for(i=0;i<formGroups.length;i++{
            // input = formGroups[i].getElementsByTagName("input");
            if(br.value == "default"){
                if(br.className.indexOf(" is-invalid") == -1){
                    br.className += " is-invalid";
                }
                erstr1+= "Η επιλογή παραρτήματος είναι υποχρεωτική!\n";
                valid1 = false;
            }
            if(fn == ""){ 
                if(fn.className.indexOf(" is-invalid") == -1){
                    fn.className += " is-invalid";
                }
                erstr2+= "Η εισαγωγή ονόματος είναι υποχρεωτική!\n";
                valid2 = false;
            }
            if(ln.value == ""){
                if(ln.className.indexOf(" is-invalid") == -1){
                    ln.className += " is-invalid";
                }
                erstr3+= "Η εισαγωγή επωνύμου είναι υποχρεωτική!\n";
                valid3 = false;
            }
            
            if(!valid1){
                if(br.className.indexOf(" is-invalid") == -1){
                    br.className += " is-invalid";
                }
                if(frow1.className.indexOf(" has-danger") == -1){
                    frow1.className += " has-danger";
                }
            }else{
                if(br.className.indexOf(" is-invalid") !== -1){
                    ncn1 = br.className.replace(" is-invalid", "");
                    br.className = ncn1;
                }
                if(frow1.className.indexOf(" has-danger") !== -1){
                    ncn1 = frow1.className.replace(" has-danger", "");
                }
                br.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            }
            
            if(!valid2){
                if(fn.className.indexOf(" is-invalid") == -1){
                    fn.className += " is-invalid";
                }
                if(frow2.className.indexOf(" has-danger") == -1){
                    frow2.className += " has-danger";
                }
            }else{
                if(fn.className.indexOf(" is-invalid") !== -1){
                    ncn2 = fn.className.replace(" is-invalid", "");
                    fn.className = ncn2;
                }
                if(frow2.className.indexOf(" has-danger") !== -1){
                    ncn2 = frow2.className.replace(" has-danger", "");
                }
                fn.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            }
            
            if(!valid3){
                if(ln.className.indexOf(" is-invalid") == -1){
                    ln.className += " is-invalid";
                }
                if(frow3.className.indexOf(" has-danger") == -1){
                    frow3.className += " has-danger";
                }
            }else{
                if(ln.className.indexOf(" is-invalid") !== -1){
                    ncn3 = ln.className.replace(" is-invalid", "");
                    ln.className = ncn3;
                }
                if(frow3.className.indexOf(" has-danger") !== -1){
                    ncn3 = frow3.className.replace(" has-danger", "");
                }
                ln.nextSibling.nextSibling.innerHTML = "Το πεδίο είναι υποχρεωτικό.";
            }
        // }
        return valid;
    }
    
  </script>

  <!-- NOTE: Footer section starts here -->
  <footer class="py-0 bg-light">
    <div class="container">
      <p class="m-0 text-center">Copyright &copy; Ypakp 2020</p>
    </div>
  </footer>
  <!-- NOTE: Footer section ends here -->
  <!-- Contact form JavaScript -->
  <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
  <!-- Bootstrap core JavaScript -->
      
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/appdatepick.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>      
    
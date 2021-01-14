<?php
$title = "Αίτηση Άδειας Ειδικού Σκοπού ";
require_once "../top.php";
?>

   <div class="container mt-4">
      <!-- NOTE: Breadcrumbs section starts here -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-bg">
          <li class="breadcrumb-item"><a href="../index-level/index.html">Αρχική</a></li>
          <li class="breadcrumb-item"><a href="adeia-eidikou-skopou-info.php">COVID-19 / Άδεια Ειδικού Σκοπού</a></li>
          <li class="breadcrumb-item"><a href="adeia-eidikou-skopou-intermediates.php">Προαπαιτούμενα Αίτησης</a></li>
          <li class="breadcrumb-item active" aria-current="page">Υποβολή Αίτησης</li>
        </ol>
      </nav>
      <!-- NOTE: Breadcrumbs section ends here -->
      <h4><b>Υποβολή Αίτησης:</b></h4>
      <h5><u>Στοιχεία Αιτούντος/ούσας:</u><h5>

      <div class = "tab">
        <p class = "formitem">Κατηγορία:
            <input type="radio" name="radcat" value="ye"/><label class="radbutitem">ΥΕ</label>
            <input type="radio" name="radcat" value="de"/><label class="radbutitem">ΔΕ</label>
            <input type="radio" name="radcat" value="te"/><label class="radbutitem">ΤΕ</label>
            <input type="radio" name="radcat" value="pe"/><label class="radbutitem">ΠΕ</label>
        </p>
        <p class = "formitem">Ιδιότητα:
            <input type="radio" name="radspec" value="perm"/><label class="radbutitem">Μόνιμος</label>
            <input type="radio" name="radspec" value="idax"/><label class="radbutitem">Ι.Δ.Α.Χ</label>
            <input type="radio" name="radspec" value="idox"/><label class="radbutitem">Ι.Δ.Ο.Χ</label>
        </p>
        <p class = "formitem">Υπηρεσία:
        <input class = "inputitem" type="text" name="txtUsername" value="" maxlength="45" size="35"/>
        </p>
        <p class = "formitem">Τηλέφωνο:
        <input class = "inputitem" type="text" name="txtUsername" value="" maxlength="10" size="10"/>
        </p>
      </div>
    
      <div class = "tab">
      <br/>
        <label style="font-size:15px;">Αριθμός τέκνων</label>
        <select name="selkidcount" style="-webkit-appearance: menulist-button; height: 60%;">
            <option selected="selected" value="one">1</option>
            <option value="two">2</option>
            <option value="three">3</option>
            <option value="four">4</option>
            <option value="more">Άλλο</option>
        </select>
      </div>
      
      <div class = "tab">
        <p class = "formitem">Αριθμός Ημερών:<br/><pre>Απο:<input class = "inputitem" type="date" name="txtUsername" value="" size="10"/>    Εως<small>*</small>:<input class = "inputitem" type="date" name="txtUsername" value="" size="10"/></pre>
        <h6 style="font-size:10px;">Ελάχιστο τέσσερις(4) ημέρες</h6>
        </p>
      </div>
    
      <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Προηγούμενο</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Επόμενο</button>
        </div>
      </div>
    </div>
</body>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

</script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<?php
require_once "../bottom.php";
?>
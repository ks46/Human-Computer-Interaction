<?php

  if(!isset($_SESSION)) {
    session_start();
  }

  require_once "../config.php";
  $title = "Το προφίλ μου";
  require_once "../top.php";
?>

  <div class="container mt-4">
    <!-- NOTE: Breadcrumbs section starts here -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-bg">
        <li class="breadcrumb-item"><a href="../index-level/index.php">Αρχική</a></li>
        <li class="breadcrumb-item active" aria-current="page">Το προφίλ μου</li>
      </ol>
    </nav>
    
    
    <div class="row">
      <!-- Sidebar Column -->
      <div class="col-lg-3 mb-4">
        <div class="list-group">
          <a href="#" class="list-group-item" onclick="showTab(0)">Τα στοιχεία μου</a>
          <?php 
            $fetchAccountType = "SELECT type FROM user WHERE username = \"".$_SESSION["username"]."\"";
            $accountType = mysqli_query($link, $fetchAccountType);
            if(mysqli_num_rows($accountType) == 0){
              echo "<p>Sth went terribly wrong</p>";
            }else{
              $typerow = mysqli_fetch_array($accountType);
              if($typerow[0] == "employer"){
                echo "<a href=\"#\" class=\"list-group-item\" onclick=\"showTab(1)\">Οι υπάλληλοί μου</a>";
              }else{
                echo "<a href=\"#\" class=\"list-group-item\" onclick=\"showTab(1)\">Οι άδειές μου</a>";
              }
            }
          ?>
        </div>
      </div>
      <div class="col-lg-9 mb-4 tab">
        <h2>Τα στοιχεία μου</h2>
        <?php
          $fetchMyInfo = "SELECT * FROM user WHERE username = \"".$_SESSION["username"]."\"";
          $myInfo = mysqli_query($link, $fetchMyInfo);
          if(mysqli_num_rows($myInfo) == 0){
            echo "<p>Sth went terribly wrong</p>";
          }else{
            $row = mysqli_fetch_array($myInfo);
            echo "<p>Όνομα: $row[3]</p>";
            echo "<p>Επίθετο: $row[4]</p>";
            echo "<p>ΑΦΜ: $row[0]</p>";
            echo "<p>Τύπος λογαριασμού: ";
            if($row[5] == "employee"){
              echo "Υπάλληλος</p>";
              $fetchEmployeeInfo = "SELECT * FROM employee WHERE AFM = $row[0]";
              $myEmployeeInfo = mysqli_query($link, $fetchEmployeeInfo);
              if(mysqli_num_rows($myEmployeeInfo) == 0){
                echo "<p>Sth went terribly wrong</p>";
              }else{
                $employeerow = mysqli_fetch_array($myEmployeeInfo);
                echo "<p>Εταιρεία Απασχόλησης: $employeerow[2]</p>";
                echo "<p>Εργασιακή Κατάσταση: ";
                if($employeerow[1] == "normal"){
                  echo "Κανονική</p>";
                }else if($employeerow[1] == "suspended"){
                  echo "Σε αναστολή σύμβασης</p>";
                }else if($employeerow[1] == "remote"){
                  echo "Εξ'αποστάσεως εργασία</p>";
                }else{
                  echo "Σε άδεια ειδικού σκοπού</p>";
                }
                if($employeerow[1] == "suspended" || $employeerow[1] == "remote"){
                  $fetchDates = "SELECT startDate, endDate FROM employerForms WHERE employeeAFM = $row[0]";
                  $dates = mysqli_query($link, $fetchDates);
                  if(mysqli_num_rows($dates) != 1){
                    echo "<p>Sth went terribly wrong</p>";
                  }else{
                    $datesrow = mysqli_fetch_array($dates);
                    $year0 = str_split($datesrow[0], 4)[0];
                    $month0 = str_split(str_split($datesrow[0], 5)[1], 2)[0];
                    $day0 = str_split(str_split($datesrow[0], 8)[1], 2)[0];
                    $year1 = str_split($datesrow[1], 4)[0];
                    $month1 = str_split(str_split($datesrow[1], 5)[1], 2)[0];
                    $day1 = str_split(str_split($datesrow[1], 8)[1], 2)[0];
                    echo "<p>Από: $day0-$month0-$year0</p>";
                    echo "<p>Έως: $day1-$month1-$year1</p>";
                  }
                }else{
                  $fetchDates = "SELECT startDate, endDate FROM parentalleavecertificate WHERE employeeAFM = $row[0] ORDER BY startDate DESC";
                  $dates = mysqli_query($link, $fetchDates);
                  $datesrow = mysqli_fetch_array($dates);
                  $year0 = str_split($datesrow[0], 4)[0];
                  $month0 = str_split(str_split($datesrow[0], 5)[1], 2)[0];
                  $day0 = str_split(str_split($datesrow[0], 8)[1], 2)[0];
                  $year1 = str_split($datesrow[1], 4)[0];
                  $month1 = str_split(str_split($datesrow[1], 5)[1], 2)[0];
                  $day1 = str_split(str_split($datesrow[1], 8)[1], 2)[0];
                  echo "<p>Από: $day0-$month0-$year0</p>";
                  echo "<p>Έως: $day1-$month1-$year1</p>";
                }
                echo "<p>Τέκνο κάτω των 12 ετών: ";
                if($employeerow[3] == 0){
                  echo "Όχι</p>";
                }else{
                  echo "Ναι</p>";
                }
              }
            }else{
              echo "Εργοδότης</p>";
              $fetchEmployerInfo = "SELECT * FROM employer WHERE AFM = $row[0]";
              $myEmployerInfo = mysqli_query($link, $fetchEmployerInfo);
              if(mysqli_num_rows($myEmployerInfo) == 0){
                echo "<p>Sth went terribly wrong</p>";
              }else{
                $employerrow = mysqli_fetch_array($myEmployerInfo);
                echo "<p>Επωνυμία Επιχείρησης: $employerrow[1]</p>";
                $fetchDoy  = "SELECT * FROM company WHERE Company_Name = \"".$employerrow[1]."\"";
                $doy = mysqli_query($link, $fetchDoy);
                if(mysqli_num_rows($doy) == 0){
                  echo "<p>Sth went terribly wrong</p>";
                }else{
                  $doyrow = mysqli_fetch_array($doy);
                  echo "<p>ΔΟΥ Επιχείρησης: $doyrow[1]</p>";
                }
              }
            }
          }
        ?>
      <a class="btn btn-primary btn-lg" href="edit-userprofile.php" role="button">Αλλαγή Στοιχείων</a>
      </div>
      <div class="col-lg-9 mb-4 tab">
        <?php
          if($typerow[0] == "employer"){
            echo "<h2>Οι υπάλληλοί μου</h2>";
            $fetchMyEmployees = "SELECT * FROM employee WHERE companyName = \"$employerrow[1]\"";
            $myemployees = mysqli_query($link, $fetchMyEmployees);
            if(mysqli_num_rows($myemployees) == 0){
              echo "<p>Δεν υπάρχει κανείς από τους υπαλλήλους σας στην πλατφόρμα.</p>";
            }else{
              echo "<table class=\"table table-hover\">";
              echo "<thead>\n<tr>";
              echo "<th scope=\"col\">Όνομα</th>";
              echo "<th scope=\"col\">Επίθετο</th>";
              echo "<th scope=\"col\">Εργασιακή Κατάσταση</th>";
              echo "<th scope=\"col\">Από</th>";
              echo "<th scope=\"col\">Έως</th>";
              echo "</tr>\n</thead>";
              echo "<tbody>";
              while($myemployee = mysqli_fetch_array($myemployees)){
                $fetchMyEmployeeInfo = "SELECT * FROM user WHERE AFM = $myemployee[0]";
                $anEmployeesInfo = mysqli_query($link, $fetchMyEmployeeInfo);
                $myEmployeeRow = mysqli_fetch_array($anEmployeesInfo);
                echo "<td>$myEmployeeRow[3]</td>";
                echo "<td>$myEmployeeRow[4]</td>";
                $fetchMyEmployeeInfo = "SELECT * FROM employee WHERE AFM = $myemployee[0]";
                $anEmployeesInfo = mysqli_query($link, $fetchMyEmployeeInfo);
                $myEmployeeRow = mysqli_fetch_array($anEmployeesInfo);
                if($myEmployeeRow[1] == "normal"){
                  echo "<td>Κανονική</td>";
                }else if($myEmployeeRow[1] == "remote"){
                  echo "<td>Εξ'Αποστάσεως Απασχόληση</td>";
                }else if($myEmployeeRow[1] == "suspended"){
                  echo "<td>Αναστολή Σύμβασης</td>";
                }else{
                  echo "<td>Άδεια ειδικού σκοπού</td>";
                }
                if($myEmployeeRow[1] != "normal"){
                  if($myEmployeeRow[1] == "suspended" || $myEmployeeRow[1] == "remote"){
                    $fetchEmployeeDates = "SELECT startDate, endDate FROM employerforms WHERE employeeAFM = $myemployee[0]";
                  }else if($myEmployeeRow[1] == "parentalleave"){
                    $fetchEmployeeDates = "SELECT startDate, endDate FROM parentalleavecertificate WHERE employeeAFM = $myemployee[0]";
                  }
                  $employeeDates = mysqli_query($link, $fetchEmployeeDates);
                  $employeeDatesRow = mysqli_fetch_array($employeeDates);
                  
                  $emplyear0 = str_split($employeeDatesRow[0], 4)[0];
                  $emplmonth0 = str_split(str_split($employeeDatesRow[0], 5)[1], 2)[0];
                  $emplday0 = str_split(str_split($employeeDatesRow[0], 8)[1], 2)[0];
                  $emplyear1 = str_split($employeeDatesRow[1], 4)[0];
                  $emplmonth1 = str_split(str_split($employeeDatesRow[1], 5)[1], 2)[0];
                  $emplday1 = str_split(str_split($employeeDatesRow[1], 8)[1], 2)[0];
                  
                  echo "<td>$emplday0-$emplmonth0-$emplyear0</td>";
                  echo "<td>$emplday1-$emplmonth1-$emplyear1</td>\n</tr>";                  
                }else{
                  echo "<td></td>";
                  echo "<td></td>\n</tr>"; 
                }
              }
              echo "</tbody>\n</table>";
            }
          }else{
            echo "<h2>Οι άδειές μου</h2>";
            $fetchMyLeaves = "SELECT startDate, endDate FROM parentalleavecertificate WHERE employeeAFM = ".$_SESSION["AFM"]." ORDER BY startDate DESC";
            $myLeaves = mysqli_query($link, $fetchMyLeaves);
            echo mysqli_error($link);
            echo "<table class=\"table table-hover\">";
            echo "<thead>\n<tr>";
            echo "<th scope=\"col\">Από</th>";
            echo "<th scope=\"col\">Έως</th>";
            echo "</tr>\n</thead>";
            echo "<tbody>";
            while($leaveRow = mysqli_fetch_array($myLeaves)){
              $leaveyear0 = str_split($leaveRow[0], 4)[0];
              $leavemonth0 = str_split(str_split($leaveRow[0], 5)[1], 2)[0];
              $leaveday0 = str_split(str_split($leaveRow[0], 8)[1], 2)[0];
              $leaveyear1 = str_split($leaveRow[1], 4)[0];
              $leavemonth1 = str_split(str_split($leaveRow[1], 5)[1], 2)[0];
              $leaveday1 = str_split(str_split($leaveRow[1], 8)[1], 2)[0];
              echo "<td>$leaveday0-$leavemonth0-$leaveyear0</td>";
              echo "<td>$leaveday1-$leavemonth1-$leaveyear1</td>\n</tr>";      
            }
            echo "</tbody>\n</table>";
          }
        ?>
      </div>
    </div>
  </div>
  
  <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[currentTab].style.display = "none";
      x[n].style.display = "block";
      currentTab = n;
      // //... and fix the Previous/Next buttons:
    }
  </script>
  
<?php 
require_once "../bottom.php";
?>
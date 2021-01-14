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
          <a href="#" class="list-group-item">Τα στοιχεία μου</a>
        </div>
      </div>
      <div class="col-lg-9 mb-4">
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
                }else{
                  echo "Εξ'αποστάσεως εργασία</p>";
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
      </div>
    </div>
  </div>
  
  
  
<?php 
require_once "../bottom.php";
?>
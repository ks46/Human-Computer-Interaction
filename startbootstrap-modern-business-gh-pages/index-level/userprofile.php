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
            }else{
              echo "Εργοδότης</p>";
              $fetchEmployerInfo = "SELECT * FROM employer WHERE AFM = $row[0]";
              $myEmployerInfo = mysqli_query($link, $fetchEmployerInfo);
              if(mysqli_num_rows($myInfo) == 0){
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
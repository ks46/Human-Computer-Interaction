<?php
require_once "../config.php";
// require_once "chromephp-master/ChromePhp.php";


function validateAFM($link, $AFM, &$AFM_err){
  $AFM_is_valid = "SELECT * FROM user WHERE AFM = ".$AFM;
  $result = mysqli_query($link, $AFM_is_valid);
  if(mysqli_num_rows($result) != 1){
    $AFM_err = "Το ΑΦΜ που καταχωρήσατε δεν αντιστοιχεί με αυτό στο σύστημα";
    mysqli_free_result($result);
    return false;
  }
  mysqli_free_result($result);
  return true;
}

function validateIsEmployer($link, $AFM, &$AFM_err){
  $is_employer = "SELECT * FROM employer WHERE AFM = ".$AFM;
  $result = mysqli_query($link, $is_employer);
  if(mysqli_num_rows($result) != 1){
    $AFM_err = "Δεν υπάρχει ιδιοκτήτης επιχείρησης με τέτοιο ΑΦΜ στο σύστημα.";
    mysqli_free_result($result);
    return false;
  }
  mysqli_free_result($result);
  return true;
}

function validateIsEmployee($link, $AFM, &$AFM_err, $businessName){
  $is_employee = "SELECT * FROM employee WHERE AFM = ".$AFM;
  $result = mysqli_query($link, $is_employee);
  if(mysqli_num_rows($result) != 1){
    $AFM_err = "Δεν υπάρχει υπάλληλος με τέτοιο ΑΦΜ στο σύστημα.";
    mysqli_free_result($result);
    return false;
  }else{
    while($row = mysqli_fetch_array($result)){
      if($row[2] != $businessName){
        $AFM_err = "Δεν υπάρχει εργαζόμενος στην εταιρεία σας με τέτοιο ΑΦΜ στο σύστημα.";
        mysqli_free_result($result);
        return false;
      }
    }
  }
  mysqli_free_result($result);
  return true;
}

function validateName($link, $AFM, $FirstName, &$FirstName_err, $LastName, &$LastName_err){
  $verify_name = "SELECT first_name, last_name FROM user WHERE AFM = ".$AFM;
  $result = mysqli_query($link, $verify_name);
  $valid  = true;
  if(mysqli_num_rows($result) != 1){
    $FirstName_err = "Το ονοματεπώνυμό σας δεν αντιστοιχεί στο ΑΦΜ σας.";
    $LastName_err = "Το ονοματεπώνυμό σας δεν αντιστοιχεί στο ΑΦΜ σας.";
    $valid =  false;
  }else{
    while($row = mysqli_fetch_array($result)){
      if($row[0] != $FirstName){
        // ChromePhp::log("row[0]: ".$row[0]);
        // ChromePhp::log("FirstName: ".$FirstName);
        $FirstName_err = "Το όνομα που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα.";
        $valid = false;
      }
      if($row[1] != $LastName){
        $LastName_err = "Το επίθετο που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα.";
        $valid = false;
      }
    }
  }
  mysqli_free_result($result);
  return $valid;
}

function validateBusinessName($link, $employerAFM, $businessName, &$businessName_err){
  $verify_business_name = "SELECT Company_Name FROM employer WHERE AFM = ".$employerAFM;
  $valid = true;
  
  $result = mysqli_query($link, $verify_business_name);
  if(mysqli_num_rows($result) != 1){
    $businessName_err = "???";
    $valid = false;   
  }else{
    while($row = mysqli_fetch_array($result)){
      if($row[0] != $businessName){
        $businessName_err = "Το όνομα της επιχείρησής σας δεν αντιστοιχεί με αυτό στο σύστημα";
        $valid = false;
      }
    }
  }
  mysqli_free_result($result);
  return $valid;
}

function validateDoy($link, $businessName, $doy, &$doy_err){
  $doy_list = mysqli_query($link, "SELECT * FROM doy ORDER BY Name ASC");
  $value = 1;
  $doy_name = "";
  $valid = true;
  
  while($row = mysqli_fetch_array($doy_list)){
    if($value == $doy){
      $doy_name = $row[0];
      break;
    }
    $value++;
  }
  
  $verify_doy = "SELECT Doy  FROM company WHERE Company_Name = \"".$businessName."\"";
  $result = mysqli_query($link, $verify_doy);

  while($row = mysqli_fetch_array($result)){
    if($row[0] != $doy_name){
      $doy_err = "Η ΔΟΥ που επιλέξατε δεν αντιστοιχεί με αυτή στο σύστημα";
      $valid = false;
    }
  }
  mysqli_free_result($result);

  return $valid;
}

?>
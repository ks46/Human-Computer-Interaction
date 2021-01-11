<?php
require_once "../config.php";
require_once "chromephp-master/ChromePhp.php";

function validateAFM($link, &$employerAFM, &$employer_AFM_err){
  ChromePhp::log("in validateAFM");
  $AFM_is_valid = "SELECT * FROM user WHERE AFM = ?";
  if($stmt_0 = mysqli_prepare($link, $AFM_is_valid)){
    mysqli_stmt_bind_param($stmt_0, "s", $param_AFM);
    $param_AFM = $employerAFM;
    if(mysqli_stmt_execute($stmt_0)){
      mysqli_stmt_store_result($stmt_0);
      if(mysqli_stmt_num_rows($stmt_0) != 1) {
        $employer_AFM_err = "Το ΑΦΜ που καταχωρήσατε δεν αντιστοιχεί με αυτό στο σύστημα";
        return false;
      }else{
        return true;
      }
      // Close statement
      mysqli_stmt_close($stmt_0);
    }    
  }
  // Close connection
  // mysqli_close($link);
}
  
function validateEmployerName($link, &$employerAFM, &$employerFirstName, &$employer_FirstName_err, &$employerLastName, &$employer_LastName_err){
  ChromePhp::log("in validateEmployerName");
  $verify_name = "SELECT first_name, last_name FROM user WHERE AFM = ?";
  $result = true;
  if($stmt_1 = mysqli_prepare($link, $verify_name)){
    mysqli_stmt_bind_param($stmt_1, "s", $param_AFM);
    $param_AFM = $employerAFM;
    $param_employerFirstName = $employerFirstName;
    
    if(mysqli_stmt_execute($stmt_1)){
      mysqli_stmt_store_result($stmt_1);
      if(mysqli_stmt_num_rows($stmt_1) == 1){
        mysqli_stmt_bind_result($stmt_1, $res_employerFirstName, $res_employerLastName);
        if(mysqli_stmt_fetch($stmt_1)) {
          if($employerFirstName != $res_employerFirstName){ 
            $employer_FirstName_err = "Το όνομα που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
            $result = false;
          }
          if($employerLastName != $res_employerLastName){
            $employer_LastName_err = "Το επίθετο που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
            $result = false;
          }else{
            // header("confirmed.php");
          }
        }
      }
    }else{
      $employer_FirstName_err = "Το όνομα που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
      $employer_LastName_err = "Το επίθετο που δηλώνετε δεν αντιστοιχεί με αυτό στο σύστημα";
      $result = false;
    }
    mysqli_stmt_close($stmt_1);
    // mysqli_close($link);
    return $result;
  }
}

// function fetchDOY(){
  // $doy_list = mysqli_query($link, "SELECT * FROM doy");
              
  // $value = 0;
  // $result = "<select class=\"select\" id=\"DOY\">";
  // $result += "<option value=\"$value\" selected>Επιλέξτε</option>";
  // while($doy = mysqli_fetch_array($doy_list)){
    // $value++;
    // $result += "<option value=\"$value\">$doy[0]</option>";
  // }
  // $result += "</select>";
  // return $result;
// }

?>
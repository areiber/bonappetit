<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*------------------------------------------------------------------------------
Begin change password process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

/*-----------------------------------------------------
Set requested password change to variables
------------------------------------------------------*/
if (!empty($input["pw"])){
  $pw = $input["pw"];
}
if (!empty($input["new-pw"])){
  $newpw = $input["new-pw"];
}
if (!empty($input["confirm-pw"])){
  $confirmpw = $input["confirm-pw"];
}

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
if (isset($newpw)){
  $clean_newpw = strip_tags($newpw);
}
if (isset($confirmpw)){
  $clean_confirmpw = strip_tags($confirmpw);
}

/*-----------------------------------------------------
Confirm password is correct, then process MySQL
statments to update requested password
------------------------------------------------------*/
$user = $_SESSION["user"];
$password = getPW($user);

if ($pw == $password && $clean_newpw == $clean_confirmpw){
  setPW($user, $clean_newpw);
  $Message = "Password&nbsp;updated!";
  header("Location:http://bonappetit.website/account.html?Success=" . urlencode($Message));
}
elseif ($pw != $password){
  $Message = "Oops, your current password isn't correct! Please try again.";
  header("Location:http://bonappetit.website/password.html?Message=" . urlencode($Message));
}

elseif ($clean_newpw != $clean_confirmpw){
  $Message = "Oops, your new password fields don't match. Please try again.";
  header("Location:http://bonappetit.website/password.html?Message=" . urlencode($Message));
}
/*-----------------------------------------------------

------------------------------------------------------*/

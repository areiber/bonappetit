<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*------------------------------------------------------------------------------
Begin login process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty and that
both form fields have data.
------------------------------------------------------*/
$login_credentials = FALSE;

if (empty($_POST['user']) && empty($_POST['pw'])){
  $Message = "Please enter a username and password";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
}
elseif (empty($_POST['user'])){
  $Message = "Please enter a username";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
}
elseif (empty($_POST['pw'])){
  $Message = "Please enter a password";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
}
if (!empty($_POST['user']) && !empty($_POST['pw'])){
  $login_credentials = TRUE;
}

/*-----------------------------------------------------
Set login input to variables
------------------------------------------------------*/
if ($login_credentials == TRUE){
  $input = $_POST;
  $input_user = $input['user'];
  $input_pw = $input['pw'];

/*-----------------------------------------------------
Confirm username & password
------------------------------------------------------*/
  $correct_user = getUser($input_user);
  $correct_pw = getPW($input_user);

  if ($input_user == $correct_user && $input_pw == $correct_pw){
    $first = getFirst($correct_user);
    $last = getLast($correct_user);
    $email = getEmail($correct_user);
    /*-----------------------------------------------------
    Establish session data and login to site
    ------------------------------------------------------*/
    $_SESSION["user"]=$correct_user;
    $_SESSION["first"]=$first;
    $_SESSION["last"]=$last;
    $_SESSION["email"]=$email;
    header("Location:http://bonappetit.website/reviews.html");
  }
  /*-----------------------------------------------------
  Bad username and/or password credentials
  ------------------------------------------------------*/
  else{
  $Message = "Invalid username and/or password. Please try again.";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
  }
}
?>

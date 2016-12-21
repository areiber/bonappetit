<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*------------------------------------------------------------------------------
Begin form processing
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

/*-----------------------------------------------------
Confirm that the none of the form fields are empty
------------------------------------------------------*/
$fields = array('user','pw','first','last','email');
$errors = array();
foreach($fields AS $fieldname){
  if (empty($input[$fieldname])){
    array_push($errors,$fieldname);
  }
}

/*-----------------------------------------------------
Establish, clean and validate variables for POST data
------------------------------------------------------*/
$user = strtolower($input['user']);
$pw = $input['pw'];
$first = ucfirst(strtolower($input['first']));
$last = ucfirst(strtolower($input['last']));
$email = $input['email'];

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
$clean_user = strip_tags($user);
$clean_pw = strip_tags($pw);
$clean_first = strip_tags($first);
$clean_last = strip_tags($last);
$clean_email = trim(strip_tags($email));

/*-----------------------------------------------------
Begin email validation
------------------------------------------------------*/
$valid = true;
if (!filter_var($clean_email, FILTER_VALIDATE_EMAIL) === true){
  $valid = false;
  $Message = "Please enter a valid email address";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
}

/*-----------------------------------------------------
Confirm username is unique
------------------------------------------------------*/
$unique_user = false;
$username_check = checkUser($clean_user);
if (empty($username_check)==true){
  $unique_user = true;
}

/*-----------------------------------------------------
Confirm email is unique
------------------------------------------------------*/
$unique_email = false;
$email_check = checkEmail($clean_email);
if (empty($email_check)==true){
  $unique_email = true;
}

/*-----------------------------------------------------
Confirm unique credentials
------------------------------------------------------*/

if($unique_user==false && $unique_email==true){
  $Message = "Username already in use, please try another";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
  $valid = false;
  }
if($unique_user==true && $unique_email==false){
  $Message = "Email address already in use, please try another";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
  $valid = false;
  }
if($unique_user==false && $unique_email==false){
  $Message = "Username and email address already in use, please try another";
  header("Location:http://bonappetit.website/index.html?Message=" . urlencode($Message));
  $valid = false;
  }

/*-----------------------------------------------------
Begin MySQL statments after confirming no errors and
original username & email.
------------------------------------------------------*/
  if ($valid==true){
    addUser($clean_user);
    setPW($clean_user, $clean_pw);
    setFirst($clean_user, $clean_first);
    setLast($clean_user,  $clean_last);
    setEmail($clean_user, $clean_email);
    $_SESSION["user"]=$clean_user;
    $_SESSION["first"]=$clean_first;
    $_SESSION["last"]=$clean_last;
    $_SESSION["email"]=$clean_email;
    header("Location:http://bonappetit.website/reviews.html");
  }
?>

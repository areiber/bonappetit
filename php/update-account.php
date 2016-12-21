<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*------------------------------------------------------------------------------
Begin account update process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

/*-----------------------------------------------------
Set requested account changes to variables
------------------------------------------------------*/
$user = $_SESSION["user"];
if (!empty($input["first"])){
  $first = ucfirst(strtolower($input['first']));
}
if (!empty($input["last"])){
  $last = ucfirst(strtolower($input['last']));
}
if (!empty($input["email"])){
  $email = $input["email"];
}

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
if (isset($first)){
  $clean_first = strip_tags($first);
}
if (isset($last)){
  $clean_last = strip_tags($last);
}
if (isset($email)){
  $clean_email = trim(strip_tags($email));
}

/*-----------------------------------------------------
Begin email validation
------------------------------------------------------*/
if (isset($clean_email)){
  if (!filter_var($clean_email, FILTER_VALIDATE_EMAIL) === true){
    echo "Please enter a valid email address";
  }
}

/*-----------------------------------------------------
Process MySQL statments to update requested account
values.
------------------------------------------------------*/
if (isset($clean_first) || isset($clean_last) || isset($clean_email)){
  //Only first name field set
  if (isset($clean_first) && !isset($clean_last) && !isset($clean_email)){
    setFirst($user, $clean_first);
    $_SESSION["first"]=$clean_first;
  }
  //Only last name field set
  elseif (!isset($clean_first) && isset($clean_last) && !isset($clean_email)){
    setLast($user, $clean_last);
    $_SESSION["last"]=$clean_last;
  }
  //Only email field set
  elseif (!isset($clean_first) && !isset($clean_last) && isset($clean_email)){
    setEmail($user, $clean_email);
    $_SESSION["email"]=$clean_email;
  }
  //Only first name and last name fields set
  elseif (isset($clean_first) && isset($clean_last) && !isset($clean_email)){
    setFirst($user, $clean_first);
    setLast($user, $clean_last);
    $_SESSION["first"]=$clean_first;
    $_SESSION["last"]=$clean_last;
  }
  //Only first name and email fields set
  elseif (isset($clean_first) && !isset($clean_last) && isset($clean_email)){
    setFirst($user, $clean_first);
    setEmail($user, $clean_email);
    $_SESSION["first"]=$clean_first;
    $_SESSION["email"]=$clean_email;
  }
  //Only last name and email fields set
  elseif (!isset($clean_first) && isset($clean_last) && isset($clean_email)){
    setLast($user, $clean_last);
    setEmail($user, $clean_email);
    $_SESSION["last"]=$clean_last;
    $_SESSION["email"]=$clean_email;
  }
  //All fields set
  elseif (isset($clean_first) && isset($clean_last) && isset($clean_email)){
    setFirst($user, $clean_first);
    setLast($user, $clean_last);
    setEmail($user, $clean_email);
    $_SESSION["first"]=$clean_first;
    $_SESSION["last"]=$clean_last;
    $_SESSION["email"]=$clean_email;
  }
  $Message = "Your&nbsp;account&nbsp;has&nbsp;been&nbsp;updated&nbsp;successfully!";
  header("Location:http://bonappetit.website/account.html?Success=" . urlencode($Message));
}

else{
  $Message = "Oops! You didn't enter anything to change. Please try again";
  header("Location:http://bonappetit.website/account.html?Message=" . urlencode($Message));
}
?>

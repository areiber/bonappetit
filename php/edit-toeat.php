<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*-----------------------------------------------------
Get current user
------------------------------------------------------*/
$user = $_SESSION['user'];

/*------------------------------------------------------------------------------
Begin edit To Eat process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the REQUEST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_REQUEST)) {
    $input = $_REQUEST;
  }

/*-----------------------------------------------------
Do error checking to ensure required data passed
------------------------------------------------------*/
$completeForm = true;

if (empty($input["cmd"])){
    $completeForm = false;
    $Message="Oops! No command found, please try again.";
    header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}

if (empty($input["rest"])){
    $completeForm = false;
    $Message="Oops! No restaurant entered, please try again.";
    header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}

if (empty($input["food"])){
    $completeForm = false;
    $Message="Oops! No food item entered, please try again.";
    header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}


/*--------------------------------------------------------------
All functions below are reliant on the complete form submission
Set incoming fields to variables
---------------------------------------------------------------*/
if($completeForm = true){
  $command = $input["cmd"];
  $rest = $input["rest"];
  $food = $input["dish"];

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
$clean_rest = htmlspecialchars(strip_tags($rest),ENT_QUOTES);
$clean_food = htmlspecialchars(strip_tags($food),ENT_QUOTES);

/*-----------------------------------------------------------------
Make requested changes to db
-----------------------------------------------------------------*/

/*-----------------------------------------------------
Delete entry from db, if cmd=delete
------------------------------------------------------*/
if($command == 'delete'){
  print_r(json_decode(delToEat($user, $clean_rest, $clean_food)));
  $Message="Successfully&nbsp;removed&nbsp;from&nbsp;your&nbsp;To&nbsp;Eat&nbsp;list!";
  header("Location:http://bonappetit.website/eat.html?Success=" . urlencode($Message));
  }
}
?>

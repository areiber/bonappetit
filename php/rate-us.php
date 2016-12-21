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
Begin rate us process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

/*-----------------------------------------------------
Set app score to variable
------------------------------------------------------*/
if (!empty($input["score"])){
  $score = $input["score"];
}

/*-----------------------------------------------------
If a score is entered, Write it to the db
------------------------------------------------------*/
if (!empty($score)){
  setAppScore($user, $score);
  $Message="Thanks&nbsp;for&nbsp;your&nbsp;review!";
  header("Location:http://bonappetit.website/rate.html?Success=" . urlencode($Message));
}

elseif(empty($score)){
  $Message="Oops! No review score entered. Please try again.";
  header("Location:http://bonappetit.website/rate.html?Message=" . urlencode($Message));
}

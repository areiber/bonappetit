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
Begin add To Eat process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

/*-----------------------------------------------------
Set non-empty fields to variables
------------------------------------------------------*/
if (!empty($input["restaurant"])){
  $rest = ucwords(strtolower($input["restaurant"]));
}

if (!empty($input["dish"])){
  $food = ucwords(strtolower($input["dish"]));
}

if (!empty($input["comments"])){
  $comments = $input["comments"];
}

/*-----------------------------------------------------
Do error checking for empty fields
------------------------------------------------------*/
$completeForm = true;

if (!isset($rest) && isset($food)){
  $completeForm = false;
  $Message="Oops! Please enter a restaurant name.";
  header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}

if (isset($rest) && !isset($food)){
  $completeForm = false;
  $Message="Oops! Please enter a food dish.";
  header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}

if (!isset($rest) && !isset($food) && !isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a restaurant name and food dish.";
  header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
$clean_rest = htmlspecialchars(strip_tags($rest),ENT_QUOTES);
$clean_food = htmlspecialchars(strip_tags($food),ENT_QUOTES);
if (isset($comments)){
  $clean_comments= htmlspecialchars(strip_tags($comments));
}

/*-----------------------------------------------------
Check if requested To Eat already exists in the db
------------------------------------------------------*/
$exists = (json_decode(chkExist($user,$clean_rest, $clean_food))[0]->{id});
if($exists != ""){
  $completeForm = false;
  $Message="Oops, this dish already exists in your To Eat or Reviews list";
  header("Location:http://bonappetit.website/eat.html?Message=" . urlencode($Message));
}


/*-----------------------------------------------------------------
Write To Eat to db
-----------------------------------------------------------------*/

/*-----------------------------------------------------
Add username to new row in foods table, return row ID
------------------------------------------------------*/
if($completeForm == true){
  $id = addFoodUser($user);

/*-----------------------------------------------------
Add To Eat to the corresponding db row
------------------------------------------------------*/
  setRest($id, $clean_rest);
  setFood($id, $clean_food);
  setFoodComments($id, $clean_comments);
  $Message="Successfully&nbsp;added&nbsp;to&nbsp;your&nbsp;To&nbsp;Eat&nbsp;list!";
  header("Location:http://bonappetit.website/eat.html?Success=" . urlencode($Message));
}
?>

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
Begin food review process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

/*-----------------------------------------------------
Set restaurant name to variable
------------------------------------------------------*/
if (!empty($input["restaurant"])){
  $rest = ucwords(strtolower($input["restaurant"]));
}

/*-----------------------------------------------------
Set food dish name to variable
------------------------------------------------------*/
if (!empty($input["dish"])){
  $food = ucwords(strtolower($input["dish"]));
}

/*-----------------------------------------------------
Set comments to variable
------------------------------------------------------*/
if (!empty($input["comments"])){
  $comments = $input["comments"];
}

/*-----------------------------------------------------
Set food score to variable
------------------------------------------------------*/
if (!empty($input["score"])){
  $score = $input["score"];
}

/*-----------------------------------------------------------------
Write food review to db if all fields except comments are complete
-----------------------------------------------------------------*/
/*-----------------------------------------------------
Do error checking for empty fields
------------------------------------------------------*/
$completeForm = true;

if (!isset($rest) && isset($food) && isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a restaurant name.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

if (isset($rest) && !isset($food) && isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a food dish.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

if (isset($rest) && isset($food) && !isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a review score.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

if (!isset($rest) && !isset($food) && isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a restaurant name and food dish.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

if (!isset($rest) && isset($food) && !isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a restaurant name and review score.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

if (isset($rest) && !isset($food) && !isset($score)){
  $completeForm = false;
  $Message="Oops! Please enter a food dish and review score.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

if (!isset($rest) && !isset($food) && !isset($score)){
  $completeForm = false;
  $Message="Oops! Your review is empty, please try again.";
  header("Location:http://bonappetit.website/reviews.html?Message=" . urlencode($Message));
}

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
$clean_rest = htmlspecialchars(strip_tags($rest),ENT_QUOTES);
$clean_food = htmlspecialchars(strip_tags($food),ENT_QUOTES);
$clean_score = strip_tags($score);
if (isset($comments)){
  $clean_comments= htmlspecialchars(strip_tags($comments));
}



/*-----------------------------------------------------
Check for existing data in db for To Eat
------------------------------------------------------*/
$exists = (json_decode(chkExist($user,$clean_rest,$clean_food))[0]->{id});
if($exists != ""){
  $completeForm = false;
  $existing = true;
  $foodID = $exists;
}

/*-----------------------------------------------------
Add username to new row in foods table, return row ID
------------------------------------------------------*/
if($completeForm == true){
  $id = addFoodUser($user);

/*-----------------------------------------------------
Add the food review to the corresponding db row
------------------------------------------------------*/
  setRest($id, $clean_rest);
  setFood($id, $clean_food);
  setFoodComments($id, $comments);
  setFoodScore($id, $clean_score);
  $Message="Thanks&nbsp;for&nbsp;your&nbsp;review!";
  header("Location:http://bonappetit.website/reviews.html?Success=" . urlencode($Message));
}

if($existing == true){
  setFoodScore($foodID, $score);
  setFoodComments($foodID,$comments);
  $Message="Thanks&nbsp;for&nbsp;your&nbsp;review!";
  header("Location:http://bonappetit.website/reviews.html?Success=" . urlencode($Message));
}
?>

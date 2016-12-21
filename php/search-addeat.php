<?php
/*-----------------------------------------------------
Set required files
------------------------------------------------------*/
require 'db.php';

/*------------------------------------------------------------------------------
Begin add To Eat process
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the Request command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_REQUEST)) {
    $input = $_REQUEST;
  }

/*-----------------------------------------------------
Set non-empty fields to variables
------------------------------------------------------*/
if (!empty($input["rest"])){
  $rest = $input["rest"];
}

/*-----------------------------------------------------
Do error checking for empty fields
------------------------------------------------------*/
$completeForm = true;

if (!isset($rest)){
  $completeForm = false;
  $Message="Oops! Please enter a restaurant name.";
  header("Location:http://bonappetit.website/new-review.html?Message=" . urlencode($Message));
}

/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
$clean_rest = htmlspecialchars(strip_tags($rest),ENT_QUOTES);

/*-----------------------------------------------------
Pass on request to add to eat page
------------------------------------------------------*/
if ($completeForm = true){
header("Location:http://bonappetit.website/eat.html?SearchAdd=" . urlencode($clean_rest));
}
?>

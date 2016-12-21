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
if (!empty($_REQUEST)) {
    $input = $_REQUEST;
  }

/*-----------------------------------------------------
Set incoming query to variables
------------------------------------------------------*/
if (!empty($input["rest"])){
  $rest = ucwords(strtolower($input["rest"]));
}

if (!empty($input["dish"])){
  $food = ucwords(strtolower($input["dish"]));
}

/*--------------- NOT USING AT THIS TIME ------------------------------
if (!empty($input["comments"])){
  $comments = $input["comments"];
}
  --------------------------------------------------------------------*/
/*-----------------------------------------------------
Begin data sanitization
------------------------------------------------------*/
$clean_rest = htmlspecialchars(strip_tags($rest),ENT_QUOTES);
$clean_food = htmlspecialchars(strip_tags($food),ENT_QUOTES);
/*--------------- NOT USING AT THIS TIME ------------------------------
if (isset($comments)){
  $clean_comments= htmlspecialchars(strip_tags($comments));
}
  --------------------------------------------------------------------*/

/*-----------------------------------------------------
Pass on request to add to New Review section
------------------------------------------------------*/
if ($completeForm = true){
header("Location:http://bonappetit.website/reviews.html?rest=" . urlencode($clean_rest) . "&food=" . urlencode($clean_food));
}

?>

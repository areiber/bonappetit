<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*------------------------------------------------------------------------------
Parse incoming query strings (GET commands) to determine what queries are being
made. Acceptable queries:
    • cmd <- used to indicate type of command being made
    • user <- requested username
    • first <- requested first name
    • last <- requested last name
    • email <- requested email address
    • pw <- requested pw
    • rest <- restaurant name
    • food <- food item name
    • score <- review score for food item or app
    • message <- user comments for food review or for contact us message
------------------------------------------------------------------------------*/
if (isset($_REQUEST['cmd'])){
   $command = $_REQUEST['cmd'];
}


/*------------------------------------------------------------------------------
Do error handling to ensure proper values are passed in the query
Acceptable query values:
    • cmd:
      • newUser
      • login
      • resetPW
      • getRests
      • getFoods
      • getAcctInfo
      • updateAcct
      • updatePW
      • reviewFood
      • contact
      • avgAppScore ????????
      • reviewFood
      • addToEat
      • removeToEat
      • avgFoodScore ????????
------------------------------------------------------------------------------*/



function doError($data, $code = 400) {
  if(is_array($data)) {
    $errorText = json_encode($data);
  } else {
    $errorText = $data;
  }
  $error = array("error" => $errorText);
  returnResponse($error, $code);
}


/*------------------------------------------------------------------------------
Login Page
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Process new account creation: write username, first,
last, email, password to db table: users
------------------------------------------------------*/
function newUser($user, $first, $last, $email, $pw){

}


/*-----------------------------------------------------
Process login credentials - confirm username exists and
password matches the value from the db table: users
------------------------------------------------------*/
function login($user, $pw){

}


/*-----------------------------------------------------
Process Forgot Password - confirm username exists...

 ??? What verification are we using to determine
  eligibility to change pw ???
------------------------------------------------------*/
function resetPW($user, $pw){

}




/*------------------------------------------------------------------------------
My Reviews Page
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Retrieve reviewed restaurants from db table: foods
------------------------------------------------------*/
function getRests($user){

}


/*-----------------------------------------------------
Retrieve reviewed food items for a given restaurant
from db table: foods
------------------------------------------------------*/
function getFoods($user, $rest){

}


/*------------------------------------------------------------------------------
My Account Page
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Retrieve first, last, email from the db
table: users for display.
------------------------------------------------------*/
function getAcctInfo($user){

}


/*-----------------------------------------------------
Write first, last and/or email to the db table: users
if edited & upon submission.
------------------------------------------------------*/
function updateAcct($first='', $last='', $email=''){

}


/*-----------------------------------------------------
Confirm current password in db table: users, if it
matches, write new password to db table: users for
"Change Password" page.
------------------------------------------------------*/
function updatePW($user, $pw){

}


/*------------------------------------------------------------------------------
Rate Us Page
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Write the app score to the db table: users
------------------------------------------------------*/
function reviewApp($user, $score){

}


/*-----------------------------------------------------
Retrieve the review scores and number of reviews for
the app and generate the average review.
------------------------------------------------------*/
function avgAppScore(){

}


/*------------------------------------------------------------------------------
Contact Us Page
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Process contact form by emailing the message to a
specified email address
------------------------------------------------------*/
function contact($user, $message){

}


/*------------------------------------------------------------------------------
Create a Review Page (for food items)
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Write username, restaurant, food, score and comments to
db table: foods.
------------------------------------------------------*/
function reviewFood($user, $rest, $food, $score, $message){

}


/*------------------------------------------------------------------------------
To Eat page
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Add a Google Places result to the db table: foods.
------------------------------------------------------*/
function addEat($user, $rest, $food){

}


/*-----------------------------------------------------
Remove a Google Places result from the db table: foods.
------------------------------------------------------*/
function removeEat($user, $rest, $food){

}


/*-----------------------------------------------------
Retrieve the average food review score for a given item
at a given restaurant. Score also used on "Search" page.
------------------------------------------------------*/
function avgFoodScore($rest, $food){

}

/*------------------------------------------------------------------------------
Return response
------------------------------------------------------------------------------*/
function returnResponse($data, $code = 200) {
    http_response_code($code);
    $response = json_encode($data, JSON_PRETTY_PRINT);
    return($response);
  }
?>

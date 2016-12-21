<?php
/*-----------------------------------------------------
Start Session & set header and requirements
------------------------------------------------------*/
session_start();
// header('Content-type: text/json');
require 'db.php';

/*------------------------------------------------------------------------------
Begin contact script
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Confirm that the POST command isn't empty
------------------------------------------------------*/
  $input = "";
  if (!empty($_POST)) {
    $input = $_POST;
  }

$complete = true;

if (empty($input["contact-comments"])){
  $complete = false;
  $Message = "Please enter comments before submitting";
  header("Location:http://bonappetit.website/contact.html?Message=" . urlencode($Message));
}

if ($complete == true){
/*-----------------------------------------------------
Set incoming and outgoing email addresses
------------------------------------------------------*/
    $to = "areiber@email.arizona.edu,gflora@email.arizona.edu,andrewmatyas@email.arizona.edu";
    $from = $_POST['email'];

/*-----------------------------------------------------
Store user credentials to variables
------------------------------------------------------*/
    $user = $_POST['user'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];

/*-----------------------------------------------------
Store email info to variables
------------------------------------------------------*/
    $subject = "Bon-App-etit Contact Submission";
    $message = $first . " " . $last . ", AKA " . $user . ", wrote the following:" . "\n\n" . $_POST['contact-comments'];
    $message = wordwrap($message,70);
    $header = 'From: ' . $email;

/*-----------------------------------------------------
Initiate mail sequence
------------------------------------------------------*/
    mail($to, $subject, $message, $header);
    $Message = "Message&nbsp;sent!";
    header("Location:http://bonappetit.website/reviews.html?Success=" . urlencode($Message));
}
?>

<?php
/*------------------------------------------------------------------------------
Connect to database, establish it as a PDO and set it to global variable db
------------------------------------------------------------------------------*/
function getDB() {
  global $db;

  // $dsn = 'mysql:dbname=id16023_bonappdb;host=localhost';
  // $dbuser = 'id16023_admin';
  $dsn = 'mysql:dbname=bonappet_db;host=localhost';
  $dbuser = 'bonappet_admin';
  $dbpassword = 'ista_416';
  if (gettype($db) != 'object'){
    $db = new PDO($dsn, $dbuser, $dbpassword);
  }
  return $db;
}

/*------------------------------------------------------------------------------
User account MySQL commands for users table
------------------------------------------------------------------------------*/

/*-----------------------------------------------------
Write username to new row in users table
------------------------------------------------------*/
function addUser($user){
  $db = getDB();
  $sql = "INSERT INTO users (username) VALUES (?)";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
}

/*-----------------------------------------------------
Write password to existing record in users table
------------------------------------------------------*/
function setPW($user, $pw){
  $db = getDB();
  $sql = "UPDATE users SET password=? WHERE username=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$pw}","{$user}"));
}

/*-----------------------------------------------------
Write first name to existing record in users table
------------------------------------------------------*/
function setFirst($user, $first){
  $db = getDB();
  $sql = "UPDATE users SET first=? WHERE username=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$first}","{$user}"));
}

/*-----------------------------------------------------
Write last name to existing record in users table
------------------------------------------------------*/
function setLast($user, $last){
  $db = getDB();
  $sql = "UPDATE users SET last=? WHERE username=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$last}","{$user}"));
}

/*-----------------------------------------------------
Write email to existing record in users table
------------------------------------------------------*/
function setEmail($user, $email){
  $db = getDB();
  $sql = "UPDATE users SET email=? WHERE username=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$email}","{$user}"));
}

/*-----------------------------------------------------
Write app review score to existing record in users table
------------------------------------------------------*/
function setAppScore($user, $score){
  $db = getDB();
  $sql = "UPDATE users SET app_score=? WHERE username=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$score}","{$user}"));
}

/*-----------------------------------------------------
Check if username is unique in users table
------------------------------------------------------*/
function checkUser($user){
  $db = getDB();
  $sql = "SELECT id FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Check if email is unique in users table
------------------------------------------------------*/
function checkEmail($email){
  $db = getDB();
  $sql = "SELECT id FROM users WHERE email =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$email}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Retrieve username of current user from users table
------------------------------------------------------*/
function getUser($user){
  $db = getDB();
  $sql = "SELECT username FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Retrieve password of current user from users table
------------------------------------------------------*/
function getPW($user){
  $db = getDB();
  $sql = "SELECT password FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Retrieve first name of current user from users table
------------------------------------------------------*/
function getFirst($user){
  $db = getDB();
  $sql = "SELECT first FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Retrieve last name of current user from users table
------------------------------------------------------*/
function getLast($user){
  $db = getDB();
  $sql = "SELECT last FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Retrieve email of current user from users table
------------------------------------------------------*/
function getEmail($user){
  $db = getDB();
  $sql = "SELECT email FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*-----------------------------------------------------
Retrieve app score of current user from users table
------------------------------------------------------*/
function getAppScore($user){
  $db = getDB();
  $sql = "SELECT score FROM users WHERE username =?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetch();
  $response = $response['0'];
  return $response;
}

/*------------------------------------------------------------------------------
Review & To Eat commands for foods table
------------------------------------------------------------------------------*/
/*-----------------------------------------------------
Helper function - Retrieves ID of last inserted row
------------------------------------------------------*/

function dbLastInsertID() {
  $db = getDB();
  $stmt = $db->query("SELECT LAST_INSERT_ID()");
  $lastId = $stmt->fetch();
  $lastId = $lastId[0];
  return $lastId;
}

/*-----------------------------------------------------
Write username to new row in foods table, return
unique ID
------------------------------------------------------*/
function addFoodUser($user){
  $db = getDB();
  $sql = "INSERT INTO foods (username) VALUES (?)";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $id = dbLastInsertID();
  return $id;
}

/*-----------------------------------------------------
Write restaurant name to existing record in foods table
------------------------------------------------------*/
function setRest($foodID, $rest){
  $db = getDB();
  $sql = "UPDATE foods SET restaurant=? WHERE id=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$rest}","{$foodID}"));
}

/*-----------------------------------------------------
Write food name to existing record in foods table
------------------------------------------------------*/
function setFood($foodID, $food){
  $db = getDB();
  $sql = "UPDATE foods SET food=? WHERE id=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$food}","{$foodID}"));
}

/*-----------------------------------------------------
Write comments to existing record in foods table
------------------------------------------------------*/
function setFoodComments($foodID, $comments){
  $db = getDB();
  $sql = "UPDATE foods SET comments=? WHERE id=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$comments}","{$foodID}"));
}

/*-----------------------------------------------------
Write review score to existing record in foods table
------------------------------------------------------*/
function setFoodScore($foodID, $score){
  $db = getDB();
  $sql = "UPDATE foods SET score=? WHERE id=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$score}","{$foodID}"));
}

/*-----------------------------------------------------
Retrieve all restaurant names containing reviewed foods
for a given user (Reviewed restaurants)

http://prash.me/php-pdo-and-prepared-statements/
------------------------------------------------------*/
function getRests($user){
  $db = getDB();
  $sql = "SELECT restaurant FROM foods WHERE username =? AND score IS NOT NULL";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Retrieve all reviewed food items for a given user and
restaurant from foods table. (Reviewed foods)
------------------------------------------------------*/
function getFoods($user, $restaurant){
  $db = getDB();
  $sql = "SELECT food FROM foods WHERE username =? AND restaurant=? AND score IS NOT NULL";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}", "{$restaurant}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Retrieve review scores for a given food item and
restaurant in foods table.
------------------------------------------------------*/
function getFoodReviews($user, $restaurant, $food){
  $db = getDB();
  $sql = "SELECT score FROM foods WHERE username =? AND restaurant=? AND food=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}", "{$restaurant}", "{$food}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Retrieve all restaurant names containing non-reviewed
foods for a given user from foods table.
(To eat restaurants)
------------------------------------------------------*/
function getToEatRests($user){
  $db = getDB();
  $sql = "SELECT restaurant FROM foods WHERE username =? AND score IS NULL";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Retrieve all non-reviewed food items for a given user
and restaurant from foods table. (To eat foods)
------------------------------------------------------*/
function getToEatFoods($user, $restaurant){
  $db = getDB();
  $sql = "SELECT food FROM foods WHERE username =? AND restaurant=? AND score IS NULL";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}", "{$restaurant}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Retrieve comments from food table
------------------------------------------------------*/
function getComments($user, $restaurant, $food){
  $db = getDB();
  $sql = "SELECT comments FROM foods WHERE username =? AND restaurant=? AND food=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}", "{$restaurant}", "{$food}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Confirm a restaurant/food combination doesn't already
exist for a user.
------------------------------------------------------*/
function chkExist($user, $rest, $food){
  $db = getDB();
  $sql = "SELECT id FROM foods WHERE username=? AND restaurant=? AND food=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}", "{$rest}", "{$food}"));
  $response = $stmt->fetchAll();
  $response = json_encode($response, JSON_PRETTY_PRINT);
  return $response;
}

/*-----------------------------------------------------
Delete a To Eat entry from the food table
------------------------------------------------------*/
function delToEat($user, $rest, $food){
  $db = getDB();
  $sql = "DELETE FROM foods WHERE username=? AND restaurant=? AND food=?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array("{$user}", "{$rest}", "{$food}"));
}

?>

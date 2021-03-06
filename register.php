<?php
require_once('config.php'); 
require_once('lab14-db-functions.inc.php'); 


function getFields(){
$insertSQL = "INSERT INTO d1eamej0bobjmtrf.user (id, firstname, lastname, city, country, email, password, salt, password_sha256)";
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$city = $_POST['city'];
$country = $_POST['country'];
$email = $_POST['email'];
$password = passwordBcrypt($_POST['password']);
$userNumber = generateUserNumber();
$insertSQL .= " values ('$userNumber', '$firstName', '$lastName', '$city', '$country', '$email', '$password', ' ', ' ')";
registerUser($email, $insertSQL);
}

function registerUser ($email, $insertSQL) {
  if (!checkEmail($email)){
    saveNewUser($insertSQL); 
    echo "registered";
    echo "</br>";
  } else {
    echo "email error!";
    echo "<button id='backButton' action = 'signup.php'>Back</button>";
  }
}

function generateUserNumber() {
  try {
    $count = 0;
    $connection=setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    $sql = 'SELECT * FROM d1eamej0bobjmtrf.user';
    $statement = runQuery($connection, $sql, null);
    if ($statement){
    foreach ($statement as $s){
      $count++;
    }
    }
  $connection = null;
    return $count;
    }
  catch (PDOException $e) {
     die( $e->getMessage() );
  }
}

function checkEmail ($email) {
  try {
    $result = false;
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    $sql = 'SELECT email FROM d1eamej0bobjmtrf.user';
    $statement = runQuery($connection, $sql, null);
    foreach ($statement as $s){
      if ($email == $s[0]){
          $result = strcmp($email, $s[0]);
        $result = true;
      } 
    }
    $connection = null;
    return $result;
  }
  catch (PDOException $e) {
     die( $e->getMessage() );
  }

}

function saveNewUser ($sql){
  try {
    $connection=setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    runQuery($connection, $sql, null);
 } catch (PDOEcemption $e){
   die ($e->getMessage());
 }
}

function passwordBcrypt($password){
$newPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
  return $newPassword;
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Sign Up</title>
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800"
      rel="stylesheet"
    />
  </head>
  <body>
  <?php getFields();?>
</body>
</html>
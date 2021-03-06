<?php
require_once('signupConfig.inc.php'); 
require_once('lab14-db-functions.inc.php'); 

$insertSQL = "insert into user (FirstName, LastName, City, Country, Email, Password, UserNumber)";
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$city = $_POST['city'];
$country = $_POST['country'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPass = $_POST['confirmPass'];
$account = [$firstName, $lastName, $city, $country, $email, $password];
$userNumber = generateUserNumber();
$insertSQL .= " values ('$firstName', '$lastName', '$city', '$country', '$email', '$password', '$userNumber');";


function registerUser ($email, $insertSQL) {
  if (!checkEmail($email)){
    saveNewUser($insertSQL); 
    echo "registered";
  } else {
    echo "Email Already Registered";
  }
}


function generateUserNumber() {
  try {
    $count = 0;
    $connection=setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    $sql = 'select * from user';
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
    $sql = 'select Email from user';
    $statement = runQuery($connection, $sql, null);
    foreach ($statement as $s){
      if ($email == $s[0]){
          $result = strcmp($email, $s[0]);
          echo $result;
        $result = true;
        echo $result;
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
    <link rel="stylesheet" href="signup.css" />
  </head>
  <body>
    <?php 
    registerUser($email, $insertSQL);
    ?>
    </body>
</html>
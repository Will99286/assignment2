<?php 

//Establishing the connection (source: https://www.php.net/manual/en/function.mysqli-connect.php)
$link = mysqli_connect("127.0.0.1", "root", "", "User");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


//Setting up the variables
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);


//Database Retrieval, Password verification, and conditionals
$qry = "SELECT email, password FROM users WHERE email = '$email'";
$result = mysqli_query($link, $qry);
$row = mysqli_fetch_assoc($result);

$dbemail = $row['email'];
$dbpass = password_verify($password, $row['password']);  //https://www.php.net/manual/en/function.password-verify.php

if($email == $dbemail && $dbpass) {
    session_start();
    $_SESSION["userid"] = $row["id"];
    header("Location: test-page.php");
    exit();
}
else
{
    header("Location: login.php?error=1");
	exit(); 
}
	


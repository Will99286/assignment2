<?php
include 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>  
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../CSS/index.css" />
    </head>
    <body id="hero">
	<h1>Home</h1>
        <div id="container">
            <div id="homeContainer">
                <div>
                    <button onclick="window.location='login.php'" id="login">Login</button>
                </div>
                <div>
                    <button onclick="window.location='signup.php'" id="join">Join</button>
                </div>
                <div id="search">
                    <input type="text" name="" id="searchMovie" placeholder="SEARCH BOX FOR Movies">
                    <button onclick="" id="procSearch"></button>
                </div>
            </div>
        </div>
    </body>
    <section>
        <script src="../JS/home.js"></script>
    </section>
</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>  
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../CSS/home.css" />
    </head>
    <body id="hero">
        <div id="container">
            <div id="homeContainer">
                <div>
                    <button onclick="window.location='login.php'" id="login">Login</button>
                </div>
                <div>
                    <button onclick="window.location='signup.php'" id="join">Join</button>
                </div>
                <div id="search">
                    <form method="get" action="browse.php">
                        <input type="text" name="title" id="searchMovie" placeholder="SEARCH BOX FOR Movies">
                        <button onclick="" id="procSearch"></button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <section>
        <script src="../JS/home.js"></script>
    </section>
</html>
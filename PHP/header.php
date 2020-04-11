<?php
    session_start();

    $loggedIn = false;
    if(isset($_SESSION['loggedIn'])){
        $loggedIn = $_SESSION['loggedIn'];
    }

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/header.css">
</head>

<body>

    <header>
        <nav>
            <div class="logo">COMP 3512</div>

            <ul class="headerList">

                <?php
                    if($loggedIn){
                        ?>
                        <li><a href="homeloggedin.php">Home</a></li> 
                        <li><a href="favorites.php">Favorites</a></li>
                        <li><a href="browse.php">Browser</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="about.php">About</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="browse-movies.php">Browser</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="signup.php">Registration</a></li>
                        <li><a href="aboutPage.php">About</a></li>
                        <?php
                    }
                ?>
            </ul>
        </nav>
    </header> 
</body>

    <script type="text/javascript" src="../JS/header.js"></script>
</html>
<?php
function openCon()
    /* Code from https://www.cloudways.com/blog/connect-mysql-with-php/*/
{
    $host = "localhost";
    $user = "root";
    $pass = "iHMrpsdFnuuiC644";
    $db = "users";

    $conn = new mysqli($host, $user, $pass, $db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function closeCon($conn)
{
    $conn -> close();
}
?>
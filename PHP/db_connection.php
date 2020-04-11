<?php
function openCon()
    /* Code from https://www.cloudways.com/blog/connect-mysql-with-php/*/
{
    $host = "bbj31ma8tye2kagi.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $user = "xn917ff8eniatzex";
    $pass = "j6tpsor98ckdnsmx";
    $db = "d1eamej0bobjmtrf";

    $conn = new mysqli($host, $user, $pass, $db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function closeCon($conn)
{
    $conn -> close();
}
?>
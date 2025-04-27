<?php
$host = "localhost";
$user = "root";        // ya aapka DB username
$pass = "";            // ya password, mostly "" local me
$db = "db";            // <-- YAHI PE CHANGE KARNA HAI

$con = mysqli_connect($host, $user, $pass, $db);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}
?>

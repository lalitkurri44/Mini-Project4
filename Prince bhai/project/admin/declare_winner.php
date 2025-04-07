<?php
include "../config.php";
$id = $_GET['id'];
$winner = $_GET['winner'];

mysqli_query($con, "UPDATE matches SET winner=$winner WHERE id=$id");
header("Location: admin.php");
?>

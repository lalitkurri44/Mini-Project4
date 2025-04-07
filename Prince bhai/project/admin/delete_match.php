<?php
include "../config.php";
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM matches WHERE id=$id");
header("Location: admin.php");
?>

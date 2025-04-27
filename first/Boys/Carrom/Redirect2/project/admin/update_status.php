<?php
include "../config.php";
$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($con, "UPDATE matches SET status='$status' WHERE id=$id");
header("Location: admin.php");
?>

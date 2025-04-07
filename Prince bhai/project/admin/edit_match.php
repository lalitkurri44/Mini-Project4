<?php
include "../config.php";
$id = $_GET['id'];
$res = mysqli_query($con, "SELECT * FROM matches WHERE id=$id");
$row = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {
    $p1 = $_POST['player1_name'];
    $p2 = $_POST['player2_name'];
    $date = $_POST['match_date'];
    $timer = $_POST['timer'];

    // Default images if not updated
    $p1_img = $row['player1_image'];
    $p2_img = $row['player2_image'];

    // Player 1 Image Upload
    if ($_FILES['player1_image']['name']) {
        $target1 = "uploads/" . basename($_FILES['player1_image']['name']);
        if (move_uploaded_file($_FILES['player1_image']['tmp_name'], $target1)) {
            $p1_img = $target1;
        } else {
            echo "<script>alert('Player 1 image upload failed!');</script>";
        }
    }

    // Player 2 Image Upload
    if ($_FILES['player2_image']['name']) {
        $target2 = "uploads/" . basename($_FILES['player2_image']['name']);
        if (move_uploaded_file($_FILES['player2_image']['tmp_name'], $target2)) {
            $p2_img = $target2;
        } else {
            echo "<script>alert('Player 2 image upload failed!');</script>";
        }
    }

    // Update DB
    mysqli_query($con, "UPDATE matches SET 
        player1_name='$p1', 
        player2_name='$p2', 
        match_date='$date', 
        timer='$timer', 
        player1_image='$p1_img', 
        player2_image='$p2_img' 
        WHERE id=$id
    ");

    echo "<script>alert('Match updated successfully'); window.location.href='admin.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Match</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f9f9f9; }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], input[type="datetime-local"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="file"] { margin-top: 5px; }
        img {
            margin-top: 10px;
            height: 80px;
            border-radius: 6px;
            border: 2px solid #007bff;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Edit Match</h2>
<form method="post" enctype="multipart/form-data">
    <label>Player 1 Name:</label>
    <input type="text" name="player1_name" value="<?= $row['player1_name'] ?>" required>

    <label>Player 1 Image:</label>
    <input type="file" name="player1_image">
    <img src="<?= $row['player1_image'] ?>" alt="Player 1">

    <label>Player 2 Name:</label>
    <input type="text" name="player2_name" value="<?= $row['player2_name'] ?>" required>

    <label>Player 2 Image:</label>
    <input type="file" name="player2_image">
    <img src="<?= $row['player2_image'] ?>" alt="Player 2">

    <label>Match Date:</label>
    <input type="datetime-local" name="match_date" value="<?= date('Y-m-d\TH:i', strtotime($row['match_date'])) ?>" required>

    <label>Match Timer (in minutes):</label>
    <input type="number" name="timer" value="<?= $row['timer'] ?>" required>

    <button type="submit" name="update">Update Match</button>
</form>

</body>
</html>

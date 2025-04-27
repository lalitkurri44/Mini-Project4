<?php include "../config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Match</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="file"], input[type="number"], input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Add New Carrom Match</h2>
    <form method="POST" enctype="multipart/form-data">
        Player 1 Name: <input type="text" name="player1_name" required>
        Player 1 Image: <input type="file" name="player1_image" required>

        Player 2 Name: <input type="text" name="player2_name" required>
        Player 2 Image: <input type="file" name="player2_image" required>

        Timer (minutes): <input type="number" name="timer" value="5" min="1" max="30">

        Match Date/Time: <input type="datetime-local" name="match_date" required>

        <input type="submit" name="submit" value="Add Match">
    </form>

<?php
if(isset($_POST['submit'])) {
    $p1 = $_POST['player1_name'];
    $p2 = $_POST['player2_name'];
    $timer = $_POST['timer'];
    $date = $_POST['match_date'];

    // Public image path for DB and HTML
    $public_dir = "uploads/";
    // Actual server path to save files
    $upload_dir = "../uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Image file names
    $p1_img = time() . "_p1_" . basename($_FILES['player1_image']['name']);
    $p2_img = time() . "_p2_" . basename($_FILES['player2_image']['name']);

    $p1_target = $upload_dir . $p1_img;
    $p2_target = $upload_dir . $p2_img;

    if (move_uploaded_file($_FILES['player1_image']['tmp_name'], $p1_target) &&
        move_uploaded_file($_FILES['player2_image']['tmp_name'], $p2_target)) {

        $sql = "INSERT INTO matches 
            (player1_name, player2_name, player1_image, player2_image, timer, match_date)
            VALUES 
            ('$p1', '$p2', '$public_dir$p1_img', '$public_dir$p2_img', '$timer', '$date')";

        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Match added successfully!'); window.location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Database error: ".mysqli_error($con)."');</script>";
        }

    } else {
        echo "<script>alert('Image upload failed!');</script>";
    }
}
?>
</body>
</html>

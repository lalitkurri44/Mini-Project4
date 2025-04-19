<?php
include "../config.php";

if (!isset($_GET['id'])) {
    echo "Invalid Request";
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM carrom_boys WHERE id='$id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found";
    exit();
}

if (isset($_POST['update'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);

    $profilePath = $user['profile']; // default old image

    if (!empty($_FILES['profile']['name'])) {
        $img_loc = $_FILES['profile']['tmp_name'];
        $img_name = $_FILES['profile']['name'];
        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $img_size = $_FILES['profile']['size'] / (1024 * 1024);

        $allowed_ext = ["jpg", "jpeg", "png", "webp"];
        if (!in_array($img_ext, $allowed_ext)) {
            echo "<script>alert('Invalid Image Extension');</script>";
            exit();
        }

        if ($img_size > 3) {
            echo "<script>alert('Image size is greater than 3MB');</script>";
            exit();
        }

        $new_img_name = $username . "." . $img_ext;
        $img_path = "../Uploaded Images/" . $new_img_name;

        if (move_uploaded_file($img_loc, $img_path)) {
            $profilePath = "Uploaded Images/" . $new_img_name;
        }
    }

    $update_query = "UPDATE carrom_boys SET 
        username='$username',
        email='$email',
        contact='$contact',
        profile='$profilePath'
        WHERE id='$id'";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('User updated successfully'); window.location.href='user-table.php';</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User - ID <?= $user['id']; ?></h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?= $user['username']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $user['email']; ?>" required><br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?= $user['contact']; ?>" required><br><br>

        <label>Change Profile Picture:</label><br>
        <input type="file" name="profile"><br><br>

        <?php if ($user['profile']) { ?>
            <img src="../<?= $user['profile']; ?>" width="80" style="border-radius:50px;">
        <?php } ?>

        <br><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>

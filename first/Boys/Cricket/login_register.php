<?php
session_start();
require('connection.php'); // Use consistent connection file

// ================== LOGIN =====================
if (isset($_POST['login'])) {
    $email_username = mysqli_real_escape_string($con, $_POST['email_username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM box_cricket WHERE email='$email_username' OR username='$email_username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $result_fetch = mysqli_fetch_assoc($result);

        if (password_verify($password, $result_fetch['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $result_fetch['username'];

            header("Location: box_cricket.html");
            exit();
        } else {
            echo "<script>
                alert('Incorrect password');
                window.location.href='login.php';
                </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Email or Username not registered');
            window.location.href='register.php';
            </script>";
        exit();
    }
}


// ================== REGISTER =====================
if (isset($_POST['register'])) {
    require('connection.php');

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email    = mysqli_real_escape_string($con, $_POST['email']);
    $contact  = mysqli_real_escape_string($con, $_POST['contact']);
    $team     = mysqli_real_escape_string($con, $_POST['team_name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $check_query = "SELECT * FROM box_cricket WHERE username='$username' OR email='$email'";
    $result = mysqli_query($con, $check_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $result_fetch = mysqli_fetch_assoc($result);
        if ($result_fetch['username'] == $username) {
            echo "<script>
                alert('$username - Username already taken');
                window.location.href='register.php';
                </script>";
        } else {
            echo "<script>
                alert('$email - Email already taken');
                window.location.href='register.php';
                </script>";
        }
    } else {
        // Insert basic info
        $insert_query = "INSERT INTO box_cricket (username, email, password, contact, team_name)
                         VALUES ('$username', '$email', '$password', '$contact', '$team')";

        if (mysqli_query($con, $insert_query)) {

            // Profile Photo
            $profile_tmp = $_FILES['profile']['tmp_name'];
            $profile_name = $_FILES['profile']['name'];
            $profile_ext = strtolower(pathinfo($profile_name, PATHINFO_EXTENSION));
            $profile_size = $_FILES['profile']['size'] / (1024 * 1024);

            // Team Photo
            $team_tmp = $_FILES['team_photo']['tmp_name'];
            $team_name = $_FILES['team_photo']['name'];
            $team_ext = strtolower(pathinfo($team_name, PATHINFO_EXTENSION));
            $team_size = $_FILES['team_photo']['size'] / (1024 * 1024);

            $allowed_ext = ["jpg", "jpeg", "png", "webp"];

            if (!in_array($profile_ext, $allowed_ext) || !in_array($team_ext, $allowed_ext)) {
                echo "<script>alert('Invalid image format (JPG, PNG, etc.)');</script>";
                exit();
            }

            if ($profile_size > 3 || $team_size > 3) {
                echo "<script>alert('Image size must be under 3MB');</script>";
                exit();
            }

            // Create folders if not exist
            if (!is_dir("Uploaded Images")) mkdir("Uploaded Images", 0777, true);
            if (!is_dir("Uploaded Teams")) mkdir("Uploaded Teams", 0777, true);

            // File paths
            $profile_path = "Uploaded Images/" . $username . "." . $profile_ext;
            $team_path = "Uploaded Teams/" . $username . "." . $team_ext;

            // Update image paths in DB
            $update_query = "UPDATE box_cricket 
                             SET profile='$profile_path', team_photo='$team_path' 
                             WHERE username='$username'";

            if (mysqli_query($con, $update_query)) {
                move_uploaded_file($profile_tmp, $profile_path);
                move_uploaded_file($team_tmp, $team_path);

                echo "<script>
                    alert('Registered Successfully with Photos');
                    window.location.href='login.php';
                    </script>";
            } else {
                echo "<script>
                    alert('Failed to update images in DB');
                    window.location.href='register.php';
                    </script>";
            }

        } else {
            echo "<script>
                alert('Failed to insert user into DB');
                window.location.href='register.php';
                </script>";
        }
    }
}
?>


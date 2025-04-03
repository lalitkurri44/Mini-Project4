<?php
session_start(); // Start the session at the very beginning

require('connection.php'); // Ensure this file doesn't produce any output

if (isset($_POST['login'])) {
    $email_username = mysqli_real_escape_string($con, $_POST['email_username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM carrom_boys WHERE email='$email_username' OR username='$email_username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $result_fetch = mysqli_fetch_assoc($result);

        if (password_verify($password, $result_fetch['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $result_fetch['username'];

            header("Location: carrom.html");
            exit(); // Stop further script execution
        } else {
            echo "<script>
                alert('Incorrect password');
                window.location.href='login.php';
                </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Email or username not registered');
            window.location.href='register.php';
            </script>";
        exit();
    }
}







#register logic



if(isset($_POST['register'])) {
    include "config.php"; // Database connection file

    // Escape input to prevent SQL Injection
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if user exists
    $user_exists_query = "SELECT * FROM carrom_boys WHERE username='$username' OR email='$email'";
    $result = mysqli_query($con, $user_exists_query);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['username'] == $username) {
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
            // Insert new user
            $query = "INSERT INTO carrom_boys (username, email, password, contact) 
                      VALUES ('$username', '$email', '$password', '$contact')";

            if(mysqli_query($con, $query)) {
                // If registration is successful, proceed to upload profile picture
                if(isset($_POST['register'])) {
                    $img_loc = $_FILES['profile']['tmp_name'];
                    $img_name = $_FILES['profile']['name'];
                    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_size = $_FILES['profile']['size'] / (1024 * 1024);

                    $allowed_ext = array("jpg", "jpeg", "png", "webp");

                    if(!in_array($img_ext, $allowed_ext)) {
                        echo "<script>alert('Invalid Image Extension');</script>";
                        exit();
                    }

                    if($img_size > 3) {
                        echo "<script>alert('Image size is greater than 1MB');</script>";
                        exit();
                    }

                    $img_des = "Uploaded Images/" . $username . "." . $img_ext;

                    $upload_query = "UPDATE carrom_boys SET profile='$img_des' WHERE username='$username'";
                    
                    if(mysqli_query($con, $upload_query)) {
                        move_uploaded_file($img_loc, $img_des);
                        echo "<script>
                            alert('Registered Successfully with Profile Picture');
                            window.location.href='login.php';
                            </script>";
                    } else {
                        echo "<script>
                            alert('Profile picture upload failed');
                            window.location.href='register.php';
                            </script>";
                    }
                } else {
                    echo "<script>
                        alert('Registered Successfully');
                        window.location.href='login.php';
                        </script>";
                }
            } else {
                echo "<script>
                    alert('Database Insert Query Failed');
                    window.location.href='register.php';
                    </script>";
            }
        }
    } else {
        echo "<script>
            alert('Database Query Failed');
            window.location.href='register.php';
            </script>";
    }
}



?>

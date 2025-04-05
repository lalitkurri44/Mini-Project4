<?php require ('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="login_register.php" enctype="multipart/form-data">
            
            <!-- Username + Profile Photo -->
            <div class="form-row">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="input-group">
                    <label>Profile Photo</label>
                    <input type="file" name="profile" accept="image/*" required>
                </div>
            </div>

            <!-- Email -->
            <div class="form-row">
                <div class="input-group full-width">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
            </div>

            <!-- Password -->
            <div class="form-row">
                <div class="input-group full-width">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
            </div>

            <!-- Contact -->
            <div class="form-row">
                <div class="input-group full-width">
                    <label>Contact</label>
                    <input type="tel" name="contact" pattern="[0-9]{10}" required>
                </div>
            </div>

            <!-- Team Name + Team Photo -->
            <div class="form-row">
                <div class="input-group">
                    <label>Team Name</label>
                    <input type="text" name="team_name" required>
                </div>
                <div class="input-group">
                    <label>Team Photo</label>
                    <input type="file" name="team_photo" accept="image/*" required>
                </div>
            </div>

            <div class="btn-container">
                <button type="submit" name="register">Register</button>
            </div>
        </form>
    </div>
</body>
</html>

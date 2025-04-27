<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}



// Correct path based on your structure:
require('../cr/connection.php');

// echo "Connection file included successfully!<br>";


$username = $_SESSION['username'];

$query = "SELECT * FROM carrom_boys WHERE username='$username' LIMIT 1";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nakshatra | Welcome <?php echo htmlspecialchars($username); ?></title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .welcome-box {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      color: white;
      padding: 30px 25px;
      border-radius: 20px;
      margin: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .welcome-box h2 {
      font-size: 2rem;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .welcome-box p {
      font-size: 1.1rem;
      font-weight: 500;
    }

    

    .welcome-box {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.welcome-box {
  text-align: center;
}

.logout-btn {
        background-color: #e74c3c;
        border: none;
        color: white;
        padding: 8px 18px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #c0392b;
    }

    .menu-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 21px;
  }

  .menu-bar {
    background-color: #000;
    height: 3px;
    width: 100%;
  }


  .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: linear-gradient(90deg,rgb(255, 255, 255),rgb(255, 255, 255)); /* Deep blue gradient */
  padding: 15px 30px;
  box-shadow: 0 4px 15px rgb(255, 255, 255);
  position: sticky;
  top: 0;
  z-index: 999;
}

.nav-logo .logo-text {
  font-size: 30px;
  font-weight: 900;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  text-shadow: 1px 1px 4px rgb(255, 255, 255);
  letter-spacing: 2px;
}

.nav-section {
  display: flex;
  align-items: center;
  gap: 15px;
}

.nav-button {
  background: none;
  border: none;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.nav-button:hover {
  transform: scale(1.1);
}

.search-input {
  padding: 7px 12px;
  border-radius: 6px;
  border: none;
  outline: none;
  font-size: 14px;
}

.search-container {
  position: relative;
}

.suggestions {
  position: absolute;
  background: white;
  border-radius: 5px;
  top: 100%;
  left: 0;
  width: 100%;
  box-shadow: 0 4px 8px rgb(255, 255, 255);
  z-index: 10;
}

.logout-btn {
  background-color: #e74c3c;
  border: none;
  color: white;
  padding: 8px 16px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.logout-btn:hover {
  background-color: #c0392b;
}

.mic-button img,
.search-button img {
  width: 25px;
  height: 25px;
}
/* Make all navbar text white and bold */


/* Logo text specifically styled bigger */
.nav-logo .logo-text {
  font-size: 32px;
  font-weight: 900;
  color: white;
  font-family: 'Poppins', sans-serif;
  letter-spacing: 2px;
  text-shadow: 2px 2px 5px rgb(255, 255, 255);
}


.nav-logo .logo-text {
  font-size: 28px;
  font-weight: 800;
  font-family: 'Poppins', 'Segoe UI', sans-serif;
  color: #ffffff;
  text-shadow: 1px 1px 2px rgb(255, 255, 255);
  letter-spacing: 1.2px;
  text-transform: uppercase;
}


  </style>

</head>
<body>
  <div class="container">
    <!-- Header Navbar -->
    <header>
      <div class="navbar">
        <div class="nav-section nav-left"></div>
        <button class="nav-button menu-button"><div class="menu"></div></button>

        <div class="nav-logo">
          <h2 class="logo-text">Nakshatra</h2>
        </div>

        <div class="nav-section nav-center">
          <form action="#" class="search-form">
            <div class="search-container">
              <input type="search" id="search" placeholder="Search for a sport..." required class="search-input" />
              <div class="suggestions" id="suggestions"></div>
            </div>
            <button class="nav-button search-button">
              <img width="25px" height="27px" src="Images and icons/Search_bar-removebg-preview.png" alt="search"/>
            </button>
          </form>
          <button class="nav-button mic-button">
            <img width="25px" height="27px" src="Images and icons/Voice_button-removebg-preview.png" alt="Mic button"/>
          </button>
        </div>

        <!-- Right section of the navbar -->
        <div class="nav-section nav-right">

          

          <form action="logout.php" method="post">
            <button type="submit" class="logout-btn">Logout</button>
          </form>
        </div>
      </div>
    </header>

    <!-- Main layout -->
    <main class="main-layout">
      <aside class="sidebar">
        <div class="link-container">
          <div class="link-section">
            <h4 class="section-title">Matches</h4>
            <a href="project/user/matches.php" class="link-item" target="_blank">Match Making</a>

            <a href="crud/index.php" class="link-item" target="_blank">Table Entries</a>

          <div class="section-separator"></div>

          <div class="link-section">
            <h4 class="section-title">Details</h4>
            <a href="Redirect/leadership.html" class="link-item" target="_blank">Leaderboard</a>
            <a href="Redirect/event.html" class="link-item" target="_blank">Event Calendar</a>
            <a href="Redirect/winner.html" class="link-item" target="_blank">Winners</a>
          </div>

          <div class="link-section">
            <h4 class="section-title">Important</h4>
            <a href="Redirect/Notification.html" class="link-item" target="_blank">Notification</a>
            <a href="Redirect/feedback.html" class="link-item" target="_blank">Feedback System</a>
            <a href="Redirect/contact.html" class="link-item" target="_blank">Contact Us Page</a>
          </div>

          <div class="link-section">
            <h4 class="section-title">Game Rules</h4>
            <a href="Redirect/Rules.html" class="link-item" target="_blank">Rules</a>
          </div>
        </div>
      </aside>

      <main>
      <div class="welcome-box">
    <h2>👋 Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <!-- <p>We're excited to have you at <strong>Nakshatra</strong>. Let's make history together 🌟</p> -->
  </div>

      </main>
    </main>
  </div>

  <script src="script.js"></script>
</body>
</html>

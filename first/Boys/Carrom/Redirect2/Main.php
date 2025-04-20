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

          <?php if (!empty($user['profile_image'])): ?>
            <img src="Uploaded Images/<?php echo $user['profile_image']; ?>" alt="User image" class="user-image" />
          <?php else: ?>
            <img src="Images and icons/Nav logo.png" alt="User image" class="user-image" />
          <?php endif; ?>

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
            <a href="Redirect/indoor.html" class="link-item" target="_blank">Match Making</a>
            <a href="Redirect/outdoor.html" class="link-item" target="_blank">All Table entries</a>
          </div>
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

<?php
// Include database connection
include "connection.php";  // Ensure the correct path here

// Fetch players from the database
$query = "SELECT * FROM carrom_boys";
$result = mysqli_query($con, $query);

if ($result) {
    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if profile image exists, otherwise use a default image
        $profile_image = !empty($row['profile']) ? $row['profile'] : 'Uploaded Images/default.jpg'; // Use default if no image exists

        // Construct absolute URL to the image
        $profile_image_path = 'http://localhost/gb/Mini-project-2/first/Boys/Carrom/cr/' . $profile_image;
        
        // Display player info
        echo '<div class="player-card">';
        echo '<img src="' . $profile_image_path . '" alt="Player Image" class="player-image" style="width: 100px; height: 100px;">';
        echo '<h3>' . htmlspecialchars($row['username']) . '</h3>';
        echo '<p>Email: ' . htmlspecialchars($row['email']) . '</p>';
        echo '<p>Contact: ' . htmlspecialchars($row['contact']) . '</p>';
        echo '</div>';
    }
} else {
    // If no players found
    echo "<p>No players found.</p>";
}
?>

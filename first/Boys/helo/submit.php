<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "qr_payments");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Input validation with fallback
$name    = $_POST['user_name'] ?? '';
$upi     = $_POST['upi_id'] ?? '';
$to      = $_POST['transferred_to'] ?? '';
$method  = $_POST['payment_method'] ?? '';
$contact = $_POST['contact_number'] ?? '';
$game    = $_POST['game'] ?? '';
$amount  = $_POST['amount'] ?? '';

// Basic input check
if (empty($name) || empty($upi) || empty($game) || empty($amount)) {
    echo "Please fill all required fields.";
    exit();
}

// Check if user already submitted
$check = $conn->prepare("SELECT status FROM payment_entries WHERE user_name=? AND upi_id=? AND game=? AND amount=? LIMIT 1");
$check->bind_param("sssd", $name, $upi, $game, $amount);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->bind_result($status);
    $check->fetch();

    if ($status === "Approved") {
        header("Location: approved.html");
        exit();
    } else {
        echo "Your payment is pending approval.";
        exit();
    }
} else {
    // Insert new with Pending status
    $stmt = $conn->prepare("INSERT INTO payment_entries (user_name, upi_id, transferred_to, payment_method, contact_number, game, amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("ssssssd", $name, $upi, $to, $method, $contact, $game, $amount);

    if ($stmt->execute()) {
        echo "Form submitted successfully. Please wait for admin approval.<br>Re-enter your details after 5 mins for redirect.";
    } else {
        echo "Database Error: " . $conn->error;
    }
    $stmt->close();
}

$check->close();
$conn->close();
?>

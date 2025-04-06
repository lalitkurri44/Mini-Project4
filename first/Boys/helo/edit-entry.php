<?php
$conn = new mysqli("localhost", "root", "", "qr_payments");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM payment_entries WHERE id = $id AND status = 'Approved'");

if ($result->num_rows == 0) {
    echo "Aapki entry abhi approve nahi hui ya exist nahi karti.";
    exit();
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Approved</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-box">
    <h2>🎉 Payment Approved!</h2>
    <p><strong>Name:</strong> <?= $row['user_name'] ?></p>
    <p><strong>Game:</strong> <?= $row['game'] ?></p>
    <p><strong>Amount Paid:</strong> ₹<?= $row['amount'] ?></p>
    <p>Contact: <?= $row['contact_number'] ?></p>
  </div>
</body>
</html>

<?php
$conn = new mysqli("localhost", "root", "", "qr_payments");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE payment_entries SET status = 'Approved' WHERE id = $id");
    header("Location: admin-panel.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM payment_entries WHERE id = $id");
    header("Location: admin-panel.php");
    exit();
}

$result = $conn->query("SELECT * FROM payment_entries ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 8px 12px; border: 1px solid #ddd; text-align: center; }
    .actions a { margin: 0 5px; text-decoration: none; color: #0066cc; }
    .Approved { color: green; font-weight: bold; }
    .Pending { color: orange; font-weight: bold; }
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr { display: block; }
      th { position: absolute; left: -9999px; }
      td { border: none; position: relative; padding-left: 50%; text-align: left; }
      td::before {
        position: absolute; top: 8px; left: 12px; width: 45%; white-space: nowrap;
        font-weight: bold;
      }
      td:nth-child(1)::before { content: "ID"; }
      td:nth-child(2)::before { content: "Name"; }
      td:nth-child(3)::before { content: "UPI"; }
      td:nth-child(4)::before { content: "To"; }
      td:nth-child(5)::before { content: "App"; }
      td:nth-child(6)::before { content: "Contact"; }
      td:nth-child(7)::before { content: "Game"; }
      td:nth-child(8)::before { content: "Amount"; }
      td:nth-child(9)::before { content: "Time"; }
      td:nth-child(10)::before { content: "Status"; }
      td:nth-child(11)::before { content: "Actions"; }
    }
  </style>
</head>
<body>
<h2>Admin Panel - QR Payments</h2>
<table>
  <thead>
    <tr>
      <th>ID</th><th>Name</th><th>UPI</th><th>To</th><th>App</th><th>Contact</th><th>Game</th><th>Amount</th><th>Time</th><th>Status</th><th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['user_name']) ?></td>
      <td><?= htmlspecialchars($row['upi_id']) ?></td>
      <td><?= htmlspecialchars($row['transferred_to']) ?></td>
      <td><?= htmlspecialchars($row['payment_method']) ?></td>
      <td><?= htmlspecialchars($row['contact_number']) ?></td>
      <td><?= htmlspecialchars($row['game']) ?></td>
      <td>₹<?= number_format($row['amount'], 2) ?></td>
      <td><?= $row['submitted_at'] ?></td>
      <td class="<?= $row['status'] ?>"><?= $row['status'] ?></td>
      <td class="actions">
        <a href="?approve=<?= $row['id'] ?>">Approve</a>
        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Sure?')">Delete</a>
        <a href="edit-entry.php?id=<?= $row['id'] ?>">Edit</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>

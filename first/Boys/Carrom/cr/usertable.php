<?php
include "config.php"; // config.php should be one level up

$query = "SELECT * FROM carrom_boys";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Table</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      overflow-x: auto;
    }
    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: center;
    }
    img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
    }
    a.edit-btn {
      text-decoration: none;
      padding: 6px 12px;
      background: #007bff;
      color: #fff;
      border-radius: 4px;
    }
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      th {
        background: #eee;
      }
      td {
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: left;
      }
      td::before {
        position: absolute;
        left: 10px;
        top: 10px;
        font-weight: bold;
      }
      td:nth-child(1)::before { content: "ID"; }
      td:nth-child(2)::before { content: "Username"; }
      td:nth-child(3)::before { content: "Email"; }
      td:nth-child(4)::before { content: "Contact"; }
      td:nth-child(5)::before { content: "Profile"; }
      td:nth-child(6)::before { content: "Edit"; }
    }
  </style>
</head>
<body>

<h2>User Table</h2>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Profile</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['contact']; ?></td>
        <td>
          <?php if ($row['profile']) { ?>
            <img src="../<?= $row['profile']; ?>" alt="Profile">
          <?php } else { ?>
            No Image
          <?php } ?>
        </td>
        <td><a class="edit-btn" href="edit-user.php?id=<?= $row['id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

</body>
</html>

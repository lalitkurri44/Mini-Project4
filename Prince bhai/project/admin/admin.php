<?php include "../config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Control</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f1f1f1; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background: #007bff; color: white; }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
        }
        .live { background: green; }
        .finished { background: gray; }
        .winner { background: orange; }
        .edit { background: #17a2b8; }
        .delete { background: #dc3545; }
        .action-btn { margin: 2px 1px; display: inline-block; }
    </style>
</head>
<body>

<h2>Admin Panel - Manage Matches</h2>
<a href="add_match.php" class="btn edit">+ Add New Match</a><br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Match</th>
        <th>Status</th>
        <th>Winner</th>
        <th>Actions</th>
    </tr>
    <?php
    $res = mysqli_query($con, "SELECT * FROM matches ORDER BY match_date DESC");
    while($row = mysqli_fetch_assoc($res)) {
        $winner = $row['winner'] == 1 ? $row['player1_name'] : ($row['winner'] == 2 ? $row['player2_name'] : 'TBD');
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['player1_name']} vs {$row['player2_name']}</td>
            <td>{$row['status']}</td>
            <td>$winner</td>
            <td>
                <a class='btn live action-btn' href='update_status.php?id={$row['id']}&status=Live'>Live</a>
                <a class='btn finished action-btn' href='update_status.php?id={$row['id']}&status=Finished'>Finished</a>
                <a class='btn winner action-btn' href='declare_winner.php?id={$row['id']}&winner=1'>🏆 {$row['player1_name']}</a>
                <a class='btn winner action-btn' href='declare_winner.php?id={$row['id']}&winner=2'>🏆 {$row['player2_name']}</a>
                <a class='btn edit action-btn' href='edit_match.php?id={$row['id']}'>Edit</a>
                <a class='btn delete action-btn' href='delete_match.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this match?');\">Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>

</body>
</html>

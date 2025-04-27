<?php include "../config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Match Making</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 20px;
            margin: 0;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .match-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .match-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 370px;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            color: white;
            font-size: 13px;
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .Live { background: green; }
        .Finished { background: gray; }
        .TBD { background: orange; }

        .players {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .player {
            text-align: center;
            width: 40%;
        }
        .player img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid #007bff;
            object-fit: cover;
        }
        .winner img {
            border-color: green !important;
        }
        .vs {
            font-weight: bold;
            font-size: 18px;
            color: #e74c3c;
        }
        .details {
            font-size: 14px;
            text-align: center;
        }
        .winner-text {
            color: green;
            font-weight: bold;
            font-size: 15px;
        }

        /* Responsive tweaks */
        @media (max-width: 480px) {
            .player img {
                width: 60px;
                height: 60px;
            }
            .vs { font-size: 16px; }
        }
    </style>
</head>
<body>

<h2>Match making</h2>

<div class="match-container">
<?php
$res = mysqli_query($con, "SELECT * FROM matches ORDER BY match_date DESC");
while($row = mysqli_fetch_assoc($res)) {
    $winner = $row['winner'] == 1 ? $row['player1_name'] : ($row['winner'] == 2 ? $row['player2_name'] : '');
    $winnerClass1 = ($row['winner'] == 1) ? 'winner' : '';
    $winnerClass2 = ($row['winner'] == 2) ? 'winner' : '';

    echo '<div class="match-box">
        <span class="badge '.$row['status'].'">'.$row['status'].'</span>
        <div class="players">
            <div class="player '.$winnerClass1.'">
                <img src="'.$row['player1_image'].'" alt="P1">
                <p>'.$row['player1_name'].'</p>
            </div>
            <div class="vs">VS</div>
            <div class="player '.$winnerClass2.'">
                <img src="'.$row['player2_image'].'" alt="P2">
                <p>'.$row['player2_name'].'</p>
            </div>
        </div>
        <div class="details">
            <p><strong>Date:</strong> '.date("d M Y, h:i A", strtotime($row['match_date'])).'</p>
            <p><strong>Timer:</strong> '.$row['timer'].' min</p>';
    if($winner != '') {
        echo '<p class="winner-text">🏆 Winner: '.$winner.'</p>';
    }
    echo '</div></div>';
}
?>
</div>

</body>
</html>

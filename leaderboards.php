<?php
// Database connection code remains the same
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch top users
$sql = "SELECT nickname, points, image FROM users ORDER BY points DESC LIMIT 13";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloryQuiz Leaderboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a0e8f;
            --secondary-color: #2a0854;
            --accent-color: #ffd700;
            --text-color: #ffffff;
            --background-color: #1a0639;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .leaderboard {
            background-color: rgba(26, 6, 57, 0.8);
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        h1 {
            text-align: center;
            color: var(--accent-color);
            font-size: 3em;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px var(--accent-color), 0 0 10px var(--accent-color);
            }
            to {
                text-shadow: 0 0 10px var(--accent-color), 0 0 20px var(--accent-color);
            }
        }

        .top-3 {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin-bottom: 50px;
            position: relative;
        }

        .top-player {
            text-align: center;
            position: relative;
            margin: 0 15px;
            flex: 1;
            transition: all 0.3s ease;
        }

        .top-player:hover {
            transform: translateY(-10px);
        }

        .top-player img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid var(--accent-color);
            box-shadow: 0 0 20px rgba(255,215,0,0.5);
            transition: all 0.3s ease;
        }

        .top-player:nth-child(2) {
            order: -1;
        }

        .top-player:nth-child(2) img {
            width: 140px;
            height: 140px;
            border-width: 6px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255,215,0,0.7); }
            70% { box-shadow: 0 0 0 20px rgba(255,215,0,0); }
            100% { box-shadow: 0 0 0 0 rgba(255,215,0,0); }
        }

        .laurel {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 50px;
            color: var(--accent-color);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateX(-50%) translateY(0px); }
            50% { transform: translateX(-50%) translateY(-10px); }
            100% { transform: translateX(-50%) translateY(0px); }
        }

        .rank {
            font-size: 1.4em;
            font-weight: bold;
            margin-top: 10px;
        }

        .points {
            font-size: 1.2em;
            color: var(--accent-color);
            margin-top: 5px;
        }

        .other-players {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .player {
            background-color: rgba(58, 11, 112, 0.7);
            border-radius: 15px;
            padding: 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .player:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .player img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid var(--accent-color);
        }

        .player-info {
            flex-grow: 1;
        }

        .player-rank {
            font-weight: bold;
            margin-right: 10px;
            font-size: 1.1em;
        }

        .player-points {
            float: right;
            color: var(--accent-color);
            font-weight: bold;
        }

        .icon {
            margin-right: 5px;
            color: var(--accent-color);
        }

        .back-button {
            display: inline-block;
            margin: 20px 0;
            padding: 15px 30px;
            background-color: var(--accent-color);
            color: var(--primary-color);
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #ffec27;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
        }

        .back-button i {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5em;
            }
            .top-3 {
                flex-direction: column;
                align-items: center;
            }
            .top-player {
                margin-bottom: 30px;
            }
            .top-player:nth-child(2) {
                order: -1;
                margin-bottom: 40px;
            }
            .top-player img {
                width: 120px;
                height: 120px;
            }
            .top-player:nth-child(2) img {
                width: 160px;
                height: 160px;
            }
            .other-players {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .leaderboard {
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
            .top-player img {
                width: 100px;
                height: 100px;
            }
            .top-player:nth-child(2) img {
                width: 140px;
                height: 140px;
            }
            .player img {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="leaderboard">
        <h1><i class="fas fa-crown icon"></i>LEADERBOARD</h1>
        <div class="top-3">
            <?php
            $topThree = array_slice($users, 0, 3);
            $first = $topThree[0];
            $second = $topThree[1] ?? null;
            $third = $topThree[2] ?? null;

            function renderTopPlayer($user, $rank) {
                $medal = $rank == 1 ? '🥇' : ($rank == 2 ? '🥈' : '🥉');
                echo "<div class='top-player'>";
                if ($rank == 1) {
                    echo "<div class='laurel'>👑</div>";
                }
                echo "<img src='{$user['image']}' alt='{$user['nickname']}'>";
                echo "<div class='rank'>{$medal} {$rank}" . ($rank == 1 ? "st" : ($rank == 2 ? "nd" : "rd")) . "</div>";
                echo "<div>{$user['nickname']}</div>";
                echo "<div class='points'><i class='fas fa-star icon'></i>{$user['points']}</div>";
                echo "</div>";
            }

            if ($second) renderTopPlayer($second, 2);
            renderTopPlayer($first, 1);
            if ($third) renderTopPlayer($third, 3);
            ?>
        </div>
        <div class="other-players">
            <?php
            for ($i = 3; $i < count($users); $i++) {
                $rank = $i + 1;
                $user = $users[$i];
                echo "<div class='player'>";
                echo "<img src='{$user['image']}' alt='{$user['nickname']}'>";
                echo "<div class='player-info'>";
                echo "<span class='player-rank'>{$rank}th</span>";
                echo "<span>{$user['nickname']}</span>";
                echo "<span class='player-points'><i class='fas fa-star icon'></i>{$user['points']}</span>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i> Back to Game</a>
</body>
</html>
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users, ordered by points in descending order
$sql = "SELECT * FROM users ORDER BY points DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --text-color: #333;
            --background-color: #ecf0f1;
            --hover-color: #2980b9;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            transition: all 0.3s ease;
        }

        h1 {
            color: var(--secondary-color);
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            animation: slideIn 0.5s ease-out;
        }

        tr:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        tr:hover td {
            background-color: #f8f8f8;
        }

        td:first-child, th:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        td:last-child, th:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .points-column {
            font-weight: bold;
            color: var(--primary-color);
        }

        tr:first-child .points-column {
            color: gold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-out;
        }

        .back-btn:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        tr:hover .user-image {
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }

            .user-image {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
<div class="container">
        <a href="#" class="back-btn" onclick="history.back();">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h1><i class="fas fa-users"></i> User Information</h1>
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-star"></i> Points</th>
                    <th><i class="fas fa-user"></i> Username</th>
                    <th><i class="fas fa-signature"></i> Nickname</th>
                    <th><i class="fas fa-image"></i> Image</th>
                    <th><i class="fas fa-heart"></i> Hearts</th>
                    <th><i class="fas fa-life-ring"></i> Lifelines</th>
                    <th><i class="fas fa-forward"></i> Skips</th>
                    <th><i class="fas fa-trophy"></i> Achievements</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='points-column'>" . $row["points"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nickname"]) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row["image"]) . "' alt='User Image' class='user-image'></td>";
                        echo "<td>" . $row["hearts"] . "</td>";
                        echo "<td>" . $row["lifelines"] . "</td>";
                        echo "<td>" . $row["skips"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["achievements"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
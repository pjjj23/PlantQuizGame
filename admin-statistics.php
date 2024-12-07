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

// Fetch row counts from each table
$easyCount = $conn->query("SELECT COUNT(*) as count FROM easy")->fetch_assoc()['count'];
$mediumCount = $conn->query("SELECT COUNT(*) as count FROM medium")->fetch_assoc()['count'];
$hardCount = $conn->query("SELECT COUNT(*) as count FROM hard")->fetch_assoc()['count'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Statistics Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --text-color: #ecf0f1;
            --card-bg: #34495e;
            --hover-color: #2980b9;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
        }

        .navbar {
            background-color: var(--card-bg);
            color: var(--primary-color);
            padding: 15px 30px;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .back-btn {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .back-btn:hover {
            background-color: var(--hover-color);
        }

        .container {
            display: flex;
            justify-content: space-around;
            align-items: stretch;
            flex-wrap: wrap;
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 15px;
            width: calc(33.333% - 30px);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card h2 {
            font-size: 36px;
            margin: 10px 0;
            color: var(--primary-color);
        }

        .card p {
            font-size: 16px;
            color: var(--text-color);
            margin-bottom: 0;
        }

        .card i {
            font-size: 40px;
            color: var(--primary-color);
        }

        .chart-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .chart-wrapper {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 20px;
            margin: 15px;
            width: calc(50% - 30px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-wrapper canvas {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .card, .chart-wrapper {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div><i class="fas fa-chart-line"></i> Admin Statistics Dashboard</div>
        <button class="back-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
    </div>

    <div class="container">
        <div class="card">
            <i class="fas fa-seedling"></i>
            <h2><?php echo $easyCount; ?></h2>
            <p>Easy Questions</p>
        </div>
        <div class="card">
            <i class="fas fa-tree"></i>
            <h2><?php echo $mediumCount; ?></h2>
            <p>Medium Questions</p>
        </div>
        <div class="card">
            <i class="fas fa-leaf"></i>
            <h2><?php echo $hardCount; ?></h2>
            <p>Hard Questions</p>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-wrapper">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="chart-wrapper">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <script>
        // Data for the charts
        const easyCount = <?php echo $easyCount; ?>;
        const mediumCount = <?php echo $mediumCount; ?>;
        const hardCount = <?php echo $hardCount; ?>;

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Easy', 'Medium', 'Hard'],
                datasets: [{
                    data: [easyCount, mediumCount, hardCount],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ecf0f1'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Question Difficulty Distribution',
                        color: '#ecf0f1',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Easy', 'Medium', 'Hard'],
                datasets: [{
                    label: 'Number of Questions',
                    data: [easyCount, mediumCount, hardCount],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c'],
                    borderColor: ['#2980b9', '#27ae60', '#c0392b'],
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#ecf0f1'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#ecf0f1'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Questions by Difficulty Level',
                        color: '#ecf0f1',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });

        function goBack() {
            window.location.href='admin-home.php';
        }
    </script>
</body>
</html>
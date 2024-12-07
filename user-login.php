<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password_hash FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: Home.php"); // Redirect to dashboard or home page
            exit();
        } else {
            $login_error = "Invalid username or password";
        }
    } else {
        $login_error = "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamer Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f2f5;
        }

        .container {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            display: flex;
        }

        .form-container {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .overlay-container {
            width: 50%;
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .overlay-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .overlay-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('assets/images/icegif-4145.gif') center/cover no-repeat;
            opacity: 0.4;
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        h1 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #4e54c8;
        }

        .overlay-container h1 {
            color: #FFFFFF;
            font-size: 2.5em;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #4e54c8;
        }

        input {
            width: 100%;
            padding: 12px 15px 12px 35px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4e54c8;
            outline: none;
        }

        .btn {
            background-color: #4e54c8;
            color: #FFFFFF;
            border: none;
            padding: 12px 0;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn:hover {
            background-color: #3a3f9f;
        }

        .logreg-link {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }

        .logreg-link a {
            color: #4e54c8;
            text-decoration: none;
            font-weight: bold;
        }

		.back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: transparent;
            border: none;
            color: #4e54c8;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .back-btn:hover {
            color: #3a3f9f;
        }

        .back-btn i {
            margin-right: 5px;
        } 

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .form-container, .overlay-container {
                width: 100%;
            }

			.back-btn {
                top: 10px;
                left: 10px;
                font-size: 14px;
            }

            .overlay-container {
                order: -1;
                min-height: 200px;
            }
        }
    </style>
</head>
<body>
	
    <div class="container">
	<button class="back-btn" onclick="goBack()">
		<i class="fas fa-chevron-left"></i> Back
	</button>
        <div class="form-container">
            <h1>Gamer Login</h1>
            <?php if (!empty($login_error)) { ?>
                <p style="color: red;"><?php echo $login_error; ?></p>
            <?php } ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">LOGIN</button>
            </form> 
            <div class="logreg-link">
                <p>Don't have an account? <a href="Register.php">Sign Up</a></p>
            </div>
        </div>
        <div class="overlay-container">
            <div class="overlay-content">
                <h1>Welcome Back!</h1>
                <p>Login and experience our website made just for you. Buckle up cause here we go!</p>
            </div>
        </div>
    </div>

	<script>
		function goBack() {
            window.location.href='notLogged-home.html';
        }
	</script>
</body>
</html>
<?php
require_once 'datas.php';
$message = [];
$messages = ["Please don't leave the fields blank. Follow what is required."];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation
    if (empty($_POST["username"])) {
        $message['username'] = 'Username is required.';
    } else {
        // Check for duplicate username
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $_POST["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $message['username'] = 'Username already exists.';
        }
        $stmt->close();
    }

    if (strlen($_POST["password"]) < 8) {
        $message['password'] = 'Password must be at least 8 characters.';
    } elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
        $message['password'] = 'Password must contain at least one letter.';
    } elseif (!preg_match("/[A-Z]/", $_POST["password"])) {
        $message['password'] = 'Password must contain at least one uppercase letter.';
    } elseif (!preg_match("/[0-9]/", $_POST["password"])) {
        $message['password'] = 'Password must contain at least one number.';
    }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        $message['password_confirmation'] = 'Passwords do not match.';
    }

    // Image upload handling
    $uploadDir = 'upload/';
    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($imageFileType, $allowedExtensions)) {
            $message['image'] = 'Invalid image format. Please upload a valid image.';
        } elseif (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $message['image'] = 'Error uploading image.';
        } else {
            $imagePath = $uploadFile;
        }
    } else {
        $message['image'] = 'Image is required.';
    }

    // If no errors, proceed with registration
    if (empty($message)) {
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password_hash, image) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $_POST["username"], $password_hash, $imagePath);
            if ($stmt->execute()) {
                $success = "Registration successful! You can now log in.";
                // Clear the $_POST array to reset form fields
                $_POST = array();
            } else {
                $message['general'] = $stmt->error;
            }
            $stmt->close();
        } else {
            $message['general'] = "Preparation failed: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
    <link rel="icon" href="static/phiwheel.png" type="image/x-icon">
    <link rel="shortcut icon" href="static/phiwheel.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            background: #4e54c8;
            background: linear-gradient(to right, #8f94fb, #4e54c8);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay h1{
            color: #111;
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
            background-image: url('assets/images/icegif-4145.gif');
            background-size: cover;
            background-position: center;
        }

        h1 {
            font-weight: bold;
            margin: 0;
            color: #4e54c8;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        .form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #f5f7fa;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 5px;
        }

        .btn {
            border-radius: 20px;
            border: 1px solid #4e54c8;
            background-color: #4e54c8;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn:focus {
            outline: none;
        }

        .btn.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        #image-container {
            margin-top: 15px;
        }

        #image-container label {
            cursor: pointer;
            padding: 10px;
            background-color: #4e54c8;
            color: white;
            border-radius: 5px;
        }

        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 10px;
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .popup-content {
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .input-container {
            position: relative;
            width: 100%;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #4e54c8;
        }

        .input-container input {
            padding-left: 35px;
        }

        .error-message {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 5px;
            text-align: left;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .container {
                width: 100%;
                min-height: auto;
                padding: 20px;
            }

            .sign-up-container {
                width: 100%;
                position: relative;
            }

            .overlay-container {
                display: none;
            }

            .form {
                padding: 0 20px;
            }

            .btn {
                width: 100%;
            }

            .mobile-sign-in {
                display: block;
                margin-top: 20px;
                text-align: center;
            }

            .mobile-sign-in .btn {
                background-color: transparent;
                color: #4e54c8;
                border: 1px solid #4e54c8;
            }
        }

        @media (min-width: 769px) {
            .mobile-sign-in {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form class="form" method="post" action="" id="signup" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) && empty($success) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                <?php if (isset($message['username'])): ?>
                    <div class="error-message"><?php echo $message['username']; ?></div>
                <?php endif; ?>

                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>
                <?php if (isset($message['password'])): ?>
                    <div class="error-message"><?php echo $message['password']; ?></div>
                <?php endif; ?>

                <div class="input-container">
                    <i class="fas fa-check"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <?php if (isset($message['password_confirmation'])): ?>
                    <div class="error-message"><?php echo $message['password_confirmation']; ?></div>
                <?php endif; ?>

                <div id="image-container">
                    <label for="image"><i class="fas fa-image"></i> Upload Profile Picture</label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="updateFileLabel()" style="display:none;">
                </div>
                <?php if (isset($message['image'])): ?>
                    <div class="error-message"><?php echo $message['image']; ?></div>
                <?php endif; ?>

                <img src="upload/default.png" class="preview-img" id="preview-img">
                <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Sign Up</button>
            </form>
            <div class="mobile-sign-in">
                <p>Already have an account?</p>
                <button class="btn ghost" id="mobileSignIn"><i class="fas fa-sign-in-alt"></i> Sign In</button>
            </div>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Ready, Set, Game!</h1>
                    <p>To join and play our games feel free to create your account, Enjoy!</p>
                    <button class="btn ghost" id="signIn"><i class="fas fa-sign-in-alt"></i> Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <div id="errorPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Error</h2>
            <p id="errorMessage"></p>
        </div>
    </div>

    <div id="successPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Success</h2>
            <p id="successMessage"></p>
        </div>
    </div>

    <script>
        function updateFileLabel() {
            const input = document.getElementById('image');
            const previewImage = document.getElementById('preview-img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function showPopup(popupId, message) {
            const popup = document.getElementById(popupId);
            const messageElement = popup.querySelector('p');
            messageElement.textContent = message;
            popup.style.display = 'block';
        }

        function closePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.style.display = 'none';
        }

        document.querySelectorAll('.close').forEach(closeBtn => {
            closeBtn.addEventListener('click', function() {
                this.closest('.popup').style.display = 'none';
            });
        }); 

        document.getElementById('signIn').addEventListener('click', function() {
            window.location.href = 'user-login.php';
        });

        document.getElementById('mobileSignIn').addEventListener('click', function() {
            window.location.href = 'user-login.php';
        });

        <?php
            if (!empty($message)) {
                echo "showPopup('errorPopup', '" . addslashes(implode("\\n", $message)) . "');";
            }
            if (isset($success)) {
                echo "showPopup('successPopup', '" . addslashes($success) . "');";
                echo "document.getElementById('signup').reset();"; // Reset the form
            }
        ?>
    </script>
</body>
</html>
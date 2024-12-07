<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }

        .navbar {
            background-color: #3498db;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            font-size: 18px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .greeting {
            font-size: 22px;
            font-weight: 600;
        }

        .user-menu {
            position: relative;
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu:hover {
            color: #f39c12;
        }

        .user-menu i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .user-menu:hover i {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.2s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f1f8ff;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
            padding: 20px;
        }

        .card {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 450px;
            width: 100%;
        }

        .menu-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin: 20px 0;
            padding: 15px 20px;
            font-size: 18px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .menu-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.6s ease;
        }

        .menu-button:hover::before {
            left: 100%;
        }

        .menu-button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .menu-button i {
            margin-right: 10px;
            font-size: 20px;
        }

        /* Popup styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            justify-content: center;
            align-items: center;
        }

        .popup-overlay.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .popup {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .popup-overlay.active .popup {
            transform: scale(1);
            opacity: 1;
        }

        .popup h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #3498db;
        }

        .popup-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .popup-button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .popup-button.confirm {
            background-color: #3498db;
            color: white;
        }

        .popup-button.cancel {
            background-color: #e74c3c;
            color: white;
        }

        .popup-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            width: 100px;
            height: 100px;
            position: relative;
        }

        .flower {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
        }

        .petal {
            position: absolute;
            width: 20px;
            height: 30px;
            background-color: #ff69b4;
            border-radius: 50% 50% 0 0;
            transform-origin: bottom center;
            animation: peelPetal 2s infinite ease-in-out;
        }

        .petal:nth-child(1) { transform: rotate(0deg) translateY(-15px); }
        .petal:nth-child(2) { transform: rotate(72deg) translateY(-15px); }
        .petal:nth-child(3) { transform: rotate(144deg) translateY(-15px); }
        .petal:nth-child(4) { transform: rotate(216deg) translateY(-15px); }
        .petal:nth-child(5) { transform: rotate(288deg) translateY(-15px); }

        .center {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #ffff00;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes peelPetal {
            0%, 100% { transform: rotate(var(--rotation)) translateY(-15px); }
            50% { transform: rotate(var(--rotation)) translateY(-25px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 10px 20px;
            }

            .card {
                padding: 30px;
            }

            .menu-button {
                font-size: 16px;
            }

            .popup {
                padding: 20px;
            }

            .popup h3 {
                font-size: 20px;
            }

            .popup-button {
                font-size: 14px;
            }

            .loader {
                width: 80px;
                height: 80px;
            }

            .flower {
                width: 50px;
                height: 50px;
            }

            .petal {
                width: 16px;
                height: 24px;
            }

            .center {
                width: 16px;
                height: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Loader -->
    <div class="loader-overlay" id="loaderOverlay">
        <div class="loader">
            <div class="flower">
                <div class="petal" style="--rotation: 0deg;"></div>
                <div class="petal" style="--rotation: 72deg;"></div>
                <div class="petal" style="--rotation: 144deg;"></div>
                <div class="petal" style="--rotation: 216deg;"></div>
                <div class="petal" style="--rotation: 288deg;"></div>
                <div class="center"></div>
            </div>
        </div>
    </div>
    <div class="navbar">
        <div class="greeting" id="greeting">Good evening</div>
        <div class="user-menu" onclick="toggleDropdown()">
            <i class="fas fa-user-circle"></i> Hi, Admin <i class="fas fa-chevron-down"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="card">
            <button class="menu-button" onclick="navigateTo('admin-statistics')">
                <i class="fas fa-chart-line"></i> Statistics
            </button>
            <button class="menu-button" onclick="navigateTo('admin-users')">
                <i class="fas fa-users"></i> Users
            </button>
            <button class="menu-button" onclick="showCreateQuestionPopup()">
                <i class="fas fa-question-circle"></i> Create Questions
            </button>
        </div>
    </div>

    <!-- Logout Popup overlay -->
    <div class="popup-overlay" id="logoutPopupOverlay">
        <div class="popup">
            <h3><i class="fas fa-sign-out-alt"></i> Logout Confirmation</h3>
            <p>Are you sure you want to logout?</p>
            <div class="popup-buttons">
                <button class="popup-button confirm" onclick="logout()">Yes, Logout</button>
                <button class="popup-button cancel" onclick="closePopup('logoutPopupOverlay')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Create Question Popup overlay -->
    <div class="popup-overlay" id="createQuestionPopupOverlay">
        <div class="popup">
            <h3><i class="fas fa-layer-group"></i> Select Question Difficulty</h3>
            <div class="popup-buttons">
                <button class="popup-button confirm" onclick="navigateTo('create-question-easy')">
                    <i class="fas fa-smile"></i> Easy Level
                </button>
                <button class="popup-button confirm" onclick="navigateTo('create-question-medium')">
                    <i class="fas fa-meh"></i> Medium Level
                </button>
                <button class="popup-button confirm" onclick="navigateTo('create-question-hard')">
                    <i class="fas fa-frown"></i> Hard Level
                </button>
                <button class="popup-button cancel" onclick="closePopup('createQuestionPopupOverlay')">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function navigateTo(page) {
            window.location.href = `${page}.php`;
        }

        function updateGreeting() {
            const greetingElement = document.getElementById('greeting');
            const hours = new Date().getHours();

            let greetingMessage = 'Goodevening';
            if (hours < 12) {
                greetingMessage = 'Goodmorning';
            } else if (hours < 18) {
                greetingMessage = 'Goodafternoon';
            }

            greetingElement.textContent = greetingMessage;
        }

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('active');
        }

        function confirmLogout() {
            const popupOverlay = document.getElementById('logoutPopupOverlay');
            popupOverlay.classList.add('active');
        }

        function logout() {
            window.location.href = 'admin-login.php';
        }

        function showCreateQuestionPopup() {
            const popupOverlay = document.getElementById('createQuestionPopupOverlay');
            popupOverlay.classList.add('active');
        }

        function closePopup(popupId) {
            const popupOverlay = document.getElementById(popupId);
            popupOverlay.classList.remove('active');
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.user-menu') && !event.target.matches('.user-menu *')) {
                const dropdownMenu = document.getElementById('dropdownMenu');
                if (dropdownMenu.classList.contains('active')) {
                    dropdownMenu.classList.remove('active');
                }
            }
            
            // Close the popups if the user clicks outside of them
            if (event.target.classList.contains('popup-overlay')) {
                event.target.classList.remove('active');
            }
        };

        // Call the function to update the greeting based on the current time
        updateGreeting();

        //for loader

         // Loader functions
         function showLoader() {
            document.getElementById('loaderOverlay').style.display = 'flex';
        }

        function hideLoader() {
            document.getElementById('loaderOverlay').style.display = 'none';
        }

        // Simulate loading time
        window.addEventListener('load', function() {
            showLoader();
            setTimeout(hideLoader, 200); // Hide loader after 2 seconds
        });

        // Modified navigation function to show loader
        function navigateTo(page) {
            showLoader();
            setTimeout(function() {
                window.location.href = `${page}.php`;
            }, 1000); // Navigate after 1 second
        }
    </script>
</body>
</html>
<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Check if the user has a nickname (you'll need to implement this function)
$hasNickname = false;
if ($isLoggedIn) {
    $hasNickname = checkUserNickname($_SESSION['user_id']);
}

// Function to check if user has a nickname (implement this according to your database structure)
function checkUserNickname($userId) {
    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "floraquiz");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and execute query
    $stmt = $conn->prepare("SELECT nickname FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if nickname exists
    $hasNickname = ($result->num_rows > 0 && $result->fetch_assoc()['nickname'] != null);
    
    // Close connection
    $stmt->close();
    $conn->close();
    
    return $hasNickname;
}
?>

<!-- In the dropdown content -->
<?php if ($isLoggedIn): ?>
     
<?php else: ?>
    <a href="user-login.php"><i class="fas fa-user"></i> Login as Gamer</a>
    <a href="admin-login.php"><i class="fas fa-user-shield"></i> Login as Admin</a>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #e91e63;
            --secondary-color: #3f51b5;
            --text-color: #333;
            --bg-color: #f5f5f5;
            --card-bg: #fff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color); 
        }
        header {
            background-color: var(--card-bg);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo {
            color: var(--primary-color);
            font-size: 28px;
            font-weight: 700;
        }
        nav {
            display: flex;
            align-items: center;
        }
        nav a {
            margin-left: 30px;
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: var(--primary-color);
        }
        .main-content {
            display: flex;
            justify-content: space-between;
            padding: 80px 5%;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .text-content {
            max-width: 50%;
            color: #e91e63;
        }
        .text-content h1{ 
            color: #e91e63;
        }
        h1 {
            color: var(--secondary-color);
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        p {
            color: var(--text-color);
            margin-bottom: 30px;
            font-size: 18px;
            line-height: 1.6;
        }
        .cta-button, .secondary-button {
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        .cta-button {
            background-color: var(--primary-color);
            color: var(--card-bg);
            margin-right: 15px;
        }
        .secondary-button {
            background-color: #dfe6e9;
            color: #2d3436;
        }
        .cta-button:hover, .secondary-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            opacity: 0.9;
        }
        .button-icon {
            margin-right: 10px;
        }
        .image-content {
            position: relative;
            width: 500px;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .slider-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .slider-image.active {
            opacity: 1;
        }
        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }
        .dot {
            width: 12px;
            height: 12px;
            background-color: rgba(255,255,255,0.5);
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .dot.active {
            background-color: var(--primary-color);
            transform: scale(1.2);
        }
        .mobile-nav {
            display: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--card-bg);
            min-width: 180px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content a {
            color: var(--text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: var(--bg-color);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        nav a, .dropdown .dropbtn {
            margin-left: 30px;
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover, .dropdown .dropbtn:hover {
            color: var(--primary-color);
        }

        .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: var(--card-bg);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        z-index: 1001;
        text-align: center;
        max-width: 90%;
        width: 300px;
    }

    .popup h2 {
        margin-top: 0;
        color: var(--primary-color);
    }

    .popup p {
        margin-bottom: 20px;
    }

    .popup-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .popup-button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .popup-button:hover {
        transform: translateY(-2px);
    }

    .popup-button.confirm {
        background-color: var(--primary-color);
        color: white;
    }

    .popup-button.cancel {
        background-color: #dfe6e9;
        color: #2d3436;
    }

    .popup-icon {
        font-size: 48px;
        color: var(--primary-color);
        margin-bottom: 20px;
    }

        .mobile-nav .dropdown {
            position: relative;
        }

        .mobile-nav .dropdown-content {
            display: none;
            position: absolute;
            bottom: 100%;
            right: 0;
            background-color: var(--card-bg);
            min-width: 180px;
            box-shadow: 0px -8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .mobile-nav .dropdown.active .dropdown-content {
            display: block;
        }

        .mobile-nav .dropdown-content a {
            color: var(--text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .mobile-nav .dropdown-content a:hover {
            background-color: var(--bg-color);
        }
  
        #nicknameOverlay.fade-in {
            animation: fadeIn 0.3s ease forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
  
        #nicknameInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        #submitNickname {
            width: 100%;
        }

        #nicknameOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #nicknameOverlay .popup {
            width: 300px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            animation: popIn 0.5s cubic-bezier(0.26, 0.53, 0.74, 1.48) forwards;
            position: relative;
            top: 0;
            left: 0;
            transform: none;
        }

        @keyframes popIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            70% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .dropdown {
                position: static; 
            }
            .dropdown-content {
                position: fixed;
                bottom: 70px;
                left: -200%;
                right: 0;
                width: 100%; 
                border-radius: 0; 
            }

            .mobile-nav .dropdown-content {
                display: none;
            }

            .mobile-nav .dropdown.active .dropdown-content {
                display: block;
            }
            body {
                padding-bottom: 70px;
            }
            header {
                padding: 15px 5%;
            }
            nav {
                display: none;
            }
            .main-content {
                flex-direction: column;
                padding: 40px 5%;
            }
            .text-content {
                max-width: 100%;
                text-align: center;
                margin-bottom: 40px;
            }
            h1 {
                font-size: 36px;
            }
            p {
                font-size: 16px;
            }
            .image-content {
                width: 100%;
                height: 300px; 
            }
            .mobile-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: var(--card-bg);
                box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
                padding: 10px 0;
                justify-content: space-around;
            }
            .mobile-nav a {
                color: var(--text-color);
                text-decoration: none;
                font-size: 24px;
            }
            .mobile-nav a:hover {
                color: var(--primary-color);
            }
        }
        .active{
            color: #e91e63;
        }
    </style>
</head>
<body>
<header> 
<div id="nicknameOverlay" class="overlay" style="display: none;">
    <div class="popup">
        <h2>Welcome!</h2>
        <p>Please enter your nickname to continue:</p>
        <input type="text" id="nicknameInput" placeholder="Enter your nickname">
        <div class="popup-buttons">
            <button class="popup-button confirm" id="submitNickname">Submit</button>
        </div>
    </div>
</div>
<audio id="backgroundAudio" loop>
    <source src="assets/audio/audio-bg-1.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<button id="toggleAudioButton" style="position: fixed; bottom: 70px; left: 20px; z-index: 1000; padding: 10px; border-radius: 50%; background: var(--primary-color); color: white; border: none; cursor: pointer;">🔇</button>
    <div class="logo">Flora Quiz</div>
    <nav>
        <a href="home.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="quizplay.php"><i class="fas fa-play"></i> Quiz Play</a>
        <a href="instruction.html"><i class="fas fa-book"></i> Instruction</a>
        <div class="dropdown">
            <a href="#" class="dropbtn"><i class="fas fa-ellipsis-h"></i> More</a>
            <div class="dropdown-content">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </nav>
</header>
    <div class="main-content">
        <div class="text-content">
            <h1>Lots Of Quizzes, Lots Of Categories</h1>
            <p>Compete in exciting quizzes, climb global leaderboards, and customize your challenge with various categories and difficulties. Expand your knowledge and become a plant expert while battling for the top spot.</p>
            <a href="quizplay.php" class="cta-button"><i class="fas fa-play-circle button-icon"></i>Let's Play</a>
            <a href="leaderboards.php" class="secondary-button"><i class="fa-solid fa-trophy"></i> Leaderboards</a>
        </div>
        <div class="image-content">
            <img src="assets/images/quizDisplay1.png" alt="Quiz Illustration 1" class="slider-image active">
            <img src="assets/images/quizDisplay2.png" alt="Quiz Illustration 2" class="slider-image">
            <img src="assets/images/quizDisplay3.png" alt="Quiz Illustration 3" class="slider-image">
            <div class="slider-dots">
                <span class="dot active" data-index="0"></span>
                <span class="dot" data-index="1"></span>
                <span class="dot" data-index="2"></span>
            </div>
        </div>
    </div>

    <nav class="mobile-nav">
    <a href="home.php"><i class="fas fa-home"></i></a>
    <a href="quizplay.php"><i class="fas fa-play"></i></a>
    <a href="instruction.html"><i class="fas fa-book"></i></a>
    <div class="dropdown">
        <a href="#" class="more-btn"><i class="fas fa-ellipsis-h"></i></a>
        <div class="dropdown-content">
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</nav>

<div class="overlay" id="logoutOverlay">
    <div class="popup">
        <div class="popup-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h2>Confirm Logout</h2>
        <p>Are you sure you want to logout?</p>
        <div class="popup-buttons">
            <button class="popup-button confirm" id="confirmLogout">Yes, Logout</button>
            <button class="popup-button cancel" id="cancelLogout">Cancel</button>
        </div>
    </div>
</div>

    <script>
        const images = document.querySelectorAll('.slider-image');
        const dots = document.querySelectorAll('.dot');
        let currentIndex = 0;

        function showImage(index) {
            images.forEach(img => img.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            images[index].classList.add('active');
            dots[index].classList.add('active');
            currentIndex = index;
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        setInterval(nextImage, 3000);

        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                showImage(index);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const moreButton = document.querySelector('.mobile-nav .more-btn');
            const dropdown = document.querySelector('.mobile-nav .dropdown');

            moreButton.addEventListener('click', function(e) {
                e.preventDefault();
                dropdown.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target) && !moreButton.contains(e.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });

        //logout

        document.addEventListener('DOMContentLoaded', function() {
        const logoutLinks = document.querySelectorAll('a[href="logout.php"]');
        const logoutOverlay = document.getElementById('logoutOverlay');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        logoutLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                logoutOverlay.style.display = 'block';
            });
        });

        confirmLogout.addEventListener('click', function() {
            window.location.href = 'user-login.php';
        });

        cancelLogout.addEventListener('click', function() {
            logoutOverlay.style.display = 'none';
        });

        logoutOverlay.addEventListener('click', function(e) {
            if (e.target === logoutOverlay) {
                logoutOverlay.style.display = 'none';
            }
        });
    });

    //for the background music
    let audioWorker;

  function initAudio() {
    audioWorker = new Worker('audioWorker.js');
    audioWorker.postMessage({ action: 'init', audioSrc: 'assets/audio/audio-bg-1.mp3' });
  }

  function toggleAudio() {
    if (localStorage.getItem('audioPlaying') === 'true') {
      audioWorker.postMessage({ action: 'pause' });
      localStorage.setItem('audioPlaying', 'false');
      updateButtonText('🔇');
    } else {
      audioWorker.postMessage({ action: 'play' });
      localStorage.setItem('audioPlaying', 'true');
      updateButtonText('🔊');
    }
  }

  function updateButtonText(text) {
    document.getElementById('toggleAudioButton').innerHTML = text;
  }

  const audio = document.getElementById('backgroundAudio');
const toggleButton = document.getElementById('toggleAudioButton');

function toggleAudio() {
    if (audio.paused) {
        audio.play();
        localStorage.setItem('audioPlaying', 'true');
        toggleButton.textContent = '🔊';
    } else {
        audio.pause();
        localStorage.setItem('audioPlaying', 'false');
        toggleButton.textContent = '🔇';
    }
}

        toggleButton.addEventListener('click', toggleAudio);

        // Check localStorage on page load
        window.addEventListener('load', () => {
            const audioPlaying = localStorage.getItem('audioPlaying');
            const audioTime = localStorage.getItem('audioTime');
            
            if (audioPlaying === 'true') {
                audio.currentTime = parseFloat(audioTime) || 0;
                audio.play();
                toggleButton.textContent = '🔊';
            }
        });

        // Store audio time before unload
        window.addEventListener('beforeunload', () => {
            localStorage.setItem('audioTime', audio.currentTime);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
            const hasNickname = <?php echo json_encode($hasNickname); ?>;
            const nicknameOverlay = document.getElementById('nicknameOverlay');
            const nicknameInput = document.getElementById('nicknameInput');
            const submitNickname = document.getElementById('submitNickname');

            if (isLoggedIn && !hasNickname) {
                // Show the overlay with a slight delay to ensure smooth animation
                setTimeout(() => {
                    nicknameOverlay.style.display = 'flex';  // Changed from 'block' to 'flex'
                    nicknameOverlay.classList.add('fade-in');
                }, 100);
            }

            submitNickname.addEventListener('click', function() {
                const nickname = nicknameInput.value.trim();
                if (nickname) {
                    // Send nickname to server using AJAX
                    fetch('update_nickname.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'nickname=' + encodeURIComponent(nickname)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Add a fade-out animation before hiding the overlay
                            nicknameOverlay.style.animation = 'fadeIn 0.3s ease reverse forwards';
                            setTimeout(() => {
                                nicknameOverlay.style.display = 'none';
                            }, 300);
                        } else {
                            alert('Failed to update nickname. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
                } else {
                    alert('Please enter a valid nickname.');
                }
            });
        });
    </script>
</body>
</html>
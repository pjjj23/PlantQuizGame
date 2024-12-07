<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Quiz - Quiz Play</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --primary-color: #e91e63;
            --secondary-color: #3f51b5;
            --text-color: #333;
            --bg-color: #f5f5f5;
            --card-bg: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            padding-bottom: 60px;
        }

        header {
            background-color: var(--card-bg);
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .mobile-nav {
            display: none;
        }

        nav {
            display: flex;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: var(--text-color);
            font-weight: 600;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 5%;
        }

        h1 {
            font-size: 36px;
            color: var(--secondary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .popup {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    backdrop-filter: blur(5px);
}

.popup-content {
    background-color: var(--card-bg);
    margin: 10% auto;
    padding: 40px;
    border-radius: 20px;
    width: 90%;
    max-width: 500px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    animation: popupAppear 0.3s ease-out;
}

@keyframes popupAppear {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.popup-content h2 {
    color: var(--secondary-color);
    font-size: 28px;
    margin-bottom: 15px;
}

.popup-description {
    color: #666;
    margin-bottom: 25px;
}

.difficulty-buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
}

.difficulty-btn {
    flex: 1;
    margin: 0 10px;
    padding: 15px;
    border: 2px solid var(--primary-color);
    border-radius: 10px;
    background-color: transparent;
    color: var(--primary-color);
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.difficulty-btn i {
    font-size: 24px;
    margin-bottom: 10px;
}

.difficulty-btn:hover, .difficulty-btn.selected {
    background-color: var(--primary-color);
    color: white;
}

.time-display {
    font-size: 18px;
    font-weight: 600;
    color: var(--secondary-color);
    margin-bottom: 25px;
}

.action-buttons {
    display: flex;
    justify-content: space-between;
}

.action-buttons button {
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

#continueBtn {
    background-color: var(--secondary-color);
    color: white;
}

#continueBtn:hover:not(:disabled) {
    background-color: #303f9f;
}

#continueBtn:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

#cancelBtn {
    background-color: #f44336;
    color: white;
}

#cancelBtn:hover {
    background-color: #d32f2f;
}

        .breadcrumb {
            color: #666;
            margin-bottom: 30px;
            text-align: center;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .quiz-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .quiz-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .quiz-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .quiz-card-icon {
            font-size: 64px;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .quiz-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .quiz-card p {
            font-size: 16px;
            color: #666;
        }

        .user-info-card {
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 40px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .user-info-card:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        #user-nickname {
            font-size: 32px;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .user-stats {
            display: flex;
            gap: 25px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: var(--text-color);
            transition: transform 0.2s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
        }

        .stat-item i {
            font-size: 24px;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .achievements-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .achievements-btn:hover {
            background-color: #303f9f;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .achievements-btn i {
            margin-right: 10px;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            body {
                padding-bottom: 70px;
            }

            header {
                padding: 20px;
            }

            nav {
                display: none;
            }

            .user-info-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 25px;
            }

            .user-stats {
                flex-wrap: wrap;
                gap: 15px;
            }

            .achievements-btn {
                width: 100%;
                text-align: center;
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

            .quiz-options {
                grid-template-columns: 1fr;
            }
            .popup-content{ 
                height: 55%;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 28px;
            }

            .quiz-card {
                padding: 20px;
            }
        }
        .active{
            color: #e91e63;
        }

        #noHeartsPopup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }

        #noHeartsPopup .popup-content {
            background-color: var(--card-bg);
            margin: 15% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: popupAppear 0.3s ease-out;
        }

        #noHeartsPopup h2 {
            color: var(--secondary-color);
            font-size: 24px;
            margin-bottom: 15px;
        }

        #noHeartsPopup p {
            color: #666;
            font-size: 20px;
            margin-bottom: 20px;
        }

        #noHeartsPopup button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: var(--primary-color);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #noHeartsPopup button:hover {
            background-color: #d81b60;
        }

        .leaderboards-btn {
    background-color: var(--secondary-color);
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.leaderboards-btn:hover {
    background-color: #303f9f;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.leaderboards-btn i {
    margin-right: 10px;
    font-size: 20px;
}
    </style>
</head>
<body> 
    <audio id="backgroundAudio" loop>
        <source src="assets/audio/audio-bg-1.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <button id="toggleAudioButton" style="position: fixed; bottom: 70px; left: 20px; z-index: 1000; padding: 10px; border-radius: 50%; background: var(--primary-color); color: white; border: none; cursor: pointer;">🔇</button>
    
    <header>
        <div class="logo">
            <img src="assets/images/yoga-1805784_640.png" alt="Elite Quiz Logo">
            Flora Quiz
        </div>
        <nav>
            <a href="home.php"><i class="fas fa-home"></i> Home</a>
            <a href="quizplay.php" class="active"><i class="fas fa-play"></i> Quiz Play</a>
            <a href="instruction.html"><i class="fas fa-book"></i> Instruction</a> 
        </nav>
    </header>
    <main>
        <h1>Quiz Play</h1> 
        <div class="user-info-card">
            <div class="user-details">
                <h2 id="user-nickname">Loading...</h2>
                <div class="user-stats">
                    <span><i class="fas fa-heart"></i> <span id="user-hearts">0</span> Hearts</span>
                    <span id="heart-regen-timer" style="display:none;">Next heart in: <span id="minutes-left"></span> min</span>
                    <span><i class="fas fa-life-ring"></i> <span id="user-lifelines">0</span> Lifelines</span> 
                </div>
            </div>
            <button class="leaderboards-btn"><i class="fas fa-trophy"></i> Leaderboards</button>
        </div>

        <div class="quiz-options">
            <div class="quiz-card" data-category="Plant Identification">
                <div class="quiz-card-icon"><i class="fas fa-leaf"></i></div>
                <h3>Plant Identification</h3>
                <p>Test your knowledge of plant species</p>
            </div>
            <div class="quiz-card" data-category="Plant Care">
                <div class="quiz-card-icon"><i class="fas fa-seedling"></i></div>
                <h3>Plant Care</h3>
                <p>Learn about proper plant maintenance</p>
            </div>
            <div class="quiz-card" data-category="Plant Use">
                <div class="quiz-card-icon"><i class="fas fa-tree"></i></div>
                <h3>Plant Use</h3>
                <p>Identify plants at different growth stages</p>
            </div>
            <div class="quiz-card" data-category="Plant Trivia">
                <div class="quiz-card-icon"><i class="fas fa-lightbulb"></i></div>
                <h3>Plant Trivia</h3>
                <p>Discover fascinating plant facts</p>
            </div>
            <div class="quiz-card" data-category="Environmental Impact">
                <div class="quiz-card-icon"><i class="fas fa-globe-americas"></i></div>
                <h3>Environmental Impact</h3>
                <p>Explore plants' role in ecosystems</p>
            </div>
        </div>
    </main>

    <div id="difficultyPopup" class="popup">
    <div class="popup-content">
        <h2>Select Difficulty</h2>
        <p class="popup-description">Choose the difficulty level for your quiz:</p>
        <div class="difficulty-buttons">
            <button class="difficulty-btn" data-difficulty="easy">
                <i class="fas fa-seedling"></i>
                <span>Easy</span>
            </button>
            <button class="difficulty-btn" data-difficulty="medium">
                <i class="fas fa-tree"></i>
                <span>Medium</span>
            </button>
            <button class="difficulty-btn" data-difficulty="hard">
                <i class="fas fa-mountain"></i>
                <span>Hard</span>
            </button>
        </div>
        <p id="timeDisplay" class="time-display"></p>
        <div class="action-buttons">
            <button id="cancelBtn">Cancel</button>
            <button id="continueBtn" disabled>Continue</button>
        </div>
    </div>
</div>
<div id="noHeartsPopup" class="popup">
        <div class="popup-content">
            <h2>Out of Hearts!</h2>
            <p>You don't have any hearts left to play. Would you like to use a lifeline to continue?</p>
            <button id="useLifelineBtn">Use Lifeline</button>
            <button id="closeNoHeartsPopup">Close</button>
        </div>
    </div>

    <nav class="mobile-nav">
        <a href="home.php"><i class="fas fa-home"></i></a>
        <a href="quizplay.php"><i class="fas fa-play"></i></a>
        <a href="instruction.html"><i class="fas fa-book"></i></a> 
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchUserInfo();
            setupQuizCards();
        });

function fetchUserInfo() {
    fetch('get_user_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
            } else {
                updateUserInfoCard(data);
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateUserInfoCard(userData) {
    document.getElementById('user-nickname').textContent = userData.nickname;
    document.getElementById('user-hearts').textContent = userData.hearts;
    document.getElementById('user-lifelines').textContent = userData.lifelines;
    document.getElementById('user-skips').textContent = userData.skips;
    
    const useLifelineBtn = document.getElementById('useLifelineBtn');
            if (userData.lifelines > 0) {
                useLifelineBtn.disabled = false;
                useLifelineBtn.textContent = `Use Lifeline (${userData.lifelines} left)`;
            } else {
                useLifelineBtn.disabled = true;
                useLifelineBtn.textContent = 'No Lifelines Available';
            }
    // Update achievements button to show count
    const leaderboardsBtn = document.querySelector('.leaderboards-btn');
    leaderboardsBtn.innerHTML = `<i class="fas fa-trophy"></i> Leaderboards`;

    const heartRegenTimer = document.getElementById('heart-regen-timer');
    const minutesLeft = document.getElementById('minutes-left');

    if (userData.hearts < 3 && userData.minutes_to_next_heart !== null) {
        heartRegenTimer.style.display = 'inline';
        minutesLeft.textContent = userData.minutes_to_next_heart;

        // Update the timer every minute
        let minutes = userData.minutes_to_next_heart;
        const timerInterval = setInterval(() => {
            minutes--;
            if (minutes <= 0) {
                clearInterval(timerInterval);
                fetchUserInfo(); // Refresh user info
            } else {
                minutesLeft.textContent = minutes;
            }
        }, 60000); // Update every minute
    } else {
        heartRegenTimer.style.display = 'none';
    }
}

// Add click event for achievements button
document.querySelector('.leaderboards-btn').addEventListener('click', function() {
    window.location.href='leaderboards.php';
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
 
function setupQuizCards() {
    const quizCards = document.querySelectorAll('.quiz-card');
    const popup = document.getElementById('difficultyPopup');
    const noHeartsPopup = document.getElementById('noHeartsPopup');
    const difficultyBtns = document.querySelectorAll('.difficulty-btn');
    const timeDisplay = document.getElementById('timeDisplay');
    const continueBtn = document.getElementById('continueBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const closeNoHeartsPopupBtn = document.getElementById('closeNoHeartsPopup');

    let selectedCategory = null;
    let selectedDifficulty = null;

    quizCards.forEach(card => {
        card.addEventListener('click', () => {
            const hearts = parseInt(document.getElementById('user-hearts').textContent);
            if (hearts === 0) {
                noHeartsPopup.style.display = 'flex';
            } else {
                quizCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                selectedCategory = card.dataset.category;
                popup.style.display = 'flex';
            }
        });
    });

    const useLifelineBtn = document.getElementById('useLifelineBtn');
            
            useLifelineBtn.addEventListener('click', () => {
                fetch('use_lifeline.php', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        noHeartsPopup.style.display = 'none';
                        fetchUserInfo(); // Refresh user info
                        // Continue with quiz selection
                        selectedCategory = document.querySelector('.quiz-card.selected').dataset.category;
                        popup.style.display = 'flex';
                    } else {
                        alert('Failed to use lifeline. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Heart added.');
                });
            });

    closeNoHeartsPopupBtn.addEventListener('click', () => {
        noHeartsPopup.style.display = 'none';
    });

    difficultyBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            difficultyBtns.forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            selectedDifficulty = btn.getAttribute('data-difficulty');
            let time;
            switch(selectedDifficulty) {
                case 'easy':
                    time = '2 minutes';
                    break;
                case 'medium':
                    time = '1 mins 30 secs';
                    break;
                case 'hard':
                    time = '1 minutes';
                    break;
            }
            timeDisplay.textContent = `Time: ${time}`;
            continueBtn.disabled = false;
        });
    });

    continueBtn.addEventListener('click', () => {
        if (!selectedCategory || !selectedDifficulty) {
            alert('Please select both a category and a difficulty level.');
            return;
        }
        
        // Use AJAX to set the session variables
        fetch('set_quiz_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `category=${encodeURIComponent(selectedCategory)}&difficulty=${selectedDifficulty}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect based on selected difficulty
                switch(selectedDifficulty) {
                    case 'easy':
                        window.location.href = 'game-easy.php';
                        break;
                    case 'medium':
                        window.location.href = 'game-medium.php';
                        break;
                    case 'hard':
                        window.location.href = 'game-hard.php';
                        break;
                    default:
                        console.error('Invalid difficulty selected');
                }
            } else {
                console.error('Failed to set session');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    cancelBtn.addEventListener('click', () => {
        popup.style.display = 'none';
        timeDisplay.textContent = '';
        continueBtn.disabled = true;
        difficultyBtns.forEach(b => b.classList.remove('selected'));
        quizCards.forEach(c => c.classList.remove('selected'));
        selectedCategory = null;
        selectedDifficulty = null;
    });
}
    </script>
</body>
</html>
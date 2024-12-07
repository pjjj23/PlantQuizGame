<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions from the database
$sql = "SELECT * FROM medium ORDER BY RAND() LIMIT 20";
$result = $conn->query($sql);

$questions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();

// Convert questions to JSON for JavaScript
$questionsJson = json_encode($questions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flora Quiz Game</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
    --primary-color: #FF9FF3;
    --secondary-color: #54A0FF;
    --background-color: #FFEAA7;
    --text-color: #5758BB;
    --option-color: #81ECEC;
    --wrong-color: #FF7675;
    --correct-color: #55EFC4;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Comic Sans MS', cursive, sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    background-image: url('data:image/svg+xml,%3Csvg width="52" height="26" viewBox="0 0 52 26" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.4"%3E%3Cpath d="M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 3.314 2.686 6 6 6v-2c-2.21 0-4-1.79-4-4 0-3.314-2.686-6-6-6-2.21 0-4-1.79-4-4zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
}

.quiz-container {
    display: grid;
    grid-template-columns: auto 1fr;
    grid-gap: 20px;
    max-width: 1200px;
    width: 100%;
    background-color: white;
    border-radius: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 30px;
    border: 8px solid var(--primary-color);
    background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z" fill="%239C92AC" fill-opacity="0.1" fill-rule="evenodd"/%3E%3C/svg%3E');
}

.sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.menu-btn, .timer-container {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 15px;
    font-size: 24px;
    cursor: pointer;
    border-radius: 50%;
    transition: all 0.3s ease;
    width: 80px;
    height: 80px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.menu-btn:hover, .timer-container:hover {
    transform: scale(1.1) rotate(5deg);
}

.timer-container {
    background-color: var(--secondary-color);
    font-size: 28px;
    font-weight: bold;
    position: relative;
    overflow: hidden;
}

.timer-fill {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.3);
    transition: height 1s linear;
}

.question-card {
    background-color: var(--primary-color);
    color: white;
    padding: 30px;
    border-radius: 25px;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px;
    align-items: center;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.question-card:hover {
    transform: translateY(-5px);
}

.question-image {
    width: 150px;
    height: 150px;
    background-color: white;
    border-radius: 20px;
    border: 5px solid var(--secondary-color);
    background-size: cover;
    background-position: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.question-text {
    font-size: 28px;
    font-weight: bold;
}

.options-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.option-btn {
    background-color: var(--option-color);
    color: var(--text-color);
    border: none;
    padding: 20px;
    cursor: pointer;
    font-size: 20px;
    text-align: left;
    border-radius: 20px;
    transition: all 0.3s ease;
    font-weight: bold;
    display: flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.option-btn:hover {
    transform: scale(1.05) translateY(-5px);
    background-color: var(--secondary-color);
    color: white;
}

.option-btn.correct {
    background-color: var(--correct-color);
    color: white;
}

.option-btn.wrong {
    background-color: var(--wrong-color);
    color: white;
}

.option-label {
    background-color: var(--secondary-color);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    margin-right: 15px;
}

.reveal-answer {
    display: none;
    grid-column: 1 / -1;
    background-color: var(--secondary-color);
    color: white;
    padding: 20px;
    border-radius: 20px;
    text-align: center;
    font-size: 24px;
    margin-top: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.continue-btn, .restart-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 20px;
    border-radius: 50px;
    cursor: pointer;
    margin-top: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.continue-btn:hover, .restart-btn:hover {
    transform: scale(1.05) translateY(-5px);
    background-color: var(--secondary-color);
}

.pause-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    display: none;
}

.pause-content {
    background-color: white;
    padding: 40px;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.pause-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 20px;
    border-radius: 50px;
    cursor: pointer;
    margin: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.pause-btn:hover {
    transform: scale(1.05) translateY(-5px);
    background-color: var(--secondary-color);
}

.result-container {
    text-align: center;
    padding: 40px;
    background-color: var(--primary-color);
    border-radius: 25px;
    color: white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.result-title {
    font-size: 36px;
    margin-bottom: 20px;
}

.result-score {
    font-size: 48px;
    font-weight: bold;
    margin-bottom: 20px;
}

.result-message {
    font-size: 24px;
    margin-bottom: 30px;
}

.result-icon {
    font-size: 72px;
    margin-bottom: 20px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}

@media (max-width: 768px) {
    .quiz-container {
        grid-template-columns: 1fr;
    }

    .sidebar {
        flex-direction: row;
        justify-content: space-between;
    }

    .question-card {
        grid-template-columns: 1fr;
    }

    .question-image {
        width: 100%;
        height: 200px;
    }

    .options-container {
        grid-template-columns: 1fr;
    }
}

.fill-in-blank-input {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            border: 3px solid var(--primary-color);
            border-radius: 15px;
            background-color: white;
            color: var(--text-color);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .fill-in-blank-input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .submit-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            font-weight: bold;
        }

        .submit-btn:hover {
            transform: scale(1.05) translateY(-3px);
            background-color: var(--primary-color);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <div class="sidebar">
            <button class="menu-btn"><i class="fas fa-bars"></i></button>
            <div class="timer-container">
                <div class="timer-fill"></div>
                <span id="timer">30</span>
            </div>
        </div>
        <div class="main-content">
            <div class="question-card">
                <div class="question-image"></div>
                <div class="question-text"></div>
            </div>
            <div class="options-container"></div>
            <div class="reveal-answer">
                <p id="answer-text"></p>
                <button class="continue-btn">Continue</button>
            </div>
        </div>
    </div>

    <div class="pause-menu">
        <div class="pause-content">
            <h2>Game Paused</h2>
            <button class="pause-btn" id="resume-btn"><i class="fas fa-play"></i> Resume</button>
            <button class="pause-btn" id="exit-btn"><i class="fas fa-sign-out-alt"></i> Exit</button>
        </div>
    </div>

    <audio id="background-music" loop>
        <source src="assets/audio/game-bg.mp3" type="audio/mpeg">
    </audio>
    <audio id="button-click-sound">
        <source src="assets/audio/click.mp3" type="audio/mpeg">
    </audio>
    <audio id="correct-sound">
        <source src="assets/audio/correct.wav" type="audio/mpeg">
    </audio>
    <audio id="wrong-sound">
        <source src="assets/audio/incorrect.wav" type="audio/mpeg">
    </audio>
    <audio id="result-sound">
        <source src="assets/audio/final_success.wav" type="audio/mpeg">
    </audio>

    <script>
        const questions = <?php echo $questionsJson; ?>;
        let currentQuestionIndex = 0;
        let score = 0;
        const menuBtn = document.querySelector('.menu-btn');
        const pauseMenu = document.querySelector('.pause-menu');
        const resumeBtn = document.getElementById('resume-btn');
        const exitBtn = document.getElementById('exit-btn');
        const timerElement = document.getElementById('timer');
        const timerFill = document.querySelector('.timer-fill');
        const optionsContainer = document.querySelector('.options-container');
        const questionCard = document.querySelector('.question-card');
        const questionImage = document.querySelector('.question-image');
        const questionText = document.querySelector('.question-text');
        const revealAnswer = document.querySelector('.reveal-answer');
        const answerText = document.getElementById('answer-text');
        const continueBtn = document.querySelector('.continue-btn');
        const backgroundMusic = document.getElementById('background-music');
        const buttonClickSound = document.getElementById('button-click-sound');
        const correctSound = document.getElementById('correct-sound');
        const wrongSound = document.getElementById('wrong-sound');
        const resultSound = document.getElementById('result-sound');

        let isPaused = false;
        let timer;
        const totalTime = 90; 

        function startTimer() {
            let timeLeft = totalTime;
            updateTimerDisplay(timeLeft);
            timerFill.style.height = '0%';

            timer = setInterval(() => {
                if (!isPaused) {
                    timeLeft--;
                    updateTimerDisplay(timeLeft);
                    const percentageFilled = ((totalTime - timeLeft) / totalTime) * 100;
                    timerFill.style.height = `${percentageFilled}%`;

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        endQuiz();
                    }
                }
            }, 1000);
        }

        function updateTimerDisplay(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            timerElement.textContent = `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        function displayQuestion() {
            const question = questions[currentQuestionIndex];
            questionText.textContent = question.Mquestion;

            if (question.Mimgupload && question.MtypeQuestion === 'imageIdentification') {
        questionImage.style.display = 'block';
        const imagePath = `${question.Mimgupload}`;
        console.log('Attempting to load image:', imagePath);
        
        // Create a new Image object to test loading
        const testImage = new Image();
        testImage.onload = function() {
            console.log('Image loaded successfully');
            questionImage.style.backgroundImage = `url('${imagePath}')`;
        };
        testImage.onerror = function() {
            console.error('Failed to load image:', imagePath);
            questionImage.textContent = 'Image failed to load';
        };
        testImage.src = imagePath;
    } else {
                questionImage.style.display = 'none';
            }

            optionsContainer.innerHTML = '';

            switch (question.MtypeQuestion) {
                case 'multipleChoice':
                case 'matchingType':
                case 'imageIdentification':
                    createMultipleChoiceOptions(question);
                    break;
                case 'trueOrFalse':
                    createTrueFalseOptions(question);
                    break;
                case 'fillInTheBlanks':
                    createFillInTheBlanks(question);
                    break;
            }

            revealAnswer.style.display = 'none';
        }

        function createMultipleChoiceOptions(question) {
            const options = [question.option1, question.option2, question.option3, question.option4];
            const labels = ['A', 'B', 'C', 'D'];

            options.forEach((option, index) => {
                if (option) {
                    const button = document.createElement('button');
                    button.className = 'option-btn';
                    button.innerHTML = `
                        <span class="option-label">${labels[index]}</span>
                        ${option}
                    `;
                    button.addEventListener('click', () => {
                        buttonClickSound.play();
                        checkAnswer(`option${index + 1}`, question.Mcorrectanswer, question.Mpoint);
                    });
                    optionsContainer.appendChild(button);
                }
            });
        }

        function createTrueFalseOptions(question) {
            const options = [question.option1, question.option2];
            const labels = ['A', 'B'];

            options.forEach((option, index) => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.innerHTML = `
                    <span class="option-label">${labels[index]}</span>
                    ${option}
                `;
                button.addEventListener('click', () => {
                    buttonClickSound.play();
                    checkAnswer(`option${index + 1}`, question.Mcorrectanswer, question.Mpoint);
                });
                optionsContainer.appendChild(button);
            });
        }
 
        function createFillInTheBlanks(question) {
            const inputContainer = document.createElement('div');
            inputContainer.className = 'fill-in-blank-container';

            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'fill-in-blank-input';
            input.placeholder = 'Type your answer here';

            const submitButton = document.createElement('button');
            submitButton.textContent = 'Submit Answer';
            submitButton.className = 'submit-btn';
            submitButton.addEventListener('click', () => {
                buttonClickSound.play();
                checkAnswer(input.value, question.Mcorrectanswer, question.Mpoint);
            });

            // Add event listener for 'Enter' key press
            input.addEventListener('keypress', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    submitButton.click();
                }
            });

            inputContainer.appendChild(input);
            inputContainer.appendChild(submitButton);
            optionsContainer.appendChild(inputContainer);
        }

function checkAnswer(userAnswer, correctAnswer, points) {
    let isCorrect = false;

    if (questions[currentQuestionIndex].MtypeQuestion === 'fillInTheBlanks') {
        isCorrect = userAnswer.trim().toLowerCase() === correctAnswer.trim().toLowerCase();
    } else {
        isCorrect = userAnswer === correctAnswer;
    }

    if (isCorrect) {
        score += parseInt(points);
        correctSound.play();
    } else {
        wrongSound.play();
    }

    // Highlight correct and incorrect options
    const options = document.querySelectorAll('.option-btn');
    options.forEach(option => {
        if (option.textContent.includes(correctAnswer)) {
            option.classList.add('correct');
        } else if (option.textContent.includes(userAnswer)) {
            option.classList.add('wrong');
        }
        option.disabled = true;
    });

    revealAnswer.style.display = 'block';
    answerText.innerHTML = isCorrect ? 
        '<i class="fas fa-check-circle"></i> Correct!' : 
        `<i class="fas fa-times-circle"></i> Incorrect. The correct answer is: ${getCorrectAnswerText(correctAnswer)}`;
    continueBtn.style.display = 'block';
}

function getCorrectAnswerText(correctAnswer) {
    const question = questions[currentQuestionIndex];
    if (question.MtypeQuestion === 'fillInTheBlanks') {
        return correctAnswer;
    } else {
        return question[correctAnswer];
    }
}

continueBtn.addEventListener('click', () => {
    buttonClickSound.play();
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        displayQuestion();
    } else {
        endQuiz();
    }
});

function endQuiz() {
            clearInterval(timer);
            questionCard.style.display = 'none';
            optionsContainer.style.display = 'none';
            revealAnswer.style.display = 'block';
            
            resultSound.play();

            const resultContainer = document.createElement('div');
            resultContainer.className = 'result-container';
            
            const resultIcon = document.createElement('div');
            resultIcon.className = 'result-icon';
            resultIcon.innerHTML = score > (questions.length * 5) / 2 ? '<i class="fas fa-trophy"></i>' : '<i class="fas fa-star"></i>';

            const resultTitle = document.createElement('h2');
            resultTitle.className = 'result-title';
            resultTitle.textContent = 'Quiz Completed!';

            const resultScore = document.createElement('p');
            resultScore.className = 'result-score';
            resultScore.textContent = `Your Score: ${score} / ${questions.length * 10}`;

            const resultMessage = document.createElement('p');
            resultMessage.className = 'result-message';
            resultMessage.textContent = score > (questions.length * 5) / 2 ? 
                'Great job! You did well!' : 'Good effort! Keep practicing!';

            const restartBtn = document.createElement('button');
             

            resultContainer.appendChild(resultIcon);
            resultContainer.appendChild(resultTitle);
            resultContainer.appendChild(resultScore);
            resultContainer.appendChild(resultMessage);
            resultContainer.appendChild(restartBtn);

            revealAnswer.innerHTML = '';
            revealAnswer.appendChild(resultContainer);

            // Save the score to the database
            saveScore(score);
        }

        function restartQuiz() {
            buttonClickSound.play();
            currentQuestionIndex = 0;
            score = 0;
            clearInterval(timer);
            startTimer();
            displayQuestion();
            questionCard.style.display = 'grid';
            optionsContainer.style.display = 'grid';
            revealAnswer.style.display = 'none';
        }

        function saveScore(score) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_score.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    console.log('Score saved and heart deducted successfully');
                } else {
                    console.error('Error saving score and deducting heart');
                }
            };
            xhr.send('score=' + score);
        }

menuBtn.addEventListener('click', () => {
    buttonClickSound.play();
    pauseMenu.style.display = 'flex';
    isPaused = true;
    backgroundMusic.pause();
});

resumeBtn.addEventListener('click', () => {
    buttonClickSound.play();
    pauseMenu.style.display = 'none';
    isPaused = false;
    backgroundMusic.play();
});

exitBtn.addEventListener('click', () => {
    buttonClickSound.play();
    // Handle exit game logic (e.g., redirect to home page)
    window.location.href = 'quizplay.php';
});

// Start the game
backgroundMusic.play();
startTimer();
displayQuestion();
    </script>
</body>
</html>
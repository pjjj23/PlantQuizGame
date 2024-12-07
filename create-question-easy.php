<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Question EASY</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f4f8;
            color: #333;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        select, input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #bdc3c7;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }
        select:focus, input:focus, textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            background-color: #fff;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .hidden {
            display: none;
        }
        .icon {
            margin-right: 10px;
            color: #3498db;
        }
        #imagePreview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .popup-content {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .close-popup {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .close-popup:hover {
            background-color: #2980b9;
        }
        .back-button {
            background-color: #95a5a6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #7f8c8d;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .form-container {
                padding: 20px;
            }
            h1 {
                font-size: 24px;
            }
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .action-button {
                margin-bottom: 10px;
            }
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .action-button {
            padding: 10px 15px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            width: 40px;
            height: 40px;
        }

        .delete-button:hover {
            background-color: #c0392b;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<div class="action-buttons">
    <a href="#" class="action-button back-button" onclick="goBack()">
        <i class="fas fa-arrow-left icon"></i>Back
    </a>
    <a href="manage_question_easy.php" class="action-button delete-button" title="Manage Questions">
        <i class="fas fa-trash-alt"></i>
    </a>
</div> 
    <form id="questionForm" action="save_question_easy.php" method="POST" enctype="multipart/form-data">
        <div class="form-container">
            <h1><i class="fas fa-question-circle icon"></i>Creating Question - <span style="color: #e74c3c">EASY</span></h1>
            <div class="form-group">
                <label for="questionType"><i class="fas fa-list-ul icon"></i>Type of Question</label>
                <select id="questionType" name="questionType" required>
                    <option value="" disabled selected>Select Question Type</option>
                    <option value="multipleChoice">Multiple Choice</option>
                    <option value="trueOrFalse">True or False</option>
                    <option value="imageIdentification">Image Identification</option>
                    <option value="matchingType">Matching Type</option>
                    <option value="fillInTheBlanks">Fill in the Blanks</option>
                </select>
            </div>

            <div id="categoryGroup" class="form-group hidden">
                <label for="category"><i class="fas fa-tag icon"></i>Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="plantIdentification">Plant Identification</option>
                    <option value="plantCare">Plant Care</option>
                    <option value="plantUse">Plant Use</option>
                    <option value="plantTrivia">Plant Trivia</option>
                    <option value="environmentalImpact">Environmental Impact</option>
                </select>
            </div>

            <div id="pointsGroup" class="form-group hidden">
                <label for="points"><i class="fas fa-star icon"></i>Points</label>
                <select id="points" name="points" required>
                    <option value="">Select Points</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div id="questionGroup" class="form-group hidden">
                <label for="question"><i class="fas fa-pen icon"></i>Question</label>
                <textarea id="question" name="question" rows="3" placeholder="Enter your question here" required></textarea>
            </div>

            <div id="optionsContainer" class="hidden">
                <div class="form-group">
                    <label for="option1"><i class="fas fa-check-circle icon"></i>Option 1</label>
                    <input type="text" id="option1" name="option1" placeholder="Enter option 1" required>
                </div>
                <div class="form-group">
                    <label for="option2"><i class="fas fa-check-circle icon"></i>Option 2</label>
                    <input type="text" id="option2" name="option2" placeholder="Enter option 2" required>
                </div>
                <div class="form-group multipleChoice matchingType">
                    <label for="option3"><i class="fas fa-check-circle icon"></i>Option 3</label>
                    <input type="text" id="option3" name="option3" placeholder="Enter option 3">
                </div>
                <div class="form-group multipleChoice matchingType">
                    <label for="option4"><i class="fas fa-check-circle icon"></i>Option 4</label>
                    <input type="text" id="option4" name="option4" placeholder="Enter option 4">
                </div>
            </div>

            <div id="answerGroup" class="form-group hidden">
                <label for="answer"><i class="fas fa-key icon"></i>Answer</label>
                <select id="answer" name="answer" required>
                    <option value="">Select Answer</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    <option value="option4">Option 4</option>
                </select>
            </div>

            <div id="fillInAnswerGroup" class="form-group hidden">
                <label for="fillInAnswer"><i class="fas fa-key icon"></i>Answer</label>
                <input type="text" id="fillInAnswer" name="fillInAnswer" placeholder="Enter the correct answer">
            </div>

            <div id="imageUploadGroup" class="form-group hidden">
                <label for="imageUpload"><i class="fas fa-image icon"></i>Upload Image</label>
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*">
                <img id="imagePreview" class="hidden" alt="Image preview">
            </div>

            <button type="submit"><i class="fas fa-paper-plane icon"></i>Submit</button>
        </div>
    </form>

    <div id="successPopup" class="popup">
        <div class="popup-content">
            <i class="fas fa-check-circle" style="font-size: 48px; color: #2ecc71; margin-bottom: 20px;"></i>
            <h2 style="margin-bottom: 20px;">Success!</h2>
            <p>Question successfully added to the database.</p>
            <button class="close-popup" onclick="closePopup('successPopup')">Close</button>
        </div>
    </div>

    <div id="errorPopup" class="popup">
        <div class="popup-content">
            <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #e74c3c; margin-bottom: 20px;"></i>
            <h2 style="margin-bottom: 20px;">Error</h2>
            <p>Please fill in all required fields.</p>
            <button class="close-popup" onclick="closePopup('errorPopup')">Close</button>
        </div>
    </div>

    <script>
        const form = document.getElementById('questionForm');
        const questionType = document.getElementById('questionType');
        const categoryGroup = document.getElementById('categoryGroup');
        const pointsGroup = document.getElementById('pointsGroup');
        const questionGroup = document.getElementById('questionGroup');
        const optionsContainer = document.getElementById('optionsContainer');
        const answerGroup = document.getElementById('answerGroup');
        const fillInAnswerGroup = document.getElementById('fillInAnswerGroup');
        const imageUploadGroup = document.getElementById('imageUploadGroup');

        questionType.addEventListener('change', function() {
    const selectedType = this.value;
    
    // Show common elements
    categoryGroup.classList.remove('hidden');
    pointsGroup.classList.remove('hidden');
    questionGroup.classList.remove('hidden');

    // Hide all specific elements first
    optionsContainer.classList.add('hidden');
    answerGroup.classList.add('hidden');
    fillInAnswerGroup.classList.add('hidden');
    imageUploadGroup.classList.add('hidden');

    // Reset options and answer
    document.getElementById('option1').value = '';
    document.getElementById('option2').value = '';
    document.getElementById('option3').value = '';
    document.getElementById('option4').value = '';
    document.getElementById('answer').innerHTML = '<option value="">Select Answer</option>';

    // Show elements based on question type
    if (selectedType === 'multipleChoice' || selectedType === 'matchingType' || selectedType === 'imageIdentification') {
        optionsContainer.classList.remove('hidden');
        answerGroup.classList.remove('hidden');
        document.querySelectorAll('.multipleChoice, .matchingType').forEach(el => el.classList.remove('hidden'));
        for (let i = 1; i <= 4; i++) {
            document.getElementById('answer').innerHTML += `<option value="option${i}">Option ${i}</option>`;
        }
        document.getElementById('option1').required = true;
        document.getElementById('option2').required = true;
        document.getElementById('option3').required = true;
        document.getElementById('option4').required = true;
        document.getElementById('answer').required = true;
        document.getElementById('fillInAnswer').required = false;
    } else if (selectedType === 'trueOrFalse') {
        optionsContainer.classList.remove('hidden');
        answerGroup.classList.remove('hidden');
        document.querySelectorAll('.multipleChoice, .matchingType').forEach(el => el.classList.add('hidden'));
        document.getElementById('option1').value = 'TRUE';
        document.getElementById('option2').value = 'FALSE';
        document.getElementById('answer').innerHTML += '<option value="option1">TRUE</option>';
        document.getElementById('answer').innerHTML += '<option value="option2">FALSE</option>';
        document.getElementById('option1').required = true;
        document.getElementById('option2').required = true;
        document.getElementById('option3').required = false;
        document.getElementById('option4').required = false;
        document.getElementById('answer').required = true;
        document.getElementById('fillInAnswer').required = false;
    } else if (selectedType === 'fillInTheBlanks') {
        fillInAnswerGroup.classList.remove('hidden');
        document.getElementById('option1').required = false;
        document.getElementById('option2').required = false;
        document.getElementById('option3').required = false;
        document.getElementById('option4').required = false;
        document.getElementById('answer').required = false;
        document.getElementById('fillInAnswer').required = true;
    }

    if (selectedType === 'imageIdentification') {
        imageUploadGroup.classList.remove('hidden');
    }
});

        const imageUpload = document.getElementById('imageUpload');
        const imagePreview = document.getElementById('imagePreview');

        imageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Add this to transform Fill in the Blanks answer to uppercase
        const fillInAnswer = document.getElementById('fillInAnswer');
        fillInAnswer.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const selectedType = questionType.value;
    const formData = new FormData(form);

    // Check if all required fields for the current question type are filled
    let allFilled = true;
    const requiredFields = ['questionType', 'category', 'points', 'question'];

    if (selectedType === 'fillInTheBlanks') {
        requiredFields.push('fillInAnswer');
        formData.delete('option1');
        formData.delete('option2');
        formData.delete('option3');
        formData.delete('option4');
        formData.delete('answer');
        formData.set('answer', formData.get('fillInAnswer'));
    } else if (selectedType === 'trueOrFalse') {
        requiredFields.push('option1', 'option2', 'answer');
        formData.delete('option3');
        formData.delete('option4');
    } else if (selectedType === 'imageIdentification') {
        requiredFields.push('option1', 'option2', 'option3', 'option4', 'answer', 'imageUpload');
    } else {
        requiredFields.push('option1', 'option2', 'option3', 'option4', 'answer');
    }

    for (let field of requiredFields) {
        if (!formData.get(field)) {
            allFilled = false;
            break;
        }
    }

    if (!allFilled) {
        document.getElementById('errorPopup').style.display = 'block';
        return;
    }

    fetch('save_question_easy.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('successPopup').style.display = 'block';
            form.reset();
            imagePreview.classList.add('hidden');
            imagePreview.src = '';
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }

    function goBack() {
        window.location.href='admin-home.php';
    }
    </script>
</body>
</html>
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
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set parameters with error checking
    $category = isset($_POST['category']) ? $conn->real_escape_string($_POST['category']) : '';
    $correctAnswer = isset($_POST['answer']) ? $conn->real_escape_string($_POST['answer']) : '';
    $point = isset($_POST['points']) ? intval($_POST['points']) : 0;
    $question = isset($_POST['question']) ? $conn->real_escape_string($_POST['question']) : '';
    $typeQuestion = isset($_POST['questionType']) ? $conn->real_escape_string($_POST['questionType']) : '';
    $option1 = isset($_POST['option1']) ? $conn->real_escape_string($_POST['option1']) : '';
    $option2 = isset($_POST['option2']) ? $conn->real_escape_string($_POST['option2']) : '';
    $option3 = isset($_POST['option3']) ? $conn->real_escape_string($_POST['option3']) : '';
    $option4 = isset($_POST['option4']) ? $conn->real_escape_string($_POST['option4']) : '';

    // Handle image upload
    $imgUpload = '';
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        $target_dir = "uploads/medium/";
        $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
        if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
            $imgUpload = $target_file;
        }
    }

    // For fill in the blanks, use fillInAnswer
    if ($typeQuestion == 'fillInTheBlanks') {
        $correctAnswer = isset($_POST['fillInAnswer']) ? $conn->real_escape_string($_POST['fillInAnswer']) : '';
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO medium (Mcategory, Mcorrectanswer, Mimgupload, Mpoint, Mquestion, MtypeQuestion, option1, option2, option3, option4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die(json_encode(["status" => "error", "message" => "Error preparing statement: " . $conn->error]));
    }

    // Corrected bind_param call
    if (!$stmt->bind_param("sssissssss", $category, $correctAnswer, $imgUpload, $point, $question, $typeQuestion, $option1, $option2, $option3, $option4)) {
        die(json_encode(["status" => "error", "message" => "Binding parameters failed: " . $stmt->error]));
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "New record created successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Form was not submitted."]);
}

$conn->close();
?>
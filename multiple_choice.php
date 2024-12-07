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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $category = $_POST['category'];
    $points = $_POST['points'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct-answer'];

    // Prepare SQL statement
    $sql = "INSERT INTO `multiple-choice` (multcategory, multpoints, multques, option1, option2, option3, option4, multansw)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssss", $category, $points, $question, $option1, $option2, $option3, $option4, $correct_answer);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
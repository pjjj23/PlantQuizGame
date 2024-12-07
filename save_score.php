<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['score'])) {
    die('Invalid request');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$score = intval($_POST['score']);

// Start transaction
$conn->begin_transaction();

try {
    // Update score
    $sql_score = "UPDATE users SET points = points + ? WHERE id = ?";
    $stmt_score = $conn->prepare($sql_score);
    $stmt_score->bind_param("ii", $score, $user_id);
    $stmt_score->execute();
    $stmt_score->close();

    // Deduct one heart
    $sql_heart = "UPDATE users SET hearts = hearts - 1 WHERE id = ? AND hearts > 0";
    $stmt_heart = $conn->prepare($sql_heart);
    $stmt_heart->bind_param("i", $user_id);
    $stmt_heart->execute();
    $stmt_heart->close();

    // Commit transaction
    $conn->commit();
    echo "Score updated and heart deducted successfully";
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo "Error updating score and deducting heart: " . $e->getMessage();
}

$conn->close();
?>
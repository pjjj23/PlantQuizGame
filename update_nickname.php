<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $nickname = trim($_POST['nickname']);
    $userId = $_SESSION['user_id'];

    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "floraquiz");
    
    // Check connection
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Connection failed']));
    }
    
    // Prepare and execute query
    $stmt = $conn->prepare("UPDATE users SET nickname = ? WHERE id = ?");
    $stmt->bind_param("si", $nickname, $userId);
    $result = $stmt->execute();
    
    // Close connection
    $stmt->close();
    $conn->close();
    
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update nickname']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
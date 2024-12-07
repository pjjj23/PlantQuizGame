<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['difficulty']) && isset($_POST['category'])) {
    $_SESSION['current_quiz'] = [
        'difficulty' => $_POST['difficulty'],
        'category' => $_POST['category']
    ];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
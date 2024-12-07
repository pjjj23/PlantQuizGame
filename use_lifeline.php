<?php
session_start();
header('Content-Type: application/json');

// Database connection
$db = new mysqli('localhost', 'root', '', 'floraquiz');

if ($db->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $db->connect_error]));
}

// Assuming you have the user's ID stored in the session
$user_id = $_SESSION['user_id'] ?? 0;

// Start transaction
$db->begin_transaction();

try {
    // Get current user data
    $stmt = $db->prepare("SELECT hearts, lifelines FROM users WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if ($row['lifelines'] > 0) {
            // Decrease lifeline count and increase heart count
            $new_lifeline_count = $row['lifelines'] - 1;
            $new_heart_count = min($row['hearts'] + 1, 3); // Assuming max hearts is 3
            
            // Update the database
            $update_stmt = $db->prepare("UPDATE users SET hearts = ?, lifelines = ? WHERE id = ?");
            $update_stmt->bind_param("iii", $new_heart_count, $new_lifeline_count, $user_id);
            $update_stmt->execute();
            $update_stmt->close();
            
            // Commit transaction
            $db->commit();
            
            echo json_encode(['success' => true, 'hearts' => $new_heart_count, 'lifelines' => $new_lifeline_count]);
        } else {
            // No lifelines available
            $db->rollback();
            echo json_encode(['success' => false, 'error' => 'No lifelines available']);
        }
    } else {
        // User not found
        $db->rollback();
        echo json_encode(['success' => false, 'error' => 'User not found']);
    }
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $db->rollback();
    echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
}

$stmt->close();
$db->close();
?>
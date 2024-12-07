<?php
session_start();
header('Content-Type: application/json');

// Database connection
$db = new mysqli('localhost', 'root', '', 'floraquiz');

if ($db->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $db->connect_error]));
}

// Assuming you have the user's ID stored in the session
$user_id = $_SESSION['user_id'] ?? 0;

$stmt = $db->prepare("SELECT nickname, hearts, lifelines, skips, achievements, last_heart_regeneration FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $current_time = time();
    $last_regen_time = $row['last_heart_regeneration'];
    $time_passed = $current_time - $last_regen_time;
    $regeneration_interval = 600; // 10 minutes in seconds

    // Check if it's time to regenerate a heart
    if ($row['hearts'] < 3 && $time_passed >= $regeneration_interval) {
        $hearts_to_add = min(3 - $row['hearts'], floor($time_passed / $regeneration_interval));
        $new_heart_count = $row['hearts'] + $hearts_to_add;
        
        // Update the database
        $new_last_regen_time = $current_time - ($time_passed % $regeneration_interval);
        $update_stmt = $db->prepare("UPDATE users SET hearts = ?, last_heart_regeneration = ? WHERE id = ?");
        $update_stmt->bind_param("iii", $new_heart_count, $new_last_regen_time, $user_id);
        $update_stmt->execute();
        $update_stmt->close();

        $row['hearts'] = $new_heart_count;
        $last_regen_time = $new_last_regen_time;
    }

    $time_until_next_heart = ($row['hearts'] < 3) ? max(0, $regeneration_interval - ($current_time - $last_regen_time)) : 0;
    $minutes_left = ceil($time_until_next_heart / 60);

    $response = [
        'nickname' => $row['nickname'],
        'hearts' => $row['hearts'],
        'lifelines' => $row['lifelines'],
        'skips' => $row['skips'],
        'achievements' => $row['achievements'],
        'minutes_to_next_heart' => ($row['hearts'] < 3) ? $minutes_left : null
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'User not found']);
}

$stmt->close();
$db->close();
?>
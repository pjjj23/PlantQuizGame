<?php
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
}

// Initialize an array to store the counts
$counts = array();

// Define the tables to count
$tables = array('multiple-choice', 'truefalse', 'image-identity', 'matching-type', 'fill-in-the-blank');

// Count questions for each table
foreach ($tables as $table) {
    $query = "SELECT COUNT(*) as count FROM `$table`";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $counts[$table] = $row['count'];
    } else {
        $counts[$table] = "Error: " . mysqli_error($conn);
    }
}

// Calculate total questions
$counts['total'] = array_sum(array_filter($counts, 'is_numeric'));

// Close the database connection
mysqli_close($conn);

// Return the counts as JSON
echo json_encode($counts);
?>
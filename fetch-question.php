<?php
session_start();
header('Content-Type: application/json');

$db = new mysqli('localhost', 'root', '', 'floraquiz');

if ($db->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $db->connect_error]));
}

$difficulty = $_SESSION['current_quiz']['difficulty'] ?? 'easy';
$category = $_SESSION['current_quiz']['category'] ?? 'Plant Identification';

$tableMap = [
    'Plant Identification' => '`image-identity`',
    'Plant Care' => '`multiple-choice`',
    'Plant Use' => '`matching-type`',
    'Plant Trivia' => '`fill-in-the-blank`',
    'Environmental Impact' => 'truefalse'
];

$table = $tableMap[$category] ?? '`image-identity`';

$columnMap = [
    '`fill-in-the-blank`' => ['diff' => 'fbdiff', 'cat' => 'fbcat'],
    '`image-identity`' => ['diff' => 'imgdiff', 'cat' => 'imgcat'],
    '`matching-type`' => ['diff' => 'mtdiff', 'cat' => 'mtcat'],
    '`multiple-choice`' => ['diff' => 'multdifficulty', 'cat' => 'multcategory'],
    'truefalse' => ['diff' => 'tfdifficulty', 'cat' => 'tfcategory']
];

$difficultyColumn = $columnMap[$table]['diff'];
$categoryColumn = $columnMap[$table]['cat'];

$query = "SELECT * FROM $table WHERE $difficultyColumn = ? AND $categoryColumn = ? ORDER BY RAND() LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bind_param('ss', $difficulty, $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $question = $result->fetch_assoc();
    $question['type'] = str_replace('`', '', $table);
    $question['selected_difficulty'] = $difficulty; // Add this line
    echo json_encode($question);
} else {
    echo json_encode(['error' => 'No question found for the selected difficulty and category']);
}

$stmt->close();
$db->close();
?>
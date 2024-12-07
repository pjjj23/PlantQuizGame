<?php
session_start();

if (!isset($_SESSION['current_quiz']) || !isset($_SESSION['current_quiz']['difficulty']) || !isset($_SESSION['current_quiz']['category'])) {
    die("Error: Quiz settings not found. Please select a quiz first.");
}

$difficulty = $_SESSION['current_quiz']['difficulty'];
$quizType = $_SESSION['current_quiz']['category'];

// Map quiz types to database tables
$tableMap = [
    'Plant Identification' => '`image-identity`',
    'Plant Care' => '`multiple-choice`',
    'Plant Use' => '`matching-type`',
    'Plant Trivia' => '`fill-in-the-blank`',
    'Environmental Impact' => 'truefalse'
];

$table = $tableMap[$quizType] ?? '`image-identity`';

// Map tables to difficulty columns
$difficultyColumnMap = [
    '`fill-in-the-blank`' => 'fbdiff',
    '`image-identity`' => 'imgdiff',
    '`matching-type`' => 'mtdiff',
    '`multiple-choice`' => 'multdifficulty',
    'truefalse' => 'tfdifficulty'
];

// Map tables to category columns
$categoryColumnMap = [
    '`fill-in-the-blank`' => 'fbcat',
    '`image-identity`' => 'imgcat',
    '`matching-type`' => 'mtcat',
    '`multiple-choice`' => 'multcategory',
    'truefalse' => 'tfcategory'
];

$difficultyColumn = $difficultyColumnMap[$table] ?? 'imgdiff';
$categoryColumn = $categoryColumnMap[$table] ?? 'imgcat';

$_SESSION['current_quiz']['table'] = $table;
$_SESSION['current_quiz']['difficultyColumn'] = $difficultyColumn;
$_SESSION['current_quiz']['categoryColumn'] = $categoryColumn;

// For debugging purposes, you can print out the session data
// echo "<pre>"; print_r($_SESSION['current_quiz']); echo "</pre>";
$_SESSION['current_quiz'] = [
    'difficulty' => $difficulty,
    'category' => $quizType,
    'table' => $table,
    'difficultyColumn' => $difficultyColumn
];

echo "<pre>";
print_r($_SESSION['current_quiz']);
echo "</pre>";
// Include the HTML content from the second file here
include 'game.php';
?>
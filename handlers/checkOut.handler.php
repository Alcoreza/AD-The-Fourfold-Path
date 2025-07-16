<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once BOOTSTRAP_PATH;
require_once UTILS_PATH . 'checkOut.util.php';

header('Content-Type: application/json');

// Get the user ID from session
$userId = $_SESSION['user']['id'] ?? null;

// Check if user is logged in
if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

// Run the function
$response = completeOrderForUser($userId);

// Show the result
echo json_encode($response);
exit;
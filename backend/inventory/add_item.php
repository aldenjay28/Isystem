<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    if (!$name || !$category || !$quantity || !$price) {
        http_response_code(400);
        echo json_encode(['error' => 'All fields are required.']);
        exit;
    }

    $query = "INSERT INTO inventory (name, category, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: Unable to prepare statement.']);
        exit;
    }
    $stmt->bind_param('ssii', $name, $category, $quantity, $price);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item added successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to add item. Please try again.']);
    }
}

function logAction($userId, $action) {
    global $conn;
    $query = "INSERT INTO audit_logs (user_id, action) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $userId, $action);
    $stmt->execute();
}

// Example usage:
logAction($_SESSION['user_id'], 'Added new inventory item: ' . $name);

?>

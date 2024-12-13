<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if (!$name || !$email || !$phone) {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required.']);
    exit;
}

$query = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('sssi', $name, $email, $phone, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update profile.']);
}
?>

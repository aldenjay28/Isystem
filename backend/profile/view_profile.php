<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT name, email, phone, role, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $profile = $result->fetch_assoc();
    echo json_encode(['profile' => $profile]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Profile not found.']);
}
?>

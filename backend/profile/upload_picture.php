<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $user_id = $_SESSION['user_id'];
    $file = $_FILES['profile_picture'];
    $upload_dir = '../../uploads/';
    $filename = uniqid() . '_' . basename($file['name']);
    $target_file = $upload_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        $query = "UPDATE users SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $filename, $user_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Profile picture updated successfully.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Database error while updating profile picture.']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to upload profile picture.']);
    }
}
?>

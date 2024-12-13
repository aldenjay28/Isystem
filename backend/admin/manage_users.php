<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../frontend/login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all users except admins
    $query = "SELECT id, name, email, phone, role FROM users WHERE role != 'admin'";
    $result = $conn->query($query);
    $users = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    header('Content-Type: application/json');
    echo json_encode($users);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete a user
    $userId = $_GET['id'];
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    echo json_encode(['success' => $stmt->affected_rows > 0]);
}
?>

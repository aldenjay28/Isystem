<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../frontend/login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $itemId = $_GET['id'];
    $query = "DELETE FROM inventory WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $itemId);
    $stmt->execute();
    echo json_encode(['success' => $stmt->affected_rows > 0]);
}
?>

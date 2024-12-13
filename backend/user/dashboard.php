<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: ../../frontend/login.html');
    exit;
}

// Fetch user's activity log
$query = "SELECT * FROM inventory_logs WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$logs = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode(['logs' => $logs]);
?>

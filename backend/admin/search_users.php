<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

$search = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : '%';
$query = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $search, $search);
$stmt->execute();
$result = $stmt->get_result();

$users = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode(['users' => $users]);
?>

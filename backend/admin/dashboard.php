<?php
require_once '../db.php';
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../../frontend/user/dashboard.html');
    exit;
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../frontend/login.html');
    exit;
}

$response = [];

// Fetch inventory stats
$query = "SELECT COUNT(*) as total_items, SUM(quantity) as total_quantity FROM inventory";
$result = $conn->query($query);
if ($result && $row = $result->fetch_assoc()) {
    $response['inventory'] = $row;
}

// Fetch total users
$query = "SELECT COUNT(*) as total_users FROM users WHERE role = 'user'";
$result = $conn->query($query);
if ($result && $row = $result->fetch_assoc()) {
    $response['users'] = $row['total_users'];
}

// Fetch recent waste logs
$query = "SELECT * FROM waste_logs ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($query);
$response['recent_waste_logs'] = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

header('Content-Type: application/json');
echo json_encode($response);
?>

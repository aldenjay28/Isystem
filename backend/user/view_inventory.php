<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: ../../frontend/login.html');
    exit;
}

$query = "SELECT id, name, category, quantity, price FROM inventory";
$result = $conn->query($query);
$items = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

header('Content-Type: application/json');
echo json_encode($items);
?>

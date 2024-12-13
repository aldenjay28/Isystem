<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../frontend/login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "UPDATE inventory SET name = ?, category = ?, quantity = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssidi', $name, $category, $quantity, $price, $itemId);
    $stmt->execute();
    echo json_encode(['success' => $stmt->affected_rows > 0]);
}
?>

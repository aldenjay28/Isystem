<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

$search = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : '%';
$category = isset($_GET['category']) && $_GET['category'] !== 'all' ? $_GET['category'] : null;

$query = "SELECT * FROM inventory WHERE name LIKE ?";
if ($category) {
    $query .= " AND category = ?";
}

$stmt = $conn->prepare($query);
if ($category) {
    $stmt->bind_param('ss', $search, $category);
} else {
    $stmt->bind_param('s', $search);
}
$stmt->execute();
$result = $stmt->get_result();

$items = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode(['items' => $items]);
?>

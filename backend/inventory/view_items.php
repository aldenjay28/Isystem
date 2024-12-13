<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // Items per page
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM inventory LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
$items = $result->fetch_all(MYSQLI_ASSOC);

$query = "SELECT COUNT(*) AS total FROM inventory";
$totalResult = $conn->query($query)->fetch_assoc();
$totalPages = ceil($totalResult['total'] / $limit);

echo json_encode(['items' => $items, 'total_pages' => $totalPages]);
?>

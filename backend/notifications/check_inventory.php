<?php
include '../db.php';

$result = $conn->query("SELECT name FROM inventory WHERE quantity < 10");

$low_stock_items = [];
while ($row = $result->fetch_assoc()) {
    $low_stock_items[] = $row['name'];
}

if (count($low_stock_items) > 0) {
    echo json_encode([
        "success" => true,
        "message" => "Low stock alert for items: " . implode(", ", $low_stock_items)
    ]);
} else {
    echo json_encode(["success" => false, "message" => "All inventory levels are sufficient."]);
}
?>

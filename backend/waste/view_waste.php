<?php
include '../db.php';

$result = $conn->query("SELECT wl.id, i.name AS item_name, wl.quantity, wl.reason, wl.created_at
                        FROM waste_logs wl
                        JOIN inventory i ON wl.inventory_id = i.id");

$waste_logs = [];
while ($row = $result->fetch_assoc()) {
    $waste_logs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($waste_logs);
?>

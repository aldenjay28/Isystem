<?php
include '../db.php';

$inventory_count = $conn->query("SELECT COUNT(*) AS total_items FROM inventory")->fetch_assoc();
$waste_count = $conn->query("SELECT COUNT(*) AS total_waste FROM waste_logs")->fetch_assoc();
$pending_orders = $conn->query("SELECT COUNT(*) AS pending_orders FROM purchase_orders WHERE status='pending'")->fetch_assoc();

$report = [
    "inventory_count" => $inventory_count['total_items'],
    "waste_count" => $waste_count['total_waste'],
    "pending_orders" => $pending_orders['pending_orders']
];

header('Content-Type: application/json');
echo json_encode($report);
?>

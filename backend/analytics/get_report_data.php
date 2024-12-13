<?php
require_once '../db.php';

header('Content-Type: application/json');

try {
    $inventoryQuery = $conn->query("SELECT DATE_FORMAT(date, '%Y-%m-%d') AS label, SUM(quantity) AS value FROM inventory_log GROUP BY label");
    $wasteQuery = $conn->query("SELECT DATE_FORMAT(date, '%Y-%m-%d') AS label, SUM(waste_quantity) AS value FROM waste_log GROUP BY label");

    $inventoryData = $inventoryQuery->fetchAll(PDO::FETCH_ASSOC);
    $wasteData = $wasteQuery->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'inventory' => [
            'labels' => array_column($inventoryData, 'label'),
            'values' => array_column($inventoryData, 'value')
        ],
        'waste' => [
            'labels' => array_column($wasteData, 'label'),
            'values' => array_column($wasteData, 'value')
        ]
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

<?php
include '../db.php';

$result = $conn->query("SELECT name, SUM(quantity) AS total_used
                        FROM order_items
                        GROUP BY name");

$predictions = [];
while ($row = $result->fetch_assoc()) {
    $predictions[] = [
        "name" => $row['name'],
        "forecast" => ceil($row['total_used'] / 30) // Average daily usage
    ];
}

header('Content-Type: application/json');
echo json_encode($predictions);
?>

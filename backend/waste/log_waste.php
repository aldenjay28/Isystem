<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventory_id = $_POST['inventory_id'];
    $quantity = $_POST['quantity'];
    $reason = $_POST['reason'];

    $stmt = $conn->prepare("INSERT INTO waste_logs (inventory_id, quantity, reason) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $inventory_id, $quantity, $reason);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Waste logged successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
    $stmt->close();
}
?>

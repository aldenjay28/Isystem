<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO suppliers (name, contact, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $contact, $rating);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Supplier added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
    $stmt->close();
}
?>

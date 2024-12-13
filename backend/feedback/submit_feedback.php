<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO feedback (user_id, feedback) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $feedback);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Feedback submitted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
    $stmt->close();
}
?>

<?php
require '../vendor/autoload.php'; // Include PHPMailer
require '../db.php';

use PHPMailer\PHPMailer\PHPMailer;

$lowInventoryItems = $conn->query("SELECT name FROM inventory WHERE quantity < reorder_level")->fetchAll(PDO::FETCH_ASSOC);

if ($lowInventoryItems) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'youremail@example.com';
    $mail->Password = 'yourpassword';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('youremail@example.com', 'Inventory System');
    $mail->addAddress('admin@example.com', 'Admin');
    $mail->Subject = 'Low Inventory Alert';
    $mail->Body = "The following items have low inventory:\n" . implode("\n", array_column($lowInventoryItems, 'name'));

    if ($mail->send()) {
        echo "Notification sent.";
    } else {
        echo "Failed to send notification.";
    }
}
?>

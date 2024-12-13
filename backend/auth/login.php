<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, role, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $role, $hash);
    $stmt->fetch();

    if ($hash && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = $role;

        echo json_encode(["success" => true, "role" => $role]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials."]);
    }
    $stmt->close();
}
?>

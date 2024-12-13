<?php

require '../auth/role_check.php';
checkAdmin();

function checkRole($requiredRole) {
    if ($_SESSION['role'] !== $requiredRole) {
        header('Location: ../auth/unauthorized.php');
        exit;
    }
}

function checkAdmin() {
    session_start();
    if ($_SESSION['role'] !== 'admin') {
        header('Location: ../../frontend/user/dashboard.html');
        exit;
    }
}

?>

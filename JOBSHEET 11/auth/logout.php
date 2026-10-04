<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("
        UPDATE users
        SET remember_token = NULL,
            remember_expires = NULL
        WHERE id = :id
    ");

    $stmt->execute([
        ':id' => $_SESSION['user_id']
    ]);
}

setcookie('remember_token', '', time() - 3600, '/');

session_destroy();

header('Location: login.php');
exit;

session_destroy();
header('Location: login.php');
exit;
<?php
// Guard clause: di-include di baris paling atas setiap halaman yang
// membutuhkan login (sebelum header.php mengeluarkan output apa pun),
// agar header('Location: ...') masih bisa dipanggil.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {

    $token = hash('sha256', $_COOKIE['remember_token']);

    $stmt = $pdo->prepare("
        SELECT id, nama, username, role
        FROM users
        WHERE remember_token = :token
        AND remember_expires > NOW()
        LIMIT 1
    ");

    $stmt->execute([
        ':token' => $token
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];
    }
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
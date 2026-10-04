<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if ($_SESSION['login_attempts'] >= 3) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Terlalu banyak percobaan login gagal. Silakan coba lagi nanti.'
    ];

    header('Location: login.php');
    exit;
}

require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Regenerasi session ID setelah login berhasil untuk mencegah session fixation.
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    if (isset($_POST['remember'])) {
    $token = bin2hex(random_bytes(32));

    $expires = date('Y-m-d H:i:s', time() + (30 * 24 * 60 * 60));

    $stmt = $pdo->prepare("
        UPDATE users
        SET remember_token = :token,
            remember_expires = :expires
        WHERE id = :id
    ");

    $stmt->execute([
        ':token' => hash('sha256', $token),
        ':expires' => $expires,
        ':id' => $user['id']
    ]);

    setcookie(
        'remember_token',
        $token,
        time() + (30 * 24 * 60 * 60),
        '/',
        '',
        false,
        true
    );
}

    header('Location: ../index.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau password salah.'];
header('Location: login.php');
exit;
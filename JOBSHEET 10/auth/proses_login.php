
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE username = :username"
);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    if (isset($_POST['remember_me'])) {
        $token = bin2hex(random_bytes(32));

        $stmt = $pdo->prepare(
            "UPDATE users SET remember_token = :token WHERE id = :id"
        );
        $stmt->execute([
            'token' => hash('sha256', $token),
            'id' => $user['id']
        ]);

        setcookie('remember_token', $token, [
            'expires' => time() + (30 * 24 * 60 * 60),
            'path' => '/',
            'httponly' => true,
            'secure' => !empty($_SERVER['HTTPS'])
                && $_SERVER['HTTPS'] !== 'off',
            'samesite' => 'Lax'
        ]);
    }

    header('Location: ../index.php');
    exit;
}

$_SESSION['flash'] = [
    'type' => 'error',
    'pesan' => 'Username atau password salah.'
];

header('Location: login.php');
exit;

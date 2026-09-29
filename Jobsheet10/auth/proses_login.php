<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// Menyiapkan penghitung percobaan login
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = [];
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


// ===============================
// LOGIN BERHASIL
// ===============================
if ($user && password_verify($password, $user['password'])) {

    // Reset jumlah percobaan jika login berhasil
    $_SESSION['login_attempts'][$username] = 0;

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    // ===============================
    // INGAT SAYA
    // ===============================
    if (isset($_POST['remember'])) {
        setcookie(
            'remember_user',
            $user['id'],
            time() + (60 * 60 * 24 * 30),
            '/',
            '',
            false,
            true
        );
    }

    header('Location: ../index.php');
    exit;
}


// ===============================
// LOGIN GAGAL
// ===============================

if (!isset($_SESSION['login_attempts'][$username])) {
    $_SESSION['login_attempts'][$username] = 0;
}

// Tambah jumlah percobaan gagal
$_SESSION['login_attempts'][$username]++;

$attempts = $_SESSION['login_attempts'][$username];


// Tampilkan peringatan setelah 3 kali gagal
if ($attempts >= 3) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => "Login gagal $attempts kali. Silakan periksa kembali username dan password Anda."
    ];

} else {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => "Username atau password salah. Percobaan ke-$attempts."
    ];
}

header('Location: login.php');
exit;
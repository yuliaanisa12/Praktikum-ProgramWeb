<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika belum login, langsung arahkan ke login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Silakan login terlebih dahulu.'
    ];

    header('Location: /auth/login.php');
    exit;
}
<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/csrf.php';

$requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ($requestMethod !== 'POST') {
    header('Location: list.php');
    exit;
}

// Periksa token CSRF
csrf_verify();

// Ambil ID anggota
$id = $_POST['id'] ?? null;

// Jika ID kosong
if (!$id) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID anggota tidak ditemukan.'
    ];

    header('Location: list.php');
    exit;
}

// Hapus anggota
$stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
$stmt->execute([
    ':id' => $id
]);

// Pesan berhasil
$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil dihapus.'
];

header('Location: list.php');
exit;

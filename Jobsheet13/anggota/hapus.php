<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

// Hanya admin yang boleh menghapus anggota
if (($_SESSION['role'] ?? '') !== 'admin') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akses ditolak. Hanya admin yang dapat menghapus anggota.'
    ];

    header('Location: list.php');
    exit;
}

// Hanya menerima method POST
$method = $_SERVER['REQUEST_METHOD'] ?? '';

if ($method !== 'POST') {
    header('Location: list.php');
    exit;
}

// Periksa CSRF token
csrf_verify();

// Ambil ID dari POST
$id = $_POST['id'] ?? null;

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
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil dihapus.'
];

header('Location: list.php');
exit;
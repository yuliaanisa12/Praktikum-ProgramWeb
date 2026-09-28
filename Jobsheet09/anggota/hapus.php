<?php

session_start();

require __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_POST['id'] ?? 0);

if ($id > 0) {

    $stmt = $pdo->prepare("
        DELETE FROM public.anggota
        WHERE id = :id
    ");

    $stmt->execute([
        'id' => $id
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Anggota berhasil dihapus.'
    ];
}

header('Location: list.php');
exit;
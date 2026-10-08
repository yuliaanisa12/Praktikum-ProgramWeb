<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';


// Hanya menerima POST
$method = $_SERVER['REQUEST_METHOD'] ?? '';

if ($method !== 'POST') {

    header('Location: kembali.php');

    exit;
}


// Periksa CSRF
csrf_verify();


// Ambil ID
$id = $_POST['id'] ?? null;


if (!$id) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID peminjaman tidak ditemukan.'
    ];

    header('Location: kembali.php');

    exit;
}


try {

    $pdo->beginTransaction();


    // Ambil data peminjaman
    $stmt = $pdo->prepare(
        "SELECT buku_id, status
         FROM peminjaman
         WHERE id = :id
         FOR UPDATE"
    );

    $stmt->execute([
        'id' => $id
    ]);

    $trx = $stmt->fetch(PDO::FETCH_ASSOC);


    // Validasi
    if (
        !$trx ||
        $trx['status'] !== 'dipinjam'
    ) {

        throw new Exception(
            'Transaksi tidak ditemukan atau buku sudah dikembalikan.'
        );
    }


    // Ubah status peminjaman
    $updatePeminjaman = $pdo->prepare(
        "UPDATE peminjaman
         SET status = 'dikembalikan',
             tanggal_kembali = CURRENT_DATE
         WHERE id = :id"
    );

    $updatePeminjaman->execute([
        'id' => $id
    ]);


    // Tambahkan stok buku
    $updateBuku = $pdo->prepare(
        "UPDATE buku
         SET stok = stok + 1
         WHERE id = :buku_id"
    );

    $updateBuku->execute([
        'buku_id' => $trx['buku_id']
    ]);


    // Simpan
    $pdo->commit();


    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Buku berhasil dikembalikan.'
    ];


} catch (Exception $e) {

    if ($pdo->inTransaction()) {

        $pdo->rollBack();
    }


    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Gagal memproses pengembalian: ' .
                   $e->getMessage()
    ];
}


header('Location: kembali.php');

exit;
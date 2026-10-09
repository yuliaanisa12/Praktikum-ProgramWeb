<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';


// Hanya menerima POST
$method = $_SERVER['REQUEST_METHOD'] ?? '';

if ($method !== 'POST') {

    header('Location: tambah.php');

    exit;
}


// Periksa CSRF
csrf_verify();


// Ambil data dari form
$anggota_id = $_POST['anggota_id'] ?? null;
$buku_id = $_POST['buku_id'] ?? null;


// Validasi
if (!$anggota_id || !$buku_id) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Anggota dan buku harus dipilih.'
    ];

    header('Location: tambah.php');

    exit;
}


try {

    // Mulai transaksi
    $pdo->beginTransaction();


    // Cek buku dan kunci baris
    $stmtBuku = $pdo->prepare(
        "SELECT id, stok
         FROM buku
         WHERE id = :id
         FOR UPDATE"
    );

    $stmtBuku->execute([
        'id' => $buku_id
    ]);

    $dataBuku = $stmtBuku->fetch(PDO::FETCH_ASSOC);


    // Buku tidak ditemukan
    if (!$dataBuku) {

        throw new Exception(
            'Buku tidak ditemukan.'
        );
    }


    // Stok habis
    if ((int) $dataBuku['stok'] <= 0) {

        throw new Exception(
            'Stok buku sudah habis.'
        );
    }


    // Cek anggota
    $stmtAnggota = $pdo->prepare(
        "SELECT id
         FROM anggota
         WHERE id = :id"
    );

    $stmtAnggota->execute([
        'id' => $anggota_id
    ]);

    $dataAnggota = $stmtAnggota->fetch(PDO::FETCH_ASSOC);


    if (!$dataAnggota) {

        throw new Exception(
            'Anggota tidak ditemukan.'
        );
    }

    // Cek apakah anggota memiliki peminjaman
    // yang terlambat lebih dari 14 hari
    $stmtTerlambat = $pdo->prepare(
        "SELECT id, tanggal_jatuh_tempo,
                CURRENT_DATE - tanggal_jatuh_tempo AS hari_terlambat
         FROM peminjaman
         WHERE anggota_id = :anggota_id
           AND status = 'dipinjam'
           AND tanggal_kembali IS NULL
           AND CURRENT_DATE - tanggal_jatuh_tempo > 14
         LIMIT 1"
    );

    $stmtTerlambat->execute([
        'anggota_id' => $anggota_id
    ]);

    $dataTerlambat = $stmtTerlambat->fetch(PDO::FETCH_ASSOC);

    // Jika anggota terlambat, tolak peminjaman baru
    if ($dataTerlambat) {
        throw new Exception(
            'Peminjaman ditolak. Anggota memiliki buku yang terlambat lebih dari 14 hari.'
        );
    }

    // Tanggal jatuh tempo
    // 7 hari dari tanggal peminjaman
    $tanggalJatuhTempo = date(
        'Y-m-d',
        strtotime('+7 days')
    );


    // Simpan peminjaman
    $stmtPinjam = $pdo->prepare(
        "INSERT INTO peminjaman
        (
            anggota_id,
            buku_id,
            tanggal_pinjam,
            tanggal_jatuh_tempo,
            status
        )
        VALUES
        (
            :anggota_id,
            :buku_id,
            CURRENT_DATE,
            :tanggal_jatuh_tempo,
            'dipinjam'
        )"
    );

    $stmtPinjam->execute([
        'anggota_id' => $anggota_id,
        'buku_id' => $buku_id,
        'tanggal_jatuh_tempo' => $tanggalJatuhTempo
    ]);


    // Kurangi stok buku
    $stmtUpdateBuku = $pdo->prepare(
        "UPDATE buku
         SET stok = stok - 1
         WHERE id = :id"
    );

    $stmtUpdateBuku->execute([
        'id' => $buku_id
    ]);


    // Simpan transaksi
    $pdo->commit();


    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Peminjaman berhasil disimpan.'
    ];


    header('Location: riwayat.php');

    exit;


} catch (Exception $e) {

    // Batalkan transaksi
    if ($pdo->inTransaction()) {

        $pdo->rollBack();
    }


    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Gagal menyimpan peminjaman: ' .
                   $e->getMessage()
    ];


    header('Location: tambah.php');

    exit;
}
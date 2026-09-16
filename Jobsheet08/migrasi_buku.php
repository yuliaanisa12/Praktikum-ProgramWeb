<?php

require_once __DIR__ . '/includes/koneksi.php';

// lokasi file JSON dari Jobsheet 06
$file = __DIR__ . '/../Jobsheet06/data/buku.json';

// membaca file JSON
$json = file_get_contents($file);

if ($json === false) {
    die("File buku.json tidak ditemukan.");
}

// mengubah JSON menjadi array PHP
$data = json_decode($json, true);

if ($data === null) {
    die("Data JSON gagal dibaca.");
}

// query untuk memasukkan data
$sql = "
    INSERT INTO buku (judul, pengarang, tahun, stok)
    VALUES (:judul, :pengarang, :tahun, :stok)
";

$stmt = $pdo->prepare($sql);

// memasukkan semua data JSON ke database
foreach ($data as $buku) {
    $stmt->execute([
        ':judul' => $buku['judul'],
        ':pengarang' => $buku['pengarang'],
        ':tahun' => $buku['tahun'],
        ':stok' => $buku['stok']
    ]);
}

echo "Migrasi data buku berhasil.";
?>
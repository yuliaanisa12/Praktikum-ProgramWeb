<?php

require __DIR__ . '/includes/koneksi.php';

echo "<h2>CEK DATABASE PHP</h2>";

echo "Database: ";
echo $pdo->query("SELECT current_database()")->fetchColumn();

echo "<br><br>";

echo "Schema: ";
echo $pdo->query("SELECT current_schema()")->fetchColumn();

echo "<br><br>";

echo "Jumlah buku: ";
echo $pdo->query("SELECT COUNT(*) FROM public.buku")->fetchColumn();

echo "<h3>Data Buku:</h3>";

$data = $pdo->query("
    SELECT id, judul, pengarang, tahun, isbn, stok, kategori
    FROM public.buku
    ORDER BY id
")->fetchAll();

echo "<pre>";
print_r($data);
echo "</pre>";
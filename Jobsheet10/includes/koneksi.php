<?php

$host = "localhost";
$port = "5432";
$db   = "simpus_mini";
$user = "postgres";
$pass = "123456";

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("KONEKSI DATABASE GAGAL: " . $e->getMessage());
}
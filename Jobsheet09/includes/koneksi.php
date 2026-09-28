<?php

$host = "127.0.0.1";
$port = "5432";
$db   = "simpus_mini";
$user = "postgres";
$pass = "123456";

try {

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {

    die("KONEKSI GAGAL: " . $e->getMessage());

}
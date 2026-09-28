<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($page_title ?? 'SIMPUS-Mini'); ?>
    </title>

    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>

<header>

    <h1>SIMPUS-Mini</h1>

    <nav>

        <a href="/index.php">Beranda</a>

        <a href="/buku/list.php">Daftar Buku</a>

        <a href="/buku/tambah.php">Tambah Buku</a>

        <a href="/anggota/list.php">Daftar Anggota</a>

        <a href="/anggota/tambah.php">Tambah Anggota</a>

    </nav>

</header>

<main>
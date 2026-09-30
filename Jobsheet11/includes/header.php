<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';

$sudahLogin = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php
        echo isset($page_title)
            ? e($page_title)
            : 'SIMPUS-Mini';
        ?>
    </title>

    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>

<header>

    <h1>SIMPUS-Mini</h1>

    <nav>

        <a href="/index.php">
            Beranda
        </a>

        <a href="/buku/list.php">
            Daftar Buku
        </a>

        <?php if ($sudahLogin): ?>

            <a href="/anggota/list.php">
                Daftar Anggota
            </a>

        <?php endif; ?>

    </nav>

    <div class="auth-status">

        <?php if ($sudahLogin): ?>

            <span>
                Petugas:
                <?php echo e($_SESSION['nama'] ?? ''); ?>
            </span>

            <a href="/auth/logout.php">
                Logout
            </a>

        <?php else: ?>

            <a href="/auth/login.php">
                Login
            </a>

        <?php endif; ?>

    </div>

</header>

<main>
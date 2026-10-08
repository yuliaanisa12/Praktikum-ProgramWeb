<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';

/*
|--------------------------------------------------------------------------
| Data Session
|--------------------------------------------------------------------------
*/

$userId = $_SESSION['user_id'] ?? null;
$namaUser = $_SESSION['nama'] ?? 'User';

$sudahLogin = !empty($userId);


/*
|--------------------------------------------------------------------------
| Menentukan Base Path
|--------------------------------------------------------------------------
*/

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

if (
    strpos($scriptName, '/buku/') !== false ||
    strpos($scriptName, '/anggota/') !== false ||
    strpos($scriptName, '/peminjaman/') !== false ||
    strpos($scriptName, '/auth/') !== false
) {
    $base = '../';
} else {
    $base = '';
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        SIMPUS-Mini
        <?php
        if (isset($page_title)) {
            echo ' | ' . e($page_title);
        }
        ?>
    </title>

    <link
        rel="stylesheet"
        href="<?php echo $base; ?>assets/css/style.css"
    >

</head>

<body>

<header>

    <h1>SIMPUS-Mini</h1>

    <button
        type="button"
        id="nav-toggle-btn"
        class="nav-toggle-label"
        aria-label="Menu"
    >
        &#9776;
    </button>

    <nav>

        <ul>

            <li>
                <a href="<?php echo $base; ?>index.php">
                    Beranda
                </a>
            </li>

            <li>
                <a href="<?php echo $base; ?>buku/list.php">
                    Daftar Buku
                </a>
            </li>

            <?php if ($sudahLogin): ?>

                <li>
                    <a href="<?php echo $base; ?>buku/tambah.php">
                        Tambah Buku
                    </a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>anggota/list.php">
                        Daftar Anggota
                    </a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>anggota/tambah.php">
                        Tambah Anggota
                    </a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>peminjaman/tambah.php">
                        Peminjaman Baru
                    </a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>peminjaman/kembali.php">
                        Pengembalian
                    </a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>peminjaman/riwayat.php">
                        Riwayat
                    </a>
                </li>

            <?php endif; ?>

        </ul>

    </nav>

    <div class="auth-status">

        <?php if ($sudahLogin): ?>

            <span>
                <?php echo e($namaUser); ?>
            </span>

            <a href="<?php echo $base; ?>auth/logout.php">
                Logout
            </a>

        <?php else: ?>

            <a href="<?php echo $base; ?>auth/login.php">
                Login
            </a>

        <?php endif; ?>

    </div>

</header>

<main>
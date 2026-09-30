<?php

$page_title = "Beranda";

include __DIR__ . '/includes/header.php';

require __DIR__ . '/includes/koneksi.php';


/* ========================================
   MENGAMBIL DATA DARI DATABASE
======================================== */

$totalBuku = $pdo->query(
    "SELECT COUNT(*) FROM buku"
)->fetchColumn();

$totalAnggota = $pdo->query(
    "SELECT COUNT(*) FROM anggota"
)->fetchColumn();


/*
   Untuk sementara jumlah peminjaman
   masih 0 karena tabel peminjaman
   belum digunakan di halaman ini.
*/
$sedangDipinjam = 0;

?>

<!-- ======================================
     SELAMAT DATANG
======================================= -->

<section class="dashboard-card">

    <h2>
        Selamat Datang di Sistem Perpustakaan Mini
    </h2>

    <p>
        Aplikasi sederhana untuk mengelola data buku
        dan anggota perpustakaan.
    </p>

</section>


<!-- ======================================
     RINGKASAN
======================================= -->

<section class="summary">

    <h2>
        Ringkasan
    </h2>


    <div class="summary-stats">


        <!-- TOTAL BUKU -->

        <div class="stat-card">

            <h3>
                Total Buku
            </h3>

            <div class="stat-number">
                <?php echo $totalBuku; ?>
            </div>

        </div>


        <!-- TOTAL ANGGOTA -->

        <div class="stat-card">

            <h3>
                Total Anggota
            </h3>

            <div class="stat-number">
                <?php echo $totalAnggota; ?>
            </div>

        </div>


        <!-- SEDANG DIPINJAM -->

        <div class="stat-card">

            <h3>
                Sedang Dipinjam
            </h3>

            <div class="stat-number">
                <?php echo $sedangDipinjam; ?>
            </div>

        </div>


    </div>

</section>


<?php

include __DIR__ . '/includes/footer.php';

?>
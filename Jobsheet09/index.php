<?php

$page_title = "Beranda";

require __DIR__ . '/includes/koneksi.php';

$totalBuku = $pdo->query(
    "SELECT COUNT(*) FROM public.buku"
)->fetchColumn();

$totalAnggota = $pdo->query(
    "SELECT COUNT(*) FROM public.anggota"
)->fetchColumn();

include __DIR__ . '/includes/header.php';

?>

<section>

    <h2>Beranda</h2>

    <p>
        Selamat datang di SIMPUS-Mini.
    </p>

    <div class="stats">

        <div class="stat-card">

            <h3>
                <?= $totalBuku; ?>
            </h3>

            <p>Total Buku</p>

        </div>

        <div class="stat-card">

            <h3>
                <?= $totalAnggota; ?>
            </h3>

            <p>Total Anggota</p>

        </div>

    </div>

</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
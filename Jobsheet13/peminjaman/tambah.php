<?php

$page_title = "Peminjaman Buku Baru";

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';


// Ambil data anggota
$stmtAnggota = $pdo->query(
    "SELECT id, nama
     FROM anggota
     ORDER BY nama ASC"
);

$anggota = $stmtAnggota->fetchAll(PDO::FETCH_ASSOC);


// Ambil buku yang stoknya masih tersedia
$stmtBuku = $pdo->query(
    "SELECT id, judul, stok
     FROM buku
     WHERE stok > 0
     ORDER BY judul ASC"
);

$buku = $stmtBuku->fetchAll(PDO::FETCH_ASSOC);


include __DIR__ . '/../includes/header.php';

?>

<section class="peminjaman-card">

    <h2>
        Peminjaman Buku Baru
    </h2>


    <form
        method="POST"
        action="proses_tambah.php"
    >

        <?php echo csrf_field(); ?>


        <!-- ANGGOTA -->

        <p>

            <label for="anggota_id">
                Anggota
            </label>

            <select
                name="anggota_id"
                id="anggota_id"
                required
            >

                <option value="">
                    -- Pilih Anggota --
                </option>

                <?php foreach ($anggota as $a): ?>

                    <option value="<?php echo $a['id']; ?>">

                        <?php echo e($a['nama']); ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </p>


        <!-- BUKU -->

        <p>

            <label for="buku_id">
                Buku (hanya yang stoknya tersedia)
            </label>

            <select
                name="buku_id"
                id="buku_id"
                required
            >

                <option value="">
                    -- Pilih Buku --
                </option>

                <?php foreach ($buku as $b): ?>

                    <option value="<?php echo $b['id']; ?>">

                        <?php echo e($b['judul']); ?>

                        - Stok:
                        <?php echo $b['stok']; ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </p>


        <!-- TOMBOL -->

        <p>

            <button type="submit">
                Simpan Peminjaman
            </button>

        </p>

    </form>

</section>


<?php

include __DIR__ . '/../includes/footer.php';

?>
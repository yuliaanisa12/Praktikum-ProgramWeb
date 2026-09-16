<?php
$page_title = "Daftar Buku";

require_once __DIR__ . '/../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// mengambil kata kunci pencarian
$keyword = $_GET['keyword'] ?? '';

// mengambil data buku dari database
$stmt = $pdo->prepare("
    SELECT *
    FROM buku
    WHERE judul ILIKE :keyword
    ORDER BY id DESC
");

$stmt->execute([
    ':keyword' => '%' . $keyword . '%'
]);

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h2>Daftar Buku</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>">
            <?php echo htmlspecialchars($flash['pesan']); ?>
        </p>
    <?php endif; ?>

    <!-- Pencarian buku -->
    <div class="search-box">
        <form method="get">
            <label for="search-input">Cari Judul Buku</label>

            <input
                type="text"
                id="search-input"
                name="keyword"
                placeholder="Ketik judul buku..."
                value="<?php echo htmlspecialchars($keyword); ?>"
            >

            <button type="submit">Cari</button>
        </form>
    </div>

    <!-- Tabel buku -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                    <th>Tanggal Ditambahkan</th>
                </tr>
            </thead>

            <tbody>

                <?php if (empty($daftarBuku)): ?>

                    <tr>
                        <td colspan="6">
                            <?php if ($keyword): ?>
                                Buku dengan judul
                                "<strong><?php echo htmlspecialchars($keyword); ?></strong>"
                                tidak ditemukan.
                            <?php else: ?>
                                Belum ada data buku.
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarBuku as $buku): ?>

                        <tr>
                            <td>
                                <?php echo htmlspecialchars($buku['judul']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($buku['pengarang']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($buku['tahun']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($buku['stok']); ?>
                            </td>

                            <td>
                                <button type="button">Edit</button>
                                <button type="button" class="btn-hapus">
                                    Hapus
                                </button>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($buku['tanggal_ditambahkan']); ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>
        </table>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
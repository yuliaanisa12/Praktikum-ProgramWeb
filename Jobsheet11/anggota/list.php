<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/csrf.php';

$page_title = "Daftar Anggota";

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare(
        "SELECT COUNT(*) FROM anggota WHERE nama ILIKE :kw"
    );

    $hitung->execute([
        'kw' => '%' . $keyword . '%'
    ]);

    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare(
        "SELECT * FROM anggota
         WHERE nama ILIKE :kw
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue('kw', '%' . $keyword . '%');

} else {
    $totalRows = $pdo
        ->query("SELECT COUNT(*) FROM anggota")
        ->fetchColumn();

    $stmt = $pdo->prepare(
        "SELECT * FROM anggota
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );
}

$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));

include __DIR__ . '/../includes/header.php';
?>
<section>

    <h2>Daftar Anggota</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo e($flash['type']); ?>">
            <?php echo e($flash['pesan']); ?>
        </p>
    <?php endif; ?>

    <p>
        <a href="tambah.php">+ Tambah Anggota</a>
    </p>

    <div class="search-box">
        <form method="get">
            <input
                type="text"
                name="q"
                placeholder="Cari nama anggota..."
                value="<?php echo e($keyword); ?>"
            >

            <button type="submit">
                Cari
            </button>
        </form>
    </div>

    <div class="table-responsive">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. Anggota</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (empty($daftarAnggota)): ?>

                    <tr>
                        <td colspan="6">
                            Belum ada data anggota.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarAnggota as $index => $row): ?>

                        <tr>

                            <td>
                                <?php echo $offset + $index + 1; ?>
                            </td>

                            <td>
                                <?php echo e($row['nama']); ?>
                            </td>

                            <td>
                                <?php echo e($row['no_anggota']); ?>
                            </td>

                            <td>
                                <?php echo e($row['alamat']); ?>
                            </td>

                            <td>
                                <?php echo e($row['no_hp']); ?>
                            </td>

                            <td>

                                <a href="edit.php?id=<?php echo (int) $row['id']; ?>">
                                    Edit
                                </a>

                                <form
                                    action="hapus.php"
                                    method="post"
                                    class="form-hapus"
                                    style="display:inline;"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?php echo (int) $row['id']; ?>"
                                    >

                                    <?php echo csrf_field(); ?>

                                    <button type="submit">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <?php if ($totalPages > 1): ?>

        <div class="pagination">

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                <a
                    href="?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                    class="<?php echo $i === $page ? 'active' : ''; ?>"
                >
                    <?php echo $i; ?>
                </a>

            <?php endfor; ?>

        </div>

    <?php endif; ?>

</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
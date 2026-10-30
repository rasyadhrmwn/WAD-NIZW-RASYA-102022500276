<?php
require 'koneksi.php';

$successMessage = $_GET['success'] ?? '';
$sql = "SELECT id, kode, nama, rumpun, kata_kunci, deskripsi FROM topik ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
$topikList = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $topikList[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Topik & Bidang Minat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Sistem Tugas Akhir & Skripsi</h1>
        <p>Studi Kasus 11 - Modul Topik & Bidang Minat</p>
    </header>

    <nav>
        <a href="index.php">Topik & Bidang Minat</a>
        <a href="tambah-topik.php">Tambah Topik</a>
    </nav>

    <main>
        <div class="header-action">
            <h2>Topik & Bidang Minat</h2>
            <a href="tambah-topik.php" class="btn btn-primary">+ Tambah Topik</a>
        </div>

        <?php if ($successMessage !== ''): ?>
            <p style="color: green; font-weight: bold;">
                <?php echo htmlspecialchars($successMessage); ?>
            </p>
        <?php endif; ?>

        <table>
            <tr>
                <th>Kode</th>
                <th>Nama Topik</th>
                <th>Rumpun Ilmu</th>
                <th>Kata Kunci</th>
                <th>Deskripsi Fokus</th>
                <th>Aksi</th>
            </tr>

            <?php if (empty($topikList)): ?>
                <tr>
                    <td colspan="6">Belum ada data topik.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($topikList as $topik): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($topik['kode']); ?></td>
                        <td><?php echo htmlspecialchars($topik['nama']); ?></td>
                        <td><?php echo htmlspecialchars($topik['rumpun']); ?></td>
                        <td><?php echo htmlspecialchars($topik['kata_kunci']); ?></td>
                        <td><?php echo htmlspecialchars($topik['deskripsi']); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="edit-topik.php?id=<?php echo (int) $topik['id']; ?>" class="action-btn action-edit">Edit</a>
                                <a href="hapus-topik.php?id=<?php echo (int) $topik['id']; ?>" class="action-btn action-delete" onclick="return confirm('Yakin ingin menghapus topik ini?');">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <h2>Rumpun Ilmu / Bidang Minat</h2>
        <ul>
            <li>Sistem Informasi</li>
            <li>Kecerdasan Buatan</li>
            <li>Rekayasa Perangkat Lunak</li>
            <li>Jaringan & Keamanan</li>
            <li>Data Science</li>
        </ul>

    </main>

    <footer>
        <h3>Identitas Mahasiswa</h3>
        <p>Nama: Mohamad Rasya Dharmawan</p>
        <p>NIM: 10202250026</p>
        <p>Kelas: SI4907</p>
        <p>Kelompok: 11</p>
        <p>Modul Topik & Bidang Minat</p>
    </footer>

</body>
</html>

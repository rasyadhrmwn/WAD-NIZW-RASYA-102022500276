<?php
require 'koneksi.php';

$errorMessage = $_GET['error'] ?? '';
$nama = '';
$rumpun = '';
$kataKunci = '';
$deskripsi = '';

function generateTopikCode($conn)
{
    $result = mysqli_query($conn, "SELECT kode FROM topik ORDER BY id DESC LIMIT 1");
    $kodeTerakhir = 'TP-000';

    if ($row = mysqli_fetch_assoc($result)) {
        $kodeTerakhir = $row['kode'];
    }

    $nomor = (int) substr($kodeTerakhir, 3) + 1;
    return 'TP-' . str_pad((string) $nomor, 3, '0', STR_PAD_LEFT);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Topik</title>
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
        <h2>Tambah Topik & Bidang Minat</h2>

        <?php if ($errorMessage !== ''): ?>
            <p style="color: red; font-weight: bold;">
                <?php echo htmlspecialchars($errorMessage); ?>
            </p>
        <?php endif; ?>

        <form action="simpan-topik.php" method="post" class="form-card">
            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Topik</label>
                    <input class="form-control" type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
                </div>

                <div class="form-group">
                    <label for="rumpun">Rumpun Ilmu</label>
                    <select class="form-control" id="rumpun" name="rumpun">
                        <option value="">-- Pilih Rumpun Ilmu --</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Kecerdasan Buatan">Kecerdasan Buatan</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        <option value="Jaringan & Keamanan">Jaringan & Keamanan</option>
                        <option value="Data Science">Data Science</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kata_kunci">Kata Kunci</label>
                    <input class="form-control" type="text" id="kata_kunci" name="kata_kunci" value="<?php echo htmlspecialchars($kataKunci); ?>">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Fokus</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($deskripsi); ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
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

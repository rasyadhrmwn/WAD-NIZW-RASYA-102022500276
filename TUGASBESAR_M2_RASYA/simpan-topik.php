<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

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

$nama = trim($_POST['nama'] ?? '');
$rumpun = trim($_POST['rumpun'] ?? '');
$kataKunci = trim($_POST['kata_kunci'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');

if ($nama === '' || $rumpun === '' || $kataKunci === '' || $deskripsi === '') {
    header('Location: tambah-topik.php?error=' . urlencode('Semua field wajib diisi.'));
    exit;
}

$kodeBaru = generateTopikCode($conn);
$stmt = mysqli_prepare($conn, 'INSERT INTO topik (kode, nama, rumpun, kata_kunci, deskripsi) VALUES (?, ?, ?, ?, ?)');

if (!$stmt) {
    header('Location: tambah-topik.php?error=' . urlencode('Gagal menyiapkan query: ' . mysqli_error($conn)));
    exit;
}

mysqli_stmt_bind_param($stmt, 'sssss', $kodeBaru, $nama, $rumpun, $kataKunci, $deskripsi);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: index.php?success=' . urlencode('Topik berhasil ditambahkan.'));
    exit;
}

mysqli_stmt_close($stmt);
header('Location: tambah-topik.php?error=' . urlencode('Gagal menyimpan topik: ' . mysqli_error($conn)));
exit;

<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$editId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nama = trim($_POST['nama'] ?? '');
$rumpun = trim($_POST['rumpun'] ?? '');
$kataKunci = trim($_POST['kata_kunci'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');

if ($editId <= 0 || $nama === '' || $rumpun === '' || $kataKunci === '' || $deskripsi === '') {
    header('Location: edit-topik.php?id=' . $editId . '&error=' . urlencode('Semua field wajib diisi.'));
    exit;
}

$query = "UPDATE topik SET nama = ?, rumpun = ?, kata_kunci = ?, deskripsi = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    header('Location: edit-topik.php?id=' . $editId . '&error=' . urlencode('Gagal menyiapkan query: ' . mysqli_error($conn)));
    exit;
}

mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $rumpun, $kataKunci, $deskripsi, $editId);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: index.php?success=' . urlencode('Topik berhasil diperbarui.'));
    exit;
}

mysqli_stmt_close($stmt);
header('Location: edit-topik.php?id=' . $editId . '&error=' . urlencode('Gagal memperbarui topik: ' . mysqli_error($conn)));
exit;

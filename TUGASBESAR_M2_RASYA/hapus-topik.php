<?php
require 'koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$deleteId = (int) $_GET['id'];
$stmt = mysqli_prepare($conn, 'DELETE FROM topik WHERE id = ?');

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $deleteId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header('Location: index.php?success=' . urlencode('Topik berhasil dihapus.'));
exit;
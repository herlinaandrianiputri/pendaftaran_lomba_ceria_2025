<?php
include 'koneksi.php';

// Pastikan parameter id ada
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int)$_GET['id'];

// Hapus data berdasarkan ID
$conn->query("DELETE FROM pendaftaran WHERE id_pendaftaran=$id");

// Redirect ke index.php dengan pesan sukses
header("Location: index.php?msg=Kontak+berhasil+dihapus");
exit;
?>

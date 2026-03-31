<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID peserta tidak ditemukan");
}

$id = intval($_GET['id']);

$conn->query("DELETE FROM peserta WHERE id = $id");

header("Location: admin.php");
exit;
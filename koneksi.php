<?php
$conn = new mysqli("localhost", "root", "", "pendaftaran");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';

$now = date("Y-m-d H:i:s");

$q = $conn->query("
    SELECT * FROM kuota 
    WHERE waktu_buka <= '$now'
    ORDER BY waktu_buka ASC
");

$gelombang = null;

while ($k = $q->fetch_assoc()) {

    $id = $k['id'];

    $result = $conn->query("
        SELECT COUNT(*) as total 
        FROM peserta 
        WHERE kuota_id = $id
    ");
    $row = $result->fetch_assoc();

    if ($row['total'] < $k['maksimal'] && $now <= $k['waktu_tutup']) {
        $gelombang = $k;
        break;
    }
}

$status = "Pendaftaran ditutup!";
$color = "red";

if ($gelombang) {

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("
            INSERT INTO peserta (nama, email, kuota_id) 
            VALUES (?, ?, ?)
        ");

        $stmt->bind_param("ssi", $nama, $email, $gelombang['id']);
        $stmt->execute();

        $conn->commit();

        $status = "✅ Berhasil di " . $gelombang['nama_gelombang'];
        $color = "green";

    } catch (Exception $e) {
        $conn->rollback();
        $status = "❌ Gagal / Email sudah terdaftar";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="bg-white p-8 rounded-xl shadow text-center">
    <h2 class="text-2xl font-bold text-<?php echo $color ?>-500">
        <?= $status ?>
    </h2>

    <a href="index.php" class="mt-4 inline-block bg-blue-500 text-white px-5 py-2 rounded">
        Kembali
    </a>
</div>

</body>
</html>
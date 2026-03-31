<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$now = date("Y-m-d H:i:s");

$q = $conn->query("
    SELECT * FROM kuota 
    WHERE waktu_buka <= '$now'
    ORDER BY waktu_buka ASC
");

$response = [
    "status" => "tutup",
    "gelombang" => "-",
    "sisa" => 0
];

while ($k = $q->fetch_assoc()) {

    $id = $k['id'];

    $result = $conn->query("
        SELECT COUNT(*) as total 
        FROM peserta 
        WHERE kuota_id = $id
    ");
    $row = $result->fetch_assoc();

    if ($row['total'] < $k['maksimal'] && $now <= $k['waktu_tutup']) {

        $response["status"] = "buka";
        $response["gelombang"] = $k['nama_gelombang'];
        $response["sisa"] = $k['maksimal'] - $row['total'];
        break;
    }
}

header('Content-Type: application/json');
echo json_encode($response);


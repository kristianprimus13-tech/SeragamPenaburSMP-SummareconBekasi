<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");

// Ambil semua gelombang
$gelombangQ = $conn->query("SELECT * FROM kuota ORDER BY id ASC");

$gelombangList = [];
while ($g = $gelombangQ->fetch_assoc()) {
    // Hitung jumlah peserta
    $id = $g['id'];
    $pesertaQ = $conn->query("SELECT * FROM peserta WHERE kuota_id = $id ORDER BY created_at ASC");
    $peserta = [];
    while ($p = $pesertaQ->fetch_assoc()) {
        $peserta[] = $p;
    }

    $g['peserta'] = $peserta;
    $g['terisi'] = count($peserta);
    $g['sisa'] = $g['maksimal'] - $g['terisi'];

    $gelombangList[] = $g;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

<?php foreach($gelombangList as $g): ?>
<div class="bg-white p-4 rounded-xl shadow mb-6">
    <h2 class="text-xl font-bold mb-2"><?= $g['nama_gelombang'] ?></h2>
    <p>Kuota: <?= $g['maksimal'] ?> | Terisi: <?= $g['terisi'] ?> | Sisa: <?= $g['sisa'] ?></p>

    <?php if ($g['terisi'] > 0): ?>
    <table class="w-full mt-2 border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Email</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($g['peserta'] as $i => $p): ?>
            <tr>
                <td class="border px-2 py-1"><?= $i+1 ?></td>
                <td class="border px-2 py-1"><?= $p['nama'] ?></td>
                <td class="border px-2 py-1"><?= $p['email'] ?></td>
                <td class="border px-2 py-1">
                    <a href="hapus.php?id=<?= $p['id'] ?>" 
                       class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                       onclick="return confirm('Yakin ingin hapus peserta ini?');">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-gray-500 mt-2">Belum ada peserta</p>
    <?php endif; ?>
</div>
<?php endforeach; ?>

</body>
</html>
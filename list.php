<?php
include 'koneksi.php';
$data = $conn->query("SELECT * FROM peserta");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peserta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">Daftar Peserta</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="p-2">No</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = $data->fetch_assoc()): ?>
            <tr class="text-center border-b hover:bg-gray-100">
                <td class="p-2"><?= $no++ ?></td>
                <td class="p-2"><?= $row['nama'] ?></td>
                <td class="p-2"><?= $row['email'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <div class="mt-4">
        <a href="index.php" class="text-blue-500 hover:underline">
            ← Kembali ke Form
        </a>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pendaftaran</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow w-full max-w-md">

<h2 class="text-xl font-bold text-center mb-4">Pendaftaran Event</h2>

<p id="gelombang" class="text-center font-bold text-blue-500"></p>
<p id="kuota" class="text-center text-gray-600 mb-4"></p>

<form method="POST" action="proses.php" class="space-y-3">
<input type="text" name="nama" placeholder="Nama" class="w-full p-2 border rounded" required>
<input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>

<button class="w-full bg-blue-500 text-white py-2 rounded">
Daftar
</button>
</form>

</div>

<script>
function loadStatus() {
    fetch('get_status.php')
    .then(res => res.json())
    .then(data => {

        const g = document.getElementById("gelombang");
        const k = document.getElementById("kuota");
        const btn = document.querySelector("button");

        if (data.status === "buka") {
            g.innerText = "Gelombang: " + data.gelombang;
            k.innerText = "Sisa kuota: " + data.sisa;

            btn.disabled = false;
            btn.classList.remove("bg-gray-400");
            btn.classList.add("bg-blue-500");

        } else {
            g.innerText = "Pendaftaran ditutup";
            k.innerText = "";

            btn.disabled = true;
            btn.classList.remove("bg-blue-500");
            btn.classList.add("bg-gray-400");
        }
    });
}

setInterval(loadStatus, 3000);
loadStatus();
</script>

</body>
</html>


<?php
require_once __DIR__ . '/config/database.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$judul = trim($_POST['judul'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$teknologi = trim($_POST['teknologi'] ?? '');
$tautan = trim($_POST['tautan'] ?? '');
$dibuatPada = trim($_POST['dibuat_pada'] ?? '');
if ($judul === '') {
$errors[] = 'Judul wajib diisi.';
}
if ($dibuatPada === '') {
$errors[] = 'Tanggal dibuat wajib diisi.';
}
if ($teknologi === '') {
$errors[] = 'Teknologi wajib diisi.';
}
if (strlen($judul) > 150) {
$errors[] = 'Judul maksimal 150 karakter';
}
 if (empty($errors)) {
$stmt = $pdo->prepare(
'INSERT INTO project (judul, deskripsi, teknologi, tautan, dibuatpada)
VALUES (:judul, :deskripsi, :teknologi, :tautan, :dibuatpada)'
);
$stmt->execute([
'judul' => $judul,
'deskripsi' => $deskripsi,
'teknologi' => $teknologi,
'tautan' => $tautan,
'dibuatpada' => $dibuatPada,
]);
header('Location: project.php');
exit;
}
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Project</title>
</head>
<body>
<h1>Tambah Project Baru</h1>
<?php if (!empty($errors)): ?>
<ul style="color: red;">
<?php foreach ($errors as $pesan): ?>
<li><?= htmlspecialchars($pesan) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<form method="post">
<label>Judul Project</label><br>
<input type="text" name="judul" value="<?= htmlspecialchars($judul ?? '')
?>"><br><br>
<label>Deskripsi</label><br>
<textarea name="deskripsi" rows="4"><?= htmlspecialchars($deskripsi ?? '')
?></textarea><br><br>
<label>Teknologi</label><br>
<input type="text" name="teknologi" value="<?= htmlspecialchars($teknologi ??
'') ?>"><br><br>
<label>Tautan (Link)</label><br>
<input type="url" name="tautan" value="<?= htmlspecialchars($tautan ?? '')
?>"><br><br>
<label>Tanggal Dibuat</label><br>
<input type="date" name="dibuat_pada" value="<?= htmlspecialchars($dibuatPada
?? '') ?>"><br><br>
<button type="submit">Simpan Project</button>
</form>
<p><a href="project.php">Kembali ke Dashboard</a></p>
</body>
</html>
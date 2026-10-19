<?php
require_once __DIR__ . '/config/database.php';
$stmt = $pdo->query('SELECT * FROM project ORDER BY dibuatpada DESC');
$project = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Project</title>
</head>
<body>
<h1>Daftar Project</h1>
<p><a href="tesssssssssssssssssst.php">buat baru</a></p>
<?php if (count($project) === 0): ?>
<p>Belum ada project.</p>
<?php else: ?>
<table border="1" cellpadding="8" cellspacing="0">
<tr>
<th>Judul</th>
<th>Deskripsi</th>
<th>Teknologi</th>
<th>Tautan</th>
<th>Tanggal Dibuat</th>
</tr>
<?php foreach ($project as $project): ?>
<tr>
<td><?= htmlspecialchars($project['judul']) ?></td>
<td><?= htmlspecialchars($project['deskripsi']) ?></td>
<td><?= htmlspecialchars($project['teknologi']) ?></td>
<td>
<?php if (!empty($project['tautan'])): ?>
<a href="<?= htmlspecialchars($project['tautan']) ?>" target="_blank">Lihat</a>
<?php else: ?>
-
<?php endif; ?>
</td>
<td><?= htmlspecialchars($project['dibuatpada']) ?></td>
<td>
 <a href="edit.php?id=<?= (int) $project['id'] ?>"> </a>
 <form method="post" action="hapus-project.php" style="display:inline"
 onsubmit="return confirm('Update project ini?');">
 <input type="hidden" name="id" value="<?= $project['id'] ?>">
 <button type="submit">Update</button>
 </form>
</td>
<td>
<form method="post" action="delete.php"
onsubmit="return confirm('Hapus project ini?');">
<input type="hidden" name="id" value="<?= $project['id'] ?>">
<button type="submit">Hapus</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</body>
</html>
<?php
require_once __DIR__ . '/config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
$id = $_POST['id'];
$stmt = $pdo->prepare('DELETE FROM project WHERE id = ?');
$stmt->execute([$id]);
}
header('Location: project.php');
exit;
<?php
require_once __DIR__ . '/../../core/check_admin.php';

$stmt = $pdo->query("SELECT * FROM tickets ORDER BY id DESC");
$tickets = $stmt->fetchAll();

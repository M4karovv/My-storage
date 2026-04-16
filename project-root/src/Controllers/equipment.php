<?php
require_once __DIR__ . '/../../../config/db.php';

$inv = isset($_GET['inv']) ? trim($_GET['inv']) : '';

if ($inv === '') {
    die("Нет инвентарного номера");
}

$stmt = $pdo->prepare("SELECT * FROM tickets WHERE inventory_number = ?");
$stmt->execute([$inv]);

$ticket = $stmt->fetch();

if (!$ticket) {
    die("Оборудование не найдено");
}
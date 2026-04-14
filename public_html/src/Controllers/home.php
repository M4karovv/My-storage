<?php
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// общее количество
$total = $pdo->query("SELECT COUNT(*) FROM tickets")->fetchColumn();
$total_pages = ceil($total / $limit);

// выборка только 6 тикетов
$stmt = $pdo->prepare("
    SELECT * FROM tickets
    ORDER BY id DESC
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$tickets = $stmt->fetchAll();

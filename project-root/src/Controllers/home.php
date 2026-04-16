<?php
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$limit = 6;
$offset = ($page - 1) * $limit;

// ==========================
// ЕСЛИ ЕСТЬ ПОИСК
// ==========================
if ($search !== '') {

    // общее количество найденных
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM tickets
        WHERE inventory_number LIKE :search
    ");
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $total_pages = ceil($total / $limit);

    // выборка
    $stmt = $pdo->prepare("
        SELECT * FROM tickets
        WHERE inventory_number LIKE :search
        ORDER BY id DESC
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

} else {

    // обычный режим (без поиска)
    $total = $pdo->query("SELECT COUNT(*) FROM tickets")->fetchColumn();
    $total_pages = ceil($total / $limit);

    $stmt = $pdo->prepare("
        SELECT * FROM tickets
        ORDER BY id DESC
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}

$tickets = $stmt->fetchAll();
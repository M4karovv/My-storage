<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../../../core/check_admin.php';

$sql = "
    SELECT
        orders.id as order_id,
        orders.created_at,
        users.email,
        tickets.room,
        tickets.frp,
        tickets.equipment,
        tickets.type
    FROM orders
    JOIN users ON orders.user_id = users.id
    JOIN tickets ON orders.ticket_id = tickets.id
    ORDER BY orders.id DESC
";

$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll();
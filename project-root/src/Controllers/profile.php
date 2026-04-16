<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "
    SELECT
        orders.id AS order_id,
        orders.created_at,
        orders.status,
        tickets.room,
        tickets.equipment,
        tickets.image_url
    FROM orders
    JOIN tickets ON orders.ticket_id = tickets.id
    WHERE orders.user_id = ?
    ORDER BY orders.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$my_orders = $stmt->fetchAll();

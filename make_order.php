<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require 'db.php';

// 1. Проверка: Вошел ли пользователь?
if (!isset($_SESSION['user_id'])) {
    die("Сначала войдите в систему! <a href='login.php'>Вход</a>");
}

// 2. Получаем ID товара из ссылки (например, make_order.php?id=5)
// (int) — это защита от хакеров, превращаем всё в число
$ticket_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

if ($ticket_id > 0) {
    // 3. Создаем заказ
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, ticket_id) VALUES (?, ?)");
    try {
        $stmt->execute([$user_id, $ticket_id]);
        echo "Заказ успешно оформлен! Менеджер свяжется с вами. <a href='index.php'>Вернуться</a>";
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
} else {
    echo "Неверный товар.";
}
?>
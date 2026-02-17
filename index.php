<?php
session_start();
require 'db.php';

// 1. Получаем все товары из базы
// ORDER BY id DESC означает "сначала новые"
$stmt = $pdo->query("SELECT * FROM tickets ORDER BY id DESC");
$tickets = $stmt->fetchAll();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Получаем общее кол-во товаров (для кнопок 1, 2, 3...)
$total_stmt = $pdo->query("SELECT COUNT(*) FROM products");
$total_rows = $total_stmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Навигация -->
<nav class="navbar navbar-light bg-light px-4 mb-4 shadow-sm">
    <span class="navbar-brand mb-0 h1">Мой Инвентаризатор</span>
    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Если вошел -->
            <span class="me-3">Привет!</span>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="admin_panel.php" class="btn btn-outline-danger btn-sm">Админка</a>
                <a href="add_item.php" class="btn btn-success btn-sm">+ Добавить услугу</a>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-dark btn-sm">Выйти</a>
            <a href="profile.php" class="btn btn-outline-primary btn-sm">Профиль</a>
        <?php else: ?>
            <!-- Если гость -->
            <a href="login.php" class="btn btn-primary btn-sm">Войти</a>
            <a href="register.php" class="btn btn-outline-primary btn-sm">Регистрация</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <h2 class="mb-4">Каталог услуг</h2>
    
    <div class="row">
        <!-- Исправлено имя переменной цикла -->
        <?php foreach ($tickets as $ticket): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!-- Если картинки нет, ставим заглушку -->
                    <?php $img = $ticket['image_url'] ?: 'https://via.placeholder.com/300'; ?>
                    <img src="<?= htmlspecialchars($img) ?>" class="card-img-top" alt="Фото" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title">№ кабинета: <?= htmlspecialchars($ticket['room'])?></h5>
                        <p class="card-text text-truncate"><strong>Ответственный:</strong> <?= htmlspecialchars($ticket['frp']) ?></p>
                        <p class="card-text fw-bold text-truncate"><strong>Оборудование:</strong> <?= htmlspecialchars($ticket['equipment']) ?></p>
                        <p class="card-text fw-bold text-truncate"><strong>Тип:</strong> <?= htmlspecialchars($ticket['type']) ?></p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <!-- Кнопка теперь использует правильную переменную $ticket -->
                        <a href="make_order.php?id=<?= $ticket['id'] ?>" class="btn btn-primary w-100">Заказать</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if (count($tickets) === 0): ?>
            <p class="text-muted">Товаров пока нет. Зайдите под админом и добавьте их.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

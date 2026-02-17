<?php
require 'check_admin.php';
require 'db.php';


$stmt = $pdo->query("SELECT * FROM tickets ORDER BY id DESC");
$tickets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="alert alert-success">
    <h1>Панель Администратора</h1>
    <p>Добро пожаловать в систему управления.</p>

    <a href="add_item.php" class="btn btn-primary">Добавить запись</a>
    <a href="logout.php" class="btn btn-danger">Выйти</a>
    <a href="index.php" class="btn btn-danger">Назад</a>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4>Все услуги / тикеты</h4>
    </div>

    <div class="card-body">

        <?php if (count($tickets) > 0): ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Комната</th>
                        <th>Оборудование</th>
                        <th>Действия</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tickets as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['room']) ?></td>
                            <td><?= htmlspecialchars($item['equipment']) ?></td>
                            <td><a href="edit_item.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">✏️ Редактировать</a></td>
                                    
                                <td>
                                    <form action="delete_item.php" method="POST" onsubmit="return confirm('Вы уверены?');">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <!-- CSRF токен обязателен! (см. урок от 29.01) -->
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Удалить</button>
                                    </form>
                                </td>
                                
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="text-muted">Записей пока нет</p>
        <?php endif; ?>

    </div>
</div>

</body>
</html>

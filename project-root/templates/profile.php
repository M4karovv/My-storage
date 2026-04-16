<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <!-- Подключаем Bootstrap для красоты -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <!-- Навигация -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=home">Мой Инвентаризатор</a>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                Вы вошли как: <b><?php echo htmlspecialchars(isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'User'); ?></b>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Выйти</a>
            <a href="index.php?page=change_password" class="btn btn-outline-warning btn-sm">Сменить пароль</a>
        </div>
    </div>
</nav>


<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h2 class="mb-0">Мои заказы</h2>
                    </div>
                    <div class="card-body">
                        
                        <!-- Проверка: Есть ли заказы вообще? -->
                        <?php if (count($my_orders) > 0): ?>
                            
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>№ Заказа</th>
                                            <th>Дата</th>
                                            <th>Номер кабинета</th>
                                            <th>Оборудование</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($my_orders as $order): ?>
                                            <tr>
                                                <!-- ID заказа -->
                                                <td>#<?= $order['order_id'] ?></td>
                                                
                                                <!-- Дата (форматируем красиво) -->
                                                <td>
                                                    <?= date('d.m.Y H:i', strtotime($order['created_at'])) ?>
                                                </td>
                                                
                                                <!-- Название товара (защита от XSS) -->
                                                <td>
                                                    <strong><?= htmlspecialchars($order['room']) ?></strong>
                                                </td>
                                                
                                                <!-- Цена -->
                                                <td><?= htmlspecialchars($order['equipment']) ?></td>
                                                
                                                <!-- Статус с цветным бейджиком -->
                                                <td>
                                                    <?php 
                                                    // Логика цвета для статуса
                                                    $status_color = 'secondary';
                                                    if ($order['status'] == 'new') $status_color = 'primary';
                                                    if ($order['status'] == 'processing') $status_color = 'warning';
                                                    if ($order['status'] == 'done') $status_color = 'success';
                                                    ?>
                                                    <span class="badge bg-<?= $status_color ?>">
                                                        <?= htmlspecialchars($order['status']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php else: ?>
                            <!-- Если заказов нет -->
                            <div class="text-center py-5">
                                <h4 class="text-muted">Вы еще ничего не заказывали.</h4>
                                <a href="index.php?page=home" class="btn btn-primary mt-3">Перейти в каталог</a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

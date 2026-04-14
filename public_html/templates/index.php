<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - ГлавИнвент</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="logo">ГлавИнвент</div>
                <div class="contacts">
                    <span>+7 495 191-13-15</span>
                    <span>info@glavinvent.ru</span>
                </div>
            </div>
        </div>
    </div>

   <nav class="navbar navbar-light bg-light px-4 mb-4 shadow-sm">
        <span class="navbar-brand mb-0 h1">Мой Инвентаризатор</span>
    
        <div class="d-flex align-items-center gap-2">
    
            <!--ПАГИНАЦИЯ -->
            <?php if (isset($total_pages) && $total_pages > 1): ?>
                <div class="btn-group me-3">
                    <?php
                    $current_page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
                    ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="index.php?page=home&p=<?= $i ?>"
                           class="btn btn-sm <?= ($i == $current_page) ? 'btn-primary' : 'btn-outline-primary' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="me-2">Привет!</span>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="index.php?page=admin" class="btn btn-outline-danger btn-sm">Админка</a>
                    <a href="index.php?page=add" class="btn btn-success btn-sm">+ Добавить услугу</a>
                <?php endif; ?>
                <a href="index.php?page=logout" class="btn btn-dark btn-sm">Выйти</a>
                <a href="index.php?page=profile" class="btn btn-outline-primary btn-sm">Профиль</a>
            <?php else: ?>
    
                <a href="index.php?page=login" class="btn btn-primary btn-sm">Войти</a>
                <a href="index.php?page=register" class="btn btn-outline-primary btn-sm">Регистрация</a>
            <?php endif; ?>
    
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Каталог оборудования</h1>

        <?php if (!empty($tickets)): ?>
            <div class="row g-3">
                <?php foreach ($tickets as $item): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($item['image_url'])): ?>
                                <img src="<?= htmlspecialchars($item['image_url']) ?>" class="card-img-top" alt="Оборудование" style="height:220px; object-fit:cover;">
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2"><?= htmlspecialchars($item['equipment']) ?></h5>
                                <p class="mb-1"><b>Инв. номер:</b> <?= htmlspecialchars($item['inventory_number']) ?></p>
                                <p class="mb-1"><b>Кабинет:</b> <?= htmlspecialchars($item['room']) ?></p>
                                <p class="mb-3"><b>Тип:</b> <?= htmlspecialchars($item['type']) ?></p>
                                <div class="mt-auto d-flex gap-2">
                                    <div class="text-center mt-2">
                                        <img src="<?= qrEquipment($item['inventory_number']) ?>" alt="QR">
                                    </div>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <a class="btn btn-primary btn-sm" href="index.php?page=make_order&id=<?= (int)$item['id'] ?>">Оформить</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Пока нет оборудования для отображения.</div>
        <?php endif; ?>
    </div>
</body>
</html>

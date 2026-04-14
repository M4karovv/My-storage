<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - ГлавИнвент</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Желтая шапка с контактами -->
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

    <!-- Навигационное меню -->
    <nav class="navbar">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="index.php?page=home">Главная</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?page=profile">Профиль</a></li>
                    <li><a href="index.php?page=logout">Выход</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=login">Вход</a></li>
                    <li><a href="index.php?page=register">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Регистрация</h4>
                </div>
                <div class="card-body">
                    
                    <!-- Блок вывода сообщений -->
                    <?php if($errorMsg): ?>
                        <div class="alert alert-danger"><?= $errorMsg ?></div>
                    <?php endif; ?>
                    
                    <?php if($successMsg): ?>
                        <div class="alert alert-success"><?= $successMsg ?></div>
                    <?php else: ?>

                    <!-- Сама форма -->
                    <form method="POST" action="index.php?page=register">
                        <div class="mb-3">
                            <label class="form-label">Email адрес</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Подтверждение пароля</label>
                            <input type="password" name="password_confirm" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="index.php?page=login">Уже есть аккаунт? Войти</a>
                    </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer>
        <div class="container">
            <p>&copy; 2024 ГлавИнвент. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
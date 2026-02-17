<?php
session_start();
require 'db.php';

// 1. Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

// 2. Генерация CSRF-токена (старый способ, совместимый)
if (!isset($_SESSION['csrf_token']) || empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
}

// 3. Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Проверка CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Ошибка безопасности. Попробуйте снова.");
    }

    // Получаем данные из формы
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : '';
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Проверка совпадения нового пароля
    if ($new_password !== $confirm_password) {
        $message = "Новый пароль и подтверждение не совпадают.";
    } elseif (strlen($new_password) < 8) {
        $message = "Новый пароль должен быть не короче 8 символов.";
    } else {
        // Получаем хеш текущего пароля
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ?");
        $stmt->execute(array($user_id));
        $user = $stmt->fetch();

        if (!$user) {
            $message = "Пользователь не найден.";
        } elseif (!password_verify($old_password, $user['password_hash'])) {
            $message = "Старый пароль неверный.";
        } else {
            // Обновляем пароль
            $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
            if ($stmt->execute(array($new_hash, $user_id))) {
                $message = "Пароль успешно изменен!";
            } else {
                $message = "Ошибка при обновлении пароля.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Смена пароля</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3>Смена пароля</h3>
                </div>
                <div class="card-body">
                    <?php
                    if (!empty($message)) {
                        echo '<div class="alert alert-info">' . htmlspecialchars($message) . '</div>';
                    }
                    ?>
                    <form method="post" action="">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                        <div class="mb-3">
                            <label>Старый пароль</label>
                            <input type="password" name="old_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Новый пароль</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Повтор нового пароля</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Сменить пароль</button>
                        <a href="profile.php" class="btn btn-link w-100 mt-2">Отмена</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

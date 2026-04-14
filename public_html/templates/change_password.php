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
                        <a href="index.php?page=profile" class="btn btn-link w-100 mt-2">Отмена</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
$errorMsg = '';
$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
    $pass = isset($_POST['password']) ? $_POST['password'] : '';
    $passConfirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

    if (empty($email) || empty($pass)) {
        $errorMsg = "Заполните все поля!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Некорректный формат Email!";
    } elseif ($pass !== $passConfirm) {
        $errorMsg = "Пароли не совпадают!";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password_hash, role) VALUES (:email, :hash, 'client')";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':email' => $email,
                ':hash' => $hash
            ]);
            $successMsg = "Регистрация успешна! <a href='index.php?page=login'>Войти</a>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errorMsg = "Такой email уже зарегистрирован.";
            } else {
                $errorMsg = "Ошибка БД: " . $e->getMessage();
            }
        }
    }
}
<?php
// 1. Подключаем БД и проверку на админа
require 'db.php';
require 'check_admin.php'; // Эту страницу видит только админ!

$message = '';

// 2. Если нажата кнопка "Сохранить"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $room      = trim($_POST['room']);
    $frp       = trim($_POST['frp']);
    $equipment = trim($_POST['equipment']);
    $type      = trim($_POST['type']);
    $image_url = trim($_POST['image_url']);

    if (empty($room) || empty($frp) || empty($equipment) || empty($type)) {
        $message = '<div class="alert alert-danger">Заполните все поля!</div>';
    } else {

        $sql = "INSERT INTO tickets (room, frp, equipment, type, image_url)
                VALUES (:room, :frp, :equipment, :type, :image_url)";

        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':room'      => $room,
                ':frp'       => $frp,
                ':equipment' => $equipment,
                ':type'      => $type,
                ':image_url' => $image_url
            ]);

            $message = '<div class="alert alert-success">Тикет успешно создан!</div>';

        } catch (PDOException $e) {
            $message = '<div class="alert alert-danger">Ошибка БД: ' . $e->getMessage() . '</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создать тикет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1>Создание нового тикета</h1>
        <a href="index.php" class="btn btn-secondary mb-3">← На главную</a>
        
        <?= $message ?>

        <form method="POST" class="card p-4 shadow-sm">

            <div class="mb-3">
                <label>Номер кабинета:</label>
                <input type="text" name="room" class="form-control" placeholder="Например: 101, 205," required>
            </div>
            
            <div class="mb-3">
                <label>Тип оборудования:</label>
                <input type="text" name="type" class="form-control" placeholder="Например: Компьютер, Принтер" required>
            </div>

            <div class="mb-3">
                <label>Оборудование:</label>
                <input type="text" name="equipment" class="form-control" placeholder="Например: HP LaserJet Pro, Dell OptiPlex 7090" required>
            </div>

            <div class="mb-3">
                <label>Ответственное лицо (frp):</label>
                <input type="text" name="frp" class="form-control" placeholder="ФИО ответственного лица" required>
            </div>
            
            <div class="mb-3">
                <label>Ссылка на картинку (URL):</label>
                <input type="text" name="image_url" class="form-control" placeholder="https://...">
                <small class="text-muted">Пока просто вставьте ссылку на картинку из интернета</small>
            </div>

            <button type="submit" class="btn btn-success">Создать тикет</button>
        </form>
    </div>
</body>
</html>
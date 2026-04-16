<?php
header('Content-Type: text/html; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    die('Доступ запрещен');
}

$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {

    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Ошибка загрузки файла: " . $file['error']);
    }

    if (!in_array($file['type'], $allowedTypes)) {
        die("Можно только JPG, PNG, GIF");
    }

    // 🔥 создаём имя ФАЙЛА СНАЧАЛА
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid('ticket_') . '.' . $extension;

    // 🔥 ПРАВИЛЬНЫЕ ПУТИ
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    $serverPath = $uploadDir . $newName;

    $dbPath = 'uploads/' . $newName;

    // 🔥 ЗАГРУЗКА
    if (move_uploaded_file($file['tmp_name'], $serverPath)) {

        if (isset($_POST['ticket_id'])) {

            $stmt = $pdo->prepare("UPDATE tickets SET image_url = ? WHERE id = ?");
            $stmt->execute([$dbPath, $_POST['ticket_id']]);
        }

        echo "Файл загружен успешно! <a href='index.php?page=admin'>Назад</a>";

    } else {
        echo "❌ Ошибка move_uploaded_file";
    }
}
?>
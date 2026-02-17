<?php
require 'db.php';
require 'check_admin.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Неверный ID");
}

/* SELECT */
$stmt = $pdo->prepare("SELECT * FROM tickets WHERE id = ?");
$stmt->execute([$id]);
$ticket = $stmt->fetch();

if (!$ticket) {
    die("Тикет не найден");
}

/* UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $room = $_POST['room'];
    $frp = $_POST['frp'];
    $equipment = $_POST['equipment'];
    $type = $_POST['type'];
    $image_url = $_POST['image_url'];

    $sql = "UPDATE tickets 
            SET room = ?, frp = ?, equipment = ?, type = ?, image_url = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$room, $frp, $equipment, $type, $image_url, $id]);

    header("Location: edit_item.php?id=" . $id . "&success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование услуги</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container">

    <h2 class="mb-4">Редактирование тикета</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Изменения сохранены</div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Комната</label>
            <input type="text" name="room" class="form-control"
                   value="<?php echo htmlspecialchars($ticket['room']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ФИО</label>
            <input type="text" name="frp" class="form-control"
                   value="<?php echo htmlspecialchars($ticket['frp']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Оборудование</label>
            <input type="text" name="equipment" class="form-control"
                   value="<?php echo htmlspecialchars($ticket['equipment']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Тип</label>
            <input type="text" name="type" class="form-control"
                   value="<?php echo htmlspecialchars($ticket['type']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Изображение (URL)</label>
            <input type="text" name="image_url" class="form-control"
                   value="<?php echo htmlspecialchars($ticket['image_url']); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="admin_panel.php" class="btn btn-secondary">Назад</a>

    </form>

    <?php if (!empty($ticket['image_url'])): ?>
        <div class="mt-4">
            <p>Текущее изображение:</p>
            <img src="<?php echo htmlspecialchars($ticket['image_url']); ?>" style="max-width:300px;">
        </div>
    <?php endif; ?>

</div>

</body>
</html>

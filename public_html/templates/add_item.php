<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создать тикет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

<div class="container">

<!-- =========================
     ШАПКА (как в старом стиле)
========================= -->
<div class="alert alert-primary shadow-sm">
    <h3 class="mb-0">Создание нового тикета</h3>
</div>

<a href="index.php?page=admin" class="btn btn-secondary mb-3">← Назад</a>

<?= $message ?>

<!-- =========================
     ФОРМА СОЗДАНИЯ (СТАРЫЙ СТИЛЬ CARD)
========================= -->
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST">

            <input type="hidden" name="create_ticket" value="1">

            <div class="mb-3">
                <label class="form-label">Номер кабинета</label>
                <input type="text" name="room" class="form-control" placeholder="Например: 101" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Тип оборудования</label>
                <input type="text" name="type" class="form-control" placeholder="Компьютер / Принтер" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Оборудование</label>
                <input type="text" name="equipment" class="form-control" placeholder="HP / Dell / Canon" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ответственный</label>
                <input type="text" name="frp" class="form-control" placeholder="ФИО" required>
            </div>

            <button type="submit" class="btn btn-success w-100">
                Создать тикет
            </button>

        </form>

    </div>
</div>

<!-- =========================
     ЗАГРУЗКА ФОТО (upload.php)
========================= -->
<?php if ($lastInsertedId): ?>

<div class="card mt-4 shadow-sm">
    <div class="card-body">

        <h5 class="mb-3">Загрузка изображения</h5>

        <form action="index.php?page=upload" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="ticket_id" value="<?= $lastInsertedId ?>">

            <input type="file" name="file" class="form-control mb-3" required>

            <button type="submit" class="btn btn-primary w-100">
                Загрузить фото
            </button>

        </form>

    </div>
</div>

<?php endif; ?>

</div>

</body>
</html>
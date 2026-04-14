<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Карточка оборудования</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <a href="index.php?page=home" class="btn btn-secondary mb-3">
        Назад
    </a>

    <div class="card">

        <div class="card-header">
            Карточка оборудования
        </div>

        <div class="card-body">

            <h4>
                <?php echo htmlspecialchars($ticket['inventory_number']); ?>
            </h4>

            <p>
                <b>Кабинет:</b>
                <?php echo htmlspecialchars($ticket['room']); ?>
            </p>

            <p>
                <b>Тип:</b>
                <?php echo htmlspecialchars($ticket['type']); ?>
            </p>

            <p>
                <b>Оборудование:</b>
                <?php echo htmlspecialchars($ticket['equipment']); ?>
            </p>

            <p>
                <b>Ответственный:</b>
                <?php echo htmlspecialchars($ticket['frp']); ?>
            </p>

            <?php if (!empty($ticket['image_url'])) { ?>
                <img src="<?php echo htmlspecialchars($ticket['image_url']); ?>" style="max-width:300px;">
            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>
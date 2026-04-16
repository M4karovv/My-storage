<?php
require_once __DIR__ . '/../../../core/check_admin.php';

$message = '';
$lastInsertedId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_ticket'])) {
    $room = trim(isset($_POST['room']) ? $_POST['room'] : '');
    $type = trim(isset($_POST['type']) ? $_POST['type'] : '');
    $equipment = trim(isset($_POST['equipment']) ? $_POST['equipment'] : '');
    $frp = trim(isset($_POST['frp']) ? $_POST['frp'] : '');

    if (empty($room) || empty($type) || empty($equipment) || empty($frp)) {
        $message = "<div class='alert alert-danger'>Заполните все поля!</div>";
    } else {
        $stmtLast = $pdo->query("SELECT MAX(id) FROM tickets");
        $last_id = $stmtLast->fetchColumn();
        $inventory_number = 'INV-' . str_pad($last_id + 1, 6, '0', STR_PAD_LEFT);

        $sql = "INSERT INTO tickets (room, frp, equipment, type, inventory_number)
                VALUES (:room, :frp, :equipment, :type, :inventory_number)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':room' => $room,
            ':frp' => $frp,
            ':equipment' => $equipment,
            ':type' => $type,
            ':inventory_number' => $inventory_number
        ]);

        $lastInsertedId = $pdo->lastInsertId();
        $message = "<div class='alert alert-success'>Тикет создан! INV: <b>$inventory_number</b></div>";
    }
}
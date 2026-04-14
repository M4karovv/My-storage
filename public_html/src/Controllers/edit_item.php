<?php
require_once __DIR__ . '/../../core/check_admin.php';

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

    header("Location: index.php?page=edit&id=" . $id . "&success=1");
    exit;
}
$success = isset($_GET['success']);

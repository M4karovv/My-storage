<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// проверка авторизации
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    die("Доступ запрещён");
}

// CSRF токен (ГАРАНТИРОВАННО БЕЗ КРАША)
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
}
?>
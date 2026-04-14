<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// очистка сессии
$_SESSION = [];

session_destroy();

// редирект
header("Location: index.php?page=home");
exit;
<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/core/functions.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {

    // 🏠 ГЛАВНАЯ
    case 'home':
        require __DIR__ . '/src/Controllers/home.php';
        require __DIR__ . '/templates/index.php';
        break;

    // 🔐 LOGIN
    case 'login':
        require __DIR__ . '/src/Controllers/login.php';
        require __DIR__ . '/templates/login.php';
        break;

    // 📝 REGISTER
    case 'register':
        require __DIR__ . '/src/Controllers/register.php';
        require __DIR__ . '/templates/register.php';
        break;

    // 🚪 LOGOUT
    case 'logout':
        require __DIR__ . '/src/Controllers/logout.php';
        break;

    // ➕ ADD ITEM
    case 'add':
        require __DIR__ . '/src/Controllers/add_item.php';
        require __DIR__ . '/templates/add_item.php';
        break;

    // ✏️ EDIT
    case 'edit':
        require __DIR__ . '/src/Controllers/edit_item.php';
        require __DIR__ . '/templates/edit_item.php';
        break;

    // 🗑 DELETE
    case 'delete':
        require __DIR__ . '/src/Controllers/delete_item.php';
        break;

    // 📦 ADMIN PANEL
    case 'admin':
        require __DIR__ . '/src/Controllers/admin_panel.php';
        require __DIR__ . '/templates/admin_panel.php';
        break;

    // 👤 PROFILE
    case 'profile':
        require __DIR__ . '/src/Controllers/profile.php';
        require __DIR__ . '/templates/profile.php';
        break;

    // 🔑 PASSWORD CHANGE
    case 'change_password':
        require __DIR__ . '/src/Controllers/change_password.php';
        require __DIR__ . '/templates/change_password.php';
        break;

    // 📤 UPLOAD IMAGE
    case 'upload':
        require __DIR__ . '/src/Controllers/upload.php';
        break;

    // 🛒 CREATE ORDER
    case 'make_order':
        require __DIR__ . '/src/Controllers/make_order.php';
        break;

    // 🖥 EQUIPMENT CARD
    case 'equipment':
        require __DIR__ . '/src/Controllers/equipment.php';
        require __DIR__ . '/templates/equipment.php';
        break;

    // 📌 DEFAULT
    default:
        echo "404 - Page not found";
        break;
}
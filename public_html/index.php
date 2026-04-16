<?php
session_start();
$root = dirname(__DIR__);
require_once $root . '/config/db.php';
require_once $root . '/core/functions.php';
$app = $root . '/project-root';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {

    //  ГЛАВНАЯ
    case 'home':
        require $app . '/src/Controllers/home.php';
        require $app . '/templates/index.php';
        break;

    //  LOGIN
    case 'login':
        require $app . '/src/Controllers/login.php';
        require $app . '/templates/login.php';
        break;

    //  REGISTER
    case 'register':
        require $app . '/src/Controllers/register.php';
        require $app . '/templates/register.php';
        break;

    //  LOGOUT
    case 'logout':
        require $app . '/src/Controllers/logout.php';
        break;

    // DD ITEM
    case 'add':
        require $app . '/src/Controllers/add_item.php';
        require $app . '/templates/add_item.php';
        break;

    //  EDIT
    case 'edit':
        require $app . '/src/Controllers/edit_item.php';
        require $app . '/templates/edit_item.php';
        break;

    //  DELETE
    case 'delete':
        require $app . '/src/Controllers/delete_item.php';
        break;

    //  ADMIN PANEL
    case 'admin':
        require $app . '/src/Controllers/admin_panel.php';
        require $app . '/templates/admin_panel.php';
        break;

    //  PROFILE
    case 'profile':
        require $app . '/src/Controllers/profile.php';
        require $app . '/templates/profile.php';
        break;

    // PASSWORD CHANGE
    case 'change_password':
        require $app . '/src/Controllers/change_password.php';
        require $app . '/templates/change_password.php';
        break;

    //  UPLOAD IMAGE
    case 'upload':
        require $app . '/src/Controllers/upload.php';
        break;

    //  CREATE ORDER
    case 'make_order':
        require $app . '/src/Controllers/make_order.php';
        break;

    //  EQUIPMENT CARD
    case 'equipment':
        require $app . '/src/Controllers/equipment.php';
        require $app . '/templates/equipment.php';
        break;

    //  DEFAULT
    default:
        echo "404 - Page not found";
        break;
}
<?php
require_once('../config/database.php');
require_once('../models/User.php');
require_once('../controllers/AuthController.php');
require_once('../controllers/UserController.php');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'login':
        AuthController::login();
        break;
    case 'create':
        UserController::create();
        break;
    case 'read':
        UserController::read();
        break;
    case 'update':
        UserController::update();
        break;
    case 'delete':
        UserController::delete();
        break;
    default:
        echo json_encode(["message" => "Acción no válida."]);
}

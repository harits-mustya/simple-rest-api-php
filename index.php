<?php

require_once 'controllers/api_controller.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

$controller = new api_controller();


// Debugging: Output the request method and query parameters
error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
error_log("Query String: " . $_SERVER['QUERY_STRING']);
error_log("Action Parameter: " . ($_GET['action'] ?? 'Not Set'));

// file_put_contents('debug_log.txt', print_r([
//     'Method' => $_SERVER['REQUEST_METHOD'],
//     'Query String' => $_SERVER['QUERY_STRING'],
//     'Action' => $_GET['action'] ?? 'Not Set',
// ], true), FILE_APPEND);

switch ($method) {
    case 'GET':
        if ($action === 'getAll') {
            $controller->getAll();
        } else {
            echo json_encode(["Message" => "Invalid action"]);
        }
        break;

    case 'POST':
        if ($action === 'add') {
            $controller->add();
        } else {
            echo json_encode(["Message" => "Invalid action"]);
            }
            break;

    case 'PUT':
        if ($action === 'edit') {
            $controller->edit();
        } else {
            echo json_encode(["Message" => "Invalid action"]);
            }
            break;

    case 'PATCH':
        if ($action === 'upd') {
            $controller->upd();
        } else {
            echo json_encode(["Message" => "Invalid action"]);
            }
            break;

    case 'DELETE':
        if ($action === 'del') {
            $controller->del();
        } else {
            echo json_encode(["Message" => "Invalid action"]);
            }
            break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}


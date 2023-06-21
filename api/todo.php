<?php
header('Content-Type: application/json');

require 'config.php';
require 'controllers/TodosController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$database = new Database();
$db = $database->getConnection();

$todosController = new TodosController($db);

switch ($requestMethod) {
  case 'GET':
    if (end($requestUri) !== 'todo') {
      $todoId = end($requestUri);
      $response = $todosController->getTodoById($todoId);
      if ($response !== false) {
        echo $response;
        http_response_code(200);
      } else {
        echo json_encode(
          array("message" => "Item não encontrado")
        );
        http_response_code(400);
      }
    } else {
      echo $todosController->getAllTodos();
    }
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['title'])) {
      echo json_encode(
        array("message" => "Title é um campo obrigatório")
      );
      http_response_code(401);
    } else {
      echo $todosController->createTodo($data);
      http_response_code(200);
    }

    break;

  case 'PUT':
  case 'PATCH':
    if (end($requestUri) !== 'todo') {
      $todoId = end($requestUri);
      $data = json_decode(file_get_contents('php://input'), true);
      echo $todosController->updateTodo($todoId, $data);
    }
    break;

  case 'DELETE':
    if (end($requestUri) !== 'todo') {
      $todoId = end($requestUri);
      echo $todosController->deleteTodo($todoId);
    }
    break;

  default:
    echo json_encode(
      array("message" => "Método inválido")
    );
    http_response_code(401);
    break;
}

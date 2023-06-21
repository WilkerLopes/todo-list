<?php

require __DIR__ . '/../models/Todo.php';

class TodosController
{
  private $todoModel;

  public function __construct($db)
  {
    $this->todoModel = new Todo($db);
  }

  public function getAllTodos()
  {
    $todos = $this->todoModel->getAllTodos();
    return json_encode($todos);
  }

  public function getTodoById($id)
  {
    $todo = $this->todoModel->getTodoById($id);
    return json_encode($todo);
  }

  public function createTodo($data)
  {
    $title = $data['title'];
    $due_date = isset($data['due_date']) ? $data['due_date'] : null;

    $success = $this->todoModel->createTodo($title, $due_date);
    if ($success) {
      return json_encode(['message' => 'Item criado com sucesso.']);
    } else {
      return json_encode(['message' => 'Falha ao criar item.']);
    }
  }

  public function updateTodo($id, $data)
  {
    $success = $this->todoModel->updateTodo($id, $data);
    if ($success) {
      return json_encode(['message' => 'Item atualizado com sucesso.']);
    } else {
      return json_encode(['message' => 'Falha ao atualizar item.']);
    }
  }

  public function deleteTodo($id)
  {
    $success = $this->todoModel->deleteTodo($id);
    if ($success) {
      return json_encode(['message' => 'Item excluído com sucesso.']);
    } else {
      return json_encode(['message' => 'Falha ao excluir item.']);
    }
  }
}

<?php

class Todo
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function getAllTodos()
  {
    $stmt = $this->db->query('SELECT * FROM todos');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTodoById($id)
  {
    $sql = "SELECT * FROM todos WHERE id = $id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createTodo($title, $due_date)
  {
    $stmt = $this->db->prepare('INSERT INTO todos (title, due_date) VALUES (:title, :due_date)');
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':due_date', $due_date);
    return $stmt->execute();
  }

  public function updateTodo($id, $data)
  {
    $columns = preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
    $values = array_map(function ($value) {
      if ($value === null || empty($value)) return null;
      return $value;
    }, array_values($data));

    $set = '';
    for ($i = 0; $i < count($columns); $i++) {
      $set .= ($i > 0 ? ',' : '') . '`' . $columns[$i] . '`=';
      $set .= ($values[$i] === null ? 'NULL' : '"' . $values[$i] . '"');
    }

    $sql = "UPDATE todos SET $set WHERE id = $id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute();
  }

  public function deleteTodo($id)
  {
    $stmt = $this->db->prepare('DELETE FROM todos WHERE id = :id');
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }
}

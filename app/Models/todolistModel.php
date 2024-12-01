<?php

namespace App\Models;

use CodeIgniter\Model;

class todolistModel extends Model
{
  protected $table = 'todos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user_id', 'task', 'status'];

  // Mengambil semua to-do berdasarkan user_id
  public function getTodosByUser($userId)
  {
    return $this->where('user_id', $userId)->findAll();
  }

  // Menambah to-do baru untuk user tertentu
  public function addTodo($task, $userId)
  {
    $data = [
      'task' => $task,
      'user_id' => $userId,
      'status' => 'pending',
    ];
    return $this->insert($data);
  }

  // Menghitung jumlah to-do untuk user tertentu
  public function getTodoCountByUser($userId)
  {
    return $this->where('user_id', $userId)->countAllResults();
  }

  // Menandai to-do sebagai selesai
  public function completeTodo($id)
  {
    return $this->update($id, ['status' => 'completed']);
  }

  // Menghapus to-do
  public function deleteTodo($id)
  {
    return $this->delete($id);
  }
}

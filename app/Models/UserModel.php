<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id'; // Menentukan primary key tabel
    protected $allowedFields = ['username', 'password', 'api_key']; // Menambahkan 'api_key' ke allowedFields

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first(); // Mengambil pengguna berdasarkan username
    }

    public function deleteApiKey($userId)
    {
        // Update atau hapus API key berdasarkan user ID
        return $this->where('id', $userId)->set('api_key', null)->update(); // Misalkan 'api_key' adalah kolom yang menyimpan API key
    }
}

<?php

namespace App\Controllers;

use App\Models\todolistModel;

class todolistController extends BaseController
{
    protected $todolistModel;
    protected $session;

    public function __construct()
    {
        $this->todolistModel = new todolistModel();
        $this->session = \Config\Services::session(); // Mengakses session
    }

    public function index()
    {
        // Mengambil user_id dari sesi
        $userId = $this->session->get('user_id');

        // Mengambil data todo list dari model berdasarkan user_id
        $data['todos'] = $this->todolistModel->getTodosByUser($userId);

        // Tampilkan halaman todo dengan data yang diambil
        return view('todolistView', $data);
    }

    public function add()
    {
        $task = $this->request->getPost('task');
        $userId = $this->session->get('user_id');
        $currentTaskCount = $this->todolistModel->getTodoCountByUser($userId);

        if (!empty($task)) {
            if ($currentTaskCount >= 5) {
                $this->session->setFlashdata('error', 'Anda tidak dapat menambahkan lebih dari 5 tugas.');
            } else {
                $result = $this->todolistModel->addTodo($task, $userId);
                if ($result) {
                    $this->session->setFlashdata('success', 'Tugas berhasil ditambahkan.');
                } else {
                    // Tambahkan log jika insert gagal
                    log_message('error', 'Gagal menambahkan tugas: ' . json_encode($this->todolistModel->errors()));
                    $this->session->setFlashdata('error', 'Gagal menambahkan tugas. Silakan coba lagi.');
                }
            }
        }
        return redirect()->to('/todo');
    }


    public function complete($id)
    {
        // Menandai tugas sebagai selesai
        $this->todolistModel->completeTodo($id);
        // Set flashdata untuk pesan sukses
        $this->session->setFlashdata('success', 'Tugas selesai.');
        return redirect()->to('/todo');
    }

    public function delete($id)
    {
        // Menghapus tugas
        $this->todolistModel->deleteTodo($id);
        return redirect()->to('/todo');
    }
}

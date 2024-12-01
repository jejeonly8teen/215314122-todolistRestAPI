<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ApiKeyAuth implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $session = session(); // Use the session() helper function

    // Periksa apakah pengguna sudah login dan memiliki API key
    if (!$session->get('admin_logged_in') || !$session->get('api_key')) {
      return redirect()->to('/login')->with('error', 'Anda harus login.');
    }

    // Ambil API key dari database
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($session->get('user_id'));

    // Cek apakah pengguna ditemukan
    if (!$user) {
      return redirect()->to('/login')->with('error', 'Pengguna tidak ditemukan.');
    }

    // Verifikasi API key yang ada di sesi dengan yang ada di database
    if ($session->get('api_key') !== $user['api_key']) {
      return redirect()->to('/login')->with('error', 'API key tidak valid.');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Tidak ada aksi tambahan setelah request
  }
}

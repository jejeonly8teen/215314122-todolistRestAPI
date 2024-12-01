<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel(); // Pastikan ini tidak error
    }

    public function login()
    {
        // Menampilkan halaman login
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Mendapatkan user berdasarkan username
        $user = $this->userModel->getUserByUsername($username);

        // Memeriksa apakah user ada dan password cocok
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Hasilkan API key acak
                $apiKey = bin2hex(random_bytes(32));

                // Simpan API key di database
                $this->userModel->set('api_key', $apiKey)->where('id', $user['id'])->update();

                // Simpan data pengguna di sesi, termasuk API key
                $session->set([
                    'admin_logged_in' => true,
                    'user_id' => $user['id'],
                    'api_key' => $apiKey
                ]);

                return redirect()->to('/todolist');
            } else {
                // Set flashdata untuk pesan error login
                $session->setFlashdata('error', 'Username atau Password salah');
                return redirect()->to('/login');
            }
        } else {
            // Jika pengguna tidak ditemukan
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        // Ambil user ID dari session
        $userId = $session->get('user_id');

        // Jika ada user ID, lakukan penghapusan API key dari database
        if ($userId) {
            // Hancurkan API key di database
            $this->userModel->deleteApiKey($userId);
        }

        // Hancurkan session pengguna
        $session->destroy();

        // Redirect ke halaman login atau halaman utama
        return redirect()->to('/login')->with('success', 'Anda berhasil keluar.');
    }

    public function register()
    {
        // Menampilkan halaman registrasi
        return view('auth/register');
    }

    public function registerProcess()
    {
        $model = $this->userModel;
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $password_confirm = $this->request->getVar('password_confirm');

        // Memeriksa apakah username sudah ada
        if ($model->where('username', $username)->first()) {
            session()->setFlashdata('error', 'Username sudah digunakan');
            return redirect()->to('/register');
        }

        // Memeriksa apakah password dan konfirmasi password cocok
        if ($password !== $password_confirm) {
            session()->setFlashdata('error', 'Password tidak cocok');
            return redirect()->to('/register');
        }

        // Melakukan hash pada password sebelum disimpan
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Menyimpan data user baru
        $model->save([
            'username' => $username,
            'password' => $password_hash
        ]);

        // Set flashdata untuk pesan sukses registrasi
        session()->setFlashdata('success', 'Registrasi berhasil, silakan login');
        return redirect()->to('/login');
    }
}

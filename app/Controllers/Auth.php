<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login_validation()
    {
        // var_dump('oyy');exit;
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('auth');
        }

        $session = session();
        $model = new AuthModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_user' => $data['id'],
                    'username' => $data['username'],
                    'level' => $data['level'],
                    'is_login' => TRUE
                ];
                // Update last login
                $this->db->table('user')->update(['last_login' => date('Y-m-d H:i:s')], ['id' => $data['id']]);

                $session->set($ses_data);
                if ($data['level'] == 'Admin') {
                    return redirect()->to('dashboard');
                } else {
                    // dd($ses_data);
                    return redirect()->to('dashboard/skw');
                }
            } else {
                session()->setFlashdata('error', 'Password yang dimasukkan salah');
                return redirect()->to('auth');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('auth');
        }
    }

    // public function addUser($username, $password)
    // {
    //     $data = ['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'level' => 'admin', 'created_at' => date('Y-m-d H:i:s')];
    //     $insert = $this->db->table('user')->insert($data);
    //     return $insert == 1 ? 1 : 0;
    // }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth');
    }
}

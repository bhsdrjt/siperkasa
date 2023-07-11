<?php

namespace App\Controllers;

class Auth_mitra extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('auth_mitra/login');
    }

    public function login_validation()
    {
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
            return redirect()->to('auth_mitra');
        }

        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $this->db->table('mitra')->getWhere(['username' => $username])->getRowArray();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_mitra' => $data['id_mitra'],
                    'username' => $data['username'],
                    'level' => 'mitra',
                    'is_login' => TRUE
                ];
                // Update last login
                $this->db->table('mitra')->update(['last_login' => date('Y-m-d H:i:s')], ['id_mitra' => $data['id_mitra']]);

                $session->set($ses_data);
                return redirect()->to('mitra/galeri/penguatan_fungsi');
            } else {
                session()->setFlashdata('error', 'Password yang dimasukkan salah');
                return redirect()->to('auth_mitra');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('auth_mitra');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth_mitra');
    }
}

<?php

namespace App\Controllers;

class Data_master extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form']);
    }

    //=======[Data user]============
    public function user()
    {
        $data = [
            'title' => 'Data Master',
            'user' => $this->db->table('user')->getWhere(['level' => 'Admin'])->getResult()
        ];
        return view('data_master/user', $data);
    }

    public function userCreate_proccess()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');

        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => $level,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $addUser = $this->db->table('user')->insert($data);
        if ($addUser) {
            session()->setFlashdata('success', 'User berhasil ditambahkan');
        }
        return redirect()->to('data_master/user');
    }

    public function userEdit_proccess()
    {
        $id_user = $this->request->getVar('id_user');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');

        if (!empty($password)) {
            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => $level,
                'modified_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'username' => $username,
                'level' => $level,
                'modified_at' => date('Y-m-d H:i:s')
            ];
        }

        $editUser = $this->db->table('user')->update($data, ['id' => $id_user]);
        if ($editUser) {
            session()->setFlashdata('success', 'User berhasil diupdate');
        }
        return redirect()->to('data_master/user');
    }

    public function userDelete_proccess()
    {
        $id_user = $this->request->getVar('id_user');
        $deleteUser = $this->db->table('user')->delete(['id' => $id_user]);
        if (!$deleteUser) {
            session()->setFlashdata('success', 'User berhasil dihapus');
        }
        return redirect()->to('data_master/user');
    }
    //=======[End Data user]============

    //=======[Data mitra]============
    public function mitra()
    {
        $data = [
            'title' => 'Data Master',
            'mitra' => $this->db->table('mitra')->get()->getResult()
        ];
        return view('data_master/mitra', $data);
    }

    public function mitraCreate_proccess()
    {
        $nama_mitra = $this->request->getVar('nama_mitra');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $jenis_lokasi = $this->request->getVar('jenis_lokasi');

        $data = [
            'nama_mitra' => $nama_mitra,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'jenis_lokasi' => $jenis_lokasi
        ];
        $addMitra = $this->db->table('mitra')->insert($data);
        if ($addMitra) {
            session()->setFlashdata('success', 'Mitra berhasil ditambahkan');
        }
        return redirect()->to('data_master/mitra');
    }

    public function mitraEdit_proccess()
    {
        $id_mitra = $this->request->getVar('id_mitra');
        $nama_mitra = $this->request->getVar('nama_mitra');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        if (!empty($password)) {
            $data = [
                'nama_mitra' => $nama_mitra,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'modified_at' => date('Y-m-d H:i:s'),
                'jenis_lokasi' => $this->request->getVar('jenis_lokasi')
            ];
        } else {
            $data = [
                'nama_mitra' => $nama_mitra,
                'username' => $username,
                'modified_at' => date('Y-m-d H:i:s'),
                'jenis_lokasi' => $this->request->getVar('jenis_lokasi')
            ];
        }

        $editMitra = $this->db->table('mitra')->update($data, ['id_mitra' => $id_mitra]);
        if ($editMitra) {
            session()->setFlashdata('success', 'Mitra berhasil diupdate');
        }
        return redirect()->to('data_master/mitra');
    }

    public function mitraDelete_proccess()
    {
        $id_mitra = $this->request->getVar('id_mitra');
        $deleteMitra = $this->db->table('mitra')->delete(['id_mitra' => $id_mitra]);
        if (!$deleteMitra) {
            session()->setFlashdata('success', 'Mitra berhasil dihapus');
        }
        return redirect()->to('data_master/mitra');
    }
    //=======[End Data mitra]============

    //=======[Data user pelaksana]============
    public function pelaksana()
    {
        $data = [
            'title' => 'Data Master',
            'pelaksana' => $this->db->table('user')->getWhere(['level !=' => 'Admin'])->getResult()
        ];
        return view('data_master/pelaksana', $data);
    }

    public function pelaksanaEdit_proccess()
    {
        $id_pelaksana = $this->request->getVar('id_pelaksana');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');

        if (!empty($password)) {
            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => $level,
                'modified_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'username' => $username,
                'level' => $level,
                'modified_at' => date('Y-m-d H:i:s')
            ];
        }

        $editPelaksana = $this->db->table('user')->update($data, ['id' => $id_pelaksana]);
        if ($editPelaksana) {
            session()->setFlashdata('success', 'Pelaksana berhasil diupdate');
        }
        return redirect()->to('data_master/pelaksana');
    }
    //=======[End Data user pelaksana]============
}

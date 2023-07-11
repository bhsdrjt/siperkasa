<?php

namespace App\Controllers;

use App\Models\M_pembangunan_strategis_skw;
use App\Models\M_penguatan_fungsi_skw;

class Mitra extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form']);
    }

    public function penguatan_fungsi()
    {
        $model = new M_penguatan_fungsi_skw();
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        helper(['tanggal']);
        if (!empty($startDate) && !empty($endDate)) {
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['penguatan_fungsi'] = $model->penguatan_fungsi_filter($startDate, $endDate);
        } else {
            $data['penguatan_fungsi'] = $model->penguatan_fungsi(3, 'penguatan_fungsi');
            $data['pager'] = $model->pager;
            // echo "<pre>";
            // print_r($data['penguatan_fungsi']);
            // echo "</pre>";
        }
        return view('mitra/penguatan_fungsi', $data);
    }

    public function pembangunan_strategis()
    {
        $model = new M_pembangunan_strategis_skw();
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        helper(['tanggal']);
        if (!empty($startDate) && !empty($endDate)) {
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['pembangunan_strategis'] = $model->pembangunan_strategis_filter($startDate, $endDate);
        } else {
            $data['pembangunan_strategis'] = $model->pembangunan_strategis(3, 'pembangunan_strategis');
            $data['pager'] = $model->pager;
            // echo "<pre>";
            // print_r($data['pembangunan_strategis']);
            // echo "</pre>";
        }
        return view('mitra/pembangunan_strategis', $data);
    }

    public function penguatan_fungsi_info($id)
    {
        helper(['tanggal']);
        $model = new M_penguatan_fungsi_skw();
        // $data['penguatan_fungsi'] = $this->db->table('penguatan_fungsi')->getWhere(['id' => $id])->getRow();
        $data['penguatan_fungsi'] = $model->penguatan_fungsi_info($id);
        // $data['dok_penguatanFungsi'] = $this->db->table('dokumentasi_penguatan_fungsi_skw')->getWhere(['id_penguatan_fungsi_skw' => $id])->getResult();
        //dd($data);
        return view('mitra/penguatan_fungsi_info', $data);
    }

    public function pembangunan_strategis_info($id)
    {
        helper(['tanggal']);
        $model = new M_pembangunan_strategis_skw();
        $data['pembangunan_strategis'] = $model->pembangunan_strategis_info($id);
        // $data['dok_pembangunanStrategis'] = $this->db->table('dokumentasi_pembangunan_strategis_skw')->getWhere(['id_pembangunan_strategis_skw' => $id])->getResult();
        //dd($data);
        return view('mitra/pembangunan_strategis_info', $data);
    }
}

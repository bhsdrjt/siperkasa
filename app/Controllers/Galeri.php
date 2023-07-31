<?php

namespace App\Controllers;

use App\Models\M_kerja_sama;
use App\Models\M_pembangunan_strategis;
use App\Models\M_penguatan_fungsi;

class Galeri extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form']);
    }

    public function penguatan_fungsi()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        helper(['tanggal']);
        $data['title'] = 'Galeri';
        // $data['startDate'] = !empty($startDate) ? $startDate : date('Y-m-d', strtotime('-5 days'));
        // $data['endDate'] = !empty($endDate) ? $endDate : date('Y-m-d');
        if (!empty($startDate) && !empty($endDate)) {
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['penguatan_fungsi'] = $this->db->table('penguatan_fungsi')->getWhere(['tgl_awal >=' => $data['startDate'], 'tgl_awal <=' => $data['endDate']])->getResult();
        } else {
            // $data['penguatan_fungsi'] = $this->db->table('penguatan_fungsi')->get()->getResult();
            $data_penguatanFungsi = new M_penguatan_fungsi();
            $data['penguatan_fungsi'] = $data_penguatanFungsi->paginate(3, 'penguatan_fungsi');
            $data['pager'] = $data_penguatanFungsi->pager;
        }
        return view('galeri/penguatan_fungsi', $data);
    }

    public function pembangunan_strategis()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        helper(['tanggal']);
        $data['title'] = 'Galeri';
        // $data['startDate'] = isset($startDate) ? $startDate : date('Y-m-d', strtotime('-5 days'));
        // $data['endDate'] = isset($endDate) ? $endDate : date('Y-m-d');
        if (!empty($startDate) && !empty($endDate)) {
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['pembangunan_strategis'] = $this->db->table('pembangunan_strategis')->getWhere(['tgl_awal >=' => $data['startDate'], 'tgl_akhir <=' => $data['endDate']])->getResult();
        } else {
            // $data['pembangunan_strategis'] = $this->db->table('pembangunan_strategis')->get()->getResult();
            $data_pembangunanStrategis = new M_pembangunan_strategis();
            $data['pembangunan_strategis'] = $data_pembangunanStrategis->paginate(3, 'pembangunan_strategis');
            $data['pager'] = $data_pembangunanStrategis->pager;
        }
        return view('galeri/pembangunan_strategis', $data);
    }

    public function penguatan_fungsi_info($id)
    {
        helper(['tanggal']);
        // $model = new M_kerja_sama();
        $data['penguatanFungsi'] = $this->db->table('penguatan_fungsi')->getWhere(['id' => $id])->getRow();
        $data['fileRKT'] = $this->db->table('rkt_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
        $dok_penguatanFungsiSKW = [];
        if (!empty($data['fileRKT'])) {
            foreach ($data['fileRKT'] as $rkt) {
                $dok_penguatanFungsiSKW[] = $this->db->table('penguatan_fungsi_skw pfs')->join('dokumentasi_penguatan_fungsi_skw dpfs', 'dpfs.id_penguatan_fungsi_skw=pfs.id')->getWhere(['id_rkt' => $rkt->id])->getResult();
            }
        }
        // $data['dok_penguatanFungsi'] = $this->db->table('dokumentasi_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
        $data['dok_penguatanFungsi'] = $dok_penguatanFungsiSKW;
        //dd($data);
        return view('galeri/penguatan_fungsi_info', $data);
    }

    public function pembangunan_strategis_info($id)
    {
        helper(['tanggal']);
        $data['pembangunanStrategis'] = $this->db->table('pembangunan_strategis')->join('mitra', 'pembangunan_strategis.mitra = mitra.id_mitra', 'left')->getWhere(['pembangunan_strategis.id' => $id])->getRow();
        $data['fileRKT'] = $this->db->table('rkt_pembangunan_strategis')->getWhere(['id_pembangunan_strategis' => $id])->getResult();
        $dok_pembangunanStrategisSKW = [];
        if (!empty($data['fileRKT'])) {
            foreach ($data['fileRKT'] as $rkt) {
                $dok_pembangunanStrategisSKW[] = $this->db->table('pembangunan_strategis_skw pss')->join('dokumentasi_pembangunan_strategis_skw dpss', 'dpss.id_pembangunan_strategis_skw=pss.id')->getWhere(['id_rkt' => $rkt->id])->getResult();
            }
        }
        // $data['dok_pembangunanStrategis'] = $this->db->table('dokumentasi_pembangunan_strategis')->getWhere(['id_pembangunan_strategis' => $id])->getResult();
        $data['dok_pembangunanStrategis'] = $dok_pembangunanStrategisSKW;
        //dd($data);
        return view('galeri/pembangunan_strategis_info', $data);
    }
}

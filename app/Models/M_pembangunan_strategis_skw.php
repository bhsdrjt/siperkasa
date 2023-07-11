<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pembangunan_strategis_skw extends Model
{

    protected $table = 'pembangunan_strategis_skw pss';
    protected $primaryKey = 'pss.id';

    public function pembangunan_strategis_filter($startDate = '', $endDate = '')
    {
        $builder = $this->builder();
        $builder->select('pss.id,file_pks,tgl_awal,tgl_akhir,judul_laporan,nama_mitra,pss.lokasi');
        $builder->join('mitra', 'mitra.id_mitra=pss.id_mitra');
        $builder->join('rkt_pembangunan_strategis rps', 'rps.id=pss.id_rkt');
        $builder->join('pembangunan_strategis ps', 'ps.id=rps.id_penguatan_fungsi');
        if ($startDate != '' && $endDate != '') {
            $builder->where(['pss.id_mitra' => session('id_mitra'), 'ps.tgl_awal >=' => $startDate, 'ps.tgl_awal <=' => $endDate]);
        }
        $builder->groupBy('pss.id');
        return $builder->get()->getResultArray();
    }

    public function pembangunan_strategis(int $index_page)
    {
        return $this->select('pss.id,file_pks,tgl_awal,tgl_akhir,judul_laporan,nama_mitra,pss.lokasi')
            ->join('mitra', 'mitra.id_mitra = pss.id_mitra')
            ->join('rkt_pembangunan_strategis rps', 'rps.id=pss.id_rkt')
            ->join('pembangunan_strategis ps', 'ps.id=rps.id_pembangunan_strategis')
            ->where(['pss.id_mitra' => session('id_mitra')])
            ->groupBy('pss.id')
            ->paginate($index_page);
    }

    public function pembangunan_strategis_info($id) //Id ini adalah id pada tabel penguatan fungsi skw
    {
        $builder = $this->builder();
        $builder->select('*,pss.lokasi AS lokasi');
        $builder->join('mitra', 'mitra.id_mitra=pss.id_mitra');
        $builder->join('rkt_pembangunan_strategis rps', 'rps.id=pss.id_rkt');
        $builder->join('pembangunan_strategis ps', 'ps.id=rps.id_pembangunan_strategis');
        $builder->where(['pss.id' => $id]);
        $builder->groupBy('pss.id');
        return $builder->get()->getRow();
    }
}

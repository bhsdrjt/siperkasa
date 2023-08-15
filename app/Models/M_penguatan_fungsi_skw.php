<?php

namespace App\Models;

use CodeIgniter\Model;

class M_penguatan_fungsi_skw extends Model
{

    protected $table = 'penguatan_fungsi_skw pfs';
    protected $primaryKey = 'pfs.id';

    public function penguatan_fungsi_filter($startDate = '', $endDate = '')
    {
        $builder = $this->builder();
        $builder->select('pfs.id,file_pks,tgl_awal,tgl_akhir,judul_laporan,nama_mitra,pfs.lokasi');
        $builder->join('mitra', 'mitra.id_mitra=pfs.id_mitra');
        $builder->join('rkt_penguatan_fungsi rpf', 'rpf.id=pfs.id_rkt');
        $builder->join('penguatan_fungsi pf', 'pf.id=rpf.id_penguatan_fungsi');
        if ($startDate != '' && $endDate != '') {
            $builder->where(['pfs.id_mitra' => session('id_mitra'), 'pf.tgl_awal >=' => $startDate, 'pf.tgl_awal <=' => $endDate]);
        }
        $builder->groupBy('pfs.id');
        return $builder->get()->getResultArray();
    }

    public function penguatan_fungsi(int $index_page)
    {
        return $this->select('pfs.id,file_pks,tgl_awal,tgl_akhir,judul_laporan,nama_mitra,pfs.lokasi ,"Penguatan Fungsi" jenis ')
            ->join('mitra', 'mitra.id_mitra = pfs.id_mitra')
            ->join('rkt_penguatan_fungsi rpf', 'rpf.id=pfs.id_rkt')
            ->join('penguatan_fungsi pf', 'pf.id=rpf.id_penguatan_fungsi')
            ->where(['pfs.id_mitra' => session('id_mitra')])
            ->groupBy('pfs.id')
            ->paginate($index_page);
    }

    public function penguatan_fungsi_info($id) //Id ini adalah id pada tabel penguatan fungsi skw
    {
        $builder = $this->builder();
        $builder->select('*,pfs.lokasi AS lokasi');
        $builder->join('mitra', 'mitra.id_mitra=pfs.id_mitra');
        $builder->join('rkt_penguatan_fungsi rpf', 'rpf.id=pfs.id_rkt');
        $builder->join('penguatan_fungsi pf', 'pf.id=rpf.id_penguatan_fungsi');
        $builder->where(['pfs.id' => $id]);
        $builder->groupBy('pfs.id');
        return $builder->get()->getRow();
    }
}

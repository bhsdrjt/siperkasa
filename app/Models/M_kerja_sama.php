<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kerja_sama extends Model
{
    public function penguatan_fungsi()
    {
        $builder = $this->db->table('penguatan_fungsi');
        $builder->select('*');
        // $builder->join('mitra', 'mitra.id_mitra=penguatan_fungsi.mitra', 'left');
        return $builder->get()->getResult();
    }

    public function pembangunan_strategis()
    {
        $builder = $this->db->table('pembangunan_strategis');
        $builder->select('pembangunan_strategis.*, mitra.nama_mitra');
        $builder->join('mitra', 'mitra.id_mitra=pembangunan_strategis.mitra', 'left');
        return $builder->get()->getResult();
    }
    public function pembangunan_strategis_byID($id)
    {
        $builder = $this->db->table('pembangunan_strategis');
        $builder->select('pembangunan_strategis.*, mitra.nama_mitra');
        $builder->join('mitra', 'mitra.id_mitra=pembangunan_strategis.mitra', 'left');
        $builder->where(['pembangunan_strategis.id' => $id]);
        return $builder->get()->getRow();
    }

    public function pembangunan_strategis_rulingID($id)
    {
        $ruanglingkup = $this->db->table('tb_ruang_lingkup');
        $ruanglingkup->select('id, id_kerjasama, nama');
        $ruanglingkup->where('id_kerjasama', $id); // Menggunakan id sebagai contoh
        $ruanglingkupResult = $ruanglingkup->get()->getResult();

        // Inisialisasi array asosiatif untuk menyimpan data kegiatan
        $kegiatanData = [];
        $anggaranData = [];

        foreach ($ruanglingkupResult as $data) {
            $kegiatan = $this->db->table('tb_kegiatan');
            $kegiatan->select('id, id_ruang_lingkup, nama');
            $kegiatan->where('id_ruang_lingkup', $data->id); // Menggunakan id sebagai contoh
            $kegiatanResult = $kegiatan->get()->getResult();

            if (!empty($kegiatanResult)) {
                $kegiatanData[$data->id] = $kegiatanResult;

                foreach ($kegiatanResult as $kegiatanItem) {
                    $anggaran = $this->db->table('tb_anggaran');
                    $anggaran->select('*');
                    $anggaran->where('id_kegiatan', $kegiatanItem->id);
                    $anggaranResult = $anggaran->get()->getResult();

                    if (!empty($anggaranResult)) {
                        $anggaranData[$kegiatanItem->id] = $anggaranResult;
                    }
                }
            }
        }

        return [
            'ruanglingkupData' => $ruanglingkupResult,
            'kegiatanData' => $kegiatanData,
            'anggaranData' => $anggaranData,
        ];
    }


    public function penguatan_fungsi_info($id)
    {
        $builder = $this->db->table('penguatan_fungsi');
        $builder->select('*');
        // $builder->join('mitra', 'mitra.id_mitra=penguatan_fungsi.mitra', 'left');
        $builder->where(['id' => $id]);
        return $builder->get()->getRow();
    }

    public function pembangunan_strategis_info($id)
    {
        $builder = $this->db->table('pembangunan_strategis');
        $builder->select('*');
        // $builder->join('mitra', 'mitra.id_mitra=pembangunan_strategis.mitra', 'left');
        $builder->where(['id' => $id]);
        return $builder->get()->getRow();
    }

    /* Model untuk User Pelaksana atau SKW */
    public function dashboard_skw($startDate, $endDate, $jenis)
    {
        if ($jenis == 'Penguatan Fungsi') {
            $builder = $this->db->table('rkt_penguatan_fungsi rpf');
            $builder->select('rpf.id AS id_rkt,rpf.id_penguatan_fungsi,nama_rkt,komitmen_rkt,realisasi_rkt,lokasi,tgl_awal,tgl_akhir');
            $builder->join('penguatan_fungsi pf', 'pf.id=rpf.id_penguatan_fungsi');
            if ($startDate != '' && $endDate != '') {
                $builder->where(['pf.lokasi' => session('level'), 'tgl_awal >=' => $startDate, 'tgl_awal <=' => $endDate]);
            } else {
                $builder->where(['pf.lokasi' => session('level')]);
            }
            $builder->orderBy('rpf.id');
            $builder->groupBy('rpf.id');
        } else { //Jika pembangunan strategis
            $builder = $this->db->table('rkt_pembangunan_strategis rps');
            $builder->select('rps.id AS id_rkt,rps.id_pembangunan_strategis,nama_rkt,komitmen_rkt,realisasi_rkt,lokasi,tgl_awal,tgl_akhir');
            $builder->join('pembangunan_strategis ps', 'ps.id=rps.id_pembangunan_strategis');
            if ($startDate != '' && $endDate != '') {
                $builder->where(['ps.lokasi' => session('level'), 'tgl_awal >=' => $startDate, 'tgl_awal <=' => $endDate]);
            } else {
                $builder->where(['ps.lokasi' => session('level')]);
            }
            $builder->orderBy('rps.id');
            $builder->groupBy('rps.id');
        }
        return $builder->get()->getResult();
    }

    public function penguatan_fungsi_skw()
    {
        $builder = $this->db->table('penguatan_fungsi_skw pfs');
        $builder->select('*,pfs.id AS id');
        $builder->join('mitra', 'mitra.id_mitra=pfs.id_mitra', 'left');
        $builder->join('rkt_penguatan_fungsi rpf', 'rpf.id=pfs.id_rkt');
        $builder->where(['pfs.lokasi' => session('level')]);
        return $builder->get()->getResult();
    }

    // Di dalam model
    public function insertKerjasama($dataRuangLingkup, $dataProgram, $dataAnggaran)
    {
        foreach ($dataRuangLingkup as $dt) {
            $this->db->table('tb_ruang_lingkup')->insert($dt);
            $id_ruanglingkup = $this->db->insertID();
            // var_dump($dt['nama']);
            foreach ($dataProgram as $dt2) {
                // var_dump($dt2['ruang_lingkup']);
                if ($dt2['ruang_lingkup'] == $dt['nama']) {
                    $parInsert = [
                        'id_ruang_lingkup' => $id_ruanglingkup,
                        'nama' => trim($dt2['nama'])
                    ];
                    $this->db->table('tb_kegiatan')->insert($parInsert);
                    $id_kegiatan = $this->db->insertID();
                    foreach ($dataAnggaran as $dt3) {
                        if ($dt3['kegiatan'] == $dt2['nama']) {
                            foreach ($dt3['anggaranbesar'] as $dt4) {
                                // var_dump($dt4['anggaran'][]);
                                $parInsert2 = [
                                    'anggaran' => $dt4['anggaran'][0],
                                    'realisasi' => $dt4['anggaran'][1],
                                    'vol' => $dt4['anggaran'][2],
                                    'id_kegiatan' => $id_kegiatan,
                                    'jenis' => $dt4['jenis'],
                                    'periode' => $dt4['periode']
                                ];
                                $this->db->table('tb_anggaran')->insert($parInsert2);
                            }
                        }
                    }
                }
            }
        }
    }


    public function pembangunan_strategis_skw()
    {
        $builder = $this->db->table('pembangunan_strategis_skw pss');
        $builder->select('*,pss.id AS id');
        $builder->join('mitra', 'mitra.id_mitra=pss.id_mitra', 'left');
        $builder->join('rkt_pembangunan_strategis rps', 'rps.id=pss.id_rkt');
        $builder->where(['pss.lokasi' => session('level')]);
        return $builder->get()->getResult();
    }

    public function getrkt($mitraId)
    {
        $builder = $this->db->table('mitra m');
        $builder->select('m.id_mitra, rps.id, rps.nama_rkt, rps.periode')
            ->join('pembangunan_strategis ps', 'ps.mitra = m.id_mitra')
            ->join('rkt_pembangunan_strategis rps', 'rps.id_pembangunan_strategis = ps.id')
            ->where('m.id_mitra', $mitraId);
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }


    public function getRuangLingkupByMitra($mitraId)
    {
        return $this->db->table('pembangunan_strategis ps')
            ->select('trl.nama, trl.id')
            ->join('tb_ruang_lingkup trl', 'trl.id_kerjasama = ps.id', 'left')
            ->where('ps.mitra', $mitraId)
            ->where('trl.tipe_kerjasama', 'Pembangunan Strategis')
            ->get()
            ->getResult();
    }
    public function getKegiatanByRuangLingkup($ruangLingkupId)
    {
        return $this->db->table('tb_kegiatan tk')
            ->select('tk.id, tk.nama')
            ->where('tk.id_ruang_lingkup', $ruangLingkupId)
            ->get()
            ->getResult();
    }
}

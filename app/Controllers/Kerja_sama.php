<?php

namespace App\Controllers;

use App\Models\M_kerja_sama;

use function PHPUnit\Framework\isNull;

class Kerja_sama extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form']);
    }

    //=======[Data penguatan fungsi]============
    public function penguatan_fungsi()
    {
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['kerja_sama'] = $model->penguatan_fungsi();
        return view('kerja_sama/penguatan_fungsi', $data);
    }

    public function penguatan_fungsi_add()
    {
        $data['title'] = 'Kerja Sama';
        $data['mitra'] = $this->db->table('mitra')->get()->getResult();
        return view('kerja_sama/penguatan_fungsi_add', $data);
    }

    public function penguatan_fungsi_process_add()
    {


        $judul = $this->request->getPost('judul');
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $surat_pks = $this->request->getPost('surat_pks');
        $no_surat_pks = $this->request->getPost('no_surat_pks');
        $ruang_lingkup = $this->request->getPost('ruang_lingkup');

        $komitmen_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_pks')));
        $realisasi_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_pks')));
        $komitmen_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rpp')));
        $realisasi_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rpp')));
        $komitmen_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_1')));
        $realisasi_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_1')));
        $komitmen_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_2')));
        $realisasi_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_2')));

        $lokasi_kerjasama = $this->request->getPost('lokasi_kerjasama');
        $mitra = intval($this->request->getPost('mitra'));

        $data = [
            'judul' => $judul,
            'mitra' => $mitra,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'no_pks' => $no_surat_pks,
            'surat_pks' => $surat_pks,
            'ruang_lingkup' => $ruang_lingkup,
            'komitmen_pks' => $komitmen_pks,
            'realisasi_pks' => $realisasi_pks,
            'komitmen_rpp' => $komitmen_rpp,
            'realisasi_rpp' => $realisasi_rpp,
            'komitmen_rkl_1' => $komitmen_rkl_1,
            'realisasi_rkl_1' => $realisasi_rkl_1,
            'komitmen_rkl_2' => $komitmen_rkl_2,
            'realisasi_rkl_2' => $realisasi_rkl_2,
            'lokasi' => $lokasi_kerjasama,
            'created_at' => date('Y-m-d H:i:s'),
            'operator' => session('username')
        ];
        // dd($data);
        $this->db->table('penguatan_fungsi')->insert($data);
        $lastID = $this->db->insertID();

        // // ***** Proses simpan cover  *****
        // $cover = $this->request->getFile('cover');
        // if ($cover != "") {
        //     // Validasi untuk cover apakah sesuai
        //     if (!$this->validate(
        //         ['rules' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]']
        //     )) {
        //         session()->setFlashdata('error', 'Periksa ekstensi cover [jpg,jpeg,png,gif]');
        //         return redirect()->to('kerja_sama/penguatan_fungsi/add');
        //     } else {
        //         // Pindahkan filenya sesuai path
        //         $nama_fileCover = $cover->getRandomName();
        //         $uploadCover = $cover->move('uploads/penguatan_fungsi/cover/', $nama_fileCover);
        //         if (!$uploadCover) {
        //             session()->setFlashdata('error', 'Gagal menyimpan foto');
        //         } else {
        //             $this->db->table('penguatan_fungsi')->update(['gambar_cover' => $nama_fileCover], ['id' => $lastID]);
        //         }
        //     }
        // }
        // // ***** Proses simpan cover  End *****

        // ***** Proses simpan file  *****
        $file_surat_pks = $this->request->getFile('file_surat_pks');
        if ($file_surat_pks != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_surat_pks', $file_surat_pks, 'Surat Persetujuan PKS', 'file_surat_pks', $lastID);
        }

        $file_pks = $this->request->getFile('file_pks');
        if ($file_pks != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_pks', $file_pks, 'Dokumen PKS', 'file_pks', $lastID);
        }

        $file_rpp = $this->request->getFile('file_rpp');
        if ($file_rpp != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rpp', $file_rpp, 'Dokumen RPP', 'file_rpp', $lastID);
        }

        $file_rkl_1 = $this->request->getFile('file_rkl_1');
        if ($file_rkl_1 != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rkl_1', $file_rkl_1, 'Dokumen RKL 1', 'file_rkl_1', $lastID);
        }

        $file_rkl_2 = $this->request->getFile('file_rkl_2');
        if ($file_rkl_2 != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rkl_2', $file_rkl_2, 'Dokumen RKL 2', 'file_rkl_2', $lastID);
        }

        // ***** Proses simpan file End *****

        // ***** Proses simpan file_rkt *****
        if ($this->request->getFileMultiple('file_rkt')) {
            $index = 0;
            foreach ($this->request->getFileMultiple('file_rkt') as $file) {
                // Pindahkan filenya sesuai path
                $namaFile = $file->getRandomName();
                $uploadFile = $file->move('uploads/penguatan_fungsi/file/', $namaFile);
                if (!$uploadFile) {
                    echo session()->setFlashdata('error', 'Gagal menyimpan foto dokumentasi');
                } else {
                    $data = [
                        'id_penguatan_fungsi' => $lastID,
                        'nama_rkt' => $this->request->getPost('nama_rkt')[$index],
                        'file_rkt' => $namaFile,
                        'komitmen_rkt' => $this->request->getPost('komitmen_rkt')[$index],
                        'realisasi_rkt' => $this->request->getPost('realisasi_rkt')[$index],
                    ];
                    $this->db->table('rkt_penguatan_fungsi')->insert($data);
                }
                $index++;
            }
        }
        // ***** Proses simpan file_rkt End *****

        $file_lokasi = $this->request->getFile('file_lokasi');
        if ($file_lokasi != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_lokasi_penguatan_fungsi('file_lokasi', $file_lokasi, 'File Lokasi Kerja Sama', 'file_lokasi', $lastID);
        }

        return redirect()->to('kerja_sama/penguatan_fungsi');
    }
    //=======[End Data penguatan fungsi]============


    function upload_file_penguatan_fungsi($nameForm, $fileSurat, $label, $field, $lastID)
    {
        // dd([$nameForm, $fileSurat, $label, $field, $lastID]);
        // Validasi untuk file apakah sesuai
        if (!$this->validate(
            ['rules' => 'uploaded[' . $nameForm . ']|mime_in[' . $nameForm . ',application/pdf]']
        )) {
            session()->setFlashdata('error', 'Periksa ekstensi file ' . $label . ', harus [pdf]');
            return redirect()->to('kerja_sama/penguatan_fungsi/add');
        } else {
            // Pindahkan filenya sesuai path
            $nama_fileSurat = $fileSurat->getRandomName();
            $uploadFileSurat = $fileSurat->move('uploads/penguatan_fungsi/file/', $nama_fileSurat);
            if (!$uploadFileSurat) {
                session()->setFlashdata('error', 'Gagal menyimpan file ' . $label);
                return redirect()->to('kerja_sama/penguatan_fungsi_add');
            } else {
                $this->db->table('penguatan_fungsi')->update(['' . $field . '' => $nama_fileSurat], ['id' => $lastID]);
                return TRUE;
            }
        }
    }

    function upload_file_lokasi_penguatan_fungsi($nameForm, $fileLokasi, $label, $field, $lastID)
    {
        // dd([$nameForm, $fileSurat, $label, $field, $lastID]);
        // Validasi untuk file apakah sesuai
        if (!$this->validate(
            ['rules' => 'uploaded[' . $nameForm . ']|mime_in[' . $nameForm . ',application/vnd.google-earth.kml+xml,application/xml,text/xml]']
        )) {
            session()->setFlashdata('error', 'Periksa ekstensi file ' . $label . ', harus .kml');
            return redirect()->to('kerja_sama/penguatan_fungsi/add');
        } else {
            // Pindahkan filenya sesuai path
            $nama_fileLokasi = $fileLokasi->getRandomName();
            $uploadFileLokasi = $fileLokasi->move('uploads/penguatan_fungsi/file/', $nama_fileLokasi);
            if (!$uploadFileLokasi) {
                session()->setFlashdata('error', 'Gagal menyimpan file ' . $label);
                return redirect()->to('kerja_sama/penguatan_fungsi_add');
            } else {
                $this->db->table('penguatan_fungsi')->update(['' . $field . '' => $nama_fileLokasi], ['id' => $lastID]);
                return TRUE;
            }
        }
    }

    public function penguatan_fungsi_edit($id)
    {
        $data['surat'] = $this->db->table('penguatan_fungsi')->getWhere(['id' => $id])->getRow();
        $data['mitra'] = $this->db->table('mitra')->get()->getResult();
        $data['fileRKT'] = $this->db->table('rkt_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
        return view('kerja_sama/penguatan_fungsi_edit', $data);
    }

    public function penguatan_fungsi_process_edit()
    {
        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $surat_pks = $this->request->getPost('surat_pks');
        $no_surat_pks = $this->request->getPost('no_surat_pks');
        $ruang_lingkup = $this->request->getPost('ruang_lingkup');

        $komitmen_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_pks')));
        $realisasi_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_pks')));
        $komitmen_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rpp')));
        $realisasi_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rpp')));
        $komitmen_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_1')));
        $realisasi_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_1')));
        $komitmen_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_2')));
        $realisasi_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_2')));

        $lokasi_kerjasama = $this->request->getPost('lokasi_kerjasama');

        $data = [
            'judul' => $judul,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'no_pks' => $no_surat_pks,
            'surat_pks' => $surat_pks,
            'ruang_lingkup' => $ruang_lingkup,
            'komitmen_pks' => $komitmen_pks,
            'realisasi_pks' => $realisasi_pks,
            'komitmen_rpp' => $komitmen_rpp,
            'realisasi_rpp' => $realisasi_rpp,
            'komitmen_rkl_1' => $komitmen_rkl_1,
            'realisasi_rkl_1' => $realisasi_rkl_1,
            'komitmen_rkl_2' => $komitmen_rkl_2,
            'realisasi_rkl_2' => $realisasi_rkl_2,
            'lokasi' => $lokasi_kerjasama,
            'modified_at' => date('Y-m-d H:i:s'),
            'operator' => session('username')
        ];
        $this->db->table('penguatan_fungsi')->update($data, ['id' => $id]);

        // Get data penguatan fungsi
        $penguatanFungsi = $this->db->table('penguatan_fungsi')->getWhere(['id' => $id])->getRow();
        // ***** Proses simpan cover  *****
        // $cover = $this->request->getFile('cover');
        // if ($cover != "") {
        //     // Validasi untuk cover apakah sesuai
        //     if (!$this->validate(
        //         ['rules' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]']
        //     )) {
        //         session()->setFlashdata('error', 'Periksa ekstensi cover [jpg,jpeg,png,gif]');
        //         return redirect()->to('kerja_sama/penguatan_fungsi/edit/' . $id);
        //     } else {
        //         // Hapus dulu file lama
        //         if (!empty($penguatanFungsi->gambar_cover)) {
        //             unlink('uploads/penguatan_fungsi/cover/' . $penguatanFungsi->gambar_cover);
        //         }

        //         // Pindahkan filenya sesuai path
        //         $nama_fileCover = $cover->getRandomName();
        //         $uploadCover = $cover->move('uploads/penguatan_fungsi/cover/', $nama_fileCover);
        //         if (!$uploadCover) {
        //             session()->setFlashdata('error', 'Gagal menyimpan foto');
        //         } else {
        //             $this->db->table('penguatan_fungsi')->update(['gambar_cover' => $nama_fileCover], ['id' => $id]);
        //         }
        //     }
        // }
        // ***** Proses simpan cover  End *****

        // ***** Proses simpan file  *****
        $file_surat_pks = $this->request->getFile('file_surat_pks');
        if ($surat_pks != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_surat_pks)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_surat_pks);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_surat_pks', $file_surat_pks, 'File Surat Persetujuan PKS', 'file_surat_pks', $id);
        }

        $file_pks = $this->request->getFile('file_pks');
        if ($file_pks != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_pks)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_pks);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_pks', $file_pks, 'Dokumen PKS', 'file_pks', $id);
        }

        $file_rpp = $this->request->getFile('file_rpp');
        if ($file_rpp != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_rpp)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_rpp);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rpp', $file_rpp, 'Dokumen RPP', 'file_rpp', $id);
        }

        $file_rkl_1 = $this->request->getFile('file_rkl_1');
        if ($file_rkl_1 != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_rkl_1)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_rkl_1);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rkl_1', $file_rkl_1, 'Dokumen RKL 1', 'file_rkl_1', $id);
        }

        $file_rkl_2 = $this->request->getFile('file_rkl_2');
        if ($file_rkl_2 != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_rkl_2)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_rkl_2);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rkl_2', $file_rkl_2, 'Dokumen RKL 2', 'file_rkl_2', $id);
        }

        $file_rkt = $this->request->getFile('file_rkt');
        if ($file_rkt != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_rkt)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_rkt);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi('file_rkt', $file_rkt, 'Dokumen RKT', 'file_rkt', $id);
        }
        // ***** Proses simpan file End *****

        // ***** Proses simpan file RKT *****
        $fileRKT = $this->request->getFileMultiple('file_rkt');
        //dd($fotoKerjaSama);
        if (!empty($fileRKT)) {
            // Hapus dulu file nya baru dimasukkan ulang yg baru
            $get_dataFile = $this->db->table('rkt_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
            if (!empty($get_dataFile)) {
                foreach ($get_dataFile as $data) {
                    unlink('uploads/penguatan_fungsi/file/' . $data->file_rkt);
                }
            }
            $this->db->table('rkt_penguatan_fungsi')->delete(['id_penguatan_fungsi' => $id]);

            $index = 0;
            foreach ($fileRKT as $file) {
                // Pindahkan filenya sesuai path jika ada
                $namaFile = $file->getRandomName();
                $uploadFile = $file->move('uploads/penguatan_fungsi/file/', $namaFile);
                if (!$uploadFile) {
                    echo session()->setFlashdata('error', 'Gagal menyimpan file RKT');
                } else {
                    $data = [
                        'id_penguatan_fungsi' => $id,
                        'nama_rkt' => $this->request->getPost('nama_rkt')[$index],
                        'file_rkt' => $namaFile,
                        'komitmen_rkt' => $this->request->getPost('komitmen_rkt')[$index],
                        'realisasi_rkt' => $this->request->getPost('realisasi_rkt')[$index],
                    ];
                    $this->db->table('rkt_penguatan_fungsi')->insert($data);
                    $index++;
                }
            }
        }
        // ***** Proses simpan file RKT End *****

        $file_lokasi = $this->request->getFile('file_lokasi');
        if ($file_lokasi != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_lokasi)) {
                unlink('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_lokasi);
            }

            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_lokasi_penguatan_fungsi('file_lokasi', $file_lokasi, 'File Lokasi Kerja Sama', 'file_lokasi', $id);
        }

        return redirect()->to('kerja_sama/penguatan_fungsi');
    }

    public function penguatan_fungsi_process_delete()
    {
        $id = $this->request->getPost('id');

        // Proses delete foto dokumentasi
        // $get_dataFoto = $this->db->table('dokumentasi_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
        // if (!empty($get_dataFoto)) {
        //     foreach ($get_dataFoto as $foto) {
        //         unlink('uploads/penguatan_fungsi/dokumentasi/' . $foto->gambar);
        //     }
        // }
        // $this->db->table('dokumentasi_penguatan_fungsi')->delete(['id_penguatan_fungsi' => $id]);

        // Proses delete file RKT
        $get_dataRKT = $this->db->table('rkt_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
        if (!empty($get_dataRKT)) {
            foreach ($get_dataRKT as $rkt) {
                unlink('uploads/penguatan_fungsi/file/' . $rkt->file_rkt);
            }
        }
        $this->db->table('rkt_penguatan_fungsi')->delete(['id_penguatan_fungsi' => $id]);

        // Proses hapus penguatan fungsi
        $hapus = $this->db->table('penguatan_fungsi')->delete(['id' => $id]);
        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
        }
        return redirect()->to('kerja_sama/penguatan_fungsi');
    }
    //=======[End Data penguatan fungsi]============

    //=======[Data pembangunan strategis]============
    public function pembangunan_strategis()
    {
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['kerja_sama'] = $model->pembangunan_strategis();
        return view('kerja_sama/pembangunan_strategis', $data);
    }

    public function pembangunan_strategis_add()
    {
        $data['title'] = 'Kerja Sama';
        $data['mitra'] = $this->db->table('mitra')->get()->getResult();
        return view('kerja_sama/pembangunan_strategis_add', $data);
    }

    public function pembangunan_strategis_process_add()
    {

        // foreach ($newData as $row) {
        //     if (count($row) === 6) {
        //         $ruangLingkup = $row[0]; // Ambil nilai ruang lingkup dari baris utama

        //         $program = $row[1]; // Ambil nilai program dari baris saat ini
        //         $anggaran = $row[2];
        //         $realisasi = $row[3];
        //         $jlhanggaran = $row[4];
        //         $jlhrealisasi = $row[5];

        //         // Lakukan proses penyimpanan ke tabel ruang_lingkup_detail di sini
        //         // Contoh:
        //         $dataRuangLingkupDetail = [
        //             'ruang_lingkup' => $ruangLingkup,
        //             'program' => $program,
        //             'anggaran' => $anggaran,
        //             'realisasi' => $realisasi,
        //             'jlhanggaran' => $jlhanggaran,
        //             'jlhrealisasi' => $jlhrealisasi
        //         ];

        //         // dd($dataRuangLingkupDetail);exit;
        //         $this->db->table('ruang_lingkup_detail')->insert($dataRuangLingkupDetail);

        //         $idSamaValue = date('YmdHi'); // Format: YYYYMMDDHHmm
        //         $ruangLingkup = $ruangLingkup; // Ambil nilai dari kolom kedua
        //         $ruangLingkupIdSama = $idSamaValue;
        //         $tahun = date("Y");
        //         // Ganti dengan tahun yang sesuai

        //         // Lakukan proses penyimpanan ke tabel ruang_lingkup di sini
        //         // Contoh:
        //         $dataRuangLingkup = [
        //             'id_sama' => $ruangLingkupIdSama,
        //             'ruang_lingkup' => $ruangLingkup,
        //             'tahun' => $tahun
        //         ];

        //         $existingData = $this->db->table('ruang_lingkup')
        //             ->getWhere(['id_sama' => $dataRuangLingkup['id_sama'], 'ruang_lingkup' => $dataRuangLingkup['ruang_lingkup']])
        //             ->getRow();

        //         if ($existingData) {
        //             // Data already exists, handle accordingly
        //             // ...
        //         } else {
        //             // Data doesn't exist, proceed with insertion
        //             $this->db->table('ruang_lingkup')->insert($dataRuangLingkup);
        //             // ...
        //         }
        //     } else if (count($row) === 8) {
        //         $ruangLingkup = $row[0]; // Ambil nilai ruang lingkup dari baris utama

        //         $program = $row[1]; // Ambil nilai program dari baris saat ini
        //         $anggaran = $row[2];
        //         $realisasi = $row[3];
        //         $anggaran1 = $row[4];
        //         $realisasi1 = $row[5];
        //         $jlhanggaran = $row[6];
        //         $jlhrealisasi = $row[7];

        //         // Lakukan proses penyimpanan ke tabel ruang_lingkup_detail di sini
        //         // Contoh:
        //         $dataRuangLingkupDetail = [
        //             'ruang_lingkup' => $ruangLingkup,
        //             'program' => $program,
        //             'anggaran' => $anggaran,
        //             'realisasi' => $realisasi,
        //             'anggaran1' => $anggaran1,
        //             'realisasi1' => $realisasi1,
        //             'jlhanggaran' => $jlhanggaran,
        //             'jlhrealisasi' => $jlhrealisasi
        //         ];
        //         $this->db->table('ruang_lingkup_detail')->insert($dataRuangLingkupDetail);

        //         $idSamaValue = date('YmdHi'); // Format: YYYYMMDDHHmm
        //         $ruangLingkup = $ruangLingkup; // Ambil nilai dari kolom kedua
        //         $ruangLingkupIdSama = $idSamaValue;
        //         $tahun = date("Y");
        //         $tahun1 = date("Y") + 1;
        //         // Ganti dengan tahun yang sesuai

        //         // Lakukan proses penyimpanan ke tabel ruang_lingkup di sini
        //         // Contoh:
        //         $dataRuangLingkup = [
        //             'id_sama' => $ruangLingkupIdSama,
        //             'ruang_lingkup' => $ruangLingkup,
        //             'tahun' => $tahun,
        //             'tahun1' => $tahun1
        //         ];

        //         $existingData = $this->db->table('ruang_lingkup')
        //             ->getWhere(['id_sama' => $dataRuangLingkup['id_sama'], 'ruang_lingkup' => $dataRuangLingkup['ruang_lingkup']])
        //             ->getRow();

        //         if ($existingData) {
        //             // Data already exists, handle accordingly
        //             // ...
        //         } else {
        //             // Data doesn't exist, proceed with insertion
        //             $this->db->table('ruang_lingkup')->insert($dataRuangLingkup);
        //             // ...
        //         }
        //     } else if (count($row) === 10) {
        //         $ruangLingkup = $row[0]; // Ambil nilai ruang lingkup dari baris utama

        //         $program = $row[1]; // Ambil nilai program dari baris saat ini
        //         $anggaran = $row[2];
        //         $realisasi = $row[3];
        //         $anggaran1 = $row[4];
        //         $realisasi1 = $row[5];
        //         $anggaran2 = $row[6];
        //         $realisasi2 = $row[7];
        //         $jlhanggaran = $row[8];
        //         $jlhrealisasi = $row[9];

        //         // Lakukan proses penyimpanan ke tabel ruang_lingkup_detail di sini
        //         // Contoh:
        //         $dataRuangLingkupDetail = [
        //             'ruang_lingkup' => $ruangLingkup,
        //             'program' => $program,
        //             'anggaran' => $anggaran,
        //             'realisasi' => $realisasi,
        //             'anggaran1' => $anggaran1,
        //             'realisasi1' => $realisasi1,
        //             'anggaran2' => $anggaran2,
        //             'realisasi2' => $realisasi2,
        //             'jlhanggaran' => $jlhanggaran,
        //             'jlhrealisasi' => $jlhrealisasi
        //         ];
        //         $this->db->table('ruang_lingkup_detail')->insert($dataRuangLingkupDetail);


        //         $idSamaValue = date('YmdHi'); // Format: YYYYMMDDHHmm
        //         $ruangLingkup = $ruangLingkup; // Ambil nilai dari kolom kedua
        //         $ruangLingkupIdSama = $idSamaValue;
        //         $tahun = date("Y");
        //         $tahun1 = date("Y") + 1;
        //         $tahun2 = date("Y") + 2;
        //         // Ganti dengan tahun yang sesuai

        //         // Lakukan proses penyimpanan ke tabel ruang_lingkup di sini
        //         // Contoh:
        //         $dataRuangLingkup = [
        //             'id_sama' => $ruangLingkupIdSama,
        //             'ruang_lingkup' => $ruangLingkup,
        //             'tahun' => $tahun,
        //             'tahun1' => $tahun1,
        //             'tahun2' => $tahun2
        //         ];

        //         $existingData = $this->db->table('ruang_lingkup')
        //             ->getWhere(['id_sama' => $dataRuangLingkup['id_sama'], 'ruang_lingkup' => $dataRuangLingkup['ruang_lingkup']])
        //             ->getRow();

        //         if ($existingData) {
        //             // Data already exists, handle accordingly
        //             // ...
        //         } else {
        //             // Data doesn't exist, proceed with insertion
        //             $this->db->table('ruang_lingkup')->insert($dataRuangLingkup);
        //             // ...
        //         }
        //     }
        // }


        // $tableData = json_decode($tableDataJSON);

        $judul = $this->request->getPost('judul');

        // var_dump($judul);exit;

        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $surat_pks = $this->request->getPost('surat_pks');
        $no_surat_pks = $this->request->getPost('no_surat_pks');
        $ruang_lingkup = $this->request->getPost('ruang_lingkup');

        $komitmen_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_pks')));
        $realisasi_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_pks')));
        $komitmen_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rpp')));
        $realisasi_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rpp')));
        $komitmen_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_1')));
        $realisasi_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_1')));
        $komitmen_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_2')));
        $realisasi_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_2')));

        $lokasi_kerjasama = $this->request->getPost('lokasi_kerjasama');
        $mitra = intval($this->request->getPost('mitra'));

        $data = [
            'judul' => $judul,
            'mitra' => $mitra,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'no_pks' => $no_surat_pks,
            'surat_pks' => $surat_pks,
            'ruang_lingkup' => $ruang_lingkup,
            'komitmen_pks' => $komitmen_pks,
            'realisasi_pks' => $realisasi_pks,
            'komitmen_rpp' => $komitmen_rpp,
            'realisasi_rpp' => $realisasi_rpp,
            'komitmen_rkl_1' => $komitmen_rkl_1,
            'realisasi_rkl_1' => $realisasi_rkl_1,
            'komitmen_rkl_2' => $komitmen_rkl_2,
            'realisasi_rkl_2' => $realisasi_rkl_2,
            'lokasi' => $lokasi_kerjasama,
            'created_at' => date('Y-m-d H:i:s'),
            'operator' => session('username')
        ];
        // dd($data);exit;
        $this->db->table('pembangunan_strategis')->insert($data);
        $lastID = $this->db->insertID();


        $tableDataJSON = $this->request->getPost('table_data');
        $tableDataArray = json_decode($tableDataJSON, true);
        // dd($tableDataArray);
        $newData = [];
        $currentValue = "";

        foreach ($tableDataArray as $row) {
            if (!empty($row[0])) {
                $currentValue = $row[1];
            }

            if ($row[0] == 'Total') {
                $newRow = ['Total'];
                for ($i = 1; $i < count($row); $i++) {
                    $newRow[] = $row[$i];
                }
            } else {
                $newRow = [$currentValue];
                for ($i = 1; $i < count($row); $i++) {
                    $newRow[] = $row[$i];
                }
            }
            $newData[] = $newRow;
        };


        $dataRuangLingkup = [];
        $dataProgram = [];
        $dataTotal = [];
        $dataAnggaran = [];
        $periode = $this->request->getPost('periode');
        foreach ($newData as $data) {
            if (count($data) === 3) {
                // $dataRuangLingkup[] = $data[1];
                $dataRuangLingkup[] = [
                    'id_kerjasama' => $lastID,
                    'nama' => $data[1],
                    'tipe_kerjasama' => 'Pembangunan Strategis'
                ];
            } else if ($data[0] != 'Total') {
                $dataProgram[] = [
                    'ruang_lingkup' => $data[0],
                    'nama' => $data[1]
                ];

                $pairs = [];

                for ($i = 2; $i < count($data); $i += 3) {
                    $pair = [];
                    $pair['anggaran'] = [$data[$i]];
                    $pair['jenis'] = 'anggaran';

                    $periodeIndex = ($i - 2) / 3; // Menggunakan pembagian 3 karena sekarang kita ingin pair
                    if ($periodeIndex <= count($periode)) {
                        $pair['periode'] = isset($periode[$periodeIndex]) ? $periode[$periodeIndex] : '';
                    }

                    if ($i + 1 < count($data)) {
                        $pair['anggaran'][] = $data[$i + 1];
                    }

                    if ($i + 2 < count($data)) {
                        $pair['anggaran'][] = $data[$i + 2];
                    }

                    $pairs[] = $pair;
                }


                if (!empty($pairs)) {
                    $lastIndex = count($pairs) - 1;
                    $pairs[$lastIndex]['jenis'] = 'total';
                }

                $dataAnggaran[] = [
                    'kegiatan' =>  $data[1],
                    'anggaranbesar' => $pairs
                ];
            } else {
                $dataTotal[] = [$data];
            }
        }

        // dd($dataAnggaran);
        // exit;

        // foreach ($dataRuangLingkup as $dt) {
        //     $this->db->table('tb_ruang_lingkup')->insert($dt);
        //     $id_ruanglingkup = $this->db->insertID();
        //     // var_dump($dt['nama']);
        //     foreach ($dataProgram as $dt2) {
        //         // var_dump($dt2['ruang_lingkup']);
        //         if ($dt2['ruang_lingkup'] == $dt['nama']) {
        //             $parInsert = [
        //                 'id_ruang_lingkup' => $id_ruanglingkup,
        //                 'nama' => trim($dt2['nama'])
        //             ];
        //             $this->db->table('tb_kegiatan')->insert($parInsert);
        //             $id_kegiatan = $this->db->insertID();
        //             foreach ($dataAnggaran as $dt3) {
        //                 if ($dt3['kegiatan'] == $dt2['nama']) {
        //                     foreach ($dt3['anggaranbesar'] as $dt4) {
        //                         // var_dump($dt4['anggaran'][]);
        //                         $parInsert2 = [
        //                             'anggaran' => $dt4['anggaran'][0],
        //                             'realisasi' => $dt4['anggaran'][1],
        //                             'vol' => $dt4['anggaran'][2],
        //                             'id_kegiatan' => $id_kegiatan,
        //                             'jenis' => $dt4['jenis'],
        //                             'periode' => $dt4['periode']
        //                         ];
        //                         $this->db->table('tb_anggaran')->insert($parInsert2);
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        $model = new M_kerja_sama();
        try {
            $model->insertKerjasama($dataRuangLingkup, $dataProgram, $dataAnggaran);
            // Handle jika penyimpanan berhasil
        } catch (Exception $e) {
            // Handle kesalahan jika ada
            echo 'Terjadi kesalahan: ' . $e->getMessage();
        }



        // dd($parInsert);
        // exit;
        // // ***** Proses simpan cover  *****
        // $cover = $this->request->getFile('cover');
        // if ($cover != "") {
        //     // Validasi untuk cover apakah sesuai
        //     if (!$this->validate(
        //         ['rules' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]']
        //     )) {
        //         session()->setFlashdata('error', 'Periksa ekstensi cover [jpg,jpeg,png,gif]');
        //         return redirect()->to('kerja_sama/pembangunan_strategis/add');
        //     } else {
        //         // Pindahkan filenya sesuai path
        //         $nama_fileCover = $cover->getRandomName();
        //         $uploadCover = $cover->move('uploads/pembangunan_strategis/cover/', $nama_fileCover);
        //         if (!$uploadCover) {
        //             session()->setFlashdata('error', 'Gagal menyimpan foto');
        //         } else {
        //             $this->db->table('pembangunan_strategis')->update(['gambar_cover' => $nama_fileCover], ['id' => $lastID]);
        //         }
        //     }
        // }
        // // ***** Proses simpan cover  End *****

        // ***** Proses simpan file  *****
        $file_surat_pks = $this->request->getFile('file_surat_pks');
        if ($file_surat_pks) {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_surat_pks', $file_surat_pks, 'Surat Persetujuan PKS', 'file_surat_pks', $lastID);
        }

        $file_pks = $this->request->getFile('file_pks');
        if ($file_pks) {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_pks', $file_pks, 'Dokumen PKS', 'file_pks', $lastID);
        }

        $file_rpp = $this->request->getFile('file_rpp');
        if ($file_rpp) {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rpp', $file_rpp, 'Dokumen RPP', 'file_rpp', $lastID);
        }

        $file_rkl_1 = $this->request->getFile('file_rkl_1');
        if ($file_rkl_1) {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rkl_1', $file_rkl_1, 'Dokumen RKL 1', 'file_rkl_1', $lastID);
        }

        $file_rkl_2 = $this->request->getFile('file_rkl_2');
        if ($file_rkl_2) {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rkl_2', $file_rkl_2, 'Dokumen RKL 2', 'file_rkl_2', $lastID);
        }

        // ***** Proses simpan file End *****

        // ***** Proses simpan file_rkt *****
        if ($this->request->getFileMultiple('file_rkt')) {
            $index = 0;
            foreach ($this->request->getFileMultiple('file_rkt') as $file) {
                // Pindahkan filenya sesuai path
                $namaFile = $file->getRandomName();
                $uploadFile = $file->move('uploads/pembangunan_strategis/file/', $namaFile);
                if (!$uploadFile) {
                    echo session()->setFlashdata('error', 'Gagal menyimpan foto dokumentasi');
                } else {
                    $data = [
                        'id_pembangunan_strategis' => $lastID,
                        'nama_rkt' => $this->request->getPost('nama_rkt')[$index],
                        'file_rkt' => $namaFile,
                        'komitmen_rkt' => $this->request->getPost('komitmen_rkt')[$index],
                        'realisasi_rkt' => $this->request->getPost('realisasi_rkt')[$index],
                        'periode' => $this->request->getPost('periode')[$index],
                    ];
                    $this->db->table('rkt_pembangunan_strategis')->insert($data);
                }
                $index++;
            }
        }
        // ***** Proses simpan file_rkt End *****

        $file_lokasi = $this->request->getFile('file_lokasi');
        if ($file_lokasi) {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_lokasi_pembangunan_strategis('file_lokasi', $file_lokasi, 'File Lokasi Kerja Sama', 'file_lokasi', $lastID);
        }

        return redirect()->to('kerja_sama/pembangunan_strategis');
    }

    function upload_file_pembangunan_strategis($nameForm, $fileSurat, $label, $field, $lastID)
    {
        // dd([$nameForm, $fileSurat, $label, $field, $lastID]);
        // Validasi untuk file apakah sesuai
        if (!$this->validate(
            ['rules' => 'uploaded[' . $nameForm . ']|mime_in[' . $nameForm . ',application/pdf]']
        )) {
            session()->setFlashdata('error', 'Periksa ekstensi file ' . $label . ', harus [pdf]');
            return redirect()->to('kerja_sama/pembangunan_strategis/add');
        } else {
            // Pindahkan filenya sesuai path
            $nama_fileSurat = $fileSurat->getRandomName();
            $uploadFileSurat = $fileSurat->move('uploads/pembangunan_strategis/file/', $nama_fileSurat);
            if (!$uploadFileSurat) {
                session()->setFlashdata('error', 'Gagal menyimpan file ' . $label);
                return redirect()->to('kerja_sama/pembangunan_strategis_add');
            } else {
                $this->db->table('pembangunan_strategis')->update(['' . $field . '' => $nama_fileSurat], ['id' => $lastID]);
                return TRUE;
            }
        }
    }

    function upload_file_lokasi_pembangunan_strategis($nameForm, $fileLokasi, $label, $field, $lastID)
    {
        // dd([$nameForm, $fileSurat, $label, $field, $lastID]);
        // Validasi untuk file apakah sesuai
        if (!$this->validate(
            ['rules' => 'uploaded[' . $nameForm . ']|mime_in[' . $nameForm . ',application/vnd.google-earth.kml+xml,application/xml,text/xml]']
        )) {
            session()->setFlashdata('error', 'Periksa ekstensi file ' . $label . ', harus .kml');
            return redirect()->to('kerja_sama/pembangunan_strategis/add');
        } else {
            // Pindahkan filenya sesuai path
            $nama_fileLokasi = $fileLokasi->getRandomName();
            $uploadFileLokasi = $fileLokasi->move('uploads/pembangunan_strategis/file/', $nama_fileLokasi);
            if (!$uploadFileLokasi) {
                session()->setFlashdata('error', 'Gagal menyimpan file ' . $label);
                return redirect()->to('kerja_sama/pembangunan_strategis_add');
            } else {
                $this->db->table('pembangunan_strategis')->update(['' . $field . '' => $nama_fileLokasi], ['id' => $lastID]);
                return TRUE;
            }
        }
    }

    public function pembangunan_strategis_edit($id)
    {
        // $data['surat'] = $this->db->table('pembangunan_strategis')->getWhere(['id' => $id])->getRow();
        $model = new M_kerja_sama();
        $data['ruanglingkup'] = $model->pembangunan_strategis_rulingID($id);
        $data['surat'] = $model->pembangunan_strategis_byID($id);
        // var_dump($data['ruanglingkup']);
        // dd($data['surat']);
        // exit;
        $data['mitra'] = $this->db->table('mitra')->get()->getResult();
        $data['fileRKT'] = $this->db->table('rkt_pembangunan_strategis')->getWhere(['id_pembangunan_strategis' => $id])->getResult();
        $data['jumlahPeriode'] = count($data['fileRKT']);
        // var_dump($data['fileRKT'][0]->periode);
        // var_dump($data['fileRKT']->periode);
        return view('kerja_sama/pembangunan_strategis_edit', $data);
    }

    public function pembangunan_strategis_process_edit()
    {
        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $surat_pks = $this->request->getPost('surat_pks');
        $no_surat_pks = $this->request->getPost('no_surat_pks');
        $ruang_lingkup = $this->request->getPost('ruang_lingkup');

        $komitmen_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_pks')));
        $realisasi_pks = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_pks')));
        $komitmen_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rpp')));
        $realisasi_rpp = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rpp')));
        $komitmen_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_1')));
        $realisasi_rkl_1 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_1')));
        $komitmen_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('komitmen_rkl_2')));
        $realisasi_rkl_2 = intval(str_replace(['Rp', '.'], '', $this->request->getPost('realisasi_rkl_2')));

        $lokasi_kerjasama = $this->request->getPost('lokasi_kerjasama');
        $mitra = intval($this->request->getPost('mitra'));

        $data = [
            'judul' => $judul,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'no_pks' => $no_surat_pks,
            'surat_pks' => $surat_pks,
            'ruang_lingkup' => $ruang_lingkup,
            'komitmen_pks' => $komitmen_pks,
            'realisasi_pks' => $realisasi_pks,
            'komitmen_rpp' => $komitmen_rpp,
            'realisasi_rpp' => $realisasi_rpp,
            'komitmen_rkl_1' => $komitmen_rkl_1,
            'realisasi_rkl_1' => $realisasi_rkl_1,
            'komitmen_rkl_2' => $komitmen_rkl_2,
            'realisasi_rkl_2' => $realisasi_rkl_2,
            'lokasi' => $lokasi_kerjasama,
            'mitra' => $mitra,
            'modified_at' => date('Y-m-d H:i:s'),
            'operator' => session('username')
        ];
        $this->db->table('pembangunan_strategis')->update($data, ['id' => $id]);

        // Get data penguatan fungsi
        $pembangunanStrategis = $this->db->table('pembangunan_strategis')->getWhere(['id' => $id])->getRow();
        // ***** Proses simpan cover  *****
        // $cover = $this->request->getFile('cover');
        // if ($cover != "") {
        //     // Validasi untuk cover apakah sesuai
        //     if (!$this->validate(
        //         ['rules' => 'uploaded[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]']
        //     )) {
        //         session()->setFlashdata('error', 'Periksa ekstensi cover [jpg,jpeg,png,gif]');
        //         return redirect()->to('kerja_sama/pembangunan_strategis/edit/' . $id);
        //     } else {
        //         // Hapus dulu file lama
        //         if (!empty($pembangunanStrategis->gambar_cover)) {
        //             unlink('uploads/pembangunan_strategis/cover/' . $pembangunanStrategis->gambar_cover);
        //         }

        //         // Pindahkan filenya sesuai path
        //         $nama_fileCover = $cover->getRandomName();
        //         $uploadCover = $cover->move('uploads/pembangunan_strategis/cover/', $nama_fileCover);
        //         if (!$uploadCover) {
        //             session()->setFlashdata('error', 'Gagal menyimpan foto');
        //         } else {
        //             $this->db->table('pembangunan_strategis')->update(['gambar_cover' => $nama_fileCover], ['id' => $id]);
        //         }
        //     }
        // }
        // ***** Proses simpan cover  End *****

        // ***** Proses simpan file  *****
        $file_surat_pks = $this->request->getFile('file_surat_pks');
        if ($surat_pks != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_surat_pks)) {
                unlink('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_surat_pks);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_surat_pks', $file_surat_pks, 'File Surat Persetujuan PKS', 'file_surat_pks', $id);
        }

        $file_pks = $this->request->getFile('file_pks');
        if ($file_pks != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_pks)) {
                unlink('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_pks);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_pks', $file_pks, 'Dokumen PKS', 'file_pks', $id);
        }

        $file_rpp = $this->request->getFile('file_rpp');
        if ($file_rpp != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_rpp)) {
                unlink('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rpp);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rpp', $file_rpp, 'Dokumen RPP', 'file_rpp', $id);
        }

        $file_rkl_1 = $this->request->getFile('file_rkl_1');
        if ($file_rkl_1 != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_rkl_1)) {
                unlink('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rkl_1);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rkl_1', $file_rkl_1, 'Dokumen RKL 1', 'file_rkl_1', $id);
        }

        $file_rkl_2 = $this->request->getFile('file_rkl_2');
        if ($file_rkl_2 != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_rkl_2)) {
                unlink('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rkl_2);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rkl_2', $file_rkl_2, 'Dokumen RKL 2', 'file_rkl_2', $id);
        }

        $file_rkt = $this->request->getFile('file_rkt');
        if ($file_rkt != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_rkt)) {
                unlink('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rkt);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis('file_rkt', $file_rkt, 'Dokumen RKT', 'file_rkt', $id);
        }
        // ***** Proses simpan file End *****

        // ***** Proses simpan file RKT *****
        $fileRKT = $this->request->getFileMultiple('file_rkt');
        //dd($fotoKerjaSama);
        if (!empty($fileRKT)) {
            // Hapus dulu file nya baru dimasukkan ulang yg baru
            $get_dataFile = $this->db->table('rkt_penguatan_fungsi')->getWhere(['id_penguatan_fungsi' => $id])->getResult();
            if (!empty($get_dataFile)) {
                foreach ($get_dataFile as $data) {
                    unlink('uploads/pembangunan_strategis/file/' . $data->file_rkt);
                }
            }
            $this->db->table('rkt_penguatan_fungsi')->delete(['id_penguatan_fungsi' => $id]);

            $index = 0;
            foreach ($fileRKT as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $namaFile = $file->getRandomName();
                    $uploadFile = $file->move('uploads/pembangunan_strategis/file/', $namaFile);
                    if (!$uploadFile) {
                        echo session()->setFlashdata('error', 'Gagal menyimpan file RKT');
                    } else {
                        $data = [
                            'id_penguatan_fungsi' => $id,
                            'nama_rkt' => $this->request->getPost('nama_rkt')[$index],
                            'file_rkt' => $namaFile,
                            'komitmen_rkt' => $this->request->getPost('komitmen_rkt')[$index],
                            'realisasi_rkt' => $this->request->getPost('realisasi_rkt')[$index],
                        ];
                        $this->db->table('rkt_penguatan_fungsi')->insert($data);
                        $index++;
                    }
                }
            }
        }
        // ***** Proses simpan file RKT End *****

        $file_lokasi = $this->request->getFile('file_lokasi');
        if ($file_lokasi != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_lokasi)) {
                unlink('uploads/penguatan_fungsi/file/' . $pembangunanStrategis->file_lokasi);
            }

            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_lokasi_pembangunan_strategis('file_lokasi', $file_lokasi, 'File Lokasi Kerja Sama', 'file_lokasi', $id);
        }

        return redirect()->to('kerja_sama/pembangunan_strategis');
    }

    public function pembangunan_strategis_process_delete()
    {
        $id = $this->request->getPost('id');
        // Proses delete foto dokumentasi
        // $get_dataFoto = $this->db->table('dokumentasi_pembangunan_strategis')->getWhere(['id_pembangunan_strategis' => $id])->getResult();
        // if (!empty($get_dataFoto)) {
        //     foreach ($get_dataFoto as $foto) {
        //         unlink('uploads/pembangunan_strategis/dokumentasi/' . $foto->gambar);
        //     }
        // }
        // $this->db->table('dokumentasi_pembangunan_strategis')->delete(['id_pembangunan_strategis' => $id]);

        // Proses delete file RKT
        $get_dataRKT = $this->db->table('rkt_pembangunan_strategis')->getWhere(['id_pembangunan_strategis' => $id])->getResult();
        if (!empty($get_dataRKT)) {
            foreach ($get_dataRKT as $rkt) {
                unlink('uploads/pembangunan_strategis/file/' . $rkt->file_rkt);
            }
        }
        $this->db->table('rkt_pembangunan_strategis')->delete(['id_pembangunan_strategis' => $id]);

        // Proses hapus pembangunan strategis
        $hapus = $this->db->table('pembangunan_strategis')->delete(['id' => $id]);
        // var_dump($hapus);exit;
        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
        }
        return redirect()->to('kerja_sama/pembangunan_strategis');
    }
    //=======[End Data pembangunan strategis]============


    //=======[Data penguatan fungsi SKW]============
    public function penguatan_fungsi_skw()
    {
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['kerja_sama'] = $model->penguatan_fungsi_skw();
        return view('kerja_sama_skw/penguatan_fungsi', $data);
    }

    public function penguatan_fungsi_skw_add()
    {
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['mitra'] = $this->db->table('mitra')->getWhere(['jenis_lokasi' => session('level')])->getResult();
        $data['rkt'] = $this->db->table('rkt_penguatan_fungsi')->get()->getResult();
        return view('kerja_sama_skw/penguatan_fungsi_add', $data);
    }

    public function getmitra($skw = null)
    {
        if ($skw) {
            $list = $this->db->table('mitra')->getWhere(['jenis_lokasi' => session('level')])->getResult();
            echo json_encode($list);
        } else {
            $searchTerm = $this->request->getGet('q');
            if ($searchTerm) {
                $list = $this->db->table('mitra')->like('nama_mitra', $searchTerm)->get()->getResult();
            } else {
                $list = $this->db->table('mitra')->get()->getResult();
            }
            echo json_encode($list);
        }
    }

    public function penguatan_fungsi_skw_process_add()
    {
        $mitra = $this->request->getPost('mitra');
        $rkt = $this->request->getPost('rkt');
        $judul = $this->request->getPost('judul');


        $data = [
            'lokasi' => session('level'),
            'id_mitra' => $mitra,
            'id_rkt' => $rkt,
            'judul_laporan' => $judul,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($data);
        $this->db->table('penguatan_fungsi_skw')->insert($data);
        $lastID = $this->db->insertID();


        // ***** Proses simpan file  *****
        $file_laporan = $this->request->getFile('file_laporan');
        if ($file_laporan != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi_skw('file_laporan', $file_laporan, 'Laporan Kerja Sama', 'file_laporan', $lastID);
        }

        $file_spt = $this->request->getFile('file_spt');
        if ($file_spt != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi_skw('file_spt', $file_spt, 'File SPT', 'file_spt', $lastID);
        }

        // ***** Proses simpan file End *****

        // ***** Proses simpan file dokumentasi *****
        if ($this->request->getFileMultiple('file_dokumentasi')) {
            $index = 0;
            foreach ($this->request->getFileMultiple('file_dokumentasi') as $file) {
                // Pindahkan filenya sesuai path
                $namaFile = $file->getRandomName();
                $uploadFile = $file->move('uploads/penguatan_fungsi_skw/dokumentasi/', $namaFile);
                if (!$uploadFile) {
                    echo session()->setFlashdata('error', 'Gagal menyimpan foto dokumentasi');
                } else {
                    $data = [
                        'id_penguatan_fungsi_skw' => $lastID,
                        'gambar' => $namaFile,
                    ];
                    $this->db->table('dokumentasi_penguatan_fungsi_skw')->insert($data);
                }
                $index++;
            }
        }
        // ***** Proses simpan file dokumentasi End *****
        return redirect()->to('kerja_sama/penguatan_fungsi_skw');
    }

    public function penguatan_fungsi_skw_edit($id)
    {
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['mitra'] = $this->db->table('mitra')->getWhere(['jenis_lokasi' => session('level')])->getResult();
        $data['rkt'] = $this->db->table('rkt_penguatan_fungsi')->get()->getResult();
        $data['penguatanFungsi'] = $this->db->table('penguatan_fungsi_skw')->getWhere(['id' => $id])->getRow();
        $data['dokumentasi'] = $this->db->table('dokumentasi_penguatan_fungsi_skw')->getWhere(['id_penguatan_fungsi_skw' => $id])->getResult();
        return view('kerja_sama_skw/penguatan_fungsi_edit', $data);
    }

    public function penguatan_fungsi_skw_process_edit()
    {
        $id = $this->request->getPost('id');
        $mitra = $this->request->getPost('mitra');
        $rkt = $this->request->getPost('rkt');
        $judul = $this->request->getPost('judul');


        $data = [
            'lokasi' => session('level'),
            'id_mitra' => $mitra,
            'id_rkt' => $rkt,
            'judul_laporan' => $judul,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($data);
        $this->db->table('penguatan_fungsi_skw')->update($data, ['id' => $id]);

        // Get data penguatan fungsi skw
        $penguatanFungsi = $this->db->table('penguatan_fungsi_skw')->getWhere(['id' => $id])->getRow();

        // ***** Proses simpan file  *****
        $file_laporan = $this->request->getFile('file_laporan');
        if ($file_laporan != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_laporan)) {
                unlink('uploads/penguatan_fungsi_skw/file/' . $penguatanFungsi->file_laporan);
            }

            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi_skw('file_laporan', $file_laporan, 'Laporan Kerja Sama', 'file_laporan', $id);
        }

        $file_spt = $this->request->getFile('file_spt');
        if ($file_spt != "") {
            // Hapus dulu file lama
            if (!empty($penguatanFungsi->file_spt)) {
                unlink('uploads/penguatan_fungsi_skw/file/' . $penguatanFungsi->file_spt);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_penguatan_fungsi_skw('file_spt', $file_spt, 'File SPT', 'file_spt', $id);
        }

        // ***** Proses simpan file End *****

        // ***** Proses simpan file dokumentasi *****
        $file_dokumentasi = $this->request->getFileMultiple('file_dokumentasi');
        //dd($fotoKerjaSama);
        if (!empty($file_dokumentasi)) {
            // Hapus dulu file nya baru dimasukkan ulang yg baru
            $get_dataFile = $this->db->table('dokumentasi_penguatan_fungsi_skw')->getWhere(['id_penguatan_fungsi_skw' => $id])->getResult();
            if (!empty($get_dataFile)) {
                foreach ($get_dataFile as $data) {
                    unlink('uploads/penguatan_fungsi_skw/dokumentasi/' . $data->gambar);
                }
            }
            $this->db->table('dokumentasi_penguatan_fungsi_skw')->delete(['id_penguatan_fungsi_skw' => $id]);

            $index = 0;
            foreach ($file_dokumentasi as $file) {
                // Pindahkan filenya sesuai path
                $namaFile = $file->getRandomName();
                $uploadFile = $file->move('uploads/penguatan_fungsi_skw/dokumentasi/', $namaFile);
                if (!$uploadFile) {
                    echo session()->setFlashdata('error', 'Gagal menyimpan foto dokumentasi');
                } else {
                    $data = [
                        'id_penguatan_fungsi_skw' => $id,
                        'gambar' => $namaFile,
                    ];
                    $this->db->table('dokumentasi_penguatan_fungsi_skw')->insert($data);
                }
                $index++;
            }
        }
        // ***** Proses simpan file dokumentasi End *****
        return redirect()->to('kerja_sama/penguatan_fungsi_skw');
    }

    function upload_file_penguatan_fungsi_skw($nameForm, $fileSurat, $label, $field, $lastID)
    {
        // dd([$nameForm, $fileSurat, $label, $field, $lastID]);
        // Validasi untuk file apakah sesuai
        if (!$this->validate(
            ['rules' => 'uploaded[' . $nameForm . ']|mime_in[' . $nameForm . ',application/pdf]']
        )) {
            session()->setFlashdata('error', 'Periksa ekstensi file ' . $label . ', harus [pdf]');
            return redirect()->to('kerja_sama/penguatan_fungsi_skw/add');
        } else {
            // Pindahkan filenya sesuai path
            $nama_fileSurat = $fileSurat->getRandomName();
            $uploadFileSurat = $fileSurat->move('uploads/penguatan_fungsi_skw/file/', $nama_fileSurat);
            if (!$uploadFileSurat) {
                session()->setFlashdata('error', 'Gagal menyimpan file ' . $label);
                return redirect()->to('kerja_sama/penguatan_fungsi_skw/add');
            } else {
                $this->db->table('penguatan_fungsi_skw')->update(['' . $field . '' => $nama_fileSurat], ['id' => $lastID]);
                return TRUE;
            }
        }
    }

    public function penguatan_fungsi_skw_process_delete()
    {
        $id = intval($this->request->getPost('id'));

        // dd($id);
        // Proses delete foto dokumentasi
        $get_dataFoto = $this->db->table('dokumentasi_penguatan_fungsi_skw')->getWhere(['id_penguatan_fungsi_skw' => $id])->getResult();
        if (!empty($get_dataFoto)) {
            foreach ($get_dataFoto as $foto) {
                unlink('uploads/penguatan_fungsi_skw/dokumentasi/' . $foto->gambar);
            }
        }
        $this->db->table('dokumentasi_penguatan_fungsi_skw')->delete(['id_penguatan_fungsi_skw' => $id]);

        // Proses delete file penguatan fungsi skw
        // Get data penguatan fungsi skw
        $penguatanFungsi = $this->db->table('penguatan_fungsi_skw')->getWhere(['id' => $id])->getRow();

        if (!empty($penguatanFungsi->file_laporan)) {
            unlink('uploads/penguatan_fungsi_skw/file/' . $penguatanFungsi->file_laporan);
        }
        if (!empty($penguatanFungsi->file_spt)) {
            unlink('uploads/penguatan_fungsi_skw/file/' . $penguatanFungsi->file_spt);
        }

        // Proses hapus penguatan fungsi skw
        $hapus =  $this->db->table('penguatan_fungsi_skw')->delete(['id' => $id]);
        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
        }
        return redirect()->to('kerja_sama/penguatan_fungsi_skw');
    }
    //=======[Data penguatan fungsi SKW END]============

    //=======[Data pembangunan strategis SKW]============
    public function pembangunan_strategis_skw()
    {
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['kerja_sama'] = $model->pembangunan_strategis_skw();
        // var_dump($data['kerja_sama']);
        return view('kerja_sama_skw/pembangunan_strategis', $data);
    }

    public function pembangunan_strategis_skw_add()
    {
        $data['title'] = 'Kerja Sama';
        $data['mitra'] = $this->db->table('mitra')->getWhere(['jenis_lokasi' => session('level')])->getResult();
        // dd($data['mitra']);
        return view('kerja_sama_skw/pembangunan_strategis_add', $data);
    }

    public function getRuangLingkup()
    {
        $idMitra = $this->request->getGet('id_mitra');
        $model = new M_kerja_sama();
        $ruangLingkup = $model->getRuangLingkupByMitra($idMitra);
        // dd($ruangLingkup);
        return $this->response->setJSON($ruangLingkup);
    }
    public function getKegiatan()
    {
        $idRuling = $this->request->getGet('id_ruling');
        $model = new M_kerja_sama();
        $kegiatan = $model->getKegiatanByRuangLingkup($idRuling);
        return $this->response->setJSON($kegiatan);
    }


    public function getrkt()
    {
        $idMitra = intval($this->request->getGet('mitra'));
        $model = new M_kerja_sama();
        $rktData = $model->getrkt($idMitra);
        // var_dump($rktData);exit;
        return $this->response->setJSON($rktData);
    }

    public function pembangunan_strategis_skw_process_add()
    {
        $mitra = $this->request->getPost('mitra');
        $rkt = $this->request->getPost('rkt');
        $judul = $this->request->getPost('judul');


        $data = [
            'lokasi' => session('level'),
            'id_mitra' => $mitra,
            'id_rkt' => $rkt,
            'judul_laporan' => $judul,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($data);
        $this->db->table('pembangunan_strategis_skw')->insert($data);
        $lastID = $this->db->insertID();


        // ***** Proses simpan file  *****
        $file_laporan = $this->request->getFile('file_laporan');
        if ($file_laporan != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis_skw('file_laporan', $file_laporan, 'Laporan Kerja Sama', 'file_laporan', $lastID);
        }

        $file_spt = $this->request->getFile('file_spt');
        if ($file_spt != "") {
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis_skw('file_spt', $file_spt, 'File SPT', 'file_spt', $lastID);
        }

        // ***** Proses simpan file End *****

        // ***** Proses simpan file dokumentasi *****
        $fileDokumentasi = $this->request->getFileMultiple('file_dokumentasi');

        if (!empty($fileDokumentasi)) {
            $index = 0;

            foreach ($fileDokumentasi as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $namaFile = $file->getRandomName();
                    $uploadFile = $file->move('uploads/pembangunan_strategis_skw/dokumentasi/', $namaFile);

                    if (!$uploadFile) {
                        echo session()->setFlashdata('error', 'Gagal menyimpan foto dokumentasi');
                    } else {
                        $data = [
                            'id_pembangunan_strategis_skw' => $lastID,
                            'gambar' => $namaFile,
                        ];
                        $this->db->table('dokumentasi_pembangunan_strategis_skw')->insert($data);
                    }
                }

                $index++;
            }
        }

        // ***** Proses simpan file dokumentasi End *****
        return redirect()->to('kerja_sama/pembangunan_strategis_skw');
    }

    public function pembangunan_strategis_skw_edit($id)
    {
        // dd($id);
        $model = new M_kerja_sama();
        $data['title'] = 'Kerja Sama';
        $data['mitra'] = $this->db->table('mitra')->getWhere(['jenis_lokasi' => session('level')])->getResult();
        $data['rkt'] = $this->db->table('rkt_pembangunan_strategis')->get()->getResult();
        $data['pembangunanStrategis'] = $this->db->table('pembangunan_strategis_skw')->getWhere(['id' => $id])->getRow();
        $data['dokumentasi'] = $this->db->table('dokumentasi_pembangunan_strategis_skw')->getWhere(['id_pembangunan_strategis_skw' => $id])->getResult();
        return view('kerja_sama_skw/pembangunan_strategis_edit', $data);
    }

    public function pembangunan_strategis_skw_process_edit()
    {
        $id = $this->request->getPost('id');
        $mitra = $this->request->getPost('mitra');
        $rkt = $this->request->getPost('rkt');
        $judul = $this->request->getPost('judul');


        $data = [
            'lokasi' => session('level'),
            'id_mitra' => $mitra,
            'id_rkt' => $rkt,
            'judul_laporan' => $judul,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($data);
        $this->db->table('pembangunan_strategis_skw')->update($data, ['id' => $id]);

        // Get data penguatan fungsi skw
        $pembangunanStrategis = $this->db->table('pembangunan_strategis_skw')->getWhere(['id' => $id])->getRow();

        // ***** Proses simpan file  *****
        $file_laporan = $this->request->getFile('file_laporan');
        if ($file_laporan != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_laporan)) {
                unlink('uploads/pembangunan_strategis_skw/file/' . $pembangunanStrategis->file_laporan);
            }

            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis_skw('file_laporan', $file_laporan, 'Laporan Kerja Sama', 'file_laporan', $id);
        }

        $file_spt = $this->request->getFile('file_spt');
        if ($file_spt != "") {
            // Hapus dulu file lama
            if (!empty($pembangunanStrategis->file_spt)) {
                unlink('uploads/pembangunan_strategis_skw/file/' . $pembangunanStrategis->file_spt);
            }
            //Parameter (nama form,variabel file,label untuk validasi,field didatabase, ID baris database yg akan diupdate)
            $this->upload_file_pembangunan_strategis_skw('file_spt', $file_spt, 'File SPT', 'file_spt', $id);
        }

        // ***** Proses simpan file End *****

        // ***** Proses simpan file dokumentasi *****
        $fileDokumentasi = $this->request->getFileMultiple('file_dokumentasi');
        // dd($fileDokumentasi);

        if (!empty($fileDokumentasi)) {
            // Hapus dulu file yang ada sebelumnya
            $getDataFile = $this->db->table('dokumentasi_pembangunan_strategis_skw')->getWhere(['id_pembangunan_strategis_skw' => $id])->getResult();

            if (!empty($getDataFile)) {
                foreach ($getDataFile as $data) {
                    unlink('uploads/pembangunan_strategis_skw/dokumentasi/' . $data->gambar);
                }
            }

            $this->db->table('dokumentasi_pembangunan_strategis_skw')->delete(['id_pembangunan_strategis_skw' => $id]);

            $index = 0;

            foreach ($fileDokumentasi as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $namaFile = $file->getRandomName();
                    $uploadFile = $file->move('uploads/pembangunan_strategis_skw/dokumentasi/', $namaFile);

                    if (!$uploadFile) {
                        echo session()->setFlashdata('error', 'Gagal menyimpan foto dokumentasi');
                    } else {
                        $data = [
                            'id_pembangunan_strategis_skw' => $id,
                            'gambar' => $namaFile,
                        ];
                        $this->db->table('dokumentasi_pembangunan_strategis_skw')->insert($data);
                    }
                }

                $index++;
            }
        }

        // ***** Proses simpan file dokumentasi End *****
        return redirect()->to('kerja_sama/pembangunan_strategis_skw');
    }

    function upload_file_pembangunan_strategis_skw($nameForm, $fileSurat, $label, $field, $lastID)
    {
        // dd([$nameForm, $fileSurat, $label, $field, $lastID]);
        // Validasi untuk file apakah sesuai
        if (!$this->validate(
            ['rules' => 'uploaded[' . $nameForm . ']|mime_in[' . $nameForm . ',application/pdf]']
        )) {
            session()->setFlashdata('error', 'Periksa ekstensi file ' . $label . ', harus [pdf]');
            return redirect()->to('kerja_sama/pembangunan_strategis_skw/add');
        } else {
            // Pindahkan filenya sesuai path
            $nama_fileSurat = $fileSurat->getRandomName();
            $uploadFileSurat = $fileSurat->move('uploads/pembangunan_strategis_skw/file/', $nama_fileSurat);
            if (!$uploadFileSurat) {
                session()->setFlashdata('error', 'Gagal menyimpan file ' . $label);
                return redirect()->to('kerja_sama/pembangunan_strategis_skw/add');
            } else {
                $this->db->table('pembangunan_strategis_skw')->update(['' . $field . '' => $nama_fileSurat], ['id' => $lastID]);
                return TRUE;
            }
        }
    }

    public function pembangunan_strategis_skw_process_delete()
    {
        $id = intval($this->request->getPost('id'));

        // dd($id);
        // Proses delete foto dokumentasi
        $get_dataFoto = $this->db->table('dokumentasi_pembangunan_strategis_skw')->getWhere(['id_pembangunan_strategis_skw' => $id])->getResult();
        if (!empty($get_dataFoto)) {
            foreach ($get_dataFoto as $foto) {
                unlink('uploads/pembangunan_strategis_skw/dokumentasi/' . $foto->gambar);
            }
        }
        $this->db->table('dokumentasi_pembangunan_strategis_skw')->delete(['id_pembangunan_strategis_skw' => $id]);

        // Proses delete file penguatan fungsi skw
        // Get data penguatan fungsi skw
        $pembangunanStrategis = $this->db->table('pembangunan_strategis_skw')->getWhere(['id' => $id])->getRow();

        if (!empty($pembangunanStrategis->file_laporan)) {
            unlink('uploads/pembangunan_strategis_skw/file/' . $pembangunanStrategis->file_laporan);
        }
        if (!empty($pembangunanStrategis->file_spt)) {
            unlink('uploads/pembangunan_strategis_skw/file/' . $pembangunanStrategis->file_spt);
        }

        // Proses hapus penguatan fungsi skw
        $hapus =  $this->db->table('pembangunan_strategis_skw')->delete(['id' => $id]);
        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
        }
        return redirect()->to('kerja_sama/pembangunan_strategis_skw');
    }
    //=======[Data pembangunan strategis SKW END]============
}
